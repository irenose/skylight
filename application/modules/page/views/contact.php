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
            <h2 class="normal-weight">Contact <?= $installer_array[0]->name; ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
    <?php
    	if (validation_errors()) {
    		echo '<div class="error-alert">' . "\n";
    		echo '<p>You have encountered some errors on this page:</p>' . "\n";
    		echo '</div>' . "\n";
    	}
    ?>
    <div class="row">
        <div class="small-12 large-4 large-push-7 large-offset-1 columns dealer-info--contact">
            <?php 
                echo '<span class="font-display dealer-title">' . $installer_array[0]->name . '</span><br>' . $installer_array[0]->address . '<br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '<br>';
            ?>
        </div>
<?php
    /*---------------------------------------------
        End Validation & Address
    ----------------------------------------------*/
?>
        <div class="small-12 large-7 large-pull-5 columns contact-form">
        
                <!-- <label>Name<?php echo required_text('name'); ?></label>
                <input type="text" name="name" class="<?php echo error_class('name'); ?>" value="<?php echo set_value('name');?>" />

                <label>Company<?php echo required_text('company'); ?></label>
                <input type="text" name="company" class="<?php echo error_class('company'); ?>" value="<?php echo set_value('company');?>" />

                <label>Email Address<?php echo required_text('email'); ?></label>
                <input type="text" name="email" class="<?php echo error_class('email'); ?>" value="<?php echo set_value('email');?>" />

                <label>Phone<?php echo required_text('phone'); ?></label>
                <input type="text" name="phone" class="<?php echo error_class('phone'); ?>" value="<?php echo set_value('phone');?>" />

                <label>How can we help?<?php echo required_text('comments'); ?></label>
                <textarea name="comments" class="<?php echo form_textarea_error('comments'); ?>"><?php echo set_value('comments');?></textarea> -->

            <?=$this->load->view('partials/_contact-form');?>
        </div>
    </div>
</section>
<section>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <div id="map"></div>
</section>