<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Meta
{
    public $CI = NULL;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function get_meta($type, $region = FALSE, $name = FALSE, $id = FALSE)
    {
        $meta_array = array();
        
        switch($type) {
            case 'global':
                $meta_array = array(
                    'title' => 'VELUX 5-Star Specialist | Skylights -Sun Tunnels - Installation',
                    'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'homepage':
                $meta_array = array(
                    'title' => 'Skylights -SUN TUNNEL skylights - installation - repair',
                    'description' => $name . ' is a certified 5-Star Skylight Specialist. We proudly carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'products':
                $meta_array = array(
                    'title' => 'Products | Residential - commercial | VELUX ' . $region,
                    'description' => 'With a broad range of energy-efficient daylighting solutions, VELUX understands the way you want to live.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'catalog-products':
                $meta_array = array(
                    'title' => 'Products | Residential - commercial | VELUX',
                    'description' => '',
                    'keywords' => ''
                );
                break;
            case 'product-category':
                switch($id) {
                    case 1:
                        $title = $title = 'Get SUN TUNNEL skylights | Products | VELUX ' . $region;;
                        $description = 'SUN TUNNEL Skylights are easily installed and a smart way to brighten any space with energy-efficient natural light.';
                        break;
                    case 2:
                        $title = 'Get Residential skylights | Products | VELUX ' . $region;
                        $description = 'VELUX offers a complete system of skylights and accessories you can configure and accessorize to fit any lifestyle.';
                        break;
                    case 3:
                        $title = 'Get Commercial skylights | Product | VELUX ' . $region;
                        $description = '';
                        break;

                }
                $meta_array = array(
                    'title' => $title,
                    'description' => $description,
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'catalog-category':
                $meta_array = array(
                    'title' => $name . ' | VELUX',
                    'description' => '',
                    'keywords' => ''
                );
                break;
            case 'product':
                $meta_array = array(
                    'title' => $name . ' | VELUX ' . $region,
                    'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'catalog-product':
                $meta_array = array(
                    'title' => $name . ' | VELUX',
                    'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'why-skylights':
                $meta_array = array(
                    'title' => 'Why Skylights? | VELUX ' . $region,
                    'description' => '',
                    'keywords' => ''
                );
                break;
            case 'installing':
                $meta_array = array(
                    'title' => 'Installing | Skylight installation | VELUX ' . $region,
                    'description' => '',
                    'keywords' => ''
                );

                break;
            case 'replacing':
                $meta_array = array(
                    'title' => 'replacing | Skylight replacement | VELUX ' . $region,
                    'description' => '',
                    'keywords' => ''
                );

                break;
            case 'about':
                $meta_array = array(
                    'title' => $name . ' | About | VELUX ' . $region,
                    'description' => 'Find a local VELUX certified 5-Star Skylight Specialist. Our installers carry the complete line of VELUX skylights, SUN TUNNEL skylights and accessories.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'warranty':
                $meta_array = array(
                    'title' => 'Warranty | VELUX Warranty | VELUX ' . $region,
                    'description' => 'Our VELUX daylighting solutions will keep you dry and comfortable, year after year.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'brochures':
                $meta_array = array(
                    'title' => 'Library | VELUX Information | VELUX ' . $region,
                    'description' => 'Here are links to a wide range of inspiring literature and product information. Simply download the literature in its PDF version.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;
            case 'contact':
                $meta_array = array(
                    'title' => 'Contact Us | Call or Email | VELUX ' . $region,
                    'description' => 'Whether it\'s more convenient to call us, email us, or send us a letter, your questions and comments are very important to us.',
                    'keywords' => 'VELUX, Skylight, Sun Tunnel Skylights, 5-Star Specialist, Green Lighting, Residential Skylights, Commercial Skylights, Deck Mounted Skylights, Curb Mounted Skylights, Pitched Skylight, Skylight Repair, No Leak Promise'
                );
                break;

        }
        return $meta_array;
    }

    public function get_all() {
        $sections = array('global','homepage','products','category','product','why-skylights','installing', 'replacing', 'about', 'warranty','brochures','contact');
        $total_array = array();
        foreach($sections as $key => $value) {
            if($value == 'category') {
                for($i = 1; $i <= 3; $i++) {
                    $new_array = $this->get_meta('product-category', 'VELUX Uptown Charlotte', 'Category', $i);
                    $new_array['page_name'] = ucfirst($value);
                    array_push($total_array, $new_array);
                }
            } else {
                if($value == 'product') {
                    $name = 'PRODUCT NAME';
                } else {
                    $name = 'Demo Site';
                }
                $new_array = $this->get_meta($value, 'VELUX Uptown Charlotte', $name);
                $new_array['page_name'] = ucfirst($value);
                array_push($total_array, $new_array);
            }
        }
        foreach($total_array as $key => $value) {
            echo $value['page_name'] . "\t";
            echo $value['title'] . "\t";
            echo $value['description'] . "\t";
            echo $value['keywords'] . "\t\n";
        }
    }
}

?>