<?php 
    /******************************* INTRO COPY AND OPTIONAL HOURS *************************/ 
?>
<section class="page-row bg-grey contact-info">
    <div class="row">
<?php
    /*---------------------------------------------
        Installer Name & Hours
    ----------------------------------------------*/
?>
        <div class="small-12 large-6 columns">
            <h1 class="normal-weight">Contact us, and things will be looking up.</h1>
            <p>How can we help? Let us know if we can answer any questions, or if you're ready to start transforming your home with the beauty of daylight and fresh air. We look forward to working with you, and giving you your own slice of the sky.</p>
        </div>
        <div class="small-12 large-4 large-offset-2 columns hours">
            <?php
                if($installer_array[0]->dealer_hours != '') {
                    echo '<span class="font-display hours-title">Hours:</span><br>' . nl2br($installer_array[0]->dealer_hours);
                }
            ?>
        </div>
<?php
    /*---------------------------------------------
        End Installer Name & Hours
    ----------------------------------------------*/
?>
    </div>
    <div id="contact-form"></div>
</section>

<?php 
    /******************************* DEALER ADDRESS AND CONTACT FORM *************************/ 
?>
<section class="page-row address-and-form">

<?php
    /*---------------------------------------------
        Validation & Address
    ----------------------------------------------*/
?>
    <div class="row">
        <div class="small-12 large-4 large-push-7 large-offset-1 columns dealer-info--contact">
            <?php 
                echo '<span class="font-display dealer-title">' . $installer_array[0]->name . '</span><br>' . $installer_array[0]->address . '<br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '<br>';
            ?>
        </div>

        <?php
            /*if (validation_errors()) {
                echo '<div class="error-alert">' . "\n";
                echo '<p>You have encountered some errors on this page:</p>' . "\n";
                echo '</div>' . "\n";
            }
            */
        ?>
<?php
    /*---------------------------------------------
        End Validation & Address
    ----------------------------------------------*/
?>
        <div class="small-12 large-7 large-pull-5 columns contact-form">
            <?= $this->load->view('partials/_contact-form');?>
        </div>
    </div>
</section>
<section id="contact-map">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <?php
        $encoded_address = $installer_array[0]->address . '+' . $installer_array[0]->city . ',' . $installer_array[0]->state . '+' . $installer_array[0]->zip;
    ?>
    <div id="map" data-lat="<?=$installer_array[0]->latitude; ?>" data-long="<?=$installer_array[0]->longitude; ?>" data-address="<?=$encoded_address; ?>"></div>
</section>