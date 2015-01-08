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
}
	
/* End of file dealer_admin_model.php */
/* Location: ./system/application/modules/dealer_admin/models/dealer_admin_model.php */