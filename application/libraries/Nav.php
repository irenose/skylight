<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Nav {

	var $CI = NULL;

	function Nav() {
		$this->CI =& get_instance();
		$this->CI->load->model('nav_model');
		$this->CI->load->model('page/page_model');
	}
	
	
	function get_main_navigation($primary_nav_array, $category_info_array, $options_array) {
		$navigation = '';
		$home_class = $options_array['category_url'] == 'home' ? ' selected' : '';
		$navigation .= '<li class="main' . $home_class . '"><a href="/' . $options_array['dealer_url'] . '">Home</a></li>';
		
		foreach($primary_nav_array as $nav) {
			if(count($category_info_array) > 0 && $nav->page_id == $category_info_array[0]->page_id) {
				$class = ' class="main selected current_section"';
				$style = ' style="display:block;"';
			} else {
				$class = ' class="main"';	
				$style = ' style="display:none;"';
			}
			$navigation .= '<li' . $class . '><a href="/' . $options_array['dealer_url'] . '/' . $nav->page_url . '"' . $class . '>' . $nav->page_title . '</a>';
			//Get Products Subnav
			if($nav->page_id == 2) {
				$sub_nav_array = $this->CI->page_model->get_product_categories($options_array['dealer_id'], 'active');
				if(count($sub_nav_array) > 0) {
					$navigation .= '<ul class="sub_nav products_subnav"' . $style . '>' . "\n";
					foreach($sub_nav_array as $sub_nav) {
						if( isset($options_array['product_category_id']) && $sub_nav->product_category_id == $options_array['product_category_id']) {
							$sub_class = ' class="selected"';
						} else {
							$sub_class = '';
						}
						$navigation .= '<li' . $sub_class . '><a href="/' . $options_array['dealer_url'] . '/product-category/' . $sub_nav->product_category_id . '/' . url_title($sub_nav->product_category_name, 'dash', TRUE) . '">' . $sub_nav->product_category_name . '</a></li>';
					}
					$navigation .= '</ul>' . "\n";
				}
			} else {
				$sub_nav_array = $this->CI->nav_model->get_secondary_nav_array($nav->page_id, 'active');
				if(count($sub_nav_array) > 0) {
					if($nav->page_id == 5) {
						$subclass = ' warranty_subnav';
					} else {
						$subclass = '';
					}
					$navigation .= '<ul class="sub_nav' . $subclass . '"' . $style . '>' . "\n";
					foreach($sub_nav_array as $sub_nav) {
						if($sub_nav->page_url == $options_array['url_page_name']) {
							$sub_class = ' class="selected"';
						} else if($sub_nav->page_id == 7 && $options_array['photo_gallery_section'] == TRUE) {
							$sub_class = ' class="selected"';
						} else {
							$sub_class = '';
						}
						$navigation .= '<li' . $sub_class . '><a href="/' . $options_array['dealer_url'] . '/' . $nav->page_url . '/' . $sub_nav->page_url . '">' . $sub_nav->page_title . '</a></li>';
					}
					$navigation .= '</ul>' . "\n";
				}
			}
			$navigation .= '</li>';
		}
		
		return $navigation;
		
	}

	function get_primary_navigation($selected_id = '', $primary_category_id = '') {
		
		/*********************************************************
			WIREFRAME MENU BUILD TO INCORPORATE DROPDOWN MENU
		*********************************************************/
		if($this->CI->config->item('template_type') == 'wireframe') {
			$primary_nav_display = '';
			$nav_array = $this->CI->nav_model->get_primary_nav_array('active');
			$primary_nav_display .= '<li><a href="/">Home</a></li>';
			foreach($nav_array as $row) {
				$sub_menu_display = '';
				if($selected_id == $row->page_id || $primary_category_id == $row->page_id) {
					$class = ' class="nav_selected"';
				} else {
					$class = '';
				}
				
				//set section path
				if($row->custom_page == 'yes') {
					$section_url = $row->custom_page_url;
				} else {
					$section_url = $row->page_url;
				}
				
				//Add Second Level Navigation If Any
				$sub_menu_array = $this->CI->nav_model->get_secondary_nav_array($row->page_id, 'active');
				if(count($sub_menu_array) > 0) {
					$sub_menu_display .= '<ul>' . "\n";
					foreach($sub_menu_array as $sub_row) {
						$third_menu_display = '';
						if($sub_row->page_id == $selected_id) {
							$subclass = '';
						} else {
							$subclass = '';
						}
						
						if($sub_row->custom_page == 'yes') {
							$sub_row_url = $sub_row->custom_page_url;
							$sub_menu_display .= '<li' . $subclass . '><a href="/' . $sub_row->custom_page_url . '">' . $sub_row->page_title . '</a>';
						} else {
							$sub_row_url = $sub_row->page_url;
							$sub_menu_display .= '<li' . $subclass . '><a href="/' . $section_url . '/' . $sub_row->page_url . '">' . $sub_row->page_title . '</a>';
						}
						//Add Third Level Navigation If Any
						$third_menu_array = $this->CI->nav_model->get_third_nav_array($sub_row->page_id, 'active');
						if(count($third_menu_array) > 0) {
							$sub_menu_display .= '<ul>' . "\n";
							foreach($third_menu_array as $third_row) {
								if($third_row->custom_page == 'yes') {
									$sub_menu_display .= '<li><a href="/' . $third_row->custom_page_url . '">' . $third_row->page_title . '</a></li>';
								} else {
									$sub_menu_display .= '<li><a href="/' . $section_url . '/' . $sub_row_url . '/' . $third_row->page_url . '">' . $third_row->page_title . '</a></li>';
								}
							}
							$sub_menu_display .= '</ul>';
						} else {
							$sub_menu_display .= '';
						}
						$sub_menu_display .= '</li>';
					}
					$sub_menu_display .= '</ul>';
				} else {
					$sub_menu_display = '';
				}
				
				/*if($row->custom_page == 'yes') {
					$section_url = $row->custom_page_url;
				} else {
					$section_url = $row->page_url;
				}*/
				$primary_nav_display .= '<li><a href="/' . $section_url . '"' . $class . '>' . $row->page_title . '</a>';
				$primary_nav_display .= $sub_menu_display;
				$primary_nav_display .= '</li>';
			}
		} else {
	
	
			/***********************************************
				STANDARD MENU BUILD FOR SITE PRODUCTION
			***********************************************/
			$primary_nav_display = '';
			$primary_nav_display .= '<li><a href="/">Home</a></li>' . "\n";
			$nav_array = $this->CI->nav_model->get_primary_nav_array('active');
			$total = count($nav_array);
			$count = 0;
			foreach($nav_array as $row) {
				$count++;
				$sub_menu_display = '';
				if($selected_id == $row->page_id || $primary_category_id == $row->page_id) {
					$class = ' class="nav_selected"';
				} else {
					$class = '';
				}
				$sub_menu_array = $this->CI->nav_model->get_secondary_nav_array($row->page_id, 'active');
				if(count($sub_menu_array) > 0) {
					$sub_menu_display .= '<ul>' . "\n";
					foreach($sub_menu_array as $sub_row) {
						if($sub_row->page_id == $selected_id) {
							$subclass = '';
						} else {
							$subclass = '';
						}
						
						if($sub_row->custom_page == 'yes') {
							$sub_menu_display .= '<li' . $subclass . '><a href="/' . $sub_row->page_url . '">' . $sub_row->page_title . '</a></li>';
						} else {
							$sub_menu_display .= '<li' . $subclass . '><a href="/' . $row->page_url . '/' . $sub_row->page_url . '">' . $sub_row->page_title . '</a></li>';
						}
					}
					$sub_menu_display .= '</ul>';
				} else {
					$sub_menu_display = '';
				}
				
				if($count == $total) {
					$style = ' style="background:none;"';
				} else {
					$style = '';
				}
				$primary_nav_display .= '<li><a' . $style . ' href="/' . $row->page_url . '"' . $class . '>' . $row->page_title . '</a>';
				$primary_nav_display .= $sub_menu_display;
				$primary_nav_display .= '</li>';
			}
		}
		
		return $primary_nav_display;
	}
	
	function get_sub_navigation($page_id, $category_url) {
		$sub_nav_display = '';
		if($this->CI->config->item('template_type') == 'wireframe') {
			$sub_menu_array = $this->CI->nav_model->get_secondary_nav_array($page_id, 'active');
			if(count($sub_menu_array) > 0) {
				foreach($sub_menu_array as $sub_menu) {
					if($sub_menu->page_id == $page_id) {
						$subclass = 'subnav_selected';
					} else {
						$subclass = '';
					}
					
					if($sub_menu->custom_page == 'yes') {
						$sub_row_url = $sub_menu->custom_page_url;
						$sub_nav_display .= '<li' . $subclass . '><a href="/' . $sub_row_url . '">' . $sub_menu->page_title . '</a></li>';
					} else {
						$sub_row_url = $sub_menu->page_url;
						$sub_nav_display .= '<li' . $subclass . '><a href="/' . $category_url . '/' . $sub_row_url . '">' . $sub_menu->page_title . '</a></li>';
					}
					
					//Check for third level nav
					$third_menu_array = $this->CI->nav_model->get_third_nav_array($sub_menu->page_id, 'active');
					if(count($third_menu_array) > 0) {
						foreach($third_menu_array as $third_menu) {
							if($third_menu->custom_page == 'yes') {
								$sub_nav_display .= '<li style="padding-left:10px;"><a href="/' . $sub_menu->custom_page_url . '">' . $sub_menu->page_title . '</a></li>';
							} else {
								$sub_nav_display .= '<li style="padding-left:10px;"><a href="/' . $category_url . '/' . $sub_row_url . '/' . $third_menu->page_url . '">' . $third_menu->page_title . '</a></li>';
							}	
						}
					}
				}
			}
		} else {
			
		}
		
		return $sub_nav_display;
	}
	
	function get_footer_navigation() {
		$footer_display = '';
		if($this->CI->config->item('template_type') == 'wireframe') {
			$footer_array = $this->CI->nav_model->get_footer_nav_array('active');
			if(count($footer_array) > 0) {
				foreach($footer_array as $footer) {
					if($footer->custom_page == 'yes') {
						$footer_display .= '<a href="/' . $footer->custom_page_url . '">' . $footer->page_title . '</a>';
					} else {
						$footer_display .= '<a href="/' . $footer->page_url . '">' . $footer->page_title . '</a>';
					}
				}
			}
		} else {
			
		}
		
		return $footer_display;
	}

}
// End of library class
// Location: system/application/libraries/Nav.php
