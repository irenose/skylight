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
				$data['user_array'] = $this->auth->process_login($login, FALSE, $data['redirected_from']);
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
		$data['dealer_list_array'] = $this->admin_model->get_dealer_site_list();
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
				$data = file_get_contents($this->config->item('contact_reports_full_dir') . $report_file);
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

	function updates($action = NULL, $update_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'updates';
		if($action == NULL) {
			$data['page_title'] = 'Updates';
			$data['update_array'] = $this->admin_model->get_site_updates();
			$data['page_content'] = 'admin_updates_list';
		} else {
			switch($action) {
				case 'add':
					$this->form_validation->set_rules('update_text', 'Update Text', 'trim|required|xss_clean');
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_updates_add';
					} else {
						$insert_id = $this->admin_model->add_site_update($_POST);
						if($insert_id != FALSE) {
							$this->session->set_flashdata('status_message','<div class="success">Site Update has been added successfully</div>');
							redirect('admin/updates');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this site update. Please try again.</p></div>');
							redirect('admin/updates');
						}
					}
					break;
				case 'delete':
					$data_array = array('update_id' => $update_id);
					$delete = $this->admin_model->delete_site_update($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your update has been deleted successfully.</div>');
						redirect('admin/updates/');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this update. Please try again.</p></div>');
						redirect('admin/updates/');
					}
					break;
			}
		}
		$this->load->view('admin_template', $data);
	}
