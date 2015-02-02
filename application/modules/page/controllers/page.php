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

            if ($vars_array[1] == 'dealer-admin') {
                redirect('installer-admin');
            }
        }

        //Define and Set as Empty Array
        $data['additional_js'] = array();
        $data['additional_css'] = array();

        // Enter url_page_names into array if they require a different view file or custom functionality
        $custom_page_array = array();

        //Define site vars
        $data['show_installer_header_footer'] = TRUE;
        $data['installer_base_url'] = base_url();
        $data['secondary_nav_array'] = array();
        $data['discover_section'] = '';
        $data['contact_products_array'] = array();
        $data['dealer_logo_display'] = '';
        $data['paid_search_page_type'] = 'day';
        $data['show_breadcrumb_modal'] = TRUE;

        if ($vars_size > 0) {
            $installer_url = $vars_array[1];
            $data['installer_url'] = $installer_url;
            $data['current_section'] = ''; // set default
            $data['installer_array'] = $this->page_model->get_installer_array($installer_url);

            //REDIRECT TO MAIN SEARCH IF INSTALLER URL INVALID
            if (count($data['installer_array']) == 0 && $installer_url != 'catalog') {
                redirect('');
            }

            //GET DEFAULT DEALER DISPLAY DATA
            if ($installer_url != 'catalog') {
                if ( !isset($_COOKIE['installer_url']) ) {
                    $domain = $_SERVER['SERVER_NAME'];
                    setcookie('installer_url', $installer_url, time()+3600, '/', $domain);
                } else {
                    unset($_COOKIE['installer_url']);
                    $domain = $_SERVER['SERVER_NAME'];
                    setcookie('installer_url', $installer_url, time()+3600, '/', $domain);
                }
                //UPDATE WITH INSTALLER URL ADDED
                $data['installer_base_url'] = base_url() . $installer_url;
                $data['canonical_url'] = base_url() . $installer_url;
                $data['product_categories_nav_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                $data['breadcrumbs_array'][] = array('label' => 'Home', 'url' => $data['installer_base_url']);
                $data['contact_products_array'] = $this->page_model->get_contact_product_list($data['installer_array'][0]->dealer_id);
                $data['dealer_logo_display'] = $this->page_model->get_dealer_logo($data['installer_array']);
                $data['installer_region'] = $data['installer_array'][0]->region != '' ? $data['installer_array'][0]->region : $data['installer_array'][0]->city;
            }

            if (count($data['installer_array']) > 0) {
                if ($vars_size == 1) {
                    //INSTALLER HOMEPAGE
                    $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                    $data['testimonials_array'] = $this->page_model->get_testimonials_by_dealer($data['installer_array'][0]->dealer_id,1);
                    $data['meta_array'] = array(
                        'title' => 'Skylights -SUN TUNNEL skylights - installation - repair',
                        'description' => '',
                        'keywords' => ''
                    );
                    $data['page_view'] = 'home/installer';
                } else {
                    switch($vars_array[2]) {
                        case 'products':
                            $data['current_section'] = 'products';
                            if ($vars_size == 2) {
                                $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                                /*------------------------------------------------------------------
                                    If installer only sells one category, redirect to category page
                                ------------------------------------------------------------------*/
                                if ( count($data['product_category_array']) == 1) {
                                    redirect($data['installer_base_url'] . '/products/category/' . $data['product_category_array'][0]->product_category_url);
                                }
                                $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . 'products');
                                $data['meta_array'] = array(
                                    'title' => 'Products | Residentail - commercial | VELUX ' . $data['installer_region'],
                                    'description' => '',
                                    'keywords' => ''
                                );
                                $data['page_view'] = 'products/index';
                            } else {
                                switch($vars_array[3]) {
                                    case 'category':
                                        if ($vars_size == 4) {
                                            $data['product_category_array'] = $this->page_model->get_category_products($data['installer_array'][0]->dealer_id, $vars_array[4], 'active');
                                            if ( count($data['product_category_array']) > 0) {
                                                $data['meta_array'] = array(
                                                    'title' => $data['product_category_array']['category']->product_category_name . ' | VELUX ' . $data['installer_region'],
                                                    'description' => '',
                                                    'keywords' => ''
                                                );
                                                $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . '/products');
                                                $data['breadcrumbs_array'][] = array('label' => $data['product_category_array']['category']->product_category_name, 'url' => '');

                                                //Only show anchors if more than 1 subcategory
                                                if (count($data['product_category_array']['subcategory_array']) > 1) {
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
                                        if (count($data['product_info_array']) > 0) {
                                            $data['product_info_array'][0]->product_subcategory_name = $this->page_model->get_category_name_by_id($data['product_info_array'][0]->primary_category_id);
                                            $data['meta_array'] = array(
                                                'title' => $data['product_info_array'][0]->product_name . ' | VELUX ' . $data['installer_region'],
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

                                            if($vars_array[3] == 'blinds') {
                                                $this->load->library('blinds');
                                                $data['blinds_array'] = $this->blinds->get_blinds();
                                                $data['page_view'] = 'products/blinds';
                                            } else {
                                                $data['page_view'] = 'products/product';
                                            }

                                        } else {
                                            redirect($data['installer_base_url'] . '/products');
                                        }
                                        break;
                                }
                            }
                            break;
                        case 'why-skylights':
                            $data['current_section'] = 'why-skylights';
                            $data['meta_array'] = array(
                                'title' => 'Why Skylights? | VELUX ' . $data['installer_region'],
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'why_skylights';
                            break;
                        case 'installing':
                            $data['current_section'] = 'installing';
                            $data['meta_array'] = array(
                                'title' => 'Installing | Skylight installation | VELUX ' . $data['installer_region'],
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
                            $data['gallery_array'] = $this->page_model->get_photos_by_dealer($data['installer_array'][0]->dealer_id);
                            $data['meta_array'] = array(
                                'title' => $data['installer_array'][0]->name . ' | About | VELUX ' . $data['installer_region'],
                                'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                                'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                            );
                            $data['about_dealer_image'] = $this->page_model->get_dealer_about_image($data['installer_array']);
                            $data['page_view'] = 'about';
                            break;
                        case 'warranty':
                            $data['current_section'] = 'warranty';
                            $data['warranty_array'] = $this->page_model->get_warranty($data['installer_array'][0]->dealer_id);
                            $data['product_category_array'] = $this->page_model->get_product_categories($data['installer_array'][0]->dealer_id, 'active');
                            $data['meta_array'] = array(
                                'title' => 'Warranty | VELUX Warranty | VELUX ' . $data['installer_region'],
                                'description' => 'Our VELUX daylighting solutions will keep you dry and comfortable, year after year.',
                                'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                            );
                            $data['page_view'] = 'warranty';
                            break;
                        case 'brochures':
                            $data['current_section'] = 'brochures';
                            $data['brochures_array'] = $this->page_model->get_literature($data['installer_array'][0]->dealer_id);
                            $data['meta_array'] = array(
                                'title' => 'Library | VELUX Information | VELUX ' . $data['installer_region'],
                                'description' => '',
                                'keywords' => ''
                            );
                            $data['page_view'] = 'brochures';
                            break;
                        case 'contact':
                            if($vars_size == 2) {
                                $data['current_section'] = 'contact';
                                $data['meta_array'] = array(
                                    'title' => 'Contact Us | Call or Email | VELUX ' . $data['installer_region'],
                                    'description' => 'Whether it\'s more convenient to call us, email us, or send us a letter, your questions and comments are very important to us.',
                                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                                );

                                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                                $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
                                if ($this->input->post('phone') == '') {
                                    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
                                }
                                $this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
                                $this->form_validation->set_rules('state', 'State', 'trim|xss_clean');
                                $this->form_validation->set_rules('zip', 'Zip', 'trim|xss_clean');
                                $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
                                $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
                                $this->form_validation->set_rules('receive_more_info', 'Receive More Info', 'trim|xss_clean');
                                if ($this->form_validation->run() == FALSE) {
                                    $data['page_view'] = 'contact/index';
                                } else {
                                    $check_fields = array('name','phone','email','comments');
                                    $spam_count = check_spam_count($_POST, $check_fields);
                                    if ($spam_count == 0) {
                                        $insert_id = $this->page_model->add_contact($_POST);

                                        if($insert_id != FALSE) {
                                            $data['form_status'] = 'success';

                                            //SEND EMAIL
                                            $recipient = (trim($data['installer_array'][0]->primary_email) != '') ? $data['installer_array'][0]->primary_email : $data['installer_array'][0]->email;
                                            $from = $this->config->item('global_email_from');
                                            $options = array();

                                            if(trim($this->input->post('email')) != '') {
                                                $options['reply_to'] = $this->input->post('email');
                                            }
                                            if(trim($data['installer_array'][0]->cc_email) != '') {
                                                $options['cc'] = trim($data['installer_array'][0]->cc_email);
                                            }
                                            $subject = 'Contact Request from your VELUX Skylight Microsite';

                                            $message = "Name:\n" . $this->input->post('name') . "\n\n";
                                            $message .= "Phone:\n " . $this->input->post('phone') . "\n\n";
                                            $message .= "E-mail:\n " . $this->input->post('email') . "\n\n";
                                            $message .= "Address:\n " . $this->input->post('address') . "\n\n";
                                            $message .= "City:\n " . $this->input->post('city') . "\n\n";
                                            $message .= "State:\n " . $this->input->post('state') . "\n\n";
                                            $message .= "ZIP:\n " . $this->input->post('zip') . "\n\n\n";
                                            $message .= "Subject:\n " . $this->input->post('subject') . "\n\n";
                                            $message .= "Comments:\n" . strip_tags($this->input->post('comments')) . "\n";

                                            Email_Send($recipient, $from, $subject, $message, $options);
                                            redirect($data['installer_base_url'] . '/contact/thanks');
                                        } else {
                                            $data['form_status'] = 'error';
                                            redirect($data['installer_base_url'] . '/contact/thanks?error=yes');
                                        }

                                    } else {
                                        //Send Spam Emails
                                        $data['form_status'] = 'success';
                                        redirect($data['installer_base_url'] . '/contact/thanks');
                                    }
                                }
                            } else {
                                switch($vars_array[3]) {
                                    case 'product':
                                        if($vars_size != 4) {
                                            redirect($data['installer_base_url'] . '/contact');
                                        } else {
                                            $product_url = $vars_array[4];
                                            $product_array = $this->page_model->get_product_by_url($product_url);
                                            if(count($product_array) > 0) {
                                                $product_name = ascii_to_entities($product_array[0]->product_name);
                                                $product_name = $product_array[0]->model_number != '' ? $product_name . ' (' . $product_array[0]->model_number . ')' : $product_name;
                                                $data['selected_contact_product'] = $product_name;
                                                $data['page_view'] = 'contact/index';
                                            } else {
                                                redirect($data['installer_base_url'] . '/contact');
                                            }
                                        }
                                        break;
                                    case 'thanks':
                                        $data['page_view'] = 'contact/thanks';
                                        break;
                                }
                            }
                            break;
                        case 'promotions':
                            $data['current_section'] = 'promotions';
                            if ($data['installer_array'][0]->promotion_page_copy == '') {
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
                            $data['current_section'] = 'paid-search';
                            $template = 'template_ps';
                            //THANKS PAGE
                            if ($vars_size == 4 && $vars_array[4] == 'thanks') {
                                $data['page_view'] = 'paidsearch/thanks';
                            } else {
                                if ($vars_size == 4 && $vars_array[4] == 'night') {
                                    $data['paid_search_page_type'] = 'night';
                                }
                                switch($vars_array[3]) {
                                    case 'no-leak-skylight':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/no_leak_night' : 'paidsearch/no_leak';
                                        break;
                                    case 'energy-efficiency':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/efficiency_night' : 'paidsearch/efficiency';
                                        break;
                                    case 'skylight-repair':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/repair_night' : 'paidsearch/repair';
                                        break;
                                    case 'sun-tunnel-skylight':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/sun_tunnel_night' : 'paidsearch/sun_tunnel';
                                        break;
                                    case 'commercial-sun-tunnel':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/commercial_sun_tunnel_night' : 'paidsearch/commercial_sun_tunnel';
                                        break;
                                    case 'skylight-replacement':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/replacement_night' : 'paidsearch/replacement';
                                        break;
                                    case 'skylight-blinds':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/blinds_night' : 'paidsearch/blinds';
                                        break;
                                    case 'hail-damage':
                                        $page_view = ($data['paid_search_page_type'] == 'night') ? 'paidsearch/hail_night' : 'paidsearch/hail';
                                        break;
                                    default:
                                        redirect($data['installer_base_url']);
                                        break;
                                }
                                $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
                                $this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
                                if ($this->input->post('phone') == '') {
                                    $this->form_validation->set_rules('email', 'Password Confirm', 'trim|required|valid_email|xss_clean');
                                }
                                $this->form_validation->set_rules('comments', 'Comments', 'trim|required|xss_clean');
                                if ($this->form_validation->run() == FALSE) {
                                    $data['page_view'] = $page_view;
                                } else {
                                    $check_fields = array('name','phone','email','comments');
                                    $spam_count = check_spam_count($_POST, $check_fields, 'confirm_email');
                                    if ($spam_count == 0) {
                                        $insert_id = $this->page_model->add_paid_search_contact($_POST);
                                        if ($insert_id != FALSE) {
                                            $data['form_status'] = 'success';

                                            //SEND EMAIL
                                            $recipient = (trim($data['installer_array'][0]->primary_email) != '') ? $data['installer_array'][0]->primary_email : $data['installer_array'][0]->email;
                                            $from = $this->config->item('global_email_from');
                                            $options = array();

                                            if(trim($this->input->post('email')) != '') {
                                                $options['reply_to'] = $this->input->post('email');
                                            }
                                            if(trim($data['installer_array'][0]->cc_email) != '') {
                                                $options['cc'] = trim($data['installer_array'][0]->cc_email);
                                            }
                                            $subject = 'Paid Search Contact Request from your VELUX Skylight Microsite';
                                            $message = "The following paid search request has been sent via your microsite:\n\n";
                                            $message .= "Name:\n" . $this->input->post('name') . "\n\n";
                                            $message .= "Phone:\n" . $this->input->post('phone') . "\n\n";
                                            $message .= "E-mail:\n" . $this->input->post('email') . "\n\n";
                                            $message .= "Paid Search URL:\n" . $this->input->post('ps_url') . "\n\n";
                                            $message .= "Comments:\n" . strip_tags($this->input->post('comments')) . "\n\n";

                                            Email_Send($recipient, $from, $subject, $message, $options);
                                            redirect($data['installer_base_url'] . '/ps/' . $vars_array[3] . '/thanks');

                                        } else {
                                            $data['form_status'] = 'error';
                                            redirect($data['installer_base_url'] . '/ps/' . $vars_array[3] . '/thanks?error=yes');
                                        }
                                    } else {
                                        //GENERATE SPAM EMAIL
                                        $data['form_status'] = 'success';
                                        redirect($data['installer_base_url'] . '/ps/' . $vars_array[3] . '/thanks');
                                    }
                                }
                            }
                            break;
                        default:
                            redirect('');
                            break;
                    }
                }

            } else if ($vars_array[1] == 'catalog') {
                /*-----------------------
                    Bazaarvoice
                ------------------------*/

                //Redirect to installer url if possible
                if (isset($_COOKIE['installer_url']) && $_COOKIE['installer_url'] != '') {
                    $redirect_link = str_replace('catalog', $_COOKIE['installer_url'], current_url());
                    redirect($redirect_link);
                }
                $template = 'template_general';
                $data['installer_base_url'] = base_url() . 'catalog';
                $data['canonical_url'] = base_url() . 'catalog';
                $data['show_breadcrumb_modal'] = FALSE;
                if ($vars_size < 2 || ($vars_size >= 2 && $vars_array[2] != 'products')) {
                    redirect('');
                } else {
                    if ($vars_size == 2) {
                        $data['product_category_array'] = $this->page_model->get_bv_product_categories();
                        $data['page_view'] = 'products/index';
                    } else {
                        switch($vars_array[3]) {
                            case 'category':
                                if ($vars_size == 4) {
                                    $data['product_category_array'] = $this->page_model->get_bv_category_products($vars_array[4]);
                                    if ( count($data['product_category_array']) > 0) {
                                        $data['meta_array'] = array(
                                            'title' => $data['product_category_array']['category']->product_category_name,
                                            'description' => '',
                                            'keywords' => ''
                                        );
                                        $data['breadcrumbs_array'][] = array('label' => 'Our Products', 'url' => $data['installer_base_url'] . '/products');
                                        $data['breadcrumbs_array'][] = array('label' => $data['product_category_array']['category']->product_category_name, 'url' => '');

                                        //Only show anchors if more than 1 subcategory
                                        if (count($data['product_category_array']['subcategory_array']) > 1) {
                                            foreach($data['product_category_array']['subcategory_array'] as $subcategory) {
                                                $data['secondary_nav_array'][] = array(
                                                    'label' => $subcategory->subcategory_name,
                                                    'anchor' => '#' . url_title($subcategory->subcategory_name,'dash',TRUE)
                                                );
                                            }
                                        }
                                        $data['page_view'] = 'products/category';
                                    } else {
                                        redirect('');
                                    }
                                } else {
                                    redirect('');
                                }
                                break;
                            default:
                                if ($vars_size != 3) {
                                    redirect('');
                                }
                                $data['product_info_array'] = $this->page_model->get_product_by_url($vars_array[3]);
                                if (count($data['product_info_array']) > 0) {
                                    $data['product_info_array'][0]->product_subcategory_name = $this->page_model->get_category_name_by_id($data['product_info_array'][0]->primary_category_id);
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
                                    redirect('');
                                }
                                break;
                        }
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
            $template = 'template_general';
            $data['canonical_url'] = base_url();
            $data['category_url'] = 'home';
            $data['meta_array'] = array(
                'title' => 'VELUX 5-Star Specialist | Skylights -Sun Tunnels - Installation',
                'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
            );
            $data['show_installer_header_footer'] = FALSE;
            $data['product_category_array'] = $this->page_model->get_bv_product_categories();

            if ($this->input->post('installer_search') == 'yes') {
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