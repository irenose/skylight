<h1 class="clearfix">
    <div class="header_label">Add Testimonial</div>
</h1>
<p>Add your custom testimonial by typing it into the box below. The customer's name is required and the source of the testimonial (such as a publication like your local newspaper) is optional. Click the "add testimonial" button to save your changes.</p>
<div class="flashdata">
    <?php 
        if(validation_errors()) {
            echo '<div class="error_alert">' . "\n";
            echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
            echo '</div>' . "\n";
        }
        if(isset($error)) {
            echo $error;
        }
        echo $this->session->flashdata('status_message');
    ?>
</div>
<?php echo form_open('/installer-admin/testimonials/add'); ?>
    <input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="testimonial_copy">Testimonial Copy<?php echo required_text('testimonial_copy'); ?></label>
            <textarea name="testimonial_copy" class="textarea_text"><?php echo set_value('testimonial_copy'); ?></textarea>
                        
            <label for="name">Testimonial Name<?php echo required_text('testimonial_name'); ?></label>
            <input type="text" name="testimonial_name" class="input_text" value="<?php echo set_value('testimonial_name') ?>" />
            
            <label for="name">Testimonial Source<?php echo required_text('testimonial_source'); ?></label>
            <input type="text" class="input_text" name="testimonial_source" value="<?php echo set_value('testimonial_source'); ?>" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_testimonial" rel="add_testimonial" value="Add Testimonial" class="submit" /><a href="/installer-admin/testimonials" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>