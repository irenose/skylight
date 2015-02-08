<?php

class Admin_model extends CI_Model {

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

	function get_site_defaults() {
		$db_table = $this->config->item('db_table_prefix') . 'site_default';
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_dealer_site_list() {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$this->db->order_by('name ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_dealer_by_id($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$this->db->where('dealer_id',$dealer_id);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_options_by_product($product_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		$this->db->where('featured_suntunnel',$product_id);
		$this->db->or_where('featured_residential',$product_id);
		$this->db->or_where('featured_commercial',$product_id);
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_dealer_list($lower_limit = '0', $per_page, $status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		if($status != NULL) {
			$this->db->where('dealer_status',$status);
		} else {
			$this->db->where('dealer_status !=','delete');	
		}
		$this->db->order_by('name ASC');
		$query = $this->db->get($db_table, $per_page, $lower_limit);
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
	
	function get_product_subcategories($primary_category_id, $status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		if($status != NULL) {
			$where = array('primary_category_id' => $primary_category_id, 'product_category_status' => $status);
		} else {
			$where = array('primary_category_id' => $primary_category_id);
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_products_by_category($product_category_id, $status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		
		$this->db->select('ss_products.product_id AS product_id, ss_product_categories.product_category_name AS product_category_name, ss_product_categories.sort_order AS product_category_sort, ss_products.sort_order AS product_sort, ss_products.product_name AS product_name, ss_products.product_status AS product_status, ss_products.primary_category_id AS primary_category_id, ss_products.secondary_category_id AS secondary_category_id, ss_products.product_category_id AS product_category_id, ss_products.model_number AS model_number, ss_products.lifestyle_image AS lifestyle_image, ss_products.lifestyle_extension AS lifestyle_extension, ss_products.product_url AS product_url', FALSE);
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
	
	function get_product_by_id($product_id) {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		$where = array('product_id' => $product_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_galleries($status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'galleries';
		$where = array('gallery_status' => $status);
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_gallery_by_id($gallery_id) {
		$db_table = $this->config->item('db_table_prefix') . 'galleries';
		$where = array('gallery_id' => $gallery_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_gallery_image_count($gallery_id) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		$where = array('gallery_id' => $gallery_id, 'dealer_id' => '0');
		$this->db->where($where);
		$query = $this->db->get($db_table);
		return $query->result_array();
	}
	
	function get_images_by_gallery($gallery_id, $dealer_id = 0, $status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		if($status != NULL) {
			$where = array('gallery_id' => $gallery_id, 'image_status' => $status, 'dealer_id' => '0');
		} else {
			$where = array('gallery_id' => $gallery_id, 'dealer_id' => '0');	
		}
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_gallery_image_by_id($gallery_image_id) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		$where = array('gallery_image_id' => $gallery_image_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_testimonials($status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		if($status != NULL) {
			$where = array('testimonial_status' => $status, 'dealer_id' => '0');
			$this->db->where($where);
		} else {
			$where = array('dealer_id' => '0');
			$this->db->where($where);
		}
		$this->db->order_by('testimonial_id DESC');
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
	
	function get_review_by_id($review_id) {
		$db_table = $this->config->item('db_table_prefix') . 'reviews';
		$where = array('review_id' => $review_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_promotions($status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'promotions';
		if($status != NULL) {
			$where = array('promotion_status' => $status);
			$this->db->where($where);
		}
		$this->db->order_by('promotion_id DESC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_dealer_promotions($promotion_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
		$this->db->where('promotion_id', $promotion_id);
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_promotion_by_id($promotion_id) {
		$db_table = $this->config->item('db_table_prefix') . 'promotions';
		$where = array('promotion_id' => $promotion_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_literature($status = NULL) {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		if($status != NULL) {
			$where = array('literature_status' => $status);
			$this->db->where($where);
		}
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}
	
	function get_literature_by_id($literature_id) {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		$where = array('literature_id' => $literature_id);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	
	function get_site_updates() {
		$db_table = $this->config->item('db_table_prefix') . 'updates';
		$this->db->order_by('insert_date DESC');
		$query = $this->db->get($db_table);
		return $query->result();	
	}



	
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
		DOCUMENTS MODULE FUNCTIONS
***********************************************************************************************************************************/
	function add_content_document($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'content_documents';
		
		$data = array(
		   'document_name' => $data_array['document_name'],
		   'document_file' => $data_array['document_file'],
		   'extension' => $data_array['extension'],
		   'document_status' => 'active',
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
		CUSTOM ADD FUNCTIONS
***********************************************************************************************************************************/
	function add_dealer_site($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$latitude = NULL;
		$longitude = NULL;
		
		//Get Coordinates
		$coordinates_array = $this->page_model->get_coordinates($data_array['zip']);
		if(count($coordinates_array) > 0) {
			$latitude = $coordinates_array[0]->latitude;
			$longitude = $coordinates_array[0]->longitude;
		}
		
		//Format URL
		if(trim($data_array['website']) != '') {
			$https_pos = strpos($data_array['website'], 'https://');
			$http_pos = strpos($data_array['website'], 'http://');
			
			$website = str_replace('http://','', $data_array['website']);
			$website = str_replace('https://', '', $website);
			
			if($https_pos === false && $http_pos === false) {
				$website = 'http://' . $data_array['website'];
			} else {
				$website = $data_array['website'];
			}
			
		} else {
			$website = '';
		}
		
		//Format URL
		if(trim($data_array['microsite_url']) != '') {
			$https_pos = strpos($data_array['microsite_url'], 'https://');
			$http_pos = strpos($data_array['microsite_url'], 'http://');
			
			$microsite_url = str_replace('http://','', $data_array['microsite_url']);
			$microsite_url = str_replace('https://', '', $microsite_url);
			
			if($https_pos === false && $http_pos === false) {
				$microsite_url = 'http://' . $data_array['microsite_url'];
			} else {
				$microsite_url = $data_array['microsite_url'];
			}
			
		} else {
			$microsite_url = '';
		}
		
		if(trim($data_array['about_dealer_text']) == '' || trim($data_array['about_dealer_text']) == '<br>') {
			$about_dealer_text = '';
		} else {
			$about_dealer_text = trim($data_array['about_dealer_text']);
		}
		
		if(trim($data_array['about_dealer_headline']) == '' || trim($data_array['about_dealer_headline']) == '<br>') {
			$about_dealer_headline = '';
		} else {
			$about_dealer_headline = trim($data_array['about_dealer_headline']);
		}
		
		$data = array(
			'name' => $data_array['name'],
			'dealer_url' => $data_array['dealer_url'],
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
			'website' => $website,
			'microsite_url' => $microsite_url,
			'dealer_hours' => trim($data_array['dealer_hours']),
			'about_dealer_headline' => $about_dealer_headline,
			'about_dealer_text' => $about_dealer_text,
			'dealer_homepage_headline' => $data_array['dealer_homepage_headline'],
			'dealer_homepage_copy' => $data_array['dealer_homepage_copy'],
			'credentials' => $data_array['credentials'],
			'longitude' => $longitude,
			'latitude' => $latitude,
			'site_status' => 'inactive',
			'dealer_status' => 'active',
			'sells_vms' => $data_array['sells_vms'],
			'insert_date' => current_timestamp(),
		    'modification_date' => current_timestamp()
					  
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			
			$insert_id = $this->db->insert_id();
			
			$db_table = $this->config->item('db_table_prefix') . 'users';
			
			//Create Default Admin User for new site
			$this->load->helper('string');
			$random_password = random_string('alnum',10);
			$salt = $this->config->item('salt');
			$hash_password = sha1($salt.$random_password);
			
			$data = array(
			   'first_name' => $data_array['contact_first_name'],
			   'last_name' => $data_array['contact_last_name'],
			   'dealer_id' => $insert_id,
			   'username' => $data_array['email'],
			   'password' => $hash_password,
			   'permission_level' => 3, //3 is dealer permission level
			   'change_password' => 'yes',
			   'user_status' => 'active',
			   'last_login' => current_timestamp(),
			   'insert_date' => current_timestamp(),
			   'modification_date' => current_timestamp()
			);
			
			$user_created = $this->db->insert($db_table, $data);
			if($user_created) {
				
				//Create Dealer Options Entry
				$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
				$data = array(
				   'dealer_id' => $insert_id,
				   'insert_date' => current_timestamp(),
				   'modification_date' => current_timestamp()
				);
				
				
				$added_options = $this->db->insert($db_table, $data);
				
				//Add Default Options
				$default_array = $this->get_site_defaults();
				$promotion_title = $default_array[0]->promotion_title;
				$promotion_page_copy = $default_array[0]->promotion_page_copy;
				
				$db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
				$data = array(
					'dealer_id' => $insert_id,
					'promotion_id' => '21',
					'promotion_page_copy' => $promotion_page_copy,
					'promotion_title' => $promotion_title,
					'promotion_status' => 'active',
					'has_promotion_page' => 'yes',
					'insert_date' => current_timestamp(),
					'modification_date' => current_timestamp()			  
				);
				
				$add_default_promotion = $this->db->insert($db_table, $data);
				
				
				//Add dealer to dealer meta table
				$db_table = $this->config->item('db_table_prefix') . 'dealer_meta';
			
				$data = array(
				   'dealer_id' => $insert_id,
				   'modification_date' => current_timestamp()
				);
				
				$added = $this->db->insert($db_table, $data);
				
				
				//Send email with login info
				$this->load->library('email');
				$this->email->from($this->config->item('global_email_from'));
				$this->email->to($data_array['email']);
				$this->email->bcc('chan.hoyle@VELUX.com,todd.beasley@VELUX.com,jd.massie@velux.com,lisa.demarco@VELUX.com,jvoorhees@wrayward.com,gparish@wrayward.com,michelle@ravenelconsulting.com,stephanie@ravenelconsulting.com,bettye.booker@VELUX.com,jhalpin@wrayward.com');
				//$this->email->to($data_array['email']);
				

				$this->email->subject('VELUX Microsite for ' . $data_array['name']);
				$message = "A VELUX microsite has been set up for " . $data_array['name'] . ". Look below for all the needed information to learn about and customize your new VELUX microsite.\n\n";
				
				$message .= "Microsite URL: www.skylightspecialist.com/" . $data_array['dealer_url'] . "\n";
				$message .= "Assigned phone number: " . $data_array['phone1'] . "\n\n";
				
				$message .= "Microsite Admin: www.skylightspecialist.com/dealer-admin\n";
				$message .= "Username: " . $data_array['email'] . "\n";
				$message .= "Password: " . $random_password . "\n\n";
				
				$message .= "View the microsite training to learn how to customize your site:\n";
				$message .= "http://www.vimeo.com/18475729\n";
				$message .= "Password: velux\n\n";
				
				$message .= "Note: your microsite is currently ACTIVE, which means it's live to the public.  You are encouraged to customize your site as soon as possible so it accurately reflects your business.";

				
				
				
				/*$message .= "Username: " . $data_array['email'] . "\n";
				$message .= "Password: " . $random_password . "\n";
				$message .= "Please log in to the admin and you will be prompted to create a new password";*/
				
				$this->email->message($message);
				$this->email->send();
				
				return $insert_id; //Return initial dealer_id
				
			} else {
				return FALSE;
			}

		} else {
			return FALSE;
		}
	}

	function add_default_promotion($dealer_id) {
		
		$default_array = $this->get_site_defaults();
		$promotion_title = $default_array[0]->promotion_title;
		$promotion_page_copy = $default_array[0]->promotion_page_copy;
		
		$db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
		$data = array(
			'dealer_id' => $dealer_id,
			'promotion_id' => '21',
			'promotion_page_copy' => $promotion_page_copy,
			'promotion_title' => $promotion_title,
			'promotion_status' => 'active',
			'has_promotion_page' => 'yes',
			'insert_date' => current_timestamp(),
			'modification_date' => current_timestamp()			  
		);
		
		$add = $this->db->insert($db_table, $data);
	}

	function add_dealer_options($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'users';
		
			
		//Create Default Admin User for new site
		$this->load->helper('string');
		$random_password = random_string('alnum',10);
		$salt = $this->config->item('salt');
		$hash_password = sha1($salt.$random_password);
		
		$data = array(
		   'first_name' => $data_array->contact_first_name,
		   'last_name' => $data_array->contact_last_name,
		   'dealer_id' => $data_array->dealer_id,
		   'username' => $data_array->email,
		   'password' => $hash_password,
		   'permission_level' => 3, //3 is dealer permission level
		   'change_password' => 'yes',
		   'user_status' => 'active',
		   'last_login' => current_timestamp(),
		   'insert_date' => current_timestamp(),
		   'modification_date' => current_timestamp()
		);
		
		$user_created = $this->db->insert($db_table, $data);
		if($user_created) {
			
			//Create Dealer Options Entry
			$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
			$data = array(
			   'dealer_id' => $data_array->dealer_id,
			   'insert_date' => current_timestamp(),
			   'modification_date' => current_timestamp()
			);
			
			
			$added_options = $this->db->insert($db_table, $data);
			
			$this->load->library('email');
			//Auto Response to contactor
			$this->email->from($this->config->item('global_email_from'));
			$this->email->to('gparish@wrayward.com');
			//$this->email->to($data_array['email']);
			$this->email->bcc('geoff_parish@yahoo.com');
			$this->email->subject($data_array->name . ' VELUX Microsite Login Information');
			$message = "Here is the login information for " . $data_array->name . ": \n";
			$message .= "Username: " . $data_array->email . "\n";
			$message .= "Password: " . $random_password . "\n";
			$message .= "Please log in to the admin and you will be prompted to create a new password";
			
			$this->email->message($message);
			$this->email->send();
			
			return $random_password; //Return initial dealer_id
			
		} else {
			return FALSE;
		}
	}
	
	function update_coordinates($data_array) {
		
		$latitude = NULL;
		$longitude = NULL;
		
		//Get Coordinates
		$coordinates_array = $this->page_model->get_coordinates($data_array->zip);
		if(count($coordinates_array) > 0) {
			$latitude = $coordinates_array[0]->latitude;
			$longitude = $coordinates_array[0]->longitude;
		}
		
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		
		$data = array(
			'latitude' => $latitude,
			'longitude' => $longitude
		);
		
		$this->db->where('dealer_id', $data_array->dealer_id);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
		
	}

	function add_product($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'products';

		$product_url = url_title($data_array['product_name'], 'dash', TRUE);
		if(trim($data_array['model_number']) != '') {
			$product_url .= '-' . trim($data_array['model_number']);
		}
		
		$data = array(
			'product_name' => $data_array['product_name'],
			'product_url' => $product_url,
			'product_name_short' => $data_array['product_name_short'],
			'model_number' => $data_array['model_number'],
			'product_description' => $data_array['product_description'],
			'product_category_id' => $data_array['product_category_id'],
			'primary_category_id' => $data_array['primary_category_id'],
			'green_friendly_flag' => 'no',
			'no_leak_flag' => $data_array['no_leak_flag'],
			'tax_credit' => $data_array['tax_credit'],
			'energy_star' => 'no',
			'remote_flag' => 'no',
			'product_status' => 'inactive',
			'meta_title' => $data_array['meta_title'],
			'meta_description' => $data_array['meta_description'],
			'meta_keywords' => $data_array['meta_keywords'],
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
	
/************************
/*	ADD TESTIMONIAL
/*	
************************/	
	function add_testimonial($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		
		$data = array(
			'dealer_id' => $data_array['dealer_id'],
			'testimonial_copy' => $data_array['testimonial_copy'],
			'testimonial_name' => $data_array['testimonial_name'],
			'testimonial_source' => $data_array['testimonial_source'],
			'testimonial_status' => 'inactive',
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

	function add_gallery_image($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		
		$data = array(
		   'image_title' => $data_array['image_title'],
		   'image_description' => $data_array['image_description'],
		   'image_name' => $data_array['image_name'],
		   'extension' => $data_array['extension'],
		   'gallery_id' => $data_array['gallery_id'],
		   'dealer_id' => 0,
		   'sort_order' => 999,
		   'image_status' => 'active',
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

	function add_promotion($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'promotions';
		
		if( isset($data_array['default_option']) && $data_array['default_option'] == 'yes') {
			$default_option = 'yes';
		} else {
			$default_option = 'no';	
		}
		
		$data = array(
		   'promotion_title' => $data_array['promotion_title'],
		   'promotion_file' => $data_array['promotion_file'],
		   'extension' => $data_array['extension'],
		   'has_flash' => $data_array['has_flash'],
		   'promotion_banner' => $data_array['promotion_banner'],
		   'banner_extension' => $data_array['banner_extension'],
		   'default_option' => $default_option,
		   'top_coordinate' => $data_array['top_coordinate'],
		   'left_coordinate' => $data_array['left_coordinate'],
		   'promotion_status' => 'active',
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
	
	function add_literature($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		
		$data = array(
		   'name' => $data_array['name'],
		   'description' => $data_array['description'],
		   'filename' => $data_array['filename'],
		   'extension' => $data_array['extension'],
		   'thumbnail' => $data_array['thumbnail'],
		   'thumbnail_extension' => $data_array['thumbnail_extension'],
		   'analytics_url' => $data_array['analytics_url'],
		   'literature_status' => 'inactive',
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

	function add_site_update($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'updates';
		
		$data = array(
			'update_text' => $data_array['update_text'],
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
		   'modified_by' => $_SESSION['admin_username'],
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
			   'modified_by' => $_SESSION['admin_username'],
			   'modification_date' => current_timestamp()
			);
		} else {
			$data = array(
			   'document_name' => $data_array['document_name'],
			   'modified_by' => $_SESSION['admin_username'],
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
			   'modified_by' => $_SESSION['admin_username'],
			   'modification_date' => current_timestamp()
			);
		} else {
			$data = array(
			   'image_name' => $data_array['image_name'],
			   'modified_by' => $_SESSION['admin_username'],
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

	function update_dealer($data_array, $has_image = FALSE) {
		
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$latitude = NULL;
		$longitude = NULL;
		
		//Get Coordinates
		$coordinates_array = $this->page_model->get_coordinates($data_array['zip']);
		if(count($coordinates_array) > 0) {
			$latitude = $coordinates_array[0]->latitude;
			$longitude = $coordinates_array[0]->longitude;
		}
		
		//Format URL
		if(trim($data_array['website']) != '') {
			$https_pos = strpos($data_array['website'], 'https://');
			$http_pos = strpos($data_array['website'], 'http://');
			
			$website = str_replace('http://','', $data_array['website']);
			$website = str_replace('https://','', $website);
			
			if($https_pos === false && $http_pos === false) {
				$website = 'http://' . $data_array['website'];
			} else {
				$website = $data_array['website'];
			}
			
		} else {
			$website = '';
		}
		
		//Format URL
		if(trim($data_array['microsite_url']) != '') {
			$https_pos = strpos($data_array['microsite_url'], 'https://');
			$http_pos = strpos($data_array['microsite_url'], 'http://');
			
			$microsite_url = str_replace('http://','', $data_array['microsite_url']);
			$microsite_url = str_replace('https://', '', $microsite_url);
			
			if($https_pos === false && $http_pos === false) {
				$microsite_url = 'http://' . $data_array['microsite_url'];
			} else {
				$microsite_url = $data_array['microsite_url'];
			}
			
		} else {
			$microsite_url = '';
		}
		
		if(trim($data_array['about_dealer_text']) == '' || trim($data_array['about_dealer_text']) == '<br>') {
			$about_dealer_text = '';
		} else {
			$about_dealer_text = trim($data_array['about_dealer_text']);
		}
		
		if(trim($data_array['about_dealer_headline']) == '' || trim($data_array['about_dealer_headline']) == '<br>') {
			$about_dealer_headline = '';
		} else {
			$about_dealer_headline = trim($data_array['about_dealer_headline']);
		}
		
		if($has_image) {
		
			$data = array(
				'name' => $data_array['name'],
				'dealer_url' => $data_array['dealer_url'],
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
				'website' => $website,
				'microsite_url' => $microsite_url,
				'paid_search_extension' => $data_array['paid_search_extension'],
				'dealer_hours' => trim($data_array['dealer_hours']),
				'dealer_logo' => $data_array['dealer_logo'],
				'extension' => $data_array['extension'],
				'about_dealer_headline' => $about_dealer_headline,
				'about_dealer_text' => $about_dealer_text,
				'dealer_homepage_headline' => $data_array['dealer_homepage_headline'],
				'dealer_homepage_copy' => $data_array['dealer_homepage_copy'],
				'credentials' => $data_array['credentials'],
				'longitude' => $longitude,
				'latitude' => $latitude,
				'site_status' => $data_array['site_status'],
				'dealer_status' => $data_array['dealer_status'],
				'sells_vms' => $data_array['sells_vms'],
				'insert_date' => current_timestamp(),
				'modification_date' => current_timestamp()
			);
			
		} else {
			$data = array(
				'name' => $data_array['name'],
				'dealer_url' => $data_array['dealer_url'],
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
				'website' => $website,
				'microsite_url' => $microsite_url,
				'paid_search_extension' => $data_array['paid_search_extension'],
				'about_dealer_text' => $about_dealer_text,
				'about_dealer_headline' => $about_dealer_headline,
				'dealer_homepage_headline' => $data_array['dealer_homepage_headline'],
				'dealer_homepage_copy' => $data_array['dealer_homepage_copy'],
				'credentials' => $data_array['credentials'],
				'longitude' => $longitude,
				'latitude' => $latitude,
				'site_status' => $data_array['site_status'],
				'dealer_status' => $data_array['dealer_status'],
				'sells_vms' => $data_array['sells_vms'],
				'insert_date' => current_timestamp(),
				'modification_date' => current_timestamp()
			);
		}
		
		$this->db->where('dealer_id', $data_array['dealer_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}

	function update_product($data_array, $uploaded_product_image = FALSE) {
		
		$db_table = $this->config->item('db_table_prefix') . 'products';

		$product_url = url_title($data_array['product_url'], 'dash', TRUE);
		
		$data = array(
			'product_name' => $data_array['product_name'],
			'product_url' => $product_url,
			'product_name_short' => $data_array['product_name_short'],
			'model_number' => $data_array['model_number'],
			'product_description' => $data_array['product_description'],
			'product_category_id' => $data_array['product_category_id'],
			'primary_category_id' => $data_array['primary_category_id'],
			'green_friendly_flag' => 'no',
			'no_leak_flag' => $data_array['no_leak_flag'],
			'tax_credit' => $data_array['tax_credit'],
			'energy_star' => 'no',
			'remote_flag' => 'no',
			'product_status' => $data_array['product_status'],
			'meta_title' => $data_array['meta_title'],
			'meta_description' => $data_array['meta_description'],
			'meta_keywords' => $data_array['meta_keywords'],
			'modified_by' => $this->session->userdata('admin_username'),
			'modification_date' => current_timestamp()
		);
		
		if($uploaded_product_image) {
			$data['product_image'] = $data_array['product_image'];
			$data['extension'] = $data_array['extension'];
		}
		
		$this->db->where('product_id', $data_array['product_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	function update_gallery_images($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		
		$image_count = $data_array['gallery_image_count'];
		for($i = 1; $i <= $image_count; $i++) {
			$image_title = 'image_title' . $i;
			$image_description = 'image_description' . $i;
			$gallery_image_id = 'gallery_image_id' . $i;
			
			$data = array(
				'image_title' => $data_array[$image_title],
				'image_description' => $data_array[$image_description],
				'modification_date' => current_timestamp()
			);
			$this->db->where('gallery_image_id', $data_array[$gallery_image_id]);
			$result = $this->db->update($db_table, $data); 	
				
		}
		
		foreach($data_array['image_item'] as $sort_order => $gallery_image_id) {
			$data = array('sort_order' => $sort_order);
			$this->db->where('gallery_image_id', $gallery_image_id);
			$result = $this->db->update($db_table, $data); 
		}
		
		return TRUE;
	}

	function update_testimonial($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		
		$data = array(
			'dealer_id' => $data_array['dealer_id'],
			'testimonial_copy' => $data_array['testimonial_copy'],
			'testimonial_name' => $data_array['testimonial_name'],
			'testimonial_source' => $data_array['testimonial_source'],
			'testimonial_status' => $data_array['testimonial_status'],
			'modified_by' => $this->session->userdata('admin_username'),
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
	
	function update_review($data_array) {
		
		$db_table = $this->config->item('db_table_prefix') . 'reviews';
		
		$data = array(
			'review' => $data_array['review'],
			'review_status' => $data_array['review_status'],
			'modification_date' => current_timestamp()
		);
			
		$this->db->where('review_id', $data_array['review_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/****************************
		Update Literature
	********************************/
	function update_literature($data_array, $has_brochure = FALSE, $has_thumbnail = FALSE) {
		
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		
		$data = array(
			'name' => $data_array['name'],
			'description' => $data_array['description'],
			'analytics_url' => $data_array['analytics_url'],
			'literature_status' => $data_array['literature_status'],
			'modification_date' => current_timestamp()
		);
		
		if($has_brochure) {
			$data['filename'] = $data_array['filename'];
			$data['extension'] = $data_array['extension'];
		}
		
		if($has_thumbnail) {
			$data['thumbnail'] = $data_array['thumbnail'];
			$data['thumbnail_extension'] = $data_array['thumbnail_extension'];
		}
			
		$this->db->where('literature_id', $data_array['literature_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	/**********************
		Update Promotion
	**********************/
	function update_promotion($data_array, $has_image = FALSE, $has_swf = FALSE, $has_banner = FALSE) {
		$db_table = $this->config->item('db_table_prefix') . 'promotions';
		
		if( isset($data_array['default_option']) && $data_array['default_option'] == 'yes') {
			$default_option = 'yes';
		} else {
			$default_option = 'no';	
		}
		
		$data = array(
		   'promotion_title' => $data_array['promotion_title'],
		   'promotion_status' => $data_array['promotion_status'],
		   'default_option' => $default_option,
		   'top_coordinate' => $data_array['top_coordinate'],
		   'left_coordinate' => $data_array['left_coordinate'],
		   'modification_date' => current_timestamp()
		);
		
		if($has_image) {
			$data['promotion_file'] = $data_array['promotion_file'];
			$data['extension'] = $data_array['extension'];
		}
		
		if($has_swf) {
			$data['has_flash'] = $data_array['has_flash'];
		}
		
		if($has_banner) {
			$data['promotion_banner'] = $data_array['promotion_banner'];
		   	$data['banner_extension'] = $data_array['banner_extension'];
		}
		
		$this->db->where('promotion_id', $data_array['promotion_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			if($data_array['promotion_status'] == 'inactive') {
				//Replace all promotions that use this image with a default of Promo ID 8 (Cloud image)
				$dealer_promo_array = $this->get_dealer_promotions($data_array['promotion_id']);
				foreach($dealer_promo_array as $dealer_promo) {
					$data = array(
						'promotion_id' => 8,
						'modification_date' => current_timestamp()
					);
					$sub_db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
					$this->db->where('dealer_promotion_id', $dealer_promo->dealer_promotion_id);
					$result = $this->db->update($sub_db_table, $data); 
				}
			}
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**********************
		Update Gallery Info
	**********************/
	function update_gallery_info($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'galleries';
		
		$data = array(
		   'gallery_name' => $data_array['gallery_name'],
		   'gallery_description' => $data_array['gallery_description'],
		   'gallery_status' => $data_array['gallery_status'],
		   'modification_date' => current_timestamp()
		);
		
		$this->db->where('gallery_id', $data_array['gallery_id']);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}



	

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
			$large_image_dir = $this->config->item('content_images_full_dir');
			
			$thumb_image = $image->image_file . '_th.' . $image->extension;
			$thumb_image_dir = $this->config->item('content_images_full_dir') . 'thumbs/';
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
			$doc_dir = $this->config->item('content_documents_full_dir');
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

/**********************************************************************************************************************************
		CUSTOM UPDATE FUNCTIONS
***********************************************************************************************************************************/

	function delete_dealer($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$data = array(
			'dealer_status' => 'delete',
			'modification_date' => current_timestamp()
		);
		$this->db->where('dealer_id',$dealer_id);
		$result = $this->db->update($db_table, $data); 
		
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
	
	function delete_gallery_image($gallery_image_id) {
		$db_table = $this->config->item('db_table_prefix') . 'gallery_images';
		$this->db->where('gallery_image_id',$gallery_image_id);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function delete_testimonial($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		$this->db->where('testimonial_id',$data_array['testimonial_id']);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function delete_review($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'reviews';
		$this->db->where('review_id',$data_array['review_id']);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	
	function delete_promotion($promotion_id, $promotion_array) {
		$db_table = $this->config->item('db_table_prefix') . 'promotions';
		
		if(count($promotion_array) > 0) {
			
			$dir = $this->config->item('promotion_files_full_dir');
			
			$image_delete = @unlink($dir . $promotion_array[0]->promotion_file . '.' . $promotion_array[0]->extension);
			if($promotion_array[0]->has_flash == 'yes') {
				@unlink($dir . $promotion_array[0]->promotion_file . '.swf');
			}
			
			if($image_delete) {
				
				//Replace all promotions that use this image with a default of Promo ID 8 (Cloud image)
				$dealer_promo_array = $this->get_dealer_promotions($promotion_id);
				foreach($dealer_promo_array as $dealer_promo) {
					$data = array(
						'promotion_id' => 8,
						'modification_date' => current_timestamp()
					);
					$sub_db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
					$this->db->where('dealer_promotion_id', $dealer_promo->dealer_promotion_id);
					$result = $this->db->update($sub_db_table, $data); 
				}
				
			
				$this->db->where('promotion_id',$promotion_id);
				$result = $this->db->delete($db_table);
				if($result) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}
	
	
	function delete_literature($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		
		$brochure_array = $this->get_literature_by_id($data_array['literature_id']);
		if(count($brochure_array) > 0) {
			
			$dir = $this->config->item('resources_full_dir');
			$thumb_dir = $this->config->item('promotion_files_full_dir') . 'thumbs/';
			
			$thumb_delete = @unlink($thumb_dir . $brochure_array[0]->thumbnail . '.' . $brochure_array[0]->thumbnail_extension);
			$brochure_delete = @unlink($dir . $brochure_array[0]->filename . '.' . $brochure_array[0]->extension);
			
			if($brochure_delete && $thumb_delete) {
			
				$this->db->where('literature_id',$data_array['literature_id']);
				$result = $this->db->delete($db_table);
				if($result) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		}
	}
	
	function delete_site_update($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'updates';
		$this->db->where('update_id',$data_array['update_id']);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function delete_product($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		//Remove any dealer site that is featuring that product
		$option_array = $this->get_options_by_product($data_array['product_id']);
		if(count($option_array) > 0) {
			//Do Deletes
			foreach($option_array as $option) {
				if($option->featured_suntunnel == $data_array['product_id']) {
					$data = array(
						'featured_suntunnel' => '',
						'modification_date' => current_timestamp()
					);
				} else if($option->featured_residential == $data_array['product_id']) {
					$data = array(
						'featured_residential' => '',
						'modification_date' => current_timestamp()
					);
				} else if($option->featured_commercial == $data_array['product_id']) {
					$data = array(
						'featured_commercial' => '',
						'modification_date' => current_timestamp()
					);
				}
				$sub_db_table = $this->config->item('db_table_prefix') . 'dealer_options';
				$this->db->where('dealer_option_id', $option->dealer_option_id);
				$result = $this->db->update($sub_db_table, $data); 
				
			}
			
		}
		$this->db->where('product_id',$data_array['product_id']);
		$result = $this->db->delete($db_table);
		if($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function get_bazaarvoice_categories() {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		$where = array('product_category_status' => 'active');
		$this->db->where($where);
		$this->db->order_by('primary_category_id ASC, sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_bazaarvoice_products() {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		$where = array('product_status' => 'active', 'product_id !=' => '25', 'product_id !=' => '26');
		$this->db->where($where);
		$this->db->order_by('primary_category_id ASC');
		$query = $this->db->get($db_table);
		return $query->result();
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

		$product_category_array = $this->get_product_categories('active');
		foreach($product_category_array as $product_category) {
			$output .= '<url>' . "\n";
			$output .= '<loc>' . $base_url . 'catalog/products/category/' . $product_category->product_category_url . '</loc>' . "\n";
			$output .= '<changefreq>weekly</changefreq>' . "\n";
			$output .= '</url>' . "\n";
			$products_array = $this->admin_model->get_products_by_category($product_category->product_category_id, 'active');
			foreach($products_array as $product) {
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . 'catalog/product/' . $product->product_url . '</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
			}
		}
		
		$site_array = $this->get_dealer_site_list();
		foreach($site_array as $site) {
			if($site->dealer_status == 'active' && $site->site_status == 'active' && $site->dealer_id != '6') {
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
				
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '/about</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";
				
				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '/warranty</loc>' . "\n";
				$output .= '<changefreq>weekly</changefreq>' . "\n";
				$output .= '</url>' . "\n";

				$output .= '<url>' . "\n";
				$output .= '<loc>' . $base_url . $site->dealer_url . '/contact</loc>' . "\n";
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
	
/* End of file admin_model.php */
/* Location: ./system/application/modules/admin/models/admin_model.php */