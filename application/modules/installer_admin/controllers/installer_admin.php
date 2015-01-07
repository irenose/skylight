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
	
	
/************************************************************************************************************************************************************
									BEGIN CUSTOM MODULES
																
***********************************************************************************************************************************************************/

	function home() {

	}

	function promotion($action = NULL) {

	}

	function about($action = NULL) {

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
/* Location: ./system/application/modules/dealer_admin/controllers/dealer_admin.php */