<?php

class Page_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
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

	function get_page_by_url($page_url) {
		$db_table = $this->config->item('db_table_prefix') . 'content_pages';
		$where = array('page_url' => $page_url, 'page_status' => 'active');
		$this->db->where($where);
		$query = $this->db->get($db_table,1);
		return $query->result();
	}
	

}
	
/* End of file page_model.php */
/* Location: ./system/application/modules/page/models/page_model.php */