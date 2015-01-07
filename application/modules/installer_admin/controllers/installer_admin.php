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

	function promotion($action = NULL) {
		$this->auth->restrict(FALSE, '3');
	}

	function about($action = NULL) {
		$this->auth->restrict(FALSE, '3');
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