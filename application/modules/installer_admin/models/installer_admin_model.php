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

/***********************************************************************************************************************************
/*		UPDATE FUNCTIONS
************************************************************************************************************************************/

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
		
		
		$db_table = $this->config->item('db_table_prefix') . 'ss_dealer_options';
		
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
			//EMAIL RAV AND JV
			$this->load->library('email');
			$this->email->from('microsites@skylightspecialist.com','VELUX');
			$this->email->to('jvoorhees@wrayward.com');
			$this->email->cc('stephanie@ravenelconsulting.com');
			$this->email->bcc('gparish@wrayward.com');
			$this->email->subject('A VELUX microsite site status has been updated');
			$email_message = $dealer_array[0]->name . ' has updated their site status to: ' . $status . ".\n";
			$this->email->message($email_message);
			$this->email->send();
			
			
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

/***********************************************************************************************************************************
/*		DELETE FUNCTIONS
************************************************************************************************************************************/

	function delete_logo($data_array) {
		
		$dealer_array = $this->get_dealer_by_id($data_array['dealer_id']);
		if(count($dealer_array) > 0) {
			
			$deleted = @unlink($_SERVER['DOCUMENT_ROOT'] . '/dealer_assets/dealer_logos/' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension);
			
			if($deleted) {
		
				$db_table = $this->config->item('db_table_prefix') . 'ss_dealers';
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
			
			$deleted = @unlink($_SERVER['DOCUMENT_ROOT'] . '/dealer_assets/about_images/' . $dealer_array[0]->about_image . '.' . $dealer_array[0]->about_extension);
			
			if($deleted) {
		
				$db_table = $this->config->item('db_table_prefix') . 'ss_dealers';
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