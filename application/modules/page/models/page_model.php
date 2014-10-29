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
		DEALER FUNCTIONS
***********************************************************************************************************************************/

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