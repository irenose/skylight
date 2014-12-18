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
}

/* End of file ajax.php */
/* Location: ./system/application/controllers/ajax.php */