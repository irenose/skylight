<?php

class Page_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_page_by_url($page_url) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$where = array('page_url' => $page_url, 'page_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

/**********************************************************************************************************************************
		SEARCH FUNCTIONS
***********************************************************************************************************************************/
	function get_coordinates($zip_code) {
		$db_table = $this->config->item('db_table_prefix') . 'zip_codes';
		//Strip Leading 00s from zip
		$zip_code = intval($zip_code);
		$this->db->where('zip',$zip_code);
		$this->db->order_by('zip_id ASC');
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

	function get_closest_installers($zip_code) {
		$coordinates_array = $this->get_coordinates($zip_code);
		if(count($coordinates_array) > 0) {
			$db_table = $this->config->item('db_table_prefix') . 'dealers';
			$distance = '5000';
			$latitude = $coordinates_array[0]->latitude;
			$longitude = $coordinates_array[0]->longitude;
			$this->db->select('dealer_id, name, address, city, state, zip, email, phone1, website, dealer_url, dealer_status, site_status, ( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) *  sin( radians( latitude ) ) ) ) AS distance', FALSE);
			$where = "distance <= '$distance' AND dealer_status = 'active' AND site_status = 'active' AND dealer_id <> '6' AND dealer_id <> '166'";
			$this->db->having($where, NULL, FALSE);
			$this->db->order_by('distance ASC');
			$query = $this->db->get($db_table,10);
			return $query->result();
		} else {
			return array();
		}	
		
	}

/**********************************************************************************************************************************
		INSTALLER FUNCTIONS
***********************************************************************************************************************************/

	function get_site_defaults() {
		$db_table = $this->config->item('db_table_prefix') . 'site_default';
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_installer_array($dealer_url, $dealer_status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$where = array('dealer_url' => $dealer_url, 'dealer_status' => $dealer_status, 'site_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_dealer_by_id($dealer_id, $dealer_status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$where = array('dealer_id' => $dealer_id, 'dealer_status' => $dealer_status, 'site_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_dealer_options($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_options';
		$where = array('dealer_id' => $dealer_id);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_meta_by_dealer($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_meta';
		$where = array('dealer_id' => $dealer_id);
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	function get_dealer_logo($installer_array) {
		if($installer_array[0]->dealer_logo != '' && file_exists($this->config->item('dealer_assets_full_dir') . 'dealer-logos/' . $installer_array[0]->dealer_logo . '.' . $installer_array[0]->extension)) {
			return '<img src="' . $this->config->item('dealer_assets_dir') . 'dealer-logos/' . $installer_array[0]->dealer_logo . '.' . $installer_array[0]->extension . '" alt="' . $installer_array[0]->name . '">';

		} else {
			return $installer_array[0]->name;
		}
	}

/**********************************************************************************************************************************
		PRODUCT FUNCTIONS
***********************************************************************************************************************************/
	
	/*
		FUNCTIONS TO ADD URLS TO PRODUCTS - USE ON LIVE DB DURING LAUNCH 
		function add_product_urls() {
			$db_table = $this->config->item('db_table_prefix') . 'products';
			$products_array = $this->get_products();
			
			foreach($products_array as $product) {
				$data = array(
					'product_url' => url_title($product->product_name, 'dash',TRUE)
				);
				$this->db->where('product_id', $product->product_id);
				$result = $this->db->update($db_table, $data); 

			}
		}
		function get_products() {
			$db_table = $this->config->item('db_table_prefix') . 'products';
			$query = $this->db->get($db_table);
			return $query->result();
		}
	*/

	function get_product_categories($dealer_id, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		$options_array = $this->get_dealer_options($dealer_id);
		if(count($options_array) > 0) {
			foreach($options_array as $option) {
				$categories_exclude = $option->product_categories;
				$exclude_array = explode(',', $categories_exclude); 
			}
		} else {
			$exclude_array = array();	
		}
		$where = array('primary_category_id' => 0, 'product_category_status' => $status);
		$this->db->where($where);
		if(count($exclude_array) > 0) {
			$this->db->where_not_in('product_category_id',$exclude_array);
		}
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();

	}

	function get_category_by_url($product_category_url, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		$where = array('product_category_url' => $product_category_url, 'product_category_status' => $status);
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

	function get_category_products($dealer_id, $product_category_url, $status = 'active') {
		$category_products_array = array();

		$category_array = $this->get_category_by_url($product_category_url, $status);
		if( count($category_array) > 0) {
			$category_products_array['category'] = $category_array[0];
			$subcategory_array = $this->get_subcategories($category_array[0]->product_category_id, 'active');
			$subcategory_count = -1;
			foreach($subcategory_array as $subcategory) {
				$subcategory_count++;
				$products_array = $this->get_products_by_category($dealer_id, $subcategory->product_category_id, $category_array[0]->product_category_id);
				$category_products_array['subcategory_array'][$subcategory_count] = (object) array(
					'subcategory_name' => $subcategory->product_category_name,
					'subcategory_url' => $subcategory->product_category_url,
					'subcategory_products' => $products_array
				);
			}
		} 
		return $category_products_array;
	}

	function get_subcategories($product_category_id, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'product_categories';
		$where = array('primary_category_id' => $product_category_id, 'secondary_category_id' => 0, 'product_category_status' => $status);
		$this->db->where($where);
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_products_by_category($dealer_id, $primary_category_id, $product_category_id, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		$options_array = $this->get_dealer_options($dealer_id);
		if(count($options_array) > 0) {
			foreach($options_array as $option) {
				$products_exclude = $option->products;
				$exclude_array = explode(',', $products_exclude); 
			}
		} else {
			$exclude_array = array();	
		}
		$where = array('primary_category_id' => $primary_category_id, 'product_category_id' => $product_category_id, 'product_status' => $status);
		$this->db->where($where);
		if(count($exclude_array) > 0) {
			$this->db->where_not_in('product_id',$exclude_array);
		}
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

	function get_product_by_url($product_url) {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		$this->db->select($this->config->item('db_table_prefix') . 'products.*, ' . $this->config->item('db_table_prefix') . 'product_categories.product_category_name AS product_category_name, ' . $this->config->item('db_table_prefix') . 'product_categories.product_category_url AS product_category_url', FALSE);
		$this->db->join($this->config->item('db_table_prefix') . 'product_categories', $this->config->item('db_table_prefix') . 'product_categories.product_category_id = ' . $this->config->item('db_table_prefix') . 'products.product_category_id', 'inner');
		$where = array($this->config->item('db_table_prefix') . 'products.product_url' => $product_url, $this->config->item('db_table_prefix') . 'products.product_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

	function get_contact_product_list($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'products';
		$options_array = $this->get_dealer_options($dealer_id);
		if(count($options_array) > 0) {
			foreach($options_array as $option) {
				$products_exclude = $option->products;
				$exclude_array = explode(',', $products_exclude); 
			}
		} else {
			$exclude_array = array();	
		}
		$where = array('product_status' => 'active');
		$this->db->where($where);
		if(count($exclude_array) > 0) {
			$this->db->where_not_in('product_id',$exclude_array);
		}
		$this->db->order_by('sort_order ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

/**********************************************************************************************************************************
		HOMEPAGE FUNCTIONS
***********************************************************************************************************************************/

	function get_homepage_promotion($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
		$this->db->select($this->config->item('db_table_prefix') . 'dealer_promotions.promotion_title AS promotion_title, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.dealer_promotion_id AS dealer_promotion_id, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_page_copy AS promotion_page_copy, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_status AS promotion_status, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_text AS promotion_text, ' . $this->config->item('db_table_prefix') . 'promotions.promotion_file AS promotion_file, ' . $this->config->item('db_table_prefix') . 'promotions.has_flash AS has_flash, ' . $this->config->item('db_table_prefix') . 'promotions.extension AS extension, ss_dealer_promotions.has_promotion_page AS has_promotion_page, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_id AS promotion_id, ' . $this->config->item('db_table_prefix') . 'promotions.top_coordinate AS top_coordinate, ' . $this->config->item('db_table_prefix') . 'promotions.left_coordinate AS left_coordinate', FALSE);
		$this->db->join($this->config->item('db_table_prefix') . 'promotions', $this->config->item('db_table_prefix') . 'promotions.promotion_id = ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_id', 'inner');

		$where = array($this->config->item('db_table_prefix') . 'dealer_promotions.dealer_id' => $dealer_id, $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		
		if(count($query->result()) > 0) {
			return $query->result();
		} else {
			$db_table = $this->config->item('db_table_prefix') . 'promotions';
			$where = array('promotion_status' => 'active', 'default_option' => 'yes');
			$this->db->where($where);
			$this->db->order_by('RAND()');
			$query = $this->db->get($db_table,1);
			return $query->result();
		}
	}

/**********************************************************************************************************************************
		PROMOTIONS FUNCTIONS
***********************************************************************************************************************************/

	function get_dealer_promotion_page($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealer_promotions';
		$this->db->select($this->config->item('db_table_prefix') . 'dealer_promotions.promotion_page_copy AS promotion_page_copy, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_status AS promotion_status, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_text AS promotion_text, ' . $this->config->item('db_table_prefix') . 'promotions.promotion_banner AS promotion_banner, ' . $this->config->item('db_table_prefix') . 'promotions.banner_extension AS banner_extension, ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_id AS promotion_id', FALSE);
		$this->db->join($this->config->item('db_table_prefix') . 'promotions', $this->config->item('db_table_prefix') . 'promotions.promotion_id = ' . $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_id', 'inner');
		
		$where = array($this->config->item('db_table_prefix') . 'dealer_promotions.dealer_id' => $dealer_id, $this->config->item('db_table_prefix') . 'dealer_promotions.has_promotion_page' => 'yes', $this->config->item('db_table_prefix') . 'dealer_promotions.promotion_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

/**********************************************************************************************************************************
		TESTIMONIALS FUNCTIONS
***********************************************************************************************************************************/

	function get_testimonials_by_dealer($dealer_id, $limit = FALSE) {
		$db_table = $this->config->item('db_table_prefix') . 'testimonials';
		$options_array = $this->get_dealer_options($dealer_id);
		if(count($options_array) > 0) {
			foreach($options_array as $option) {
				$testimonial_exclude = $option->testimonials;
				$exclude_array = explode(',', $testimonial_exclude); 
			}
		} else {
			$exclude_array = array();	
		}
		
		$dealer_id_array = array('0', $dealer_id);
		$where = array('testimonial_status' => 'active');
		$this->db->where($where);
		$this->db->where_in('dealer_id',$dealer_id_array);
		if(count($exclude_array) > 0) {
			$this->db->where_not_in('testimonial_id',$exclude_array);
		}
		$this->db->order_by('insert_date DESC');
		if($limit) {
			$query = $this->db->get($db_table,$limit);
		} else {
			$query = $this->db->get($db_table);
		}
		return $query->result();
	}

/**********************************************************************************************************************************
		LITERATURE FUNCTIONS
***********************************************************************************************************************************/

	function get_literature($dealer_id, $status = 'active') {
		$db_table = $this->config->item('db_table_prefix') . 'literature';
		
		$options_array = $this->get_dealer_options($dealer_id);
		if(count($options_array) > 0) {
			foreach($options_array as $option) {
				$literature_exclude = $option->literature;
				$exclude_array = explode(',', $literature_exclude); 
			}
		} else {
			$exclude_array = array();	
		}
		$where = array('literature_status' => $status);
		$this->db->where($where);
		if(count($exclude_array) > 0) {
			$this->db->where_not_in('literature_id',$exclude_array);
		}		
		$this->db->order_by('sort_order ASC, name ASC');
		$query = $this->db->get($db_table);
		return $query->result();
	}

/**********************************************************************************************************************************
		WARRANTY FUNCTIONS
***********************************************************************************************************************************/
	function get_warranty($dealer_id) {
		$db_table = $this->config->item('db_table_prefix') . 'dealers';
		$this->db->select('dealer_warranty');
		$where = array('dealer_id' => $dealer_id);
		$this->db->where($where);	
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

/**********************************************************************************************************************************
		CONTACT FUNCTIONS
***********************************************************************************************************************************/
	function add_contact($data_array) {
		$db_table = $this->config->item('db_table_prefix') . 'contact';
		
		$data = array(
		   'name' => $data_array['name'],
		   'phone' => $data_array['phone'],
		   'email' => $data_array['email'],
		   'comments' => strip_tags($data_array['comments']),
		   'insert_date' => current_timestamp(),
		);
		
		$added = $this->db->insert($db_table, $data);
		if($added) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		} else {
			return FALSE;
		}

	}
	

}
	
/* End of file page_model.php */
/* Location: ./system/application/modules/page/models/page_model.php */