<?php 
    /******************************* INTRO COPY AND OPTIONAL HOURS *************************/ 
?>
<section>
    <h1>Contact <?= $installer_array[0]->name; ?></h1>
    <?php
        if($installer_array[0]->dealer_hours != '') {
            echo 'Hours:<br>' . nl2br($installer_array[0]->dealer_hours);
        }
    ?>
</section>

<?php 
    /******************************* CONTACT FORM *************************/ 
?>
<section>
    <?php
    	if (validation_errors()) {
    		echo '<div class="error-alert">' . "\n";
    		echo '<p>You have encountered some errors on this page:</p>' . "\n";
    		echo '</div>' . "\n";
    	}
    ?>
    <form action="/contact" method="post">
        <label>Name<?php echo required_text('name'); ?></label>
        <input type="text" name="name" class="<?php echo error_class('name'); ?>" value="<?php echo set_value('name');?>" />

        <label>Company<?php echo required_text('company'); ?></label>
        <input type="text" name="company" class="<?php echo error_class('company'); ?>" value="<?php echo set_value('company');?>" />

        <label>Email Address<?php echo required_text('email'); ?></label>
        <input type="text" name="email" class="<?php echo error_class('email'); ?>" value="<?php echo set_value('email');?>" />

        <label>Phone<?php echo required_text('phone'); ?></label>
        <input type="text" name="phone" class="<?php echo error_class('phone'); ?>" value="<?php echo set_value('phone');?>" />

        <label>How can we help?<?php echo required_text('comments'); ?></label>
        <textarea name="comments" class="<?php echo form_textarea_error('comments'); ?>"><?php echo set_value('comments');?></textarea><br />

        <input type="submit" value="Contact Us" />
    </form>
</section>

 <?php 
    /******************************* DEALER ADDRESS *************************/ 
?>
<section>
    <?php 
        echo $installer_array[0]->name . '<br>Address: ' . $installer_array[0]->address . '<br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '<br>';
    ?>
</section>