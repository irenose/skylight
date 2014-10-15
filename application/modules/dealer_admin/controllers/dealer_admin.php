<?php

class Dealer_admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		session_start();
		$this->load->library('auth');
		$this->load->library('pagination');
		$this->load->library('sitemap');
		$this->load->library('rss');
		$this->load->model('dealer_admin_model');
		$this->load->model('page/page_model');
		parse_str($_SERVER['QUERY_STRING'],$_GET);
	}
	
/*****************************************************************************************************************************************
/*	LOGIN Page
*****************************************************************************************************************************************/
	function index() {
		echo 'here';
		exit;
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
/* Location: ./system/application/modules/dealer_admin/controllers/dealer_admin.php */