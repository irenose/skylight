<?php

class Preview_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
/*********************************************************
/*	Pulls in page content based on URL string provided
/********************************************************/
	function get_page_data($page_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$this->db->where('page_id',$page_id);
		//echo $this->db->last_query();
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}
	
	function get_custom_page_data($custom_page_url) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$where = array('custom_page_url' => $custom_page_url, 'page_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		return $query->result();
	}

	
	function get_header_image($primary_category_id) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$where = array('page_id' => $primary_category_id);
		//$where = "(page_id = '$primary_category_id')";
		$this->db->where($where);
		$query = $this->db->get($db_table, 1);
		foreach($query->result() as $row) {
			return $row->section_header . '.' . $row->extension;
		}
	}
	
	function get_default_flash_array() {
		$db_table = $this->config->item('db_table_prefix') . 'homepage_flash';
		$where = "flash_status = 'active' AND (extension = 'jpg' OR extension = 'gif')";
		$this->db->where($where);
		$this->db->order_by('flash_sort ASC');
		$query = $this->db->get($db_table, 1);
		return $query->result();
		
	}

}
	
/* End of file page_model.php */
/* Location: ./system/application/modules/page/models/page_model.php */