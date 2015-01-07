<?php
	$this->session->set_userdata('admin_username', $user_array['admin_username']);
	$this->session->set_userdata('uid', $user_array['uid']);
	$this->session->set_userdata('permission_level', $user_array['permission_level']);
	$this->session->set_userdata('first_name', $user_array['first_name']);
	$this->session->set_userdata('change_password', $user_array['change_password']);
	$this->session->set_userdata('super_admin', $user_array['super_admin']);
	$this->session->set_userdata('redirected_from', $user_array['redirected_from']);
	
	$_SESSION['admin_username'] = $user_array['admin_username'];
	$_SESSION['uid'] = $user_array['uid'];
	$_SESSION['permission_level'] = $user_array['permission_level'];
	$_SESSION['first_name'] = $user_array['first_name'];
	$_SESSION['change_password'] = $user_array['change_password'];
	$_SESSION['super_admin'] = $user_array['super_admin'];
	$_SESSION['redirected_from'] = $user_array['redirected_from'];
	
	if($user_array['change_password'] == 'yes') {
		redirect('/admin/password/update/' . $user_array['uid']);
	} else if($user_array['redirected_from'] != '') {
		$_SESSION['redirected_from'] = '';
		redirect($user_array['redirected_from']);
	} else {
		redirect('/admin/home');
	}