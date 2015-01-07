<?php

class Installer_admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		$this->load->library('auth');
		$this->load->library('pagination');
		$this->load->library('sitemap');
		$this->load->library('rss');
		$this->load->model('installer_admin_model');
		$this->load->model('page/page_model');
		parse_str($_SERVER['QUERY_STRING'],$_GET);
	}
	
/*****************************************************************************************************************************************
/*	LOGIN Page
*****************************************************************************************************************************************/
	function index() {
		if(isset($_SESSION['uid']) && $_SESSION['uid'] != '') { 
			redirect('dealer-admin/home');
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
					redirect('/installer-admin/password');
				
				} else {
					$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error resetting this password. Verify username and try again.</p></div>');
					redirect('/installer-admin/password');
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
							redirect('/installer-admin/profile/update-password/' . $user_id);
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this user. Please try again.</p></div>');
							redirect('/installer-admin/profile/update-password/' . $user_id);
						}
					}
					$this->load->view('admin_template', $data);
					break;
			}
		
		}
	}
	
	
/************************************************************************************************************************************************************
									BEGIN CUSTOM MODULES
																
***********************************************************************************************************************************************************/

	function home($dealer_id = NULL, $user = NULL) {
		$this->auth->restrict(FALSE, '3');
		$data['page_title'] = 'Installer Administration Home';

		if($dealer_id == NULL) {
			$dealer_id = $_SESSION['dealer_id'];
		} else {
			$_SESSION['dealer_id'] = $dealer_id;
			if($user == 'user') {
				//MUST SET session uid
				$user_id = $this->installer_admin_model->get_dealer_uid($_SESSION['admin_username'], $dealer_id);
				if($user_id == FALSE) {
					redirect('/installer-admin');
				} else {
					$_SESSION['uid'] = $user_id;
				}
				
			}
		}

		$data['dealer_info_array'] = $this->installer_admin_model->get_dealer_by_id($dealer_id);
		$data['site_updates_array'] = $this->installer_admin_model->get_site_updates();

		$data['page_content'] = 'admin_home';
		$data['current_section'] = 'home';
		$this->load->view('admin_template', $data);
	}