/****************************************************************************************************************************************
/*	INSTALLERS
/****************************************************************************************************************************************/

	function installers($action = NULL, $dealer_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'installers';
		if($action == NULL) {
			$data['page_title'] = 'Installers';
			if($this->input->post('dealer_status') != '') {
				$data['dealer_listing_array'] = $this->admin_model->get_dealer_list(0,$this->config->item('per_page'),$this->input->post('dealer_status'));
				$data['dealer_status'] = $this->input->post('dealer_status');
			} else {
				$data['dealer_listing_array'] = $this->admin_model->get_dealer_list(0,$this->config->item('per_page'));	
				$data['dealer_status'] = '';
			}
			$data['page_content'] = 'admin_installers_list';
		} else {
			$data['site_default_array'] = $this->admin_model->get_site_defaults();
			switch($action) {				
				case 'add':
					$this->form_validation->set_rules('name', 'Dealer Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dealer_url', 'Dealer URL', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_last_name', 'Contact Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address2', '', '');
					$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
					$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
					$this->form_validation->set_rules('zip', 'ZIP', 'trim|required|xss_clean');
					$this->form_validation->set_rules('region', 'Region', 'trim|xss_clean');
					$this->form_validation->set_rules('phone1', 'Phone', 'trim|required|xss_clean');
					$this->form_validation->set_rules('fax', '', '');
					$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');
					$this->form_validation->set_rules('website', '', '');
					$this->form_validation->set_rules('microsite_url', '', '');
					$this->form_validation->set_rules('about_dealer_headline', '', '');
					$this->form_validation->set_rules('about_dealer_text', '', '');
					$this->form_validation->set_rules('dealer_homepage_headline', '', '');
					$this->form_validation->set_rules('dealer_homepage_copy', '', '');
					$this->form_validation->set_rules('credentials', '', '');
					$this->form_validation->set_rules('dealer_hours', '', 'trim|xss_clean');
					$this->form_validation->set_rules('sells_vms', '', 'trim|xss_clean');
					
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_installers_add';
					} else {
						$insert_id = $this->admin_model->add_dealer_site($_POST);
						if($insert_id != FALSE) {
							
							/************************ UPDATE SITEMAP ******************************/
							$this->admin_model->generate_sitemap();
							
							$this->session->set_flashdata('status_message','<div class="success">Installer Site has been added successfully</div>');
							redirect('admin/installers');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this installer site. Please try again.</p></div>');
							redirect('admin/installers');
						}
						
					}
					break;
				case 'update':
					$config['upload_path'] = $this->config->item('dealer_assets_upload_path') . 'dealer-logos/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '500';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					
					//Load Upload and Image libraries
					$this->load->library('upload');
					$this->load->library('image_lib');
					$data['default_info_array'] = $this->admin_model->get_site_defaults();
					$data['dealer_array'] = $this->admin_model->get_dealer_by_id($dealer_id);
					$data['dealer_id'] = $dealer_id;
					$this->form_validation->set_rules('name', 'Dealer Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dealer_url', 'Dealer URL', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_last_name', 'Contact Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address2', '', '');
					$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
					$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
					$this->form_validation->set_rules('zip', 'ZIP', 'trim|required|xss_clean');
					$this->form_validation->set_rules('region', 'Region', 'trim|xss_clean');
					$this->form_validation->set_rules('phone1', 'Phone', 'trim|required|xss_clean');
					$this->form_validation->set_rules('fax', '', '');
					$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');
					$this->form_validation->set_rules('paid_search_extension','','trim|xss_clean');
					$this->form_validation->set_rules('website', '', '');
					$this->form_validation->set_rules('microsite_url', '', '');
					$this->form_validation->set_rules('about_dealer_headline', '', '');
					$this->form_validation->set_rules('about_dealer_text', '', '');
					$this->form_validation->set_rules('dealer_homepage_headline', '', '');
					$this->form_validation->set_rules('dealer_homepage_copy', '', '');
					$this->form_validation->set_rules('credentials', '', '');
					$this->form_validation->set_rules('dealer_status', 'Dealer Status', 'required|trim|xss_clean');
					$this->form_validation->set_rules('site_status', 'Site Status', 'required|trim|xss_clean');
					$this->form_validation->set_rules('dealer_hours', '', 'trim|xss_clean');
					$this->form_validation->set_rules('sells_vms', '', 'trim|xss_clean');
					
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_installers_update';
					} else {
						if( ! empty($_FILES['userfile']['name'])) {
							//Has previously uploaded image, so include overwrite settings
							if($this->input->post('current_filename_base') != '') {
								$config['file_name'] = $this->input->post('current_filename');
								$config['overwrite'] = TRUE;
							}
							$error = '';
							//Initialize
							$this->upload->initialize($config);
							
							if ( ! $this->upload->do_upload()) {
								$error = $this->upload->display_errors('','');
								$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
								$data['page_content'] = 'admin_dealer_update';
								break;
							} else {
								$file_path = '';
								$image_name = '';
								
								$data = array('upload_data' => $this->upload->data());
								$file_path = $data['upload_data']['file_path'];
								$image_name = $data['upload_data']['file_name'];
								
								//Use raw name to insert into DB
								$raw_name = $data['upload_data']['raw_name'];
								$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
								
								//Create re-sized thumbnail, then delete original image
								//create_image($file_path, $image_name, 63, 43, TRUE, '_th');
								//unlink($file_path . $image_name);
								
								//rename post array so we can add values to it for image
								$data_array = $_POST;
								
								//Add RSS Image data to post array
								$data_array['dealer_logo'] = $raw_name;
								$data_array['extension'] = $ext;
								
								$update = $this->admin_model->update_dealer($data_array, TRUE);
								if($update) {
									/************************ UPDATE SITEMAP ******************************/
									$this->admin_model->generate_sitemap();
									
									$this->session->set_flashdata('status_message','<div class="success">Dealer has been updated successfully</div>');
									redirect('admin/installers/update/' . $dealer_id);
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this dealer. Please try again.</p></div>');
									redirect('admin/installers/update/' . $dealer_id);
								}
							}
						} else {
							// Dealer is not trying to update or add a logo
							$update = $this->admin_model->update_dealer($_POST);
							if($update) {
								
								/************************ UPDATE SITEMAP ******************************/
								$this->admin_model->generate_sitemap();
							
								$this->session->set_flashdata('status_message','<div class="success">Dealer has been updated successfully</div>');
								redirect('admin/installers/update/' . $dealer_id);
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this dealer. Please try again.</p></div>');
								redirect('admin/installers/update/' . $dealer_id);
							}
							
						}
					}
					break;
					
				case 'delete':
					if($dealer_id != NULL) {
						$deleted = $this->admin_model->delete_dealer($dealer_id);
						if($deleted) {
							$this->session->set_flashdata('status_message','<div class="success">Installer has been deleted successfully</div>');
							redirect('admin/installers');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this installer. Please try again.</p></div>');
							redirect('admin/installers');
						}
					} else {
						redirect('admin/installers');	
					}
					break;
			}
		}
		$this->load->view('admin_template', $data);
	}

