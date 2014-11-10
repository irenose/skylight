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

        if (count($vars_array) > 0) {
            $installer_url = $vars_array[1];
            $data['installer_url'] = $installer_url;
            $data['current_section'] = ''; // set default
            $data['installer_array'] = $this->page_model->get_installer_array($installer_url);
            //UPDATE WITH INSTALLER URL ADDED
            $data['installer_base_url'] = base_url() . $installer_url;

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
                            if($vars_size == 2) {
                                $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
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
                                            $data['page_view'] = 'products/product';
                                        } else {
                                            redirect('products');
                                        }
                                        break;
                                }
                            }
                            break;
                        case 'why-skylights':
                            $data['meta_array'] = array(
                                'title' => 'Why Skylights?',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'why_skylights';
                            break;
                        case 'installing':
                            $data['meta_array'] = array(
                                'title' => 'Installing',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'installing';
                            break;
                        case 'about':
                            $data['testimonials_array'] = $this->page_model->get_testimonials_by_dealer($data['installer_array'][0]->dealer_id);
                            $data['meta_array'] = array(
                                'title' => 'About',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'about';
                            break;
                        case 'warranty':
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
                            $data['brochures_array'] = $this->page_model->get_literature($data['installer_array'][0]->dealer_id);
                            $data['meta_array'] = array(
                                'title' => 'Brochures',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'brochures';
                            break;
                        case 'contact':
                            $data['meta_array'] = array(
                                'title' => 'Contact',
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'contact';
                            break;
                        case 'promotions':
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
            $data['category_url'] = 'home';
            $data['meta_array'] = array(
                'title' => 'Homepage',
                'description' => '',
                'keywords' => ''
            );
            $data['show_installer_header_footer'] = FALSE;
            if($this->input->post('installer_search') == 'yes') {
                $zip_code = htmlentities($this->input->post('zip'),ENT_QUOTES, "UTF-8");
                $data['installer_search_array'] = $this->page_model->get_closest_installers($zip_code);
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