/*****************************************************************************************************************************************
/*	ACCOUNT INFO Page
/*	
/****************************************************************************************************************************************/	
	function account($action = NULL, $id = NULL) {
		$this->auth->restrict();
		$data['current_section'] = 'account';
		$data['dealer_array'] = $this->installer_admin_model->get_dealer_by_id($_SESSION['dealer_id']);
		
		if($action == NULL) {
			$data['page_content'] = 'admin_account';
		} else {
			switch($action) {
				case 'update':
					$data['page_title'] = 'Installer Administration - Update Account';
					$this->form_validation->set_rules('name', 'Dealer Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_first_name', 'Contact First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('contact_last_name', 'Contact Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
					$this->form_validation->set_rules('address2', '', 'trim|xss_clean');
					$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
					$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
					$this->form_validation->set_rules('zip', 'ZIP', 'trim|required|xss_clean');
					$this->form_validation->set_rules('phone1', 'Phone', 'trim|required|xss_clean');
					$this->form_validation->set_rules('fax', '', 'trim|xss_clean');
					$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');
					$this->form_validation->set_rules('primary_email', 'Primary E-mail', 'valid_email|trim|xss_clean');
					$this->form_validation->set_rules('cc_email', '', 'trim|xss_clean');
					$this->form_validation->set_rules('website', '', 'trim|xss_clean');
					$this->form_validation->set_rules('microsite_url', '', 'trim|xss_clean');
					$this->form_validation->set_rules('credentials', '', 'trim|xss_clean');
					$this->form_validation->set_rules('dealer_hours', '', 'trim|xss_clean');
					
					if($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_account_update';
					} else {
						$config['upload_path'] = './dealer_assets/dealer_logos/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '2000';
						$config['max_width']  = '1024';
						$config['max_height']  = '768';
						
						//Load Upload and Image libraries
						$this->load->library('upload');
						$this->load->library('image_lib');
						
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
								$data['page_content'] = 'admin_account_update';
								break;
							} else {
								$file_path = '';
								$image_name = '';
								
								$data = array('upload_data' => $this->upload->data());
								$file_path = $data['upload_data']['file_path'];
								$image_name = $data['upload_data']['file_name'];
								
								$image_height = $data['upload_data']['image_height'];
								
								if($image_height > 115) {
									$image_config['height'] = '115';
									//If no height specified, ratio doesn't work. set ridiculously high
									$image_config['width'] = '1500';
									$image_config['source_image'] = $file_path . $image_name;
									$image_config['maintain_ratio'] = TRUE;
									$this->image_lib->initialize($image_config);
									$this->image_lib->resize();
								}
								
								//Use raw name to insert into DB
								$raw_name = $data['upload_data']['raw_name'];
								$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
								
								//rename post array so we can add values to it for image
								$data_array = $_POST;
								
								//Add RSS Image data to post array
								$data_array['dealer_logo'] = $raw_name;
								$data_array['extension'] = $ext;
								
								$update = $this->dealer_admin_model->update_profile($data_array, TRUE);
								if($update) {
									$this->session->set_flashdata('status_message','<div class="success">Dealer has been updated successfully</div>');
									redirect('/installer-admin/account/update/');
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this dealer. Please try again.</p></div>');
									redirect('/installer-admin/account/update/');
								}
							}
						} else {
							// Dealer is not trying to update or add a logo
							$update = $this->dealer_admin_model->update_profile($_POST);
							if($update) {
								$this->session->set_flashdata('status_message','<div class="success">Profile has been updated successfully</div>');
								redirect('/installer-admin/account/update/');
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this profile. Please try again.</p></div>');
								redirect('/installer-admin/account/update/');
							}
							
						}
						
					}
					break;
				case 'homepage':
					$data['page_title'] = 'Installer Administration - Update Homepage';
					$data['default_info_array'] = $this->installer_admin_model->get_site_defaults();
					$this->form_validation->set_rules('dealer_homepage_headline', 'Homepage Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dealer_homepage_copy', 'Homepage Copy', 'trim|required|xss_clean');
					
					//Only visible to super admins, not dealers
					if($_SESSION['super_admin'] == 'yes') {
						$this->form_validation->set_rules('meta_title', '', 'trim|xss_clean');
						$this->form_validation->set_rules('meta_description', '', 'trim|xss_clean');
						$this->form_validation->set_rules('meta_keywords', '', 'trim|xss_clean');
					}
					if($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_account_homepage';
					} else {
						$update = $this->installer_admin_model->update_homepage_copy($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Homepage copy has been updated successfully</div>');
							redirect('/installer-admin/account/homepage/');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this copy. Please try again.</p></div>');
							redirect('/installer-admin/account/homepage/');
						}
					}
					break;
				case 'about':
					$data['page_title'] = 'Installer Administration - Update About';
					$this->form_validation->set_rules('about_dealer_text', 'About Dealer Copy', 'trim|required|xss_clean');
					$this->form_validation->set_rules('about_dealer_headline', 'About Dealer Headline', 'trim|required|xss_clean');
					//Only visible to super admins, not dealers
					if($this->session->userdata('super_admin') == 'yes') {
						$this->form_validation->set_rules('meta_title', '', 'trim|xss_clean');
						$this->form_validation->set_rules('meta_description', '', 'trim|xss_clean');
						$this->form_validation->set_rules('meta_keywords', '', 'trim|xss_clean');
					}
					if($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_account_about';
					} else {
						$config['upload_path'] = './dealer_assets/about_images/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '2000';
						$config['max_width']  = '1024';
						$config['max_height']  = '768';
						
						//Load Upload and Image libraries
						$this->load->library('upload');
						$this->load->library('image_lib');
						
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
								$data['page_content'] = 'admin_account_about';
								break;
							} else {
								$file_path = '';
								$image_name = '';
								
								$data = array('upload_data' => $this->upload->data());
								$file_path = $data['upload_data']['file_path'];
								$image_name = $data['upload_data']['file_name'];
								$image_width = $data['upload_data']['image_width'];
								
								if($image_width > 200) {
									$image_config['width'] = '200';
									//If no height specified, ratio doesn't work. set ridiculously high
									$image_config['height'] = '1500';
									$image_config['source_image'] = $file_path . $image_name;
									$image_config['maintain_ratio'] = TRUE;
									$this->image_lib->initialize($image_config);
									$this->image_lib->resize();
								}
								
								//Use raw name to insert into DB
								$raw_name = $data['upload_data']['raw_name'];
								$ext = substr($data['upload_data']['file_ext'], strrpos($data['upload_data']['file_ext'],'.')+1);
								
								//rename post array so we can add values to it for image
								$data_array = $_POST;
								
								$data_array['about_image'] = $raw_name;
								$data_array['about_extension'] = $ext;
								
								$update = $this->dealer_admin_model->update_about_copy($data_array, TRUE);
								if($update) {
								$this->session->set_flashdata('status_message','<div class="success">About copy has been updated successfully</div>');
									redirect('/installer-admin/account/about/');
								} else {
									$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this copy. Please try again.</p></div>');
									redirect('/installer-admin/account/about/');
								}
							}
						} else {
							
							$update = $this->dealer_admin_model->update_about_copy($_POST);
							if($update) {
								$this->session->set_flashdata('status_message','<div class="success">About copy has been updated successfully</div>');
								redirect('installer-admin/account/about/');
							} else {
								$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this copy. Please try again.</p></div>');
								redirect('installer-admin/account/about/');
							}
							
						}
						
						
					}
					break;
				case 'promotion':
					$data['page_title'] = 'Installer Administration - Update Promotion';
					$this->form_validation->set_rules('dealer_homepage_headline', 'Homepage Headline', 'trim|required|xss_clean');
					$this->form_validation->set_rules('dealer_homepage_copy', 'Homepage Copy', 'trim|required|xss_clean');
					
					if($this->form_validation->run() == FALSE) {
						$data['page_content'] = 'admin_account_promotion';
					} else {
						$update = $this->installer_admin_model->update_promotion($_POST);
						if($update) {
							$this->session->set_flashdata('status_message','<div class="success">Homepage copy has been updated successfully</div>');
							redirect('installer-admin/account/homepage/');
						} else {
							$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error updating this copy. Please try again.</p></div>');
							redirect('installer-admin/account/homepage/');
						}
					}
					break;
					
				case 'delete-logo':
					$data_array = array('dealer_id' => $id);
					$update = $this->dealer_admin_model->delete_logo($data_array);
					if($update) {
						$this->session->set_flashdata('status_message','<div class="success">Logo has been deleted successfully</div>');
						redirect('/installer-admin/account/update/');
					} else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting the logo. Please try again.</p></div>');
						redirect('/installer-admin/account/update/');
					}
					break;
					
				case 'delete-image':
					$data_array = array('dealer_id' => $id);
					$update = $this->dealer_admin_model->delete_about_image($data_array);
					if($update) {
						$this->session->set_flashdata('status_message','<div class="success">Image has been deleted successfully</div>');
						redirect('/installer-admin/account/about/');
					} else {
						$this->session->set_flashdata('status_message','<div class="error_alert"><p>There was an error deleting the image. Please try again.</p></div>');
						redirect('/installer-admin/account/about/');
					}
					break;
			}
		}
		
		$this->load->view('admin_template', $data);
	}

	
/*****************************************************************************************************************************************
/*	LOGOUT Page
/*	Destroy the logged in session and redirect to login page
/****************************************************************************************************************************************/	
	function logout() {
		$this->session->sess_destroy();
		session_destroy();
		redirect('installer-admin');
	}
	
	
}

/* End of file admin.php */
/* Location: ./system/application/modules/dealer_admin/controllers/dealer_admin.php */