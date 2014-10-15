<?php

class Preview extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('preview_model');
		$this->load->model('page/page_model');
		$this->load->library('nav');
		$this->load->library('sitemap');
	}
	
	function index()
	{

	}
	
	function view($page_id) {
		$page_array = $this->preview_model->get_page_data($page_id);
		if(count($page_array) > 0) {
		
			if($page_array[0]->primary_category == 'yes') {
				$primary_menu_display = $this->nav->get_primary_navigation($page_array[0]->page_id);
				if($page_array[0]->page_location == 'main') {
					$sub_menu_display = $this->nav->get_sub_navigation($page_array[0]->page_id, $page_array[0]->page_url);
				} else {
					$sub_menu_display = '';
				}
				$data['section_header_image'] = $this->page_model->get_header_image($page_array[0]->page_id);
			} else {
				$primary_menu_display = $this->nav->get_primary_navigation($page_array[0]->page_id, $page_array[0]->primary_category_id);
				if($page_array[0]->page_location == 'main') {
					$sub_menu_display = $this->nav->get_sub_navigation($page_array[0]->primary_category_id, $page_array[0]->page_url, $page_array[0]->page_id, $page_array[0]->secondary_category_id);
				} else {
					$sub_menu_display = '';
				}
			}
			
			$data['primary_menu_display'] = $primary_menu_display;
			$data['sub_menu_display'] = $sub_menu_display;
			
			$footer_menu_display = $this->nav->get_footer_navigation();
			$data['footer_menu_display'] = $footer_menu_display;
			
			$page_list_display = $this->nav->get_page_list();
			$data['page_list_display'] = $page_list_display;
			
			$forms_dropdown_display = $this->nav->get_dropdown_list('forms');
			$data['forms_dropdown_display'] = $forms_dropdown_display;
			
			$publications_dropdown_display = $this->nav->get_dropdown_list('publications');
			$data['publications_dropdown_display'] = $publications_dropdown_display;
			
			$data['page_title'] = $page_array[0]->page_draft_title;
			$data['page_headline'] = $page_array[0]->page_draft_headline;
			$data['page_display'] = $page_array[0]->page_draft_content;
			$data['meta_array'] = array(
				'title' => $page_array[0]->meta_title,
				'keywords' => $page_array[0]->meta_keywords,
				'description' => $page_array[0]->meta_description
			);
		}
		
		$data['page_content'] = 'preview_view';
		$template = 'page/'  . $this->config->item('template_type');
		$this->load->view($template, $data);
	}
}

/* End of file page.php */
/* Location: ./system/application/modules/page/controllers/page.php */