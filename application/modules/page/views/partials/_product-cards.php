<?php
    $card_content_array = array();
    switch($display_group) {
        case 'fixed':
            $card_content_array = array(
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &amp; Safe Glass',
                    'copy' => 'Keeps skylights virtually spotless, reduces unwanted outside noise and made for out-of-reach applications.'
                ),
                array(
                    'image' => 'pick-click.jpg',
                    'title' => 'Pick&amp;Click&trade;',
                    'copy' => 'The innovative Pick&amp;Click&trade; brackets make blinds installation fast and easy.'
                ),
                array(
                    'image' => 'sleek-appearance.png', 'title' => 'Sleek appearance', 'copy' => 'The streamlined exterior profile does not obstruct the roofline.'
                ),

            );
            break;
        case 'electric-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'touch-remote.png',
                    'title' => 'Intelligent Touch Remote Control',
                    'copy' => 'With the touch-sensitive screen and easily understood icons, programming skylights has become simpler than ever.'
                ),
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &amp; Safe Glass',
                    'copy' => 'Keeps skylights virtually spotless, reduces unwanted outside noise and made for out-of-reach applications.'
                ),
                array(
                    'image' => 'rain-sensor.jpg',
                    'title' => 'Rain Sensor',
                    'copy' => 'At the first sign of rain the skylight will close automatically.'
                ),

            );
            break;
        case 'manual-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &amp; Safe Glass',
                    'copy' => 'Keeps skylights virtually spotless, reduces unwanted outside noise and made for out-of-reach applications.'
                ),
                array(
                    'image' => 'pick-click.jpg',
                    'title' => 'Pick&amp;Click&trade;',
                    'copy' => 'The innovative Pick&amp;Click&trade; brackets make blinds installation fast and easy.'
                ),
                array(
                    'image' => 'manual-control.png',
                    'title' => 'Convenient Manual Control',
                    'copy' => 'A control rod can be used for out-of-reach applications. An optional crank handle is available for in-reach applications.'
                ),

            );
            break;
        case 'solar-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'touch-remote.png',
                    'title' => 'Intelligent Touch Remote Control',
                    'copy' => 'With the touch-sensitive screen and easy understood icons, programming skylights has become simpler than ever.'
                ),
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &amp; Safe Glass',
                    'copy' => 'Keeps skylights virtually spotless, reduces unwanted outside noise and made for out-of-reach applications.'
                ),
                array(
                    'image' => 'rain-sensor.jpg',
                    'title' => 'Rain Sensor',
                    'copy' => 'At the first sign of rain the skylight will close automatically.'
                ),

            );
            break;
    }

    foreach($card_content_array as $key => $value) {
        echo '<div class="slick__item product-card-wrapper small-12 medium-4 columns">' . "\n";
            echo '<div class="product-card">' . "\n";
                echo '<span class="img-wrapper"><img src="' . asset_url('images/cards/' . $value['image']) . '" alt></span>';
                echo '<h3>' . $value['title'] . '</h3>' . "\n";
                echo '<p>' . $value['copy'] . '</p>' . "\n";
            echo '</div>' . "\n";
        echo '</div>' . "\n";
    }
?>
