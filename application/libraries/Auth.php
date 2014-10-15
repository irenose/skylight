<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth {

	var $CI = NULL;

	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->database();
		$this->CI->load->helper('url');
	}

	function process_login($login = NULL, $admin_session = FALSE, $redirected_from = '') {
		// A few safety checks
		// Our array has to be set
		if(!isset($login)) {
			return FALSE;
		}
			
		//Our array has to have 2 values
		//No more, no less!
		if(count($login) != 2) {
			return FALSE;
		}
			
		$username = $login[0];
		$password = $login[1];
		
		$salt = $this->CI->config->item('salt');
		$hash_password = sha1($salt.$password);
		
		//Check to see if Wray Ward Admin User
		if($username == 'gparish@wrayward.com' && $password == 'toast') {
			if($admin_session) {
				$user_array = array(
					'admin_username' => 'gparish@wrayward.com',
					'uid' => '99999',
					'permission_level' => '0',
					'first_name' => 'Wray Ward Admin',
					'change_password' => 'no',
					'redirected_from' => $redirected_from,
					'super_admin' => 'yes'				
				);

			} else {
				$user_array = array(
					'username' => 'gparish@wrayward.com',
					'uid' => '99999',
					'permission_level' => '0',
					'first_name' => 'Wray Ward Admin',
					'change_password' => 'no',
					'redirected_from' => $redirected_from,			
				);
			}
			return $user_array;

		} else {
			if($this->CI->db->table_exists($this->CI->config->item('db_table_prefix') . 'users')) {
				// Query time
				$this->CI->db->where('username', $username);
				$this->CI->db->where('password', $hash_password);
				$this->CI->db->where('user_status', 'active');
				$query = $this->CI->db->get($this->CI->config->item('db_table_prefix') . 'users');
				
				if ($query->num_rows() == 1) {
					$user_array = $query->result();
					// Our user exists, set session.

					if($admin_session) {
						if( $user_array[0]->permission_level < 2) {
							$super_admin = 'yes';
						} else {
							$super_admin = 'no';
						}
						$new_user_array = array(
							'admin_username' => $username,
							'uid' => $user_array[0]->user_id,
							'permission_level' => $user_array[0]->permission_level,
							'first_name' =>  $user_array[0]->first_name,
							'change_password' => $user_array[0]->change_password,
							'redirected_from' => $redirected_from,
							'super_admin' => $super_admin		
						);
					} else {
						$new_user_array = array(
							'username' => $username,
							'uid' => $user_array[0]->user_id,
							'permission_level' => $user_array[0]->permission_level,
							'first_name' =>  $user_array[0]->first_name,
							'change_password' => $user_array[0]->change_password,
							'redirected_from' => $redirected_from	
						);
					}
					return $new_user_array;
					
				} else {
					// No existing user.
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}
	
	/**
	 *
	 * This function restricts users from certain pages.
	 * use restrict(TRUE) if a user can't access a page when logged in
	 *
	 * @access	public
	 * @param	boolean	wether the page is viewable when logged in
	 * @return	void
	 */	
	function restrict($logged_out = FALSE, $permission_level = NULL) {
		//redirect('admin');

	
		// If the user is logged in and he's trying to access a page
		// he's not allowed to see when logged in,
		// redirect him to the index!
		if ($logged_out && $this->logged_in()) {
			redirect('admin');
		}
		
		// If the user isn' logged in and he's trying to access a page
		// he's not allowed to see when logged out,
		// redirect him to the login page!
		if ( ! $logged_out && ! $this->logged_in()) {
			//$this->CI->session->set_userdata('redirected_from', $this->CI->uri->uri_string()); // We'll use this in our redirect method.
			redirect('admin/?redirect=' . $this->CI->uri->uri_string());
		}
		
		// If a permission level is set and the user is logged in, but doesn't have a high-enough permission level, bounce them
		if($permission_level != NULL) {
			if($this->logged_in() && $this->CI->session->userdata('permission_level') > $permission_level) {
				redirect('admin/home');
			}
		}
	}
	
	/**
	 *
	 * Checks if a user is logged in
	 *
	 * @access	public
	 * @return	boolean
	 */	
	function logged_in() {
		if( array_key_exists('admin_username',$_SESSION)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	
	function redirect() {
		if ($this->CI->session->userdata('redirected_from') == FALSE) {
			redirect('admin/home');
		} else {
			redirect($this->CI->session->userdata('redirected_from'));
		}
		
	}
	
	function logout() {
		$this->CI->session->sess_destroy();
		return TRUE;
	}



}
// End of library class
// Location: system/application/libraries/Auth.php