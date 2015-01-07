<?php

class Installer_admin_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
/***********************************************************************************************************************************
/*		GET FUNCTIONS
************************************************************************************************************************************/

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

	function get_site_updates() {
		$db_table = $this->config->item('db_table_prefix') . 'updates';
		$this->db->order_by('insert_date DESC');
		$query = $this->db->get($db_table, 10);
		return $query->result();
	}
}
	
/* End of file dealer_admin_model.php */
/* Location: ./system/application/modules/dealer_admin/models/dealer_admin_model.php */