/****************************************************************************************************************************************
/*	PRODUCTS
/****************************************************************************************************************************************/
	function products($action = NULL, $product_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'products';
		if($action == NULL) {
			$data['page_title'] = 'Products';
			if($this->input->post('product_status') != '') {
				$data['product_category_array'] = $this->admin_model->get_product_categories($this->input->post('product_status'));
				$data['product_status'] = $this->input->post('product_status');
			} else {
				$data['product_category_array'] = $this->admin_model->get_product_categories();	
				$data['product_status'] = '';
			}
			$data['page_content'] = 'admin_product_list';
		} else {
			
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('product_name_short', 'Product Name - Short', 'trim|xss_clean');
			$this->form_validation->set_rules('model_number', '', 'trim|xss_clean');
			$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required|xss_clean');
			$this->form_validation->set_rules('product_category_id', 'Product Category', 'trim|required|xss_clean');
			$this->form_validation->set_rules('primary_category_id', 'Product Sub-Category', 'trim|required|xss_clean');
			$this->form_validation->set_rules('no_leak_flag', '', 'trim|xss_clean');
			$this->form_validation->set_rules('tax_credit', '', 'trim|xss_clean');

			$data['product_category_array'] = $this->admin_model->get_product_categories();

			switch($action) {
				case 'add':
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_product_add';
					} else {
						$insert_id = $this->admin_model->add_product($_POST);
						if($insert_id != FALSE) {
							$this->session->set_flashdata('status_message','<div class="success">Product has been added successfully</div>');
							redirect('admin/products');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this product. Please try again.</p></div>');
							redirect('admin/products');
						}
					}
					break;
				case 'update':
					$this->form_validation->set_rules('product_status', 'Product Status', 'required|trim|xss_clean');
					$this->form_validation->set_rules('product_url', 'Product URL', 'required|trim|xss_clean');
					$data['product_array'] = $this->admin_model->get_product_by_id($product_id);
					$data['product_id'] = $product_id;
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_product_update';
					} else {
						
						//rename post array so we can add values to it for image
						$data_array = $_POST;
						$uploaded_product_image = FALSE;
						
						if( ! empty($_FILES['product_image']['name'])) {

							$config['upload_path'] = $this->config->item('product_images_upload_path');
							$config['allowed_types'] = 'gif|jpg|png';
							$config['max_size']	= '500';
							$config['max_width']  = '1024';
							$config['max_height']  = '768';
							$config['overwrite'] = TRUE;

							$filename_base = url_title($this->input->post('product_name'), 'dash', TRUE);
							if(trim($this->input->post('model_number')) != '') {
								$filename_base .= '-' . strtolower(trim($this->input->post('model_number')));
							}
							$extension = get_file_extension($_FILES['product_image']['name']);
							$config['file_name'] = $filename_base . '.' . $extension;
							
							//Load Upload and Image libraries
							$this->load->library('upload');
							$this->load->library('image_lib');
							
							$error = '';
							//Initialize
							$this->upload->initialize($config);
						
							if ( ! $this->upload->do_upload('product_image')) {
								$error = $this->upload->display_errors('','');
								$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
								$data['page_content'] = 'admin_product_update';

							} else {

								$file_path = '';
								$image_name = '';
								
								$data = array('upload_data' => $this->upload->data());
								$file_path = $data['upload_data']['file_path'];
								$image_name = $data['upload_data']['file_name'];
								
								//Use raw name to insert into DB
								$raw_name = $filename_base;
								$ext = get_file_extension($data['upload_data']['file_ext']);
								
								
								//Add RSS Image data to post array
								$data_array['product_image'] = $raw_name;
								$data_array['extension'] = $ext;

								$uploaded_product_image = TRUE;
							}
						}
								
						$update = $this->admin_model->update_product($data_array, $uploaded_product_image);
						if($update) {
							/************************ UPDATE SITEMAP ******************************/
							$this->admin_model->generate_sitemap();

							$this->session->set_flashdata('status_message','<div class="success">Product has been updated successfully</div>');
							redirect('admin/products/update/' . $product_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this product. Please try again.</p></div>');
							redirect('admin/products/update/' . $product_id);
						}
					}
					break;
					
				case 'delete':
					$data_array = array('product_id' => $product_id);
					$delete = $this->admin_model->delete_product($data_array);
					if($delete) {
						/************************ UPDATE SITEMAP ******************************/
						$this->admin_model->generate_sitemap();

						$this->session->set_flashdata('status_message','<div class="success">Your product has been deleted successfully.</div>');
						redirect('admin/products');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this product. Please try again.</p></div>');
						redirect('admin/products');
					}
					break;
				
			}
		}
		
		$this->load->view('admin_template', $data);
	}

	
/****************************************************************************************************************************************
/*	TESTIMONIALS
/****************************************************************************************************************************************/
	function testimonials($action = NULL, $testimonial_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'testimonials';
		if($action == NULL) {
			$data['page_title'] = 'Testimonials';
			$data['testimonials_array'] = $this->admin_model->get_testimonials();
			$data['page_content'] = 'admin_testimonials_list';
		} else {
			$this->form_validation->set_rules('testimonial_copy', 'Testimonial Copy', 'trim|required|xss_clean');
			$this->form_validation->set_rules('testimonial_name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('testimonial_source', '', 'trim|xss_clean');
			switch($action) {
				
				case 'add':
				
					if ($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_testimonials_add';
					} else {
						$insert_id = $this->admin_model->add_testimonial($_POST);
						if($insert_id != FALSE) {
							$this->session->set_flashdata('status_message','<div class="success">Testimonial has been added successfully</div>');
							redirect('admin/testimonials');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this testimonial. Please try again.</p></div>');
							redirect('admin/testimonials');
						}
					}
					break;
				case 'update':
					if ($this->form_validation->run() == FALSE) {
						$data['testimonial_id'] = $testimonial_id;
						$data['testimonial_array'] = $this->admin_model->get_testimonial_by_id($testimonial_id);
						$data['page_content'] = 'admin_testimonials_update';
					} else {
						$update = $this->admin_model->update_testimonial($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Testimonial has been updated successfully</div>');
							redirect('admin/testimonials/update/' . $testimonial_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this testimonial. Please try again.</p></div>');
							redirect('admin/testimonials/update/' . $testimonial_id);
						}
					}
					break;
					
				case 'delete':
					$data_array = array('testimonial_id' => $testimonial_id);
					$delete = $this->admin_model->delete_testimonial($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your testimonial has been deleted successfully.</div>');
						redirect('admin/testimonials/');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this testimonial. Please try again.</p></div>');
						redirect('admin/testimonials/');
					}
					break;
				
			}
		}
		
		$this->load->view('admin_template', $data);
	}
	
	
/****************************************************************************************************************************************
/*	LITERATURE
/****************************************************************************************************************************************/
	function literature($action = NULL, $literature_id = NULL) {
		$this->auth->restrict(FALSE, '1');
		$data['current_section'] = 'literature';
		if($action == NULL) {
			$data['page_title'] = 'Literature';
			$data['literature_array'] = $this->admin_model->get_literature();
			$data['page_content'] = 'admin_literature_list';
		} else {
			switch($action) {
				
				case 'add':
					$this->load->library('upload');
					
					$config['upload_path'] = './downloads/';
					$config['max_size']	= '20000';
					$config['overwrite'] = FALSE;
					
					$this->upload->initialize($config);
					
					$this->form_validation->set_rules('filename', '', '');
					$this->form_validation->set_rules('name', 'Brochure Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('description', 'Brochure Description', 'trim|required|xss_clean');
					$this->form_validation->set_rules('analytics_url', 'Analytics URL', 'trim|required|xss_clean');

					if($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_content'] = 'admin_literature_add';
					} else {
						$config['allowed_types'] = 'pdf|xls|doc|docx|xlsx';
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload('filename')) {
							$error = $this->upload->display_errors('','');
							$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
							$data['page_content'] = 'admin_literature_add';
							break;
						} else {
							$file_path = '';
							
							$data = array('upload_data' => $this->upload->data());
							$file_path = $data['upload_data']['file_path'];
							$file_name = $data['upload_data']['file_name'];
							$raw_name = $data['upload_data']['raw_name'];
							$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
							$full_extension = $data['upload_data']['file_ext'];
							
							$file_prefix = url_title($this->input->post('name'),'underscore', TRUE);
							rename($file_path . $file_name, $file_path . $file_prefix . $full_extension);
							
							$data_array = $_POST;

							$data_array['filename'] = $file_prefix;
							$data_array['extension'] = $ext;
							$data_array['thumbnail'] = '';
							$data_array['thumbnail_extension'] = '';
							
							// Upload Flash file if present
							if( ! empty($_FILES['thumbnail']['name'])) {
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['upload_path'] = './downloads/thumbs/';
								$this->upload->initialize($config);
								if ( ! $this->upload->do_upload('thumbnail')) {
									@unlink($file_path . $file_prefix . $full_extension);
									$error = $this->upload->display_errors('','');
									$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
									$data['page_content'] = 'admin_literature_add';
									break;
									
								} else {
									$data = array('thumb_data' => $this->upload->data());
									$thumb_file_name = $data['thumb_data']['file_name'];
									$file_path = $data['thumb_data']['file_path'];
									$raw_name = $data['thumb_data']['raw_name'];
									$ext = substr($data['thumb_data']['file_ext'], strrpos($data['thumb_data']['file_ext'],'.')+1);
									$full_extension = $data['thumb_data']['file_ext'];
									rename($file_path . $thumb_file_name, $file_path . $file_prefix . $full_extension);
									$data_array['thumbnail'] = $file_prefix;
									$data_array['thumbnail_extension'] = $ext;
								}
								
							}
							
							$insert_id = $this->admin_model->add_literature($data_array);
							if($insert_id != FALSE) {
								$this->session->set_flashdata('status_message','<div class="success">Brochure has been added successfully</div>');
								redirect('admin/literature');
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error adding this brochure. Please try again.</p></div>');
								redirect('admin/literature');
							}
						}
					}
					break;
					
				case 'update':
					$this->load->library('upload');
					$data['literature_id'] = $literature_id;
					$data['literature_array'] = $this->admin_model->get_literature_by_id($literature_id);
					
					$this->form_validation->set_rules('name', 'Brochure Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('description', 'Brochure Description', 'trim|required|xss_clean');
					$this->form_validation->set_rules('literature_status', 'Brochure Status', 'trim|required|xss_clean');
					$this->form_validation->set_rules('analytics_url', 'Analytics URL', 'trim|required|xss_clean');
					
					if ($this->form_validation->run() == FALSE) {
						$data['error'] = '';
						$data['page_content'] = 'admin_literature_update';
					} else {
						
						//rename post array so we can add values to it for image
						$data_array = $_POST;
						$file_prefix = $this->input->post('file_prefix');
						$has_thumbnail = FALSE;
						$has_brochure = FALSE;
						
						if( ! empty($_FILES['filename']['name']) || ! empty($_FILES['thumbnail']['name'])) {

							// Upload Large File
							if( ! empty($_FILES['filename']['name'])) {
								$config['overwrite'] = TRUE;
								$config['upload_path'] = './downloads/';
								$config['max_size']	= '20000';
								$config['allowed_types'] = 'pdf|xls|doc|docx|xlsx';
								
								$has_brochure = TRUE;
								
								$error = '';
								//Initialize
								$this->upload->initialize($config);
							
								if ( ! $this->upload->do_upload('filename')) {

									$error = $this->upload->display_errors('','');
									$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
									$data['page_content'] = 'admin_literature_update';
									break;
								} else {
									$file_path = '';
									$image_name = '';
									
									$data = array('upload_data' => $this->upload->data());
									$file_path = $data['upload_data']['file_path'];
									$file_name = $data['upload_data']['file_name'];
									$full_extension = $data['upload_data']['file_ext'];
									rename($file_path . $file_name, $file_path . $file_prefix . $full_extension);
									$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);

									//Add image data to post array
									$data_array['filename'] = $file_prefix;
									$data_array['extension'] = $ext;
								}
								
							}
							
							// Upload Product Image
							if( ! empty($_FILES['thumbnail']['name'])) {
								$config['overwrite'] = TRUE;
								$config['upload_path'] = './downloads/thumbs/';
								$config['max_size']	= '2000';
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								
								$has_thumbnail = TRUE;
								
								$error = '';
								//Initialize
								$this->upload->initialize($config);
							
								if ( ! $this->upload->do_upload('thumbnail')) {
									$error = $this->upload->display_errors('','');
									$data['error'] = '<div class="error_alert"><p>' . $error . '</p></div>';
									$data['page_content'] = 'admin_literature_update';
									break;
								} else {
									$file_path = '';
									$image_name = '';
									
									$data = array('upload_data' => $this->upload->data());
									$file_path = $data['upload_data']['file_path'];
									$file_name = $data['upload_data']['file_name'];
									$full_extension = $data['upload_data']['file_ext'];
									rename($file_path . $file_name, $file_path . $file_prefix . $full_extension);
									$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);

									//Add image data to post array
									$data_array['thumbnail'] = $file_prefix;
									$data_array['thumbnail_extension'] = $ext;
								}
								
							}
						}

						$update = $this->admin_model->update_literature($data_array, $has_brochure, $has_thumbnail);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Brochure has been updated successfully</div>');
							redirect('admin/literature/update/' . $literature_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this brochure. Please try again.</p></div>');
							redirect('admin/literature/update/' . $literature_id);
						}
					}

					
					break;
					
				case 'delete':
					$data_array = array('literature_id' => $literature_id);
					$delete = $this->admin_model->delete_literature($data_array);
					if($delete) {
						$this->session->set_flashdata('status_message','<div class="success">Your brochure has been deleted successfully.</div>');
						redirect('admin/literature/');
					}  else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting this brochure. Please try again.</p></div>');
						redirect('admin/literature/');
					}
					break;
				
			}
			
		}
		
		$this->load->view('admin_template', $data);
	}

/****************************************************************************************************************************************
/*	BAZAARVOICE FEED GENERATOR
/****************************************************************************************************************************************/

	function bazaarvoice() {
		$cats = $this->admin_model->get_bazaarvoice_categories();
		$prods = $this->admin_model->get_bazaarvoice_products();
		$parent_url = array(
			1 => 'sun-tunnel-skylights',
			2 => 'residential-skylights',
			3 => 'commercial-skylights'
		);
		$xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";
		$xml .= '<Feed xmlns="http://www.bazaarvoice.com/xs/PRR/ProductFeed/5.1" name="veluxskylightspecialist" incremental="false" extractDate="2011-10-18T12:00:00.000000">' . "\n";

		$xml .= '<Brands>' . "\n";
	        $xml .= "\t" . '<Brand>' . "\n";
	            $xml .= "\t\t" . '<ExternalId>VELUX-SS</ExternalId>' . "\n";
	            $xml .= "\t\t" . '<Name>VELUX Skylight Specialist</Name>' . "\n";
	        $xml .= "\t" . '</Brand>' . "\n";
	    $xml .= '</Brands>' . "\n";

		$xml .= '<Categories>' . "\n";
		foreach($cats as $cat) {
			$xml .= "\t" . '<Category>' . "\n";
			$xml .= "\t\t" . '<ExternalId>prod-cat-' . $cat->product_category_id . '</ExternalId>' . "\n";
			if($cat->primary_category_id != 0) {
				$xml .= "\t\t" . '<ParentExternalId>prod-cat-' . $cat->primary_category_id . '</ParentExternalId>' . "\n";
			}
            $xml .= "\t\t" . '<Name>' . str_replace('&trade;','',$cat->product_category_name) . '</Name>' . "\n";
            if($cat->primary_category_id != 0) {
            	$xml .= "\t\t" . '<CategoryPageUrl>' . base_url() . 'catalog/products/category/' . $parent_url[$cat->primary_category_id] . '#' . $cat->product_category_url . '</CategoryPageUrl>' . "\n";
            } else {
            	$xml .= "\t\t" . '<CategoryPageUrl>' . base_url() .  'catalog/products/category/' . $cat->product_category_url . '</CategoryPageUrl>' . "\n";
            }
            $xml .= "\t\t" . '<ImageUrl> </ImageUrl>' . "\n";
            $xml .= "\t" . '</Category>' . "\n";
		}
		$xml .= '</Categories>' . "\n";
		$xml .= '<Products>' . "\n";
	    foreach($prods as $prod) {
	        $xml .= "\t" . '<Product>' . "\n";
	        $xml .= "\t\t" . '<ExternalId>prod-' . $prod->product_id . '</ExternalId>' . "\n";
	        $xml .= "\t\t" . '<Name>' . $prod->product_name . '</Name>' . "\n";

	        $xml .= "\t\t" . '<Description>' . htmlspecialchars(strip_tags($prod->product_description)) . '</Description>' . "\n";
	        $xml .= "\t\t" . '<BrandExternalId>VELUX-SS</BrandExternalId>' . "\n";
	        $xml .= "\t\t" . '<CategoryExternalId>prod-cat-' . $prod->primary_category_id . '</CategoryExternalId>' . "\n";
	        $xml .= "\t\t" . '<ProductPageUrl>' . base_url() . 'catalog/products/' . $prod->product_url . '</ProductPageUrl>' . "\n";
	        $xml .= "\t\t" . '<ImageUrl> </ImageUrl>' . "\n";
	        if($prod->model_number != '') {
		        $xml .= "\t\t" . '<ModelNumbers>' . "\n";
		            $xml .= "\t\t\t" . '<ModelNumber>' . str_replace('Model ', '', $prod->model_number) . '</ModelNumber>' . "\n";
		        $xml .= "\t\t" . '</ModelNumbers>' . "\n";
		    }
	        $xml .= "\t\t" . '<UPCs>' . "\n";
	            $xml .= "\t\t\t" . '<UPC> </UPC>' . "\n";
	        $xml .= "\t\t" . '</UPCs>' . "\n";
	        $xml .= "\t" . '</Product>' . "\n";
	    }
	    $xml .= '</Products>' . "\n";
	    $xml .= '</Feed>' . "\n";
	    echo $xml;
	    exit;
	}
	
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