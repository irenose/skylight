<?php

class Installer_admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
/***********************************************************************************************************************************
/*		GET FUNCTIONS
************************************************************************************************************************************/

	function get_site_defaults() {
		$db_table = $this->config->item('db_table_prefix') . 'site_default';
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_dealer_by_id($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$this->db->where('dealer_id',$dealer_id);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_dealer_uid($username, $dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		$where = array('username' => $username, 'dealer_id' => $dealer_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		if($query->num_rows() == 1) {
			foreach($query->result() as $row) {
				return $row->user_id;
			}
		} else {
			return FALSE;
		}
	}

	function get_dealer_options($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		$this->db->where('dealer_id',$dealer_id);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_site_updates() {
		$db_table = $this->config->item('db_table_prefix') . 'updates';
		$this->db->order_by('insert_date DESC');
		$query = $this->db->get($db_table, 10);
		return $query->result();
	}

	function get_testimonials($dealer_id, $status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		if($status != NULL) {
			$where = array('dealer_id' => $dealer_id, 'testimonial_status' => $status);
		} else {
			$where = array('dealer_id' => $dealer_id);
		}
		$this->db->where($where);
		$this->db->order_by('testimonial_id DESC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_literature($status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		$where = array('literature_status' => $status);
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_testimonial_by_id($testimonial_id) {
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		$where = array('testimonial_id' => $testimonial_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_product_categories($status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		if($status != NULL) {
			$where = array('primary_category_id' => 0, 'product_category_status' => $status);
		} else {
			$where = array('primary_category_id' => 0);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_products_by_category($product_category_id, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		
		$this->db->select('ss_products.product_id AS product_id, ss_product_categories.product_category_name AS product_category_name, ss_product_categories.sort_order AS product_category_sort, ss_products.sort_order AS product_sort, ss_products.product_name AS product_name, ss_products.product_status AS product_status, ss_products.primary_category_id AS primary_category_id, ss_products.secondary_category_id AS secondary_category_id, ss_products.product_category_id AS product_category_id, ss_products.model_number AS model_number, ss_products.product_image AS product_image, ss_products.extension AS extension', FALSE);
		$this->db->join('ss_product_categories', 'ss_product_categories.product_category_id = ss_products.primary_category_id', 'inner');
		if($status != NULL) {
			$where = "ss_products.product_status='$status' AND ss_product_categories.product_category_status='$status' AND ss_products.product_category_id='$product_category_id'";
			$this->db->where($where, NULL, FALSE);
		} else {
			$where = "ss_products.product_category_id='$product_category_id'";
			$this->db->where($where, NULL, FALSE);
		}
		$this->db->order_by('ss_product_categories.sort_order ASC, ss_products.sort_order ASC');

		$query = $this->db->get($db_table);
		return $query->result();

	}

	function get_photos_by_dealer($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'photos';
		$where = array('dealer_id' => $dealer_id, 'photo_status' => 'active');
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_photo_by_id($photo_id) {
		$db_table = $this->config->item('db_table_prefix') . 'photos';
		$where = array('photo_id' => $photo_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();	
	}

	function get_user_by_id($user_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_user_by_email($email, $limit = 1) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
		$where = array('username' => $email);
		$this->db->where($where);
		if($limit == 'all') {
			$query = $this->db->get($db_table);
		} else {
			$query = $this->db->get($db_table, 1);
		}
		return $query->result();
	}
	
	function get_user_email($user_id) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		$this->db->select('username');
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		foreach($query->result() as $row) {
			return $row->username;
		}
	}
	

/***********************************************************************************************************************************
/*		ADD FUNCTIONS
************************************************************************************************************************************/
	function add_testimonial($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		
		$data = array(
			'dealer_id' => $data_array['dealer_id'],
			'testimonial_copy' => htmlspecialchars(strip_tags($data_array['testimonial_copy']), ENT_QUOTES, 'UTF-8'),
			'testimonial_name' => $data_array['testimonial_name'],
			'testimonial_source' => $data_array['testimonial_source'],
			'testimonial_status' => 'active',
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

/***********************************************************************************************************************************
/*		UPDATE FUNCTIONS
************************************************************************************************************************************/

	/****************************
		Update Profile
	********************************/
	function update_profile($data_array, $has_image = FALSE) {
		
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$latitude = NULL;
		$longitude = NULL;
		
		$current_info_array = $this->get_dealer_by_id($data_array['dealer_id']);
		
		//Get Coordinates
		$coordinates_array = $this->page_model->get_coordinates($data_array['zip']);
		if(count($coordinates_array) > 0) {
			$latitude = $coordinates_array[0]->latitude;
			$longitude = $coordinates_array[0]->longitude;
		}
		
		//Format URL
		if(trim($data_array['website']) != '') {
			$website = prep_url($data_array['website']);
			
		} else {
			$website = '';
		}
		
		//Format URL
		if(trim($data_array['microsite_url']) != '') {
			$microsite_url = prep_url($data_array['microsite_url']);
			
		} else {
			$microsite_url = '';
		}
		
		//Format cc emails as comma separated list
		$temp_cc_email = trim($data_array['cc_email']);
		if($temp_cc_email != '') {
			if(strpos($temp_cc_email, ',') > 0) {
				$email_array = explode(',', $temp_cc_email);				
			} else if(strpos($temp_cc_email, "\r\n") > 0) {
				$email_array = explode("\r\n", $temp_cc_email);
			} else {
				$email_array = explode("\n", $temp_cc_email);
			}
			$count = 0;
			foreach($email_array as $key => $value) {
				$count++;
				if($count == 1) {
					$cc_email = trim($value);	
				} else {
					$cc_email .= ',' . trim($value);	
				}
			}

		} else {
			$cc_email = $temp_cc_email;
		}
		
		$email_headline = '';
		$email_message = '';
		$changes = 0;
		//Compile a list of changes for email
		if(trim($current_info_array[0]->name) != trim($data_array['name'])) {
			$email_message .= 'Previous Company Name: ' . $current_info_array[0]->name . "\n" . 'New Company Name: ' . $data_array['name'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->address) != trim($data_array['address'])) {
			$email_message .= 'Previous Street Address: ' . $current_info_array[0]->address . "\n" . 'New Address: ' . $data_array['address'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->address2) != trim($data_array['address2'])) {
			$email_message .= 'Previous Street Address 2: ' . $current_info_array[0]->address2 . "\n" . 'New Street Address 2: ' . $data_array['address2'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->city) != trim($data_array['city'])) {
			$email_message .= 'Previous City: ' . $current_info_array[0]->city . "\n" . 'New City: ' . $data_array['city'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->state) != trim($data_array['state'])) {
			$email_message .= 'Previous State: ' . $current_info_array[0]->state . "\n" . 'New State: ' . $data_array['state'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->zip) != trim($data_array['zip'])) {
			$email_message .= 'Previous ZIP: ' . $current_info_array[0]->zip . "\n" . 'New ZIP: ' . $data_array['zip'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->email) != trim($data_array['email'])) {
			$email_message .= 'Previous E-mail: ' . $current_info_array[0]->email . "\n" . 'New E-mail: ' . $data_array['email'] . "\n\n";
			$changes++;
		}
		if(trim($current_info_array[0]->fax) != trim($data_array['fax'])) {
			$email_message .= 'Previous Fax: ' . $current_info_array[0]->fax . "\n" . 'New Fax: ' . $data_array['fax'] . "\n\n";
			$changes++;
		}
		if($email_message != '') {
			$email_headline = $current_info_array[0]->name . ' has updated their skylight microsite information';
			$email_message = $email_headline . "\n\n" . $email_message;
		}
		
		if($has_image) {
		
			$data = array(
				'name' => $data_array['name'],
				'contact_first_name' => $data_array['contact_first_name'],
				'contact_last_name' => $data_array['contact_last_name'],
				'address' => $data_array['address'],
				'address2' => $data_array['address2'],
				'city' => $data_array['city'],
				'state' => $data_array['state'],
				'zip' => $data_array['zip'],
				'region' => $data_array['region'],
				'phone1' => $data_array['phone1'],
				'fax' => $data_array['fax'],
				'email' => $data_array['email'],
				'dealer_hours' => trim($data_array['dealer_hours']),
				'website' => $website,
				'microsite_url' => $microsite_url,
				'dealer_logo' => $data_array['dealer_logo'],
				'extension' => $data_array['extension'],
				'credentials' => $data_array['credentials'],
				'primary_email' => $data_array['primary_email'],
				'cc_email' => $cc_email,
				'longitude' => $longitude,
				'latitude' => $latitude,
				'modification_date' => current_timestamp()
			);
			
		} else {
			$data = array(
				'name' => $data_array['name'],
				'contact_first_name' => $data_array['contact_first_name'],
				'contact_last_name' => $data_array['contact_last_name'],
				'address' => $data_array['address'],
				'address2' => $data_array['address2'],
				'city' => $data_array['city'],
				'state' => $data_array['state'],
				'zip' => $data_array['zip'],
				'region' => $data_array['region'],
				'phone1' => $data_array['phone1'],
				'fax' => $data_array['fax'],
				'email' => $data_array['email'],
				'dealer_hours' => trim($data_array['dealer_hours']),
				'website' => $website,
				'microsite_url' => $microsite_url,
				'credentials' => $data_array['credentials'],
				'primary_email' => $data_array['primary_email'],
				'cc_email' => $cc_email,
				'longitude' => $longitude,
				'latitude' => $latitude,
				'modification_date' => current_timestamp()
			);
		}
		
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			if($email_message != '' && $changes > 0) {
				$recipient = $this->config->item('profile_updates_recipient');
				$from = $this->config->item('global_email_from');
				$subject = $email_headline;
				$message = $email_message;

				//SEND CHANGE NOTIFICATION EMAIL
				Email_Send($recipient, $from, $subject, $message);

			}
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	function activate_product_category($product_category_id, $dealer_id) {
		$options_array = $this->get_dealer_options($dealer_id);
		if(trim($options_array[0]->product_categories) != '') {
			$inactive_array = explode(',',$options_array[0]->product_categories);
		} else {
			$inactive_array = array();
		}
		
		if(count($inactive_array) > 0) {
			$category_key = array_search($product_category_id,$inactive_array);
			unset($inactive_array[$category_key]);
		}
		
		$counter = 0;
		$product_categories = '';
		foreach($inactive_array as $key => $value) {
			$counter++;
			if($counter == 1) {
				$product_categories .= $value;
			} else {
				$product_categories .= ',' . $value;
			}
		}
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		
		$data = array(
			'product_categories' => $product_categories,
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('dealer_option_id', $options_array[0]->dealer_option_id);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function deactivate_product_category($product_category_id, $dealer_id) {
		$options_array = $this->get_dealer_options($dealer_id);
		if(trim($options_array[0]->product_categories) != '') {
			$inactive_array = explode(',',$options_array[0]->product_categories);
		} else {
			$inactive_array = array();
		}
		
		if(count($inactive_array) > 0) {
			$inactive_array[] = $product_category_id;
			$counter = 0;
			$product_categories = '';
			foreach($inactive_array as $key => $value) {
				$counter++;
				if($counter == 1) {
					$product_categories .= $value;
				} else {
					$product_categories .= ',' . $value;
				}
			}
		} else {
			$product_categories = $product_category_id;	
		}
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		
		$data = array(
			'product_categories' => $product_categories,
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('dealer_option_id', $options_array[0]->dealer_option_id);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_available_products($data_array) {
		
		$all_products_array = explode(',',$data_array['all_products_list']);
		
		if( isset($data_array['products'])) {
			foreach($data_array['products'] as $key => $value) {
				$product_key = array_search($value,$all_products_array);
				unset($all_products_array[$product_key]);
			}
		}
		
		if(count($all_products_array) > 0) {
			$counter = 0;
			$inactive = '';
			foreach($all_products_array as $key => $value) {
				$counter++;
				if($counter == 1) {
					$inactive .= $value;
				} else {
					$inactive .= ',' . $value;
				}
			}
		} else {
			$inactive = '';
		}
		
		$featured_field = $data_array['featured_field'];
		
		if( isset($data_array['featured']) && $data_array['featured'] != '') {
			$featured_value = $data_array['featured'];
		} else {
			$featured_value = '';
		}
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		
		$data = array(
			'products' => $inactive,
			$featured_field => $featured_value,
			'modification_date' => current_timestamp()
		);
		
		$this->db->where('dealer_option_id', $data_array['dealer_option_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_literature($data_array) {
		
		$all_brochures_array = explode(',',$data_array['all_brochures_list']);
		
		if( isset($data_array['literature'])) {
			foreach($data_array['literature'] as $key => $value) {
				$brochure_key = array_search($value,$all_brochures_array);
				unset($all_brochures_array[$brochure_key]);
			}
		}
		
		if(count($all_brochures_array) > 0) {
			$counter = 0;
			$inactive = '';
			foreach($all_brochures_array as $key => $value) {
				$counter++;
				if($counter == 1) {
					$inactive .= $value;
				} else {
					$inactive .= ',' . $value;
				}
			}
		} else {
			$inactive = '';
		}
		
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		
		$data = array(
			'literature' => $inactive,
			'modification_date' => current_timestamp()
		);
		
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_site_status($dealer_id, $action) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		
		$dealer_array = $this->get_dealer_by_id($dealer_id);
		
		if($action == 'activate') {
			$status = 'active';
		} else {
			$status = 'inactive';
		}
		
		$data = array(
			'site_status' => $status,
			'modification_date' => current_timestamp()
		);
		
		$this->db->where('dealer_id',$dealer_id);
		$result = $this->db->update($db_table, $data);
		if($result) {
			$recipient = $this->config->item('site_status_recipient');
			$from = $this->config->item('global_email_from');
			$subject = 'A VELUX microsite site status has been updated';
			$message = $dealer_array[0]->name . ' has updated their site status to: ' . $status . ".\n";
			Email_Send($recipient, $from, $subject, $message);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_warranty($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		
		$data = array(
			'dealer_warranty' => $data_array['dealer_warranty'],
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_testimonials($data_array) {
		
		$all_testimonials_array = explode(',',$data_array['all_testimonials_list']);
		
		if( isset($data_array['custom_testimonials'])) {
			foreach($data_array['custom_testimonials'] as $key => $value) {
				$testimonial_key = array_search($value,$all_testimonials_array);
				unset($all_testimonials_array[$testimonial_key]);
			}
		}
		
		if( isset($data_array['velux_testimonials'])) {
			foreach($data_array['velux_testimonials'] as $key => $value) {
				$testimonial_key = array_search($value,$all_testimonials_array);
				unset($all_testimonials_array[$testimonial_key]);
			}
		}
		
		if(count($all_testimonials_array) > 0) {
			$counter = 0;
			$inactive = '';
			foreach($all_testimonials_array as $key => $value) {
				$counter++;
				if($counter == 1) {
					$inactive .= $value;
				} else {
					$inactive .= ',' . $value;
				}
			}
		} else {
			$inactive = '';
		}
		
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		
		$data = array(
			'testimonials' => $inactive,
			'modification_date' => current_timestamp()
		);
		
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function update_testimonial($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		
		$data = array(
			'dealer_id' => $data_array['dealer_id'],
			'testimonial_copy' => $data_array['testimonial_copy'],
			'testimonial_name' => $data_array['testimonial_name'],
			'testimonial_source' => $data_array['testimonial_source'],
			'modified_by' => $_SESSION['admin_username'],
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('testimonial_id', $data_array['testimonial_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_promotion($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		
		$data = array(
			'promotion_headline' => $data_array['promotion_headline'],
			'promotion_callout_copy' => $data_array['promotion_callout_copy'],
			'promotion_page_copy' => $data_array['promotion_page_copy'],
			'promotion_status' => $data_array['promotion_status'],
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function add_photo($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'photos';
		
		$data = array(
			'dealer_id' => $data_array['dealer_id'],
			'photo_title' => htmlspecialchars(strip_tags($data_array['photo_title']), ENT_QUOTES, 'UTF-8'),
			'photo_description' => htmlspecialchars(strip_tags($data_array['photo_description']), ENT_QUOTES, 'UTF-8'),
			'photo_image' => $data_array['photo_image'],
			'extension' => $data_array['extension'],
			'sort_order' => 999,
			'photo_status' => 'active',
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

	function update_photo($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'photos';
		$data = array(
			'photo_title' => htmlspecialchars(strip_tags($data_array['photo_title']), ENT_QUOTES, 'UTF-8'),
			'photo_description' => htmlspecialchars(strip_tags($data_array['photo_description']), ENT_QUOTES, 'UTF-8'),
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('photo_id', $data_array['photo_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function update_photo_order($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'photos';
		foreach($data_array['photo_item'] as $sort_order => $photo_id) {
			$data = array('sort_order' => $sort_order);
			$this->db->where('photo_id', $photo_id);
			$result = $this->db->update($db_table, $data); 
		}
		return TRUE;
	}

	/****************************
		Update About Us Copy
	********************************/
	function update_about_copy($data_array,  $has_image = FALSE) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		
		$about_text = strip_tags(trim($data_array['about_dealer_text']));
		if($about_text == '' || $about_text == '<br>' || $about_text == '<br />') {
			$about_text = '';
		}
		
		$about_headline = trim($data_array['about_dealer_headline']);
		if($about_headline == '' || $about_headline == '<br>' || $about_headline == '<br />') {
			$about_headline = '';
		}
		
		if($has_image == TRUE) {
			$data = array(
				'about_dealer_text' => $about_text,
				'about_dealer_headline' => $about_headline,
				'about_image' => $data_array['about_image'],
				'about_extension' => $data_array['about_extension'],
				'modification_date' => current_timestamp()
			);
		} else {
			$data = array(
				'about_dealer_text' => $about_text,
				'about_dealer_headline' => $about_headline,
				'modification_date' => current_timestamp()
			);
		}
		
		if( isset($data_array['process_meta']) && $data_array['process_meta'] == 'yes') {
			$data['about_meta_title'] = $data_array['meta_title'];
			$data['about_meta_keywords'] = $data_array['meta_keywords'];
			$data['about_meta_description'] = $data_array['meta_description'];
		}
		
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

/**********************************************************************************************************************************
		USER MODULE UPDATE FUNCTIONS
***********************************************************************************************************************************/

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
		
		$user_data_array = $this->get_user_by_email($data_array['username'],'all');
		if(count($user_data_array) == 1) {
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
		
		} else if(count($user_data_array) > 1) {
			return array('message' => 'Mulitple Logins');
		} else {
			return FALSE;
		
		}
	}


/***********************************************************************************************************************************
/*		DELETE FUNCTIONS
************************************************************************************************************************************/

	function delete_logo($data_array) {
		
		$dealer_array = $this->get_dealer_by_id($data_array['dealer_id']);
		if(count($dealer_array) > 0) {
			
			$deleted = @unlink($this->config->item('dealer_assets_full_dir') . 'dealer-logos/' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension);
			
			if($deleted) {
		
				$db_table = $this->config->item('db_table_prefix') . 'dealers';
				$data = array(
					'dealer_logo' => '',
					'extension' => '',
					'modification_date' => current_timestamp()
				);
					
				$this->db->where('dealer_id',$data_array['dealer_id']);
				$result = $this->db->update($db_table, $data);
				if($result) {
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
	
	function delete_about_image($data_array) {
		
		$dealer_array = $this->get_dealer_by_id($data_array['dealer_id']);
		if(count($dealer_array) > 0) {
			
			$deleted = @unlink($this->config->item('dealer_assets_full_dir') . 'about-images/' . $dealer_array[0]->about_image . '.' . $dealer_array[0]->about_extension);
			
			if($deleted) {
		
				$db_table = $this->config->item('db_table_prefix') . 'dealers';
				$data = array(
					'about_image' => '',
					'about_extension' => '',
					'modification_date' => current_timestamp()
				);
					
				$this->db->where('dealer_id',$data_array['dealer_id']);
				$result = $this->db->update($db_table, $data);
				if($result) {
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
	
/***********************************************************************************************************************************
/*		AUTO GENERATION FUNCTIONS
************************************************************************************************************************************/	
	
	function generate_sitemap() {
		
		$xml_file = 'sitemap.xml';
		$base_url = base_url();
		
		$output =  '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
		
		$output .= '<url>' . "\n";
		$output .= '<loc>' . substr($base_url,0,strlen($base_url) - 1) . '</loc>' . "\n";
		$output .= '<changefreq>weekly</changefreq>' . "\n";
		$output .= '</url>' . "\n";
		
		$site_array = $this->get_dealer_site_list();
		foreach($site_array as $site) {
			if($site->dealer_status == 'active' && $site->site_status == 'active' && $site->dealer_id != '6') {
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
				
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '/about-us</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
				
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '/warranty</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
			}
		}
		
		$output .= '</urlset>';
		
		$file = $_SERVER['DOCUMENT_ROOT'] . "/" . $xml_file;
		$handle = fopen($file, "w+");
		$xml = fwrite($handle,$output);
		fclose($handle);
		
		if($xml) {
			return true;
		} else {
			return false;
		}	
		
		
		
	}
	
}
	
/* End of file dealer_admin_model.php */
/* Location: ./system/application/modules/dealer_admin/models/dealer_admin_model.php */