<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Sitemap {

	var $CI = NULL;
	var $xml_file;
	var $base_url;

	function Sitemap() {
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->xml_file = 'sitemap.xml';
		$this->base_url = base_url();
	}
	
	function generate() {
		$output =  '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
		
		$output .= '<url>' . "\n";
		$output .= '<loc>' . substr($this->base_url,0,strlen($this->base_url) - 1) . '</loc>' . "\n";
		$output .= '<priority>1.0</priority>' . "\n";
		$output .= '<changefreq>monthly</changefreq>' . "\n";
		$output .= '</url>' . "\n";
		
		$primary_array = $this->CI->nav_model->get_primary_nav_array('active');
		foreach($primary_array as $row) {
			//Set url and priority
			$output .= '<url>' . "\n";
			$output .= '<loc>' . $this->base_url . $row->page_url . '</loc>' . "\n";
			$output .= '<priority>1.0</priority>' . "\n";
			$output .= '<changefreq>monthly</changefreq>' . "\n";
			$output .= '</url>' . "\n";
			
			$parent_url = $row->page_url;
			
			//Check for subpages
			$subnav_array = $this->CI->nav_model->get_secondary_nav_array($row->page_id, 'active');
			if(count($subnav_array) > 0) {
				foreach($subnav_array as $sub_row) {
					$output .= '<url>' . "\n";
					if($sub_row->custom_page != 'yes') {
						$output .= '<loc>' . $this->base_url . $parent_url . '/' . $sub_row->page_url . '</loc>' . "\n";
					} else {
						$output .= '<loc>' . $this->base_url . $sub_row->custom_page_url . '</loc>' . "\n";
					}
					$output .= '<priority>0.7</priority>' . "\n";
					$output .= '<changefreq>monthly</changefreq>' . "\n";
					$output .= '</url>' . "\n";
					
					$sub_parent_url = $sub_row->page_url;
					//Check for third level nav
					$third_array = $this->CI->nav_model->get_third_nav_array($sub_row->page_id, 'active');
					if(count($third_array) > 0) {
						foreach($third_array as $third_row) {
							$output .= '<url>' . "\n";
							if($third_row->custom_page != 'yes') {
								$output .= '<loc>' . $this->base_url . $parent_url . '/' . $sub_parent_url . '/' . $third_row->page_url . '</loc>' . "\n";
							} else {
								$output .= '<loc>' . $this->base_url . $third_row->custom_page_url . '</loc>' . "\n";
							}
							$output .= '<priority>0.5</priority>' . "\n";
							$output .= '<changefreq>monthly</changefreq>' . "\n";
							$output .= '</url>' . "\n";
						}
					}
				}
			}
			
		}
		$footer_array = $this->CI->nav_model->get_footer_nav_array('active');
		foreach($footer_array as $footer_row) {
			$output .= '<url>' . "\n";
			$output .= '<loc>' . $this->base_url . $footer_row->page_url . '</loc>' . "\n";
			$output .= '<priority>1.0</priority>' . "\n";
			$output .= '<changefreq>monthly</changefreq>' . "\n";
			$output .= '</url>' . "\n";
		}
		
		/*$news_array = $this->CI->News_model->get_all_news();
		foreach($news_array as $news_row) {
			$output .= '<url>' . "\n";
			$output .= '<loc>' . $this->base_url . 'news/view/' . $news_row->news_id . '/' . url_title($news_row->news_headline,'dash',TRUE) . '</loc>' . "\n";
			$output .= '<priority>0.3</priority>' . "\n";
			$output .= '<changefreq>monthly</changefreq>' . "\n";
			$output .= '</url>' . "\n";
		}*/
		
		$output .= '</urlset>';
		
		$file = $_SERVER['DOCUMENT_ROOT'] . "/" . $this->xml_file;
		$handle = fopen($file, "w+");
		$xml = fwrite($handle,$output);
		fclose($handle);
		
		if($xml) {
			return true;
		} else {
			return false;
		}
	}
	
	function display() {
		$output = '';
		$primary_array = $this->CI->nav_model->get_primary_nav_array('active');
		foreach($primary_array as $row) {
			//Set url and priority
			$output .= '<h4><a href="/' . $row->page_url . '">' . $row->page_title . '</a></h4>' . "\n";
			
			$parent_url = $row->page_url;
			
			//Check for subpages
			$subnav_array = $this->CI->nav_model->get_secondary_nav_array($row->page_id, 'active');
			if(count($subnav_array) > 0) {
				$output .= '<p>' . "\n";
				foreach($subnav_array as $sub_row) {
					if($sub_row->custom_page != 'yes') {
						$output .= '&nbsp;&nbsp;<a href="/' . $parent_url . '/' . $sub_row->page_url . '">' . $sub_row->page_title . '</a><br />' . "\n";
					} else {
						$output .= '&nbsp;&nbsp;<a href="/' . $sub_row->custom_page_url . '">' . $sub_row->page_title . '</a><br />' . "\n";
					}
					
					$sub_parent_url = $sub_row->page_url;
					//Check for third level nav
					$third_array = $this->CI->nav_model->get_third_nav_array($sub_row->page_id, 'active');
					if(count($third_array) > 0) {
						foreach($third_array as $third_row) {
							if($third_row->custom_page != 'yes') {
								$output .= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="/' . $parent_url . '/' . $sub_parent_url . '/' . $third_row->page_url . '">' . $third_row->page_title . '</a><br />' . "\n";
							} else {
								$output .= '&nbsp;&nbsp;&nbsp;&nbsp;<a href="/' . $third_row->custom_page_url . '">' . $third_row->page_title . '</a><br />' . "\n";
							}
						}
					}
				}
			}
			
		}
		$footer_array = $this->CI->nav_model->get_footer_nav_array('active');
		foreach($footer_array as $footer_row) {
			$output .= '<h4><a href="/' . $footer_row->page_url . '">' . $footer_row->page_title . '</a></h4>' . "\n";
		}
		
		return $output;
	}

}
// End of library class
// Location: system/application/libraries/Sitemap.php
