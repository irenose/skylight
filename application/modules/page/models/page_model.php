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

	function get_coordinates($zip_code) {
		$db_table = $this->config->item('db_table_prefix') . 'zip_codes';
		//Strip Leading 00s from zip
		$zip_code = intval($zip_code);
		$this->db->where('zip',$zip_code);
		$this->db->order_by('zip_id ASC');
		$query = $this->db->get($db_table,1);
		return $query->result();
	}

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