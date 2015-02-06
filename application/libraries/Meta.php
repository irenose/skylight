<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Meta
{
    public $CI = NULL;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function get_meta($type, $region = FALSE, $name = FALSE)
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
                    'description' => '',
                    'keywords' => ''
                );
                break;
            case 'products':
                $meta_array = array(
                    'title' => 'Products | Residential - commercial | VELUX ' . $region,
                    'description' => '',
                    'keywords' => ''
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
                $meta_array = array(
                    'title' => $name . ' | VELUX ' . $region,
                    'description' => '',
                    'keywords' => ''
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
                    'description' => '',
                    'keywords' => ''
                );
                break;
            case 'catalog-product':
                $meta_array = array(
                    'title' => $name . ' | VELUX',
                    'description' => '',
                    'keywords' => ''
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
                    'description' => '',
                    'keywords' => ''
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
}

?>