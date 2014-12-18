<?php 
    /******************************* INTRO COPY AND OPTIONAL HOURS *************************/ 
?>
<section class="page-row page-row--short bg-grey contact-info">
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
<section class="page-row">

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
            <form action="/contact" method="post">
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

                <div class="row">
                    <div class="small-12 medium-6 columns">
                        <label>Name<?php echo required_text('name'); ?></label>
                        <input type="text" name="name" class="<?php echo error_class('name'); ?> full-width" value="<?php echo set_value('name');?>" />

                        <label>Phone<?php echo required_text('phone'); ?></label>
                        <input type="text" name="phone" class="<?php echo error_class('phone'); ?> full-width" value="<?php echo set_value('phone');?>" />

                        <label>Email Address<?php echo required_text('email'); ?></label>
                        <input type="text" name="email" class="<?php echo error_class('email'); ?> full-width" value="<?php echo set_value('email');?>" />

                        <label>City</label>
                        <input type="text" name="city" class="full-width" />

                        <div class="row">
                            <div class="small-12 medium-6 columns">
                                <label>Zip Code</label>
                                <input type="text" name="zip" class="full-width" />
                            </div>
                            <div class="small-12 medium-6 columns">
                                <label>State</label>
                                <div class="styled-select">
                                    <select name="state" class="selectric">
                                        <option>AK</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="small-12 medium-6 columns">
                        <label>What Can We Help You With?</label>
                        <select name="help" class="selectric">
                            <option value="default" selected>Please choose one</option>
                            <option value="option-a">Option A</option>
                            <option value="option-b">Option B</option>
                            <option value="option-c">Option C</option>
                        </select>

                        <label>Message<?php echo required_text('comments'); ?></label>
                        <textarea name="comments" class="<?php echo form_textarea_error('comments'); ?> full-width"><?php echo set_value('comments');?></textarea>

                        <label class="updates"><input type="checkbox" name="iCheck" /> Yes, I would like to receive updates</label>
                    </div>
                </div>

                <input type="submit" value="Submit Form" />
            </form>
        </div>
    </div>
</section>