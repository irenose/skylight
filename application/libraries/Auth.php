<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Auth {

	var $CI = NULL;

	function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->database();
		$this->CI->load->helper('url');
	}

	function process_login($login = NULL, $verify_dealer = FALSE, $redirected_from = '') {
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
			$user_array = array(
				'admin_username' => 'gparish@wrayward.com',
				'uid' => '99999',
				'permission_level' => '0',
				'first_name' => 'Wray Ward Admin',
				'change_password' => 'no',
				'redirected_from' => $redirected_from,
				'super_admin' => 'yes',
				'dealer_id' => 0			
			);
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

					//Super-admin. Bypass "verification of active sites"
					if( $user_array[0]->permission_level < 2) {
						$super_admin = 'yes';
						$new_user_array = array(
							'admin_username' => $username,
							'uid' => $user_array[0]->user_id,
							'permission_level' => $user_array[0]->permission_level,
							'first_name' =>  $user_array[0]->first_name,
							'change_password' => $user_array[0]->change_password,
							'redirected_from' => $redirected_from,
							'super_admin' => $super_admin,	
							'dealer_id' => $user_array[0]->dealer_id
						); 
						return $new_user_array;
					} else {

						if($verify_dealer === TRUE) {
							$db_table = $this->CI->config->item('db_table_prefix') . 'dealers';
							$where = array('dealer_id' => $user_array[0]->dealer_id, 'dealer_status' => 'active');
							$this->CI->db->where($where);
							$dealer_query = $this->CI->db->get($db_table);
							if($dealer_query->num_rows() == 0) {
								return FALSE;
								exit;
							}
						}

						$super_admin = 'no';
						$new_user_array = array(
							'admin_username' => $username,
							'uid' => $user_array[0]->user_id,
							'permission_level' => $user_array[0]->permission_level,
							'first_name' =>  $user_array[0]->first_name,
							'change_password' => $user_array[0]->change_password,
							'redirected_from' => $redirected_from,
							'super_admin' => $super_admin,
							'dealer_id' => $user_array[0]->dealer_id		
						); 
						return $new_user_array;
					}
					
				} else if($query->num_rows() > 1) {
					$user_array = $query->result();

					//Installer has multiple sites
					$active_sites_array = array();

					if($verify_dealer === TRUE) {
						foreach($user_array as $user) {
							$db_table = $this->CI->config->item('db_table_prefix') . 'dealers';
							$where = array('dealer_id' => $user->dealer_id, 'dealer_status' => 'active');
							$this->CI->db->where($where);
							$dealer_query = $this->CI->db->get($db_table);
							if($dealer_query->num_rows() > 0) {
								$dealer = $dealer_query->result();
								$active_sites_array[] = array('dealer_id' => $user->dealer_id, 'name' => $dealer[0]->name, 'city' => $dealer[0]->city);
							}
						}

						if(count($active_sites_array) == 0) {
							return FALSE;
						} else {
							if( $user_array[0]->permission_level < 2) {
								$super_admin = 'yes';
							} else {
								$super_admin = 'no';
							}

							//DEALER HAD MULTIPLE SITES, BUT ONLY 1 IS ACTIVE
							//JUST RETURN NORMAL ARRAY
							if(count($active_sites_array) == 1) {
								$dealer_id = $active_sites_array[0]['dealer_id'];
								$new_user_array = array(
									'admin_username' => $username,
									'uid' => $user_array[0]->user_id,
									'permission_level' => $user_array[0]->permission_level,
									'first_name' =>  $user_array[0]->first_name,
									'change_password' => $user_array[0]->change_password,
									'redirected_from' => $redirected_from,
									'super_admin' => $super_admin,
									'dealer_id' => $dealer_id		
								);

							} else {
								//RETURN ARRAY WITH ACTIVE SITES OPTION
								$new_user_array = array(
									'admin_username' => $username,
									'uid' => $user_array[0]->user_id,
									'permission_level' => $user_array[0]->permission_level,
									'first_name' =>  $user_array[0]->first_name,
									'change_password' => $user_array[0]->change_password,
									'redirected_from' => $redirected_from,
									'super_admin' => $super_admin,
									'active_sites' => $active_sites_array,
									'dealer_id' => ''		
								);
							}
							return $new_user_array;
						}
					}
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
			$url_base = $this->CI->uri->segment(1);
			redirect($url_base . '/?redirect=' . $this->CI->uri->uri_string());
		}
		
		// If a permission level is set and the user is logged in, but doesn't have a high-enough permission level, bounce them
		if($permission_level != NULL) {
			if($this->logged_in() && $_SESSION['permission_level'] > $permission_level) {
				if($_SESSION['permission_level'] <= 2) {
					redirect('/admin/home');
				} else {
					redirect('/installer-admin/home');
				}
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