<?php
	$this->session->set_userdata('admin_username', $user_array['admin_username']);
	$this->session->set_userdata('uid', $user_array['uid']);
	$this->session->set_userdata('permission_level', $user_array['permission_level']);
	$this->session->set_userdata('first_name', $user_array['first_name']);
	$this->session->set_userdata('change_password', $user_array['change_password']);
	$this->session->set_userdata('super_admin', $user_array['super_admin']);
	$this->session->set_userdata('redirected_from', $user_array['redirected_from']);
	$this->session->set_userdata('dealer_id', $user_array['dealer_id']);
	
	$_SESSION['admin_username'] = $user_array['admin_username'];
	$_SESSION['uid'] = $user_array['uid'];
	$_SESSION['permission_level'] = $user_array['permission_level'];
	$_SESSION['first_name'] = $user_array['first_name'];
	$_SESSION['change_password'] = $user_array['change_password'];
	$_SESSION['super_admin'] = $user_array['super_admin'];
	$_SESSION['redirected_from'] = $user_array['redirected_from'];
	$_SESSION['dealer_id'] = $user_array['dealer_id'];

	if($user_array['permission_level'] < 2) {
		redirect('/admin/home');
	} else {
		if(array_key_exists('active_sites', $user_array)) {
			$data['active_sites_array'] = $user_array['active_sites'];
			$data['page_content'] = 'admin_login_choose';
			$this->load->view('admin_template', $data);

		} else {
		
			if($user_array['change_password'] == 'yes') {
				redirect('/installer-admin/password/update/' . $user_array['uid']);
			} else if($user_array['redirected_from'] != '') {
				$_SESSION['redirected_from'] = '';
				redirect($user_array['redirected_from']);
			} else {
				redirect('/installer-admin/home');
			}
		}
	}