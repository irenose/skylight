<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blinds
{
    public $CI = NULL;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    public function get_blinds()
    {

        $blinds = array(
        	'darkening-blinds' => array(
                'heading' => 'Room darkening - double pleated blinds',
                'img' => array(
                    'src' => asset_url('images/blinds/room-darkening.jpg'),
                    'alt' => 'darkening blinds',
                ),
                'text' => 'Blackout cloth with honeycomb structure. Energy efficient aluminum coating inside improves the insulation effect. Sleek design and easy installation.',
                'rooms' => array(),
                'energy_pct' => null,
                'swatches' => array(
                    '1159-Brown.jpg',
                    '1161-orange.jpg',
                    '1160-yellow.jpg',
                    '1162-cherise.jpg',
                    '1051-raspberry.jpg',
                    '1156-blue.jpg',
                    '1049-Peach.jpg',
                ),
            ),
            'light-filtering-single' => array(
                'heading' => 'Light filtering – single pleated blinds',
                'img' => array(
                    'src' => asset_url('images/blinds/light-filtering-single.jpg'),
                    'alt' => 'filtering blinds',
                ),
                'text' => 'Colorful light effects softens incoming light to reduce glare. Sleek design and easy installation.',
                'rooms' => array(),
                'energy_pct' => '39',
                'swatches' => array(
                    '1273-sunny-orange.jpg',
                    '1272-sunny-blue.jpg',
                    '1271-sunny-yellow.jpg',
                    '1270-sunny-stripes.jpg',
                    '1269-classic-red.jpg',
                    '1268-delightful-blue.jpg',
                    '1267-burned-orange.jpg',
                    '1266-luscious-lime.jpg',
                    '1265-metallic-blue.jpg',
                    '1263-metallic-gold.jpg',
                    '1262-infinite-grey.jpg',
                    '1258-delightful-cream.jpg',
                    '1257-wavy-white.jpg',
                    '1256-classic-white.jpg',
                    '1255-snowy-white.jpg',
                ),
            ),
            'blackout-blinds' => array(
                'heading' => 'Blackout blinds - flat',
                'img' => array(
                    'src' => asset_url('images/blinds/blackout.jpg'),
                    'alt' => 'blackout blinds',
                ),
                'text' => 'Blocks up to 98 percent of the light and improves energy performance by up to 45 percent. ',
                'rooms' => array(),
                'energy_pct' => '45',
                'swatches' => array(
                    '4573-graphic-pattern.jpg',
                    'PA00-white.jpg',
                    '3009-black.jpg',
                    '4572-flash-red.jpg',
                    '4571-light-blue.jpg',
                    '4570-bright-yellow.jpg',
                    '4569-pale-green.jpg',
                    '4568-vegetal-pattern.jpg',
                    '4567-olive-green.jpg',
                    '0705-grey.jpg',
                    '4565-pale-pink.jpg',
                    '4564-orange.jpg',
                    '4563-curry.jpg',
                    '4562-dark-pattern.jpg',
                    '4561-dark-purple.jpg',
                    '2055-blue.jpg',
                    '4560-dark-red.jpg',
                    '1100-blue.jpg',
                    '4559-dark-brown.jpg',
                    '4558-essential-pattern.jpg',
                    '1705-light-grey.jpg',
                    '4556-beige.jpg',
                    '1085-beige.jpg',
                    '4555-pale-blue.jpg',
                    '1025-white.jpg',
                ),
            ),
			'light-filtering-flat' => array(
                'heading' => 'Light filtering blinds – flat',
                'img' => array(
                    'src' => asset_url('images/blinds/light-filtering-flat.jpg'),
                    'alt' => 'filtering blinds',
                ),
                'text' => 'Diffuses the light to reduce glare and improves energy performance by up to 39 percent.',
                'rooms' => array(),
                'energy_pct' => '39',
                'swatches' => array(
                    '1273-sunny-orange.jpg',
                    '1272-sunny-blue.jpg',
                    '1271-sunny-yellow.jpg',
                    '1270-sunny-stripes.jpg',
                    '1269-classic-red.jpg',
                    '1268-delightful-blue.jpg',
                    '1267-burned-orange.jpg',
                    '1266-luscious-lime.jpg',
                    '1265-metallic-blue.jpg',
                    '1263-metallic-gold.jpg',
                    '1262-infinite-grey.jpg',
                    '1258-delightful-cream.jpg',
                    '1257-wavy-white.jpg',
                    '1256-classic-white.jpg',
                    '1255-snowy-white.jpg',
                ),
            ),
			'venetian-blinds' => array(
                'heading' => 'Venetian blinds',
                'img' => array(
                    'src' => asset_url('images/blinds/venetian.jpg'),
                    'alt' => 'venetian blinds',
                ),
                'text' => 'Adjustable, so you can direct the light in any direction. Can block up to 74 percent of the light and improve energy performance by up to 34 percent.',
                'rooms' => array(),
                'energy_pct' => '34',
                'swatches' => array(
                    '7061-wenge-wipe.jpg',
                    '7060-passionate-red.jpg',
                    '7059-burned-nougat.jpg',
                    '7058-midnight-blue.jpg',
                    '7012-charcoal.jpg',
                    '7057-brushed-silver.jpg',
                    '7056-spingled-gold.jpg',
                    '7055-delicate-vanilla.jpg',
                ),
            ),
        );

        return $blinds;
    }

    function get_swatches($args_array) {
        $blinds = $this->get_blinds();
        $swatches = array();

        // returns array with category headings as keys
        if ($args_array['categorized'] === true) {
            foreach ($blinds as $_k => $_v) {
                $swatches[$_v['heading']] = $_v['swatches'];
            }
        }
        // returns a single keyless array
        else {
            foreach ($blinds as $_k => $_v) {
                foreach ($_v['swatches'] as $_s) {
                    $swatches[] = $_s;
                }
            }
        }

        return $swatches;
    }

    function format_swatch_label($file) {
        $label = array();
        $first_dash = strpos($file, '-');
        $first_dot = strpos($file, '.');

        // remove extension
        $temp = substr($file, 0, $first_dot);

        // get number (everything before first dash)
        $label['number'] = strtoupper(substr($temp, 0, $first_dash));

        // get name (everything after and not including first dash)
        $label['name'] = substr($temp, $first_dash + 1);
        $label['name'] = ucwords(str_replace('-', ' ', $label['name']));

        return $label;
    }
}

?>