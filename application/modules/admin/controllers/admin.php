<?php

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		$this->load->library('auth');
		$this->load->library('pagination');
		$this->load->library('sitemap');
		$this->load->library('rss');
		$this->load->model('admin_model');
		$this->load->model('page/page_model');
		parse_str($_SERVER['QUERY_STRING'],$_GET);
	}
	
/*****************************************************************************************************************************************
/*	LOGIN Page
*****************************************************************************************************************************************/
	function index() {

		if(isset($_SESSION['uid']) && $_SESSION['uid'] != '') { 
			redirect('admin/home');
		}

		$data['page_title'] = 'Administration Login';
		$data['hide_navigation'] = TRUE;
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		$data['redirected_from'] = ($this->input->get('redirect') != '') ? $this->input->get('redirect') : '';
		
		if ($this->form_validation->run() == FALSE) {
			$data['page_content'] = 'admin_login';
			$this->load->view('admin_template', $data);
		} else {
			if ($this->input->post('login_submitted') != FALSE)
			{
				$username = htmlspecialchars($this->input->post('username'), ENT_QUOTES, 'UTF-8');
				$login = array($username, $this->input->post('password'));
				$data['user_array'] = $this->auth->process_login($login, TRUE, $data['redirected_from']);
				if($data['user_array'] != FALSE) {
					$this->load->view('admin_session', $data);
				} else {
					$data['error'] = 'Login failed, please try again';
					$data['page_content'] = 'admin_login';
					$this->load->view('admin_template', $data);
				}
			}
		}
	}
	
	
/*****************************************************************************************************************************************
/*	PASSWORD REQUEST Page
/*	This controls the requesting of a forgotten password from the login page
/*	Action handles the forcing of them to update their password before they can continue on in admin
/*	NOTE: This is different from PROFILE section password handling.
*****************************************************************************************************************************************/

	function password($action = NULL, $user_id = NULL) {
		$data['page_title'] = 'Administration Password Request';
		$data['hide_navigation'] = TRUE;
		
		if($action == NULL) {
		
			$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				$data['page_content'] = 'admin_password';
				$this->load->view('admin_template', $data);
				
			} else {
				$temp_password = $this->admin_model->forgot_reset_password($_POST);
				$to_email = $this->input->post('username');
				if($temp_password) {
					//send email with reset link
					$this->load->library('email');
					
					//Auto Response to contactor
					$this->email->from($this->config->item('global_email_from'),$this->config->item('global_email_name'));
					$this->email->to($to_email);
					$this->email->subject('Forgotten Password Reset');
					$message = "Your password has been reset to the following: " . $temp_password . ". Please log in to the admin and you will be prompted to create a new password";
					
					$this->email->message($message);
					$this->email->send();
					
					$this->session->set_flashdata('status_message','<div class="success">Password has been reset successfully. Please check your email.</div>');
					redirect('admin/password');
				
				} else {
					$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error resetting this password. Verify username and try again.</p></div>');
					redirect('admin/password');
				}
			}
		} else {
			
			switch($action) {
			
				case 'update':
					$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password_confirm]');
					$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'trim|required|xss_clean');
					$data['user_id'] = $user_id;
					$data['user_data_array'] = $this->admin_model->get_user_by_id($user_id);
					
					if ($this->form_validation->run() == FALSE) {
						$data['page_title'] = 'Users - Update Password';
						$data['page_content'] = 'admin_password_update';
					} else {
						$update = $this->admin_model->update_user_password($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Password has been updated successfully</div>');
							$this->session->set_userdata('change_password','no');
							redirect('admin/profile/update-password/' . $user_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this user. Please try again.</p></div>');
							redirect('admin/profile/update-password/' . $user_id);
						}
					}
					$this->load->view('admin_template', $data);
					break;
			}
		
		}
	}
	
/*****************************************************************************************************************************************
/*	HOME Page
/****************************************************************************************************************************************/
	function home() {
		$this->auth->restrict(FALSE, '1');
		$data['page_title'] = 'Administration Home';
		$data['page_content'] = 'admin_home';
		$data['current_section'] = 'home';
		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	PROFILE Page
/*	Controls the updating of ones password for the admin section when they are already logged in
/*	Note: This is different that the Forgotten Password Reset/Retrieval as well as the ADMIN USER reset password
/****************************************************************************************************************************************/

	function profile($action, $user_id) {
		$this->auth->restrict(FALSE, '1');
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirm', 'trim|required|xss_clean');
		$data['user_id'] = $user_id;
		$data['user_data_array'] = $this->admin_model->get_user_by_id($user_id);
		
		if ($this->form_validation->run() == FALSE) {
			$data['page_title'] = 'Users - Update Password';
			$data['page_content'] = 'admin_profile_password';
		} else {
			$update = $this->admin_model->update_user_password($_POST);
			if($update) {
				$this->session->set_flashdata('status_message','<div class="success">Password has been updated successfully</div>');
				redirect('admin/profile/update-password/' . $user_id);
			} else {
				$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this user. Please try again.</p></div>');
				redirect('admin/profile/update-password/' . $user_id);
			}
		}
		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	CMS Images Page
/*	Generates a JS file for TinyMCE available images
/*	
/****************************************************************************************************************************************/
	 function image_list() {
	 	$this->admin_model->generate_image_list();
	 }

	
/*****************************************************************************************************************************************
/*	USERS Page
/*	Controls the add/edit/delete/permissions for users
/*	@ Restricted to only SUPER ADMIN and ADMIN level users
/*	Note: This has its own version of a password reset for any user, which is different from 
/*	the general forgot and update password methods of password() and profile($password)
/****************************************************************************************************************************************/

	function users($action = NULL, $user_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'users';
		$data['permission_array'] = array(
			1 => 'Admin',
			3 => 'General User'
		);
		
		if($action == NULL) {
			$data['page_title'] = 'Users';
			$user_listing_array = $this->admin_model->get_all_users();
			$data['user_listing_array'] = $user_listing_array;
			$data['page_content'] = 'admin_users_list';
		
		} else {
		
			switch($action) {
				
				case 'add':
					$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('permission_level', 'Permission Level', 'required');
					$this->form_validation->set_rules('username', 'E-mail Address', 'trim|required|valid_email|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
					if ($this->form_validation->run() == FALSE) {
						$data['page_title'] = 'Users - Add User';
						$data['page_content'] = 'admin_users_add';
					} else {
						$insert_id = $this->admin_model->add_user($_POST);
						if($insert_id != FALSE) {
							$this->session->set_flashdata('status_message','<div class="success">User has been added successfully</div>');
							redirect('admin/users');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this user. Please try again.</p></div>');
							redirect('admin/users');
						}
					}
					break;
					
				case 'update':
					$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('permission_level', 'Permission Level', 'required');
					$this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email|xss_clean');
					$this->form_validation->set_rules('user_status', 'User Status', 'required');
					$data['user_id'] = $user_id;
					$data['user_data_array'] = $this->admin_model->get_user_by_id($user_id);
					if ($this->form_validation->run() == FALSE) {
						$data['page_title'] = 'Users - Update User';
						$data['page_content'] = 'admin_users_update';
					} else {
						$update = $this->admin_model->update_user($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">User has been updated successfully</div>');
							redirect('admin/users/update/' . $user_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this user. Please try again.</p></div>');
							redirect('admin/users/update/' . $user_id);
						}
					}
					break;
					
				case 'reset-password':
					if($user_id == NULL) {
						redirect('/admin/users');
					} else {

						$temp_password = $this->admin_model->reset_password($user_id);
						$user_email = $this->admin_model->get_user_email($user_id);
						if($temp_password) {
							//send email with reset link
							$this->load->library('email');
							
							//Auto Response to contactor
							$this->email->from($this->config->item('global_email_from'),$this->config->item('global_email_name'));
							$this->email->to($user_email);
							//$this->email->bcc('dev@wrayward.com');
							$this->email->subject('Password Reset');
							$message = "Your password has been reset to the following: " . $temp_password . ". Please log in to the admin and you will be prompted to create a new password";
							
							$this->email->message($message);
							$this->email->send();
							
							$this->session->set_flashdata('status_message','<div class="success">Password has been reset successfully</div>');
							redirect('admin/users/update/' . $user_id);
						
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error resetting this password. Please try again.</p></div>');
							redirect('admin/users/update/' . $user_id);
						}
					}
					break;
					
				case 'delete':

					$data_array = array('user_id' => $user_id);
					$delete = $this->admin_model->delete_user($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">User has been deleted successfully.</div>');
						redirect('admin/users');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this user. Please try again.</p></div>');
						redirect('admin/users');
					}
					break;
					
				
			}
		}
		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	PAGES Page
/*	Controls the add/edit/delete/order functionality for site pages
/****************************************************************************************************************************************/
	function pages($action = NULL, $page_id = NULL, $page_type = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'pages';
		
		if($action == NULL) {
			$data['page_title'] = 'Pages';
			if($this->input->post('page_status') != FALSE && $this->input->post('page_status') != '') {
				$page_status = $this->input->post('page_status');
				$data['page_status'] = $page_status;
			} else {
				$page_status = NULL;
				$data['page_status'] = NULL;
			}
			$data['primary_nav_array'] = $this->admin_model->get_primary_nav_array($page_status);
			$data['footer_nav_array'] = $this->admin_model->get_footer_nav_array($page_status);
			$data['global_page_array'] = $this->admin_model->get_global_page_array($page_status);
			$data['page_content'] = 'admin_pages_list';
		} else {
			$data['document_dropdown_array'] = $this->admin_model->get_document_dropdown();
			
			switch($action) {
				
				case 'add':
					$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_url', 'Page URL', 'trim|xss_clean');
					$this->form_validation->set_rules('page_headline', 'Page Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('primary_category_id', 'Section', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_content', 'Page Content', 'trim|xss_clean');
					$this->form_validation->set_rules('meta_description', '', 'trim|xss_clean');
					$this->form_validation->set_rules('meta_title', '', 'trim|xss_clean');
					$this->form_validation->set_rules('meta_keywords', 'trim|xss_clean', '');
					$this->form_validation->set_rules('secondary_category_id', '', '');
	
					if ($this->form_validation->run() == FALSE) {
						$data['page_title'] = 'Add Page';
						
						//Primary Nav Array for Section Dropdown
						$data['primary_nav_array'] = $this->admin_model->get_primary_nav_array('active');
						$data['page_content'] = 'admin_pages_add';
					} else {
						$insert_id = $this->admin_model->add_page($_POST);
						if($insert_id != FALSE) {
							$this->session->set_flashdata('status_message','<div class="success">Your page has been added. You may click to <a href="">view the live page</a></div>');
							//$this->sitemap->generate();
							redirect('admin/pages/edit/' . $insert_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
							redirect('admin/pages/add');
						}
					}
					break;
					
				case 'update':
					$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_url', 'Page URL', 'trim|xss_clean');
					$this->form_validation->set_rules('page_status', 'Page Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_headline', 'Page Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_content', 'Page Content', 'trim|xss_clean');
					$this->form_validation->set_rules('primary_category_id', 'Section', 'trim|required|xss_clean');
					$this->form_validation->set_rules('meta_description', '', 'trim|xss_clean');
					$this->form_validation->set_rules('meta_title', '', 'trim|xss_clean');
					$this->form_validation->set_rules('meta_keywords', '', 'trim|xss_clean');
					$this->form_validation->set_rules('secondary_category_id', '', '');
					
					$children_array = $this->admin_model->get_page_childen($page_id);
					$data['page_url_string'] = $this->admin_model->get_url_path($page_id);
					
					if ($this->form_validation->run() == FALSE) {
						$data['page_id'] = $page_id;
						$data['page_data_array'] = $this->admin_model->get_page_data_array($page_id);
						$data['children_array'] = $children_array;
						//Primary Nav Array for Section Dropdown
						$data['primary_nav_array'] = $this->admin_model->get_primary_nav_array('active');
						$data['page_title'] = 'Update Page';
						$data['page_content'] = 'admin_pages_update';
					} else {
						$data_array = $_POST;
						$update = $this->admin_model->update_page($data_array);
						if($update) {
							//Check to see if page is inactive, and if it has children pages, de-activate them
							if($this->input->post('page_status') == 'inactive' && count($children_array) > 0) {
								$update2 = $this->admin_model->deactivate_children($children_array);
								if($update2) {
									$this->session->set_flashdata('status_message','<div class="success">Your page has been updated.</div>');
									//$this->sitemap->generate();
									redirect('admin/pages/update/' . $page_id);
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this page. Please try again.</p></div>');
									redirect('admin/pages/update/' . $page_id);
								}
							//Page has no children, and update was successful, redirect
							} else {
								//If page is set to inactive, just say it was updated
								if($this->input->post('page_status') == 'inactive') {
									$this->session->set_flashdata('status_message','<div class="success">Your page has been updated.</div>');
								} else {
									$live_url = $this->admin_model->get_url_path($page_id);
									$this->session->set_flashdata('status_message','<div class="success">Your page has been <span class="save_publish">saved and published</span>.</div>');
								}
								//$this->sitemap->generate();
								redirect('admin/pages/update/' . $page_id);	
							}
						}  else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this page. Please try again.</p></div>');
							redirect('admin/pages/update/' . $page_id);
						}
						
					}
					break;
					
				case 'add-draft':
					$data['page_id'] = $page_id;
					$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_headline', 'Page Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_content', 'Page Content', 'trim|xss_clean');
					if ($this->form_validation->run() == FALSE) {
						$data['page_title'] = 'Add Draft';
						$data['page_data_array'] = $this->admin_model->get_page_data_array($page_id);
						$data['page_content'] = 'admin_pages_add_draft';
					} else {
						$update = $this->admin_model->update_draft($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Your page has been <span class="save_draft">saved as a draft</span>. You may click to <a href="/preview/view/' . $page_id . '" target="_blank">preview the page</a></div>');
							//$this->sitemap->generate();
							redirect('admin/pages/update-draft/' . $page_id);
						}  else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
							redirect('admin/pages/add-draft/' . $page_id);
						}
					}
					
					break;
					
				case 'update-draft':
					$data['page_id'] = $page_id;
					$this->form_validation->set_rules('page_title', 'Page Title', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_headline', 'Page Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('page_content', 'Page Content', 'trim||xss_clean');
					if ($this->form_validation->run() == FALSE) {
						$data['page_data_array'] = $this->admin_model->get_page_data_array($page_id);
						$data['page_title'] = 'Update Draft';
						$data['page_content'] = 'admin_pages_update_draft';
					} else {
						switch($this->input->post('action_value')) {
							case 'save_draft':
								$update = $this->admin_model->update_draft($_POST);
								if($update) {
									$this->session->set_flashdata('status_message','<div class="success">Your page has been <span class="save_draft">saved as a draft</span>. You may click to <a href="/preview/view/' . $page_id . '" target="_blank">preview the page</a></div>');
									$this->sitemap->generate();
									redirect('admin/pages/update-draft/' . $page_id);
								}  else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
									redirect('admin/pages/add-draft/' . $page_id);
								}
								break;
							case 'publish':
								$update = $this->admin_model->update_draft_to_live($_POST);
								if($update) {
									$live_url = $this->admin_model->get_url_path($page_id);
									$this->session->set_flashdata('status_message','<div class="success">Your page has been <span class="save_publish">saved and published</span>. You may click to <a href="' . $live_url . '" target="_blank">view the live page</a></div>');
									//$this->sitemap->generate();
									redirect('admin/pages/update/' . $page_id);
								}  else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
									redirect('admin/pages/update-draft/' . $page_id);
								}
								break;
						}
					}
					
					break;
					
				case 'delete':
					$data_array = array('page_id' => $page_id);
					$delete = $this->admin_model->delete_page($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your page has been deleted successfully.</div>');
						$this->sitemap->generate();
						redirect('admin/pages/');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this page. Please try again.</p></div>');
						redirect('admin/pages/');
					}
					break;
					
				case 'reorder-sections':
					$data['page_title'] = 'Pages - Re-order Sections';
					$data['primary_nav_array'] = $this->admin_model->get_primary_nav_array();
					if($this->input->post('form_submitted') == 'yes') {
						$update = $this->admin_model->update_section_order($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Your sections have been re-ordered successfully</div>');
							$this->sitemap->generate();
							redirect('admin/pages/reorder-sections');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
							redirect('admin/pages/reorder-sections');
						}
					}
					$data['page_content'] = 'admin_reorder_sections';
					break;
					
				case 'reorder-pages':
					//Show Choose Section Pages
					if($page_id == NULL) {
						$data['page_title'] = 'Pages - Re-order Pages';
						$data['primary_nav_array'] = $this->admin_model->get_primary_nav_array();
						$data['footer_nav_array'] = $this->admin_model->get_footer_nav_array();
						$data['page_content'] = 'admin_reorder_pages_list';
					} else {
						$data['page_id'] = $page_id;
						$data['page_type'] = $page_type;
						$data['page_title'] = 'Pages - Re-order Pages';
						if($page_type == 'footer') {
							$nav_items_array = $this->admin_model->get_footer_nav_array();
						} else if($page_type == 'primary') {
							$nav_items_array = $this->admin_model->get_secondary_nav_array($page_id);
						} else {
							$nav_items_array = $this->admin_model->get_third_nav_array($page_id);	
						}
						$data['nav_items_array'] = $nav_items_array;
						if($this->input->post('form_submitted') == 'yes') {
							$update = $this->admin_model->update_section_order($_POST);
							if($update) {
								$this->session->set_flashdata('status_message','<div class="success">Your sections have been re-ordered successfully</div>');
								$this->sitemap->generate();
								redirect('admin/pages/reorder-pages/' . $page_id . '/' . $page_type);
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this page. Please try again.</p></div>');
								redirect('admin/pages/reorder-pages/' . $page_id . '/' . $page_type);
							}
						}
						$data['page_content'] = 'admin_reorder_pages';
					}
					break;
			}
		}
		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	IMAGES
/*	Controls the add/edit/delete functionality for image uploads
/****************************************************************************************************************************************/
	function images($action = NULL, $image_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'images';

		//Upload Pagination Config
		$config['base_url'] = '/admin/uploads/images/page/';
		$config['total_rows'] = $this->admin_model->get_total_image_count();
		$config['per_page'] = $this->config->item('admin_results_per_page');
		$config['num_links'] = 3;
		$config['uri_segment'] = 5;
		$config['prev_link'] = '&lt; Previous';
		$config['prev_tag_open'] = '<span class="previous_page">';
		$config['prev_tag_close'] = '</span>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<span class="next_page">';
		$config['next_tag_close'] = '</span>';

		if($action == NULL) {
			$data['page_title'] = 'Uploads - Images';
			$data['image_list_array'] = $this->admin_model->get_image_list(0, $this->config->item('admin_results_per_page'));
			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$data['page_links'] = $this->pagination->create_links();
			$data['page_content'] = 'admin_images_list';
		} else {
			switch($action) {
				case 'page':
					if($image_id == NULL || $image_id == '') {
						$page_number = 0;
					} else {
						$page_number = $image_id;
					}
					$data['page_title'] = 'Uploads - Images';
					$data['image_list_array'] = $this->admin_model->get_image_list($page_number, $this->config->item('admin_results_per_page'));
					
					$this->load->library('pagination');
					$this->pagination->initialize($config);
					$data['page_links'] = $this->pagination->create_links();
					$data['page_content'] = 'admin_images_list';
					break;
					
				case 'add':
					$config['upload_path'] = './content-uploads/content-images/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '500';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					
					//Load Upload and Image libraries
					$this->load->library('upload');
					$this->load->library('image_lib');
					
					$this->form_validation->set_rules('userfile1', '', '');
					$this->form_validation->set_rules('image_title1', 'Image Title 1', 'trim|required|xss_clean');
					
					if($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_title'] = 'Uploads - Upload Images';
						$data['page_content'] = 'admin_images_add';
					} else {
						$count = 0;
						$error_count = 0;
						$error = '';

						for($i = 1; $i <= 3; $i++) {
							$userfile = 'userfile' . $i;
							$image_title_input = 'image_title' . $i;
							if( ! empty($_FILES[$userfile]['name'])) {
								
								//Reset
								$this->upload->initialize($config);
								
								if ( ! $this->upload->do_upload($userfile)) {
									$error = $this->upload->display_errors('','');
									$data['error'] = $error;
									$data['page_content'] = 'admin_images_add';
									$error_count++;
									break;
									
								} else {
									
									$file_path = '';
									$image_name = '';
									
									$data = array('upload_data' => $this->upload->data());

									$image_title = $_POST[$image_title_input];
									$file_path = $data['upload_data']['file_path'];
									$image_name = $data['upload_data']['file_name'];
									
									//Use raw name to insert into DB
									$raw_name = $data['upload_data']['raw_name'];
									$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);

									$data_array = array('image_name' => $image_title, 'image_file' => $raw_name, 'extension' => $ext);
									$insert_id = $this->admin_model->add_content_image($data_array);
									if($insert_id != FALSE) {
										$count++;
									} else {
										$error_count++;
									}
								}
							}
							
							
						}
						if($count > 0 && $error_count == 0) {
							$this->session->set_flashdata('status_message','<div class="success">Images have been added</div>');
							redirect('admin/images');
						} else if($count > 0 && $error_count > 0) {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>One or more files may have not been uploaded</p></div>');
							redirect('admin/images');
						} else {
							if($count == 0 && $error == '') {
								$error = 'You did not select any files.';
							}
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>' . $error . ' No files were uploaded</p></div>');
							redirect('admin/images/add');
						}
						
					}
					break;
					
				case 'update':
					$data['page_title'] = 'Uploads - Update Image';
					$data['image_id'] = $image_id;
					$data['image_array'] = $this->admin_model->get_image_by_id($image_id);
					
					$this->form_validation->set_rules('image_name', 'Document Title', 'trim|required|xss_clean');
					if($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_content'] = 'admin_images_update';
					} else {
						
						$count = 0;
						$error_count = 0;
						$error = '';
						$image_id = $this->input->post('image_id');
						
						//Upload file if it exists
						if( ! empty($_FILES['userfile']['name'])) {
							$config['upload_path'] = './content-uploads/content-images/';
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']	= '500';
							$config['max_width']  = '1024';
							$config['max_height']  = '768';
							
							//Load Upload and Image libraries
							$this->load->library('upload');
							
							//If they selected Overwrite option, assign the new file name
							if($this->input->post('confirm_overwrite') == 'yes') {
								$config['file_name'] = $this->input->post('current_filename_base');
								$config['overwrite'] = TRUE;
							}
							
							//Initialize
							$this->upload->initialize($config);
							
							if ( ! $this->upload->do_upload()) {
								$error = $this->upload->display_errors('','');
								$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
								$data['page_content'] = 'admin_images_update';
								$error_count++;
								break;
								
							} else {
								
								$file_path = '';
								$document_name = '';
								
								$data = array('upload_data' => $this->upload->data());

								$image_title = $this->input->post('image_name');
								$file_path = $data['upload_data']['file_path'];
								$image_name = $data['upload_data']['file_name'];
								
								//Use raw name to insert into DB
								$raw_name = $data['upload_data']['raw_name'];
								$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
								
								$data_array = array('image_name' => $image_title, 'image_file' => $raw_name, 'extension' => $ext, 'image_id' => $image_id);
								
								
								$update = $this->admin_model->update_image($data_array, TRUE);	
								if($update) {
									$this->session->set_flashdata('status_message','<div class="success">Your image has been updated</div>');
									redirect('admin/images/update/' . $image_id);
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this image. Please try again.</p></div>');
									redirect('admin/images/update/' . $image_id);
								}
							}
							
						} else {
							
							$update = $this->admin_model->update_image($_POST);	
							if($update) {
								$this->session->set_flashdata('status_message','<div class="success">Your image has been updated</div>');
								redirect('admin/images/update/' . $image_id);
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this image. Please try again.</p></div>');
								redirect('admin/images/update/' . $image_id);
							}
						}
					}
					break;
					
				case 'delete':
					$data_array = array('image_id' => $image_id);
					$delete = $this->admin_model->delete_image($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your image has been deleted successfully.</div>');
						redirect('admin/images');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this image. Please try again.</p></div>');
						redirect('admin/images');
					}
					break;
			}
		}

		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	DOCUMENTS
/*	Controls the add/edit/delete functionality for document uploads
/****************************************************************************************************************************************/
	function documents($action = NULL, $document_id = NULL) {

		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'documents';

		//Upload Pagination Config
		$config['base_url'] = '/admin/uploads/documents/page/';
		$config['total_rows'] = $this->admin_model->get_total_documents_count();
		$config['per_page'] = $this->config->item('admin_results_per_page');
		$config['num_links'] = 3;
		$config['uri_segment'] = 5;
		$config['prev_link'] = '&lt; Previous';
		$config['prev_tag_open'] = '<span class="previous_page">';
		$config['prev_tag_close'] = '</span>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<span class="next_page">';
		$config['next_tag_close'] = '</span>';

		if($action == NULL) {
			$data['page_title'] = 'Uploads - Documents';
			$data['document_list_array'] = $this->admin_model->get_document_list(0,$this->config->item('admin_results_per_page'));

			$this->load->library('pagination');
			$this->pagination->initialize($config);
			$data['page_links'] = $this->pagination->create_links();
			$data['page_content'] = 'admin_documents_list';
		} else {
				
			switch($action) {
					
				case 'page':
					if($document_id == NULL || $document_id == '') {
						$page_number = 0;
					} else {
						$page_number = $document_id;
					}
					$data['document_list_array'] = $this->admin_model->get_document_list($page_number, $this->config->item('admin_results_per_page'));
					
					$this->load->library('pagination');
					$this->pagination->initialize($config);
					$data['page_links'] = $this->pagination->create_links();
					$data['page_title'] = 'Uploads - Documents';
					$data['page_content'] = 'admin_documents_list';
					break;
					
				case 'add':
					$config['upload_path'] = './content-uploads/content-documents/';
					$config['allowed_types'] = 'xls|doc|docx|pdf';
					$config['max_size']	= '1024';
					
					//Load Upload and Image libraries
					$this->load->library('upload');
					
					$this->form_validation->set_rules('userfile1', '', '');
					$this->form_validation->set_rules('document_name1', 'Document Title 1', 'trim|required|xss_clean');
					
					if($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_title'] = 'Uploads - Upload Documents';
						$data['page_content'] = 'admin_documents_add';
					} else {
						$count = 0;
						$error_count = 0;
						$error = '';

						for($i = 1; $i <= 3; $i++) {
							$userfile = 'userfile' . $i;
							$document_title_input = 'document_name' . $i;
							if( ! empty($_FILES[$userfile]['name'])) {
								
								//Reset
								$this->upload->initialize($config);
								
								if ( ! $this->upload->do_upload($userfile)) {
									$error = $this->upload->display_errors('','');
									$data['error'] = $error;
									$data['page_content'] = 'admin_documents_add';
									$error_count++;
									break;
									
								} else {
									
									$file_path = '';
									$document_name = '';
									
									$data = array('upload_data' => $this->upload->data());

									$document_title = $_POST[$document_title_input];
									$file_path = $data['upload_data']['file_path'];
									$document_name = $data['upload_data']['file_name'];
									
									//Use raw name to insert into DB
									$raw_name = $data['upload_data']['raw_name'];
									$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
									
									$data_array = array('document_name' => $document_title, 'document_file' => $raw_name, 'extension' => $ext);
									$insert_id = $this->admin_model->add_content_document($data_array);
									if($insert_id != FALSE) {
										$count++;
									} else {
										$error_count++;
									}
								}
							}
							
							
						}
						if($count > 0 && $error_count == 0) {
							$this->session->set_flashdata('status_message','<div class="success">Documents have been added</div>');
							redirect('admin/documents');
						} else if($count > 0 && $error_count > 0) {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>One or more files may have not been uploaded</p></div>');
							redirect('admin/documents');
						} else {
							if($count == 0 && $error == '') {
								$error = 'You did not select any files.';
							}
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>' . $error . ' No files were uploaded</p></div>');
							redirect('admin/documents/add');
						}
						
					}
					
					$data['page_title'] = 'Uploads - Upload Documents';
					$data['page_content'] = 'admin_documents_add';
					break;
					
				case 'update':
					$data['page_title'] = 'Uploads - Update Document';
					$data['document_id'] = $document_id;
					$data['document_array'] = $this->admin_model->get_document_by_id($document_id);
					
					$this->form_validation->set_rules('document_name', 'Document Title', 'trim|required|xss_clean');
					
					if($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_content'] = 'admin_documents_update';
					
					} else {
						$count = 0;
						$error_count = 0;
						$error = '';
						$document_id = $this->input->post('document_id');
						
						//Upload file if it exists
						if( ! empty($_FILES['userfile']['name'])) {
							$config['upload_path'] = './content-uploads/content-documents/';
							$config['allowed_types'] = 'xls|doc|docx|pdf';
							$config['max_size']	= '1024';
							
							//Load Upload and Image libraries
							$this->load->library('upload');
							
							//If they selected Overwrite option, assign the new file name
							if($this->input->post('confirm_overwrite') == 'yes') {
								$config['file_name'] = $this->input->post('current_filename_base');
								$config['overwrite'] = TRUE;
							}
							
							//Initialize
							$this->upload->initialize($config);
							
							if ( ! $this->upload->do_upload()) {
								$error = $this->upload->display_errors('','');
								$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
								$data['page_content'] = 'admin_documents_update';
								$error_count++;
								break;
								
							} else {
								
								$file_path = '';
								$document_name = '';
								
								$data = array('upload_data' => $this->upload->data());

								$document_title = $this->input->post('document_name');
								$file_path = $data['upload_data']['file_path'];
								$document_name = $data['upload_data']['file_name'];
								
								//Use raw name to insert into DB
								$raw_name = $data['upload_data']['raw_name'];
								$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
								
								$data_array = array('document_name' => $document_title, 'document_file' => $raw_name, 'extension' => $ext, 'document_id' => $document_id);
								
								
								$update = $this->admin_model->update_document($data_array, TRUE);	
								if($update) {
									$this->session->set_flashdata('status_message','<div class="success">Your file has been updated</div>');
									redirect('admin/documents/update/' . $document_id);
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this file. Please try again.</p></div>');
									redirect('admin/documents/update/' . $document_id);
								}
							}
							
						} else {
							
							$update = $this->admin_model->update_document($_POST);	
							if($update) {
								$this->session->set_flashdata('status_message','<div class="success">Your file has been updated</div>');
								redirect('admin/documents/update/' . $document_id);
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this file. Please try again.</p></div>');
								redirect('admin/documents/update/' . $document_id);
							}
						}
						
						
					}

					break;
					
				case 'delete':
					$data_array = array('document_id' => $document_id);
					$delete = $this->admin_model->delete_document($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your document has been deleted successfully.</div>');
						redirect('admin/documents');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this document. Please try again.</p></div>');
						redirect('admin/documents');
					}
					break;
			}
		}
		$this->load->view('admin_template', $data);
	}	

/*****************************************************************************************************************************************
/*	CONTACT Page
/*	
/****************************************************************************************************************************************/	
	function contact($action = NULL, $id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'contact';
		
		if($action == NULL) {
			$data['page_content'] = 'admin_contact';
		} else {
			$report_file = $this->admin_model->run_contact_report($this->input->post('start_date'), $this->input->post('end_date'));
			if($report_file !== FALSE) {
				$this->load->helper('download');
				$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/_assets/reports/' . $report_file);
				$name = $report_file;
				force_download($name, $data);
			} else {
				echo 'error';
				$data['page_content'] = 'admin_contact';
			}
		}
		$this->load->view('admin_template', $data);
	}
	
/************************************************************************************************************************************************************
									BEGIN CUSTOM MODULES
																
***********************************************************************************************************************************************************/


	
/*****************************************************************************************************************************************
/*	LOGOUT Page
/*	Destroy the logged in session and redirect to login page
/****************************************************************************************************************************************/	
	function logout() {
		$this->session->sess_destroy();
		session_destroy();
		redirect('admin');
	}
	
	
}

/* End of file admin.php */
/* Location: ./system/application/modules/admin/controllers/admin.php */