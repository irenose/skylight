<?php
    $card_content_array = array();
    switch($display_group) {
        case 'fixed':
            $card_content_array = array(
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &#38;<br>Safe Glass',
                    'copy' => 'All Solar Powered "Fresh Air" skylights come standard with Clean, Quiet &#38; Safe glass.'
                ),
                array(
                    'image' => 'pick-and-click.jpg',
                    'title' => 'Easy Pick&#38;Click&#153;<br>Blind Installations',
                    'copy' => 'A sunscreen accessory tray for standard site-built curbs allows for installation of VELUX Pick&#38;Click!&#153; blinds.'
                ),
                array(
                    'image' => 'new.jpg', 'title' => 'Flexible installations', 'copy' => 'The elimination of the drywall groove in this series allows for greater installation flexibility and more positioning options when replacing existing skylights.'
                ),

            );
            break;
        case 'sun-tunnel':
            $card_content_array = array(
                array(
                    'image' => 'new.jpg',
                    'title' => 'Optically engineered',
                    'copy' => 'Designed to capture light through a high-impact dome on the roof and send it through a highly reflective tunnel, transmitting a pure natural light with no color shift. '),
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Pivoting tunnel system',
                    'copy' => 'The adjustable pitch adapter makes tunnel installation easier and enables more light to be captures.'
                ),
                array(
                    'image' => 'pick-and-click.jpg',
                    'title' => 'Flexi Loc&trade; system',
                    'copy' => 'A tunnel connection system that reduces tunnel installation time in half and highly reflective tunnels that deliver the highest quality daylight into the space below.'
                ),

            );
            break;
        case 'electric-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'new.jpg',
                    'title' => 'Intelligent Touch Remote Control',
                    'copy' => 'Solar Powered "Fresh Air" skylights can easily replace a fixed or manual skylight easily because no wiring is required.'
                ),
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &#38;<br>Safe Glass',
                    'copy' => 'All Solar Powered "Fresh Air" skylights come standard with Clean, Quiet &#38; Safe glass.'
                ),
                array(
                    'image' => 'pick-and-click.jpg',
                    'title' => 'Rain Sensor',
                    'copy' => 'A sunscreen accessory tray for standard site-built curbs allows for installation of VELUX Pick&Click!&trade; blinds'
                ),

            );
            break;
        case 'manual-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &#38;<br>Safe Glass',
                    'copy' => 'All Solar Powered "Fresh Air" skylights come standard with Clean, Quiet &#38; Safe glass.'
                ),
                array(
                    'image' => 'pick-and-click.jpg',
                    'title' => 'Easy Pick&#38;Click&#153;<br>Blind Installations',
                    'copy' => 'A sunscreen accessory tray for standard site-built curbs allows for installation of VELUX Pick&#38;Click!&#153; blinds.'
                ),
                array(
                    'image' => 'new.jpg',
                    'title' => 'Convenient Manual Control',
                    'copy' => 'A control rod can be used when skylights are out of reach. An optional crank handle is available for in-reach applications.'
                ),

            );
            break;
        case 'solar-fresh-air':
            $card_content_array = array(
                array(
                    'image' => 'new.jpg',
                    'title' => 'Intelligent Touch Remote Control',
                    'copy' => 'Solar Powered "Fresh Air" skylights can easily replace a fixed or manual skylight easily because no wiring is required.'
                ),
                array(
                    'image' => 'water-droplets.jpg',
                    'title' => 'Clean, Quiet &#38;<br>Safe Glass',
                    'copy' => 'All Solar Powered "Fresh Air" skylights come standard with Clean, Quiet &#38; Safe glass.'
                ),
                array(
                    'image' => 'pick-and-click.jpg',
                    'title' => 'Rain Sensor',
                    'copy' => 'A sunscreen accessory tray for standard site-built curbs allows for installation of VELUX Pick&Click!&trade; blinds'
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
