<?php

class Ajax extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		$this->load->model('page/page_model');
		$this->load->model('admin/admin_model');
	}

/***********************************************************************************
/*	NOTES:
/*	Controls all ajax jquery requests for the site. For simplicity, response is just echoed
/*	in the function, rather than requiring a separate view file
************************************************************************************/

    function get_view() {
        $this->data['vars'] = $this->input->get('vars');
        $this->load->view('page/' . $this->input->get('view'), $this->data);        
    }

    function check_url() {
		$test_url = @$_POST['test_url'];
		if($test_url != '') {
			$url_array = $this->page_model->check_url($test_url);
			if(count($url_array) > 0) {
				echo '<span style="color:#ff0000;font-weight:bold;">URL is already in use.</span>';
			} else {
				echo '<span style="color:#4cb61d;font-weight:bold;">URL is available.</span>';	
			}
		} else {
			echo '<span style="color:#ff0000;font-weight:bold;">Please enter a URL</span>';	
		}
		
	}

	function check_email() {
		$register_email = @$_POST['register_email'];
		if($register_email != '') {
			$email_array = $this->page_model->check_email_availability($register_email);
			if(count($email_array) > 0) {
				echo '<span style="color:#ff0000;font-weight:bold;">E-mail Address is already in use.</span>';
			} else {
				echo '<span style="color:#4cb61d;font-weight:bold;">E-mail Address is available.</span>';
			}
		} else {
			echo '<span style="color:#ff0000;font-weight:bold;">Please enter an E-mail Address</span>';
		}
	}

	function admin_user_search() {
		$search_term = @$_POST['user'];
		if(trim($search_term) == '') {
			echo '<p>There are no users that matched your search.</p>';
		} else {
			$user_array = $this->admin_model->get_users_by_name($search_term);
			if(count($user_array) > 0) {
				echo '<p><strong><em>The following users matched your search:</em></strong><br />';
				foreach($user_array as $user) {
					echo $user->first_name . ' ' . $user->last_name . '&nbsp;&nbsp;&nbsp;<a href="/admin/downloads/user/' . $user->user_id . '">Download Report</a><br />';
				}
				echo '</p>';
			} else {
				echo '<p><em>There are no users that matched your search.</em></p>';
			}
		}
	}

	function dropdown() {
		$action = $_POST['action'];
		
		switch($action) {
				
			case 'get_subcategories':
				$page_id = $_POST['page_id'];
				$selected_category_id = $_POST['selected_category_id'];
				$page_array = $this->nav_model->get_subnavigation_dropdown($selected_category_id, $page_id);
				echo '<option value="">Choose a sub-category</option>' . "\n";
				foreach($page_array as $row) {
					echo '<option value="' . $row->page_id . '">' . $row->page_title . '</option>' . "\n";
				}
				break;
				
			case 'get_product_subcategories':
				$selected_category_id = $_POST['selected_category_id'];
				$cat_array = $this->admin_model->get_product_subcategories($selected_category_id);
				echo '<option value="">Choose a sub-category</option>' . "\n";
				foreach($cat_array as $row) {
					echo '<option value="' . $row->product_category_id . '">' . $row->product_category_name . '</option>' . "\n";
				}
				break;
		}
	}
}

/* End of file ajax.php */
/* Location: ./system/application/controllers/ajax.php */