<?php

class Dealer_admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
/***********************************************************************************************************************************
/*		GET FUNCTIONS
************************************************************************************************************************************/

/**********************************************************************************************************************************
		USERS MODULE FUNCTIONS
***********************************************************************************************************************************/
	
	function get_all_users($user_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		if($user_status != NULL) {
			$this->db->where('user_status',$user_status);
		}
		$this->db->order_by('last_name ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_user_by_id($user_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_user_by_email($email) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$where = array('username' => $email);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_user_email($user_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		$this->db->select('username');
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		foreach($query->result() as $row) {
			return $row->username;
		}
	}

/**********************************************************************************************************************************
		CONTACT MODULE FUNCTIONS
***********************************************************************************************************************************/

	function get_contact_requests($start_date, $end_date) {
		$db_table = $this->config->item('db_table_prefix') . 'contact';
		$where = array('insert_date >=' => $start_date, 'insert_date <=' => $end_date);
		$this->db->where($where);
		$this->db->order_by('insert_date ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

/**********************************************************************************************************************************
		PAGES MODULE FUNCTIONS
***********************************************************************************************************************************/

	function get_primary_nav_array($page_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_status == NULL) {
			$where = array('primary_category' => 'yes');
		} else {
			$where = array('primary_category' => 'yes', 'page_status' => $page_status);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_secondary_nav_array($primary_category_id, $page_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_status == NULL) {
			$where = array('primary_category_id' => $primary_category_id, 'secondary_category_id' => 0);
		} else {
			$where = array('primary_category_id' => $primary_category_id, 'secondary_category_id' => 0, 'page_status' => $page_status);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_third_nav_array($secondary_category_id, $page_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_status == NULL) {
			$where = array('secondary_category_id' => $secondary_category_id);
		} else {
			$where = array('secondary_category_id' => $secondary_category_id, 'page_status' => $page_status);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		
		return $query->result();
	}
	function get_footer_nav_array($page_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_status == NULL) {
			$where = array('page_location' => 'footer');
		} else {
			$where = array('page_location' => 'footer', 'page_status' => $page_status);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC, page_title ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_global_page_array($page_status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_status == NULL) {
			$where = array('page_location' => 'global');
		} else {
			$where = array('page_location' => 'global', 'page_status' => $page_status);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC, page_title ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_page_data_array($page_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$where = array('page_id' => $page_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_page_childen($page_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$this->db->where('primary_category_id',$page_id);
		$this->db->or_where('secondary_category_id', $page_id);
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_subnavigation_dropdown($category_id, $page_id = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		if($page_id === NULL) {
			$where = array('primary_category_id' => $category_id, 'secondary_category_id' => 0, 'page_status' => 'active', 'page_location' => 'main');
			$this->db->where($where);
			$this->db->order_by('sort_order ASC');
			$query = $this->db->get($db_table);

		} else {
			$this->db->where('primary_category_id', $category_id);
			$this->db->where('secondary_category_id', 0);
			$this->db->where('page_id !=', $page_id);
			$this->db->where('page_status', 'active');
			$this->db->where('page_location','main');
			$this->db->order_by('sort_order ASC');
			$query = $this->db->get($db_table);
		}
		return $query->result();
	}
	
	function get_url_path($page_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$this->db->where('page_id', $page_id);
		$query = $this->db->get($db_table,1);
		$page_data_array = $query->result();
		
		if($page_data_array[0]->primary_category == 'yes') {
			return '/' . $page_data_array[0]->page_url;
		} else if($page_data_array[0]->page_location == 'footer' || $page_data_array[0]->page_location == 'global') {
			return '/' . $page_data_array[0]->page_url;
		} else {
			//get primary url
			$db_table = $this->config->item('db_table_prefix') . 'content_pages';
			$this->db->where('page_id', $page_data_array[0]->primary_category_id);
			$query = $this->db->get($db_table,1);
			$primary_data_array = $query->result();	
			$url = '/' . $primary_data_array[0]->page_url;
			
			//Add secondary category page url
			if($page_data_array[0]->secondary_category_id != 0) {
				$db_table = $this->config->item('db_table_prefix') . 'content_pages';
				$this->db->where('page_id', $page_data_array[0]->secondary_category_id);
				$query = $this->db->get($db_table,1);
				$secondary_data_array = $query->result();	
				$url .= '/' . $secondary_data_array[0]->page_url;
				
			}
			
			$url .= '/' . $page_data_array[0]->page_url;
			return $url;
			
		}
	}

/**********************************************************************************************************************************
		DOCUMENTS MODULE FUNCTIONS
***********************************************************************************************************************************/

	function get_document_list($lower_limit = '0', $per_page, $sort = 'name') {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		$this->db->where('document_status','active');
		if($sort == 'name') {
			$this->db->order_by('document_name ASC');
		} else {
			switch($sort) {
				case 'insert_date':
					$this->db->order_by('insert_date DESC');
					break;
				default:
					$this->db->order_by('document_name ASC');
					break;
			}
		}
		$query = $this->db->get($db_table, $per_page, $lower_limit);
		return $query->result();
	}
	
	function get_document_by_id($document_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		$this->db->where('document_id',$document_id);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_document_dropdown() {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		$this->db->where('document_status','active');
		$this->db->order_by('document_name ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_total_documents_count() {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		$query = $this->db->get($db_table);
		return $query->num_rows();
	}

/**********************************************************************************************************************************
		IMAGES MODULE FUNCTIONS
***********************************************************************************************************************************/

	function get_image_list($lower_limit = '0', $per_page, $sort = 'name') {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		$this->db->where('image_status','active');
		if($sort == 'name') {
			$this->db->order_by('image_name ASC');
		} else {
			switch($sort) {
				case 'insert_date':
					$this->db->order_by('insert_date DESC');
					break;
				default:
					$this->db->order_by('image_name ASC');
					break;
			}
		}
		$query = $this->db->get($db_table, $per_page, $lower_limit);
		return $query->result();
	}
	
	function get_image_by_id($image_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		$this->db->where('image_id',$document_id);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	

	function get_total_image_count() {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		$query = $this->db->get($db_table);
		return $query->num_rows();
	}

/**********************************************************************************************************************************
		TINY MCE FUNCTIONS
***********************************************************************************************************************************/

	function generate_image_list() {
		// You can't simply echo everything right away because we need to set some headers first!
		$output = ''; // Here we buffer the JavaScript code we want to send to the browser.
		$delimiter = ""; // for eye candy... code gets new lines
		$output .= 'var tinyMCEImageList = new Array(';

		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		$this->db->order_by('image_name ASC');
		$query = $this->db->get($db_table);

		$image_array = $query->result();

		if(count($image_array) > 0) {
			foreach($image_array as $image) {
				$file = $image->image_file . '.' . $image->extension;
				$output .= $delimiter
					. '["'
					. utf8_encode($image->image_name)
					. '", "'
					. utf8_encode('/content-uploads/content-images/' . $file)
					. '"],';
			}
			$output = substr($output, 0, -1); // remove last comma from array item list (breaks some browsers)
		    $output .= $delimiter;
		}

		// Finish code: end of array definition. Now we have the JavaScript code ready!
		$output .= ');';

		// Make output a real JavaScript file!
		header('Content-type: text/javascript'); // browser will now recognize the file as a valid JS file

		// prevent browser from caching
		header('pragma: no-cache');
		header('expires: 0'); // i.e. contents have already expired

		// Now we can send data to the browser because all headers have been set!
		echo $output;
	}


/**********************************************************************************************************************************
		CUSTOM GET FUNCTIONS
***********************************************************************************************************************************/





	
/**********************************************************************************************************************************
		ADD FUNCTIONS
***********************************************************************************************************************************/

/**********************************************************************************************************************************
		USERS MODULE FUNCTIONS
***********************************************************************************************************************************/
	
	function add_user($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		//Create a hash
		$password = $data_array['password'];
		$salt = $this->config->item('salt');
		$hash_password = sha1($salt.$password);
		
		$data = array(
		   'first_name' => $data_array['first_name'],
		   'last_name' => $data_array['last_name'],
		   'username' => $data_array['username'],
		   'password' => $hash_password,
		   'permission_level' => $data_array['permission_level'],
		   'user_status' => 'active',
		   'last_login' => current_timestamp(),
		   'insert_date' => current_timestamp(),
		   'modification_date' => current_timestamp()
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		PAGES MODULE FUNCTIONS
***********************************************************************************************************************************/
	
	function add_page($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		if($data_array['page_content'] == '<br>' || $data_array['page_content'] == '<br />') {
			$data_array['page_content'] = '';
		}
		
		switch($data_array['primary_category_id']) {
			//New Section
			case 'main':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'main';
				$primary_category = 'yes';
				break;
			//Footer Page
			case 'footer':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'footer';
				$primary_category = 'no';
				break;
			//Global (ie Non-Categorized) Page
			case 'global':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'global';
				$primary_category = 'no';
				break;
				
			default:
				$primary_category_id = $data_array['primary_category_id'];
				if($data_array['secondary_category_id'] == '' || $data_array['secondary_category_id'] == NULL) {
					$secondary_category_id = 0;
				} else {
					$secondary_category_id = $data_array['secondary_category_id'];
				}
				$page_location = 'main';
				$primary_category = 'no';
				break;
		}
		
		$page_content = $data_array['page_content'];
		$publish_status = $data_array['page_status'] == 'active' ? 'yes' : 'no';
		$page_url = $data_array['page_url'] != '' ? url_title($data_array['page_url'], 'dash', TRUE) : url_title($data_array['page_title'], 'dash', TRUE);
		
		$data = array(
		   'page_title' => ascii_to_entities($data_array['page_title']),
		   'page_url' => $page_url,
		   'page_headline' => ascii_to_entities($data_array['page_headline']),
		   'page_content' => ascii_to_entities($page_content),
		   'page_draft_content' => '',
		   'page_location' => $page_location,
		   'primary_category' => $primary_category,
		   'primary_category_id' => $primary_category_id,
		   'secondary_category_id' => $secondary_category_id,
		   'sort_order' => '999',
		   'meta_title' => $data_array['meta_title'],
		   'meta_keywords' => $data_array['meta_keywords'],
		   'meta_description' => $data_array['meta_description'],
		   'page_status' => $data_array['page_status'],
		   'publish_status' => $publish_status,
		   'modified_by' => $_SESSION['admin_username'],
		   'insert_date' => current_timestamp(),
		   'modification_date' => current_timestamp()
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		IMAGES MODULE FUNCTIONS
***********************************************************************************************************************************/

	function add_content_image($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		
		$data = array(
		   'image_name' => $data_array['image_name'],
		   'image_file' => $data_array['image_file'],
		   'extension' => $data_array['extension'],
		   'image_status' => 'active',
		   'modified_by' => $this->session->userdata('admin_username'),
		   'insert_date' => current_timestamp(),
		   'modification_date' => current_timestamp()
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return FALSE;
		}
	}
	
/**********************************************************************************************************************************
		DOCUMENTS MODULE FUNCTIONS
***********************************************************************************************************************************/
	function add_content_document($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		
		$data = array(
		   'document_name' => $data_array['document_name'],
		   'document_file' => $data_array['document_file'],
		   'extension' => $data_array['extension'],
		   'document_status' => 'active',
		   'modified_by' => $this->session->userdata('admin_username'),
		   'insert_date' => current_timestamp(),
		   'modification_date' => current_timestamp()
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return FALSE;
		}
	}

	
/**********************************************************************************************************************************
		CUSTOM ADD FUNCTIONS
***********************************************************************************************************************************/
	
	


/**************************************************************************************************************************************
/*		UPDATE FUNCTIONS
**************************************************************************************************************************************/	

	
/**********************************************************************************************************************************
		USER MODULE UPDATE FUNCTIONS
***********************************************************************************************************************************/
	function update_user($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$data = array(
		   'first_name' => $data_array['first_name'],
		   'last_name' => $data_array['last_name'],
		   'username' => $data_array['username'],
		   'permission_level' => $data_array['permission_level'],
		   'user_status' => $data_array['user_status'],
		   'modification_date' => current_timestamp()
		);
		
		$this->db->where('user_id', $data_array['user_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function reset_password($user_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$temp_password = random_string('alnum', 12);
		$salt = $this->config->item('salt');
		$hash_password = sha1($salt.$temp_password);
		
		$data = array(
		   'password' => $hash_password,
		   'change_password' => 'yes',
		   'modification_date' => current_timestamp()
		);
		
		$this->db->where('user_id', $user_id);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return $temp_password;
		} else {
			return FALSE;
		}
	}
	
	function update_user_password($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$password = $data_array['password'];
		$salt = $this->config->item('salt');
		$hash_password = sha1($salt.$password);
		
		$data = array(
		   'password' => $hash_password,
		   'change_password' => 'no',
		   'modification_date' => current_timestamp()
		);
		
		$this->db->where('user_id', $data_array['user_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function forgot_reset_password($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$user_data_array = $this->get_user_by_email($data_array['username']);
		if(count($user_data_array) > 0) {
			$user_id = $user_data_array[0]->user_id;
			$temp_password = random_string('alnum', 12);
			$salt = $this->config->item('salt');
			$hash_password = sha1($salt.$temp_password);
			
			$data = array(
			   'password' => $hash_password,
			   'change_password' => 'yes',
			   'modification_date' => current_timestamp()
			);
			$this->db->where('user_id', $user_id);
			$result = $this->db->update($db_table, $data); 
			
			if($result) {
				return $temp_password;
			} else {
				return FALSE;
			}
		
		} else {
			
			return FALSE;
		
		}
	}

/**********************************************************************************************************************************
		PAGES MODULE FUNCTIONS
***********************************************************************************************************************************/

	/***********************************************************
	/* UPDATES A 1st/INITIAL DRAFT - A NEVER BEEN PUBLISHED PAGE
	/***********************************************************/
	function update_initial_draft($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		if($data_array['page_content'] == '<br>' || $data_array['page_content'] == '<br />') {
			$data_array['page_content'] = '';
		}
		
		switch($data_array['primary_category_id']) {
			//New Section
			case 'main':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'main';
				$primary_category = 'yes';
				break;
			//Footer Page
			case 'footer':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'footer';
				$primary_category = 'no';
				break;
			//Global (ie Non-Categorized) Page
			case 'global':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'global';
				$primary_category = 'no';
				break;
				
			default:
				$primary_category_id = $data_array['primary_category_id'];
				if($data_array['secondary_category_id'] == '' || $data_array['secondary_category_id'] == NULL) {
					$secondary_category_id = 0;
				} else {
					$secondary_category_id = $data_array['secondary_category_id'];
				}
				$page_location = 'main';
				$primary_category = 'no';
				break;
		}
		
		$page_content = $data_array['page_content'];
		
		$data = array(
		   'page_title' => '',
		   'page_draft_title' => $data_array['page_title'],
		   'page_url' => url_title($data_array['page_title'], 'dash', TRUE),
		   'page_headline' => '',
		   'page_draft_headline' => $data_array['page_headline'],
		   'page_content' => '',
		   'page_draft_content' => ascii_to_entities($page_content),
		   'page_location' => $page_location,
		   'primary_category' => $primary_category,
		   'primary_category_id' => $primary_category_id,
		   'secondary_category_id' => $secondary_category_id,
		   'meta_title' => $data_array['meta_title'],
		   'meta_keywords' => $data_array['meta_keywords'],
		   'meta_description' => $data_array['meta_description'],
		   'page_status' => 'inactive',
		   'publish_status' => 'no',
		   'modified_by' => $this->session->userdata('admin_username'),
		   'modification_date' => current_timestamp()
		);
		
		$this->db->where('page_id', $data_array['page_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
		
	}
	
	function update_page($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		if($data_array['page_content'] == '<br>' || $data_array['page_content'] == '<br />') {
			$data_array['page_content'] = '';
		}
		
		switch($data_array['primary_category_id']) {
			//New Section
			case 'main':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'main';
				$primary_category = 'yes';
				break;
			//Footer Page
			case 'footer':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'footer';
				$primary_category = 'no';
				break;
			//Global (ie Non-Categorized) Page
			case 'global':
				$primary_category_id = 0;
				$secondary_category_id = 0;
				$page_location = 'global';
				$primary_category = 'no';
				break;
				
			default:
				$primary_category_id = $data_array['primary_category_id'];
				if($data_array['secondary_category_id'] == '' || $data_array['secondary_category_id'] == NULL) {
					$secondary_category_id = 0;
				} else {
					$secondary_category_id = $data_array['secondary_category_id'];
				}
				$page_location = 'main';
				$primary_category = 'no';
				break;
		}
		
		$page_content = $data_array['page_content'];
		$publish_status = $data_array['page_status'] == 'active' ? 'yes' : 'no';
		$page_url = $data_array['page_url'] != '' ? url_title($data_array['page_url'], 'dash', TRUE) : url_title($data_array['page_title'], 'dash', TRUE);
		
		$data = array(
		   'page_title' => ascii_to_entities($data_array['page_title']),
		   'page_draft_title' => '',
		   'page_url' => $page_url,
		   'page_headline' => ascii_to_entities($data_array['page_headline']),
		   'page_draft_headline' => '',
		   'page_content' => ascii_to_entities($page_content),
		   'page_draft_content' => '',
		   'page_location' => $page_location,
		   'primary_category' => $primary_category,
		   'primary_category_id' => $primary_category_id,
		   'secondary_category_id' => $secondary_category_id,
		   'meta_title' => $data_array['meta_title'],
		   'meta_keywords' => $data_array['meta_keywords'],
		   'meta_description' => $data_array['meta_description'],
		   'page_status' => $data_array['page_status'],
		   'publish_status' => $publish_status,
		   'modified_by' => $_SESSION['admin_username'],
		   'modification_date' => current_timestamp()
		);

		$this->db->where('page_id', $data_array['page_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function update_draft($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		if($data_array['page_content'] == '<br>' || $data_array['page_content'] == '<br />') {
			$data_array['page_content'] = '';
		}
		
		$page_content = $data_array['page_content'];
		
		$data = array(
		   'page_draft_title' => $data_array['page_title'],
		   'page_draft_headline' => $data_array['page_headline'],
		   'page_draft_content' => ascii_to_entities($page_content),
		   'modified_by' => $this->session->userdata('admin_username'),
		   'modification_date' => current_timestamp()
		);

		$this->db->where('page_id', $data_array['page_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
		
		
	}
	
	/**********************************************
	/* SUBSTITUTES THE LIVE CONTENT WITH THE DRAFT ITEM, PUSHING CHANGES LIVE
	/*********************************************/
	function update_draft_to_live($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		if($data_array['page_content'] == '<br>' || $data_array['page_content'] == '<br />') {
			$data_array['page_content'] = '';
		}
		
		$page_content = $data_array['page_content'];
		
		$data = array(
		   'page_title' => $data_array['page_title'],	
		   'page_draft_title' => '',
		   'page_headline' => $data_array['page_headline'],
		   'page_draft_headline' => '',
		   'page_content' => ascii_to_entities($page_content),
		   'page_draft_content' => '',
		   'modified_by' => $this->session->userdata('admin_username'),
		   'modification_date' => current_timestamp()
		);

		$this->db->where('page_id', $data_array['page_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	function update_section_order($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		foreach($data_array['nav_item'] as $sort_order => $page_id) {
			$data = array('sort_order' => $sort_order);
			$this->db->where('page_id', $page_id);
			$result = $this->db->update($db_table, $data); 
		}
		
		return TRUE;
	}
	
	function deactivate_children($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		foreach($data_array as $page) {
			$data = array('page_status' => 'inactive');
			$this->db->where('page_id', $page->page_id);
			$result = $this->db->update($db_table, $data); 
		}
		
		return TRUE;
	}

/**********************************************************************************************************************************
		DOCUMENTS MODULE FUNCTIONS
***********************************************************************************************************************************/

	function update_document($data_array, $update_filename = FALSE) {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		
		if($update_filename == TRUE) {
			$data = array(
			   'document_name' => $data_array['document_name'],
			   'document_file' => $data_array['document_file'],
			   'extension' => $data_array['extension'],
			   'modified_by' => $this->session->userdata('admin_username'),
			   'modification_date' => current_timestamp()
			);
		} else {
			$data = array(
			   'document_name' => $data_array['document_name'],
			   'modified_by' => $this->session->userdata('admin_username'),
			   'modification_date' => current_timestamp()
			);
		}
		
		$this->db->where('document_id', $data_array['document_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		IMAGES MODULE FUNCTIONS
***********************************************************************************************************************************/
	
	function update_image($data_array, $update_filename = FALSE) {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		
		if($update_filename == TRUE) {
			$data = array(
			   'image_name' => $data_array['image_name'],
			   'image_file' => $data_array['image_file'],
			   'extension' => $data_array['extension'],
			   'modified_by' => $this->session->userdata('admin_username'),
			   'modification_date' => current_timestamp()
			);
		} else {
			$data = array(
			   'image_name' => $data_array['image_name'],
			   'modified_by' => $this->session->userdata('admin_username'),
			   'modification_date' => current_timestamp()
			);
		}
		
		$this->db->where('image_id', $data_array['image_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($this->db->affected_rows() == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		CUSTOM UPDATE FUNCTIONS
***********************************************************************************************************************************/





	

/**************************************************************************************************************************************
/*		DELETE FUNCTIONS
**************************************************************************************************************************************/	

/**********************************************************************************************************************************
		USER MODULE DELETE FUNCTIONS
***********************************************************************************************************************************/
	
	function delete_user($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		$this->db->where('user_id',$data_array['user_id']);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		PAGES MODULE DELETE FUNCTIONS
***********************************************************************************************************************************/

	function delete_page($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		
		$children_array = $this->get_page_childen($data_array['page_id']);
		
		$result = $this->db->delete($db_table, array('page_id' => $data_array['page_id']));
		
		if($result) {
			if(count($children_array) > 0) {
				//Set children pages as global if necessary
				foreach($children_array as $child) {
					$data = array('page_location' => 'global', 'primary_category_id' => 0, 'secondary_category_id' => 0);
					$this->db->where('page_id', $child->page_id);
					$result = $this->db->update($db_table, $data);
				}
				return TRUE;
			} else {
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		IMAGES MODULE DELETE FUNCTIONS
***********************************************************************************************************************************/

	function delete_image($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_images';
		$image_array = $this->get_image_by_id($data_array['image_id']);
		foreach($image_array as $image) {
			$large_image = $image->image_file . '.' . $image->extension;
			$large_image_dir = $_SERVER['DOCUMENT_ROOT'] . '/content_images/';
			
			$thumb_image = $image->image_file . '_th.' . $image->extension;
			$thumb_image_dir = $_SERVER['DOCUMENT_ROOT'] . '/content_images/thumbs/';
		}
		
		if($large_image != '') {
			$this->db->where('image_id',$data_array['image_id']);
			$result = $this->db->delete($db_table);
			if($result) {
				$large_delete = unlink($large_image_dir . $large_image);
				$thumb_delete = unlink($thumb_image_dir . $thumb_image);
				if($large_delete && $thumb_delete) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
			
		} else {
			return FALSE;
		}
		
	}

/**********************************************************************************************************************************
		DOCUMENTS MODULE DELETE FUNCTIONS
***********************************************************************************************************************************/
	
	function delete_document($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		$doc_array = $this->get_document_by_id($data_array['document_id']);
		foreach($doc_array as $doc) {
			$doc = $doc->document_file . '.' . $doc->extension;
			$doc_dir = $_SERVER['DOCUMENT_ROOT'] . '/content_documents/';
		}
		
		if($doc != '') {
			$this->db->where('document_id',$data_array['document_id']);
			$result = $this->db->delete($db_table);
			if($result) {
				$delete = unlink($doc_dir . $doc);
				if($delete) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
			
		} else {
			return FALSE;
		}
		
	}



}
	
/* End of file dealer_admin_model.php */
/* Location: ./system/application/modules/dealer_admin/models/dealer_admin_model.php */