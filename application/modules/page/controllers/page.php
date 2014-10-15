<?php

class Page extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        session_start();
        ob_start();
        $this->load->model('page_model');
    }

    function index()
    {
        $category_url = '';

        //SET DEFAULT TEMPLATE. CAN BE OVERWRITTEN IF NEEDED
        $template = 'template';

        //Get all URL Segments
        $vars_array = $this->uri->segment_array();
        $vars_size = count($vars_array);

        if ($vars_size > 0) {
            $url_page_name = $vars_array[$vars_size];   //url_page_name is last segment of url
            $data['url_page_name'] = $url_page_name;
        }

        //Define and Set as Empty Array
        $data['additional_js'] = array();
        $data['additional_css'] = array();

        // Enter url_page_names into array if they require a different view file or custom functionality
        $custom_page_array = array('styleguide');

        if (count($vars_array) > 0) {
            $category_url = $vars_array[1];
            $data['category_url'] = $category_url;
            $data['current_section'] = ''; // set default

            if (in_array($category_url, $custom_page_array)) {
                switch ($category_url) {
                    case 'styleguide':
                        $data['page_view'] = 'styleguide/index';
                        break;
                }
            } else {
                /*-----------------------
                  $data['page_array']
                  contains all CMS-powered content for the page
                ------------------------*/
                $data['page_array'] = $this->page_model->get_page_by_url($url_page_name);

                if (count($data['page_array']) > 0) {
                    $data['page_headline'] = $data['page_array'][0]->page_headline;
                    $data['page_content'] = ascii_to_entities($data['page_array'][0]->page_content);
                    if ($data['page_array'][0]->page_template != '') {
                        $data['page_view'] = $data['page_array'][0]->page_template;
                    } else {
                        $data['page_view'] = 'page_view';
                    }
                    $data['meta_array'] = array(
                        'title' => $data['page_array'][0]->meta_title,
                        'description' => ascii_to_entities($data['page_array'][0]->meta_description),
                        'keywords' => $data['page_array'][0]->meta_keywords
                    );
                } else {
                    $data['page_title'] = 'Error';
                    $data['page_view'] = 'error';
                }
            }
        } else {
            /*-----------------------
              Homepage
            ------------------------*/
            $data['category_url'] = 'home';
            $data['meta_array']['title'] = 'Homepage';
            $data['meta_array']['description'] = 'Homepage description.';
            $data['meta_array']['keywords'] = '';
            $data['page_view'] = 'homepage';
        }

        //LOAD TEMPLATE
        $this->load->view($template, $data);
        ob_flush();
    }
}

/* End of file page.php */
/* Location: ./application/modules/page/controllers/page.php */