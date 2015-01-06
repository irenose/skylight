<?php

class Page extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        session_start();
        ob_start();
        $this->load->model('page_model');
        parse_str($_SERVER['QUERY_STRING'],$_GET);
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
        $custom_page_array = array();

        $data['show_installer_header_footer'] = TRUE;
        $data['installer_base_url'] = base_url();
        $data['secondary_nav_array'] = array();
        $data['discover_section'] = '';
        $data['contact_products_array'] = array();

        if (count($vars_array) > 0) {
            $installer_url = $vars_array[1];
            $data['installer_url'] = $installer_url;
            $data['current_section'] = ''; // set default
            $data['installer_array'] = $this->page_model->get_installer_array($installer_url);

            //REDIRECT TO MAIN SEARCH IF INSTALLER URL INVALID
            if(count($data['installer_array']) == 0) {
                redirect('');
            }

            //UPDATE WITH INSTALLER URL ADDED
            $data['installer_base_url'] = base_url() . $installer_url;
            $data['canonical_url'] = base_url() . $installer_url;
            $data['product_categories_nav_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
            $data['breadcrumbs_array'][] = array('label' => 'Home', 'url' => $data['installer_base_url']);
            $data['contact_products_array'] = $this->page_model->get_contact_product_list($data['installer_array'][0]->dealer_id);
            $data['dealer_logo_display'] = $this->page_model->get_dealer_logo($data['installer_array']);

            if(count($data['installer_array']) > 0) {
                if($vars_size == 1) {
                    //INSTALLER HOMEPAGE
                    $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                    $data['promotion_array'] = $this->page_model->get_homepage_promotion($data['installer_array'][0]->dealer_id);
                    $data['testimonials_array'] = $this->page_model->get_testimonials_by_dealer($data['installer_array'][0]->dealer_id,1);
                    $data['meta_array'] = array(
                        'title' => 'Home',
                        'description' => '',
                        'keywords' => ''
                    );
                    $data['page_view'] = 'home/installer';
                } else {
                    switch($vars_array[2]) {
                        case 'products':
                            $data['current_section'] = 'products';
                            if($vars_size == 2) {
                                $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                                /*------------------------------------------------------------------
                                    If installer only sells one category, redirect to category page
                                ------------------------------------------------------------------*/
                                if( count($data['product_category_array']) == 1) {
                                    redirect($data['installer_base_url'] . '/products/category/' . $data['product_category_array'][0]->product_category_url);
                                }
                                $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . 'products');
                                $data['meta_array'] = array(
                                    'title' => 'Products',
                                    'description' => '',
                                    'keywords' => ''
                                );
                                $data['page_view'] = 'products/index';
                            } else {
                                switch($vars_array[3]) {
                                    case 'category':
                                        if($vars_size == 4) {
                                            $data['product_category_array'] = $this->page_model->get_category_products($data['installer_array'][0]->dealer_id, $vars_array[4], 'active');
                                            if( count($data['product_category_array']) > 0) {
                                                $data['meta_array'] = array(
                                                    'title' => $data['product_category_array']['category']->product_category_name,
                                                    'description' => '',
                                                    'keywords' => ''
                                                );
                                                $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . '/products');
                                                $data['breadcrumbs_array'][] = array('label' => $data['product_category_array']['category']->product_category_name, 'url' => '');

                                                //Only show anchors if more than 1 subcategory
                                                if(count($data['product_category_array']['subcategory_array']) > 1) {
                                                    foreach($data['product_category_array']['subcategory_array'] as $subcategory) {
                                                        $data['secondary_nav_array'][] = array(
                                                            'label' => $subcategory->subcategory_name,
                                                            'anchor' => '#' . url_title($subcategory->subcategory_name,'dash',TRUE)
                                                        );
                                                    }
                                                }
                                                $data['page_view'] = 'products/category';
                                            } else {
                                                redirect('/' . $data['installer_array'][0]->dealer_url . '/products');
                                            }
                                        } else {
                                            redirect('/' . $data['installer_array'][0]->dealer_url . '/products');
                                        }
                                        break;
                                    default:
                                        $data['product_info_array'] = $this->page_model->get_product_by_url($vars_array[3]);
                                        if(count($data['product_info_array']) > 0) {
                                            $data['meta_array'] = array(
                                                'title' => $data['product_info_array'][0]->product_name,
                                                'description' => '',
                                                'keywords' => ''
                                            );
                                            $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . '/products');
                                            $data['breadcrumbs_array'][] = array('label' => $data['product_info_array'][0]->product_category_name, 'url' => $data['installer_base_url'] . '/products/category/' . $data['product_info_array'][0]->product_category_url);
                                            $data['breadcrumbs_array'][] = array('label' => $data['product_info_array'][0]->product_name, 'url' => '');

                                            //Set selected product for pre-populating contact form
                                            $product_name = ascii_to_entities($data['product_info_array'][0]->product_name);
                                            $product_name = ($data['product_info_array'][0]->model_number != '') ? $product_name . ' (' . $data['product_info_array'][0]->model_number . ')' : $product_name;
                                            $data['selected_contact_product'] = $product_name;

                                            $data['page_view'] = 'products/product';
                                        } else {
                                            redirect($data['installer_base_url'] . '/products');
                                        }
                                        break;
                                }
                            }
                            break;
                        case 'styleguide':
                            $data['page_view'] = 'styleguide/index';
                            break;
                        case 'why-skylights':
                            $data['current_section'] = 'why-skylights';
                            $data['meta_array'] = array(
                                'title' => 'Why Skylights?',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'why_skylights';
                            break;
                        case 'installing':
                            $data['current_section'] = 'installing';
                            $data['meta_array'] = array(
                                'title' => 'Installing',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['secondary_nav_array'] = array(
                                array('label' => 'Overview', 'anchor' => '#overview'),
                                array('label' => 'What to Expect', 'anchor' => '#what-to-expect'),
                                array('label' => 'Skylight Orientation', 'anchor' => '#skylight-orientation'),
                                array('label' => 'Energy Efficiency', 'anchor' => '#energy-efficiency'),
                                array('label' => 'Federal Tax Credits', 'anchor' => '#tax-credits'),
                                array('label' => 'Discover More', 'anchor' => '#discover-more'),
                            );
                            $data['page_view'] = 'installing';
                            break;
                        case 'about':
                            $data['current_section'] = 'about';
                            $data['testimonials_array'] = $this->page_model->get_testimonials_by_dealer($data['installer_array'][0]->dealer_id);
                            $data['gallery_array'] = array();
                            $data['meta_array'] = array(
                                'title' => 'About',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'about';
                            break;
                        case 'warranty':
                            $data['current_section'] = 'warranty';
                            $data['warranty_array'] = $this->page_model->get_warranty($data['installer_array'][0]->dealer_id);
                            $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                            $data['meta_array'] = array(
                                'title' => 'Warranty',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'warranty';
                            break;
                        case 'brochures':
                            $data['current_section'] = 'brochures';
                            $data['brochures_array'] = $this->page_model->get_literature($data['installer_array'][0]->dealer_id);
                            $data['meta_array'] = array(
                                'title' => 'Brochures',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'brochures';
                            break;
                        case 'contact':
                            $data['current_section'] = 'contact';
                            $data['meta_array'] = array(
                                'title' => 'Contact',
                                'description' => '',
                                'keywords' => ''
                            );

                            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                            if($this->input->post('phone') == '') {
                                $this->form_validation->set_rules('email', 'Password Confirm', 'trim|required|valid_email|xss_clean');
                            }
                            $this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
                            $this->form_validation->set_rules('state', 'State', 'trim|xss_clean');
                            $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
                            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
                            $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
                            if ($this->form_validation->run() == FALSE) {
                                $data['page_view'] = 'contact';
                            } else {
                                _a($_POST);
                            }
                            break;
                        case 'promotions':
                            $data['current_section'] = 'promotions';
                            $data['dealer_promotion_array'] = $this->page_model->get_dealer_promotion_page($data['installer_array'][0]->dealer_id);
                            if(count($data['dealer_promotion_array']) == 0) {
                                redirect('/' . $data['installer_array'][0]->dealer_url);
                            }
                            $data['meta_array'] = array(
                                'title' => 'Promotions',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'promotions';
                            break;
                        case 'ps':
                            switch($vars_array[3]) {
                                case 'no-leak-skylight':
                                    $data['page_view'] = 'paidsearch/no_leak';
                                    break;
                                case 'energy-efficiency':
                                    $data['page_view'] = 'paidsearch/efficiency';
                                    break;
                                case 'skylight-repair':
                                    $data['page_view'] = 'paidsearch/repair';
                                    break;
                                case 'sun-tunnel-skylight':
                                    $data['page_view'] = 'paidsearch/sun_tunnel';
                                    break;
                                case 'commercial-sun-tunnel':
                                    $data['page_view'] = 'paidsearch/commercial_sun_tunnel';
                                    break;
                                case 'skylight-replacement':
                                    $data['page_view'] = 'paidsearch/replacement';
                                    break;
                                case 'skylight-blinds':
                                    $data['page_view'] = 'paidsearch/blinds';
                                    break;
                                default:
                                    redirect($data['installer_base_url']);
                                    break;
                            }
                            break;
                        default:
                            redirect('');
                            break;
                    }
                }

            } else {
                //INSTALLER DOESN'T EXIST
                echo 'No Dealer';
                exit;
            }
        } else {
            /*-----------------------
                Global Landing Page
                Search for Installer
            ------------------------*/
            $data['canonical_url'] = base_url();
            $data['category_url'] = 'home';
            $data['meta_array'] = array(
                'title' => 'Homepage',
                'description' => '',
                'keywords' => ''
            );
            $data['show_installer_header_footer'] = FALSE;
            if($this->input->post('installer_search') == 'yes') {
                $data['search_zip_code'] = htmlentities($this->input->post('zip'),ENT_QUOTES, "UTF-8");
                $data['installer_search_array'] = $this->page_model->get_closest_installers($data['search_zip_code']);
                $data['page_view'] = 'home/results';
            } else {
                $data['page_view'] = 'home/search';
            }
        }

        //LOAD TEMPLATE
        $this->load->view($template, $data);
        ob_flush();
    }
}

/* End of file page.php */
/* Location: ./application/modules/page/controllers/page.php */