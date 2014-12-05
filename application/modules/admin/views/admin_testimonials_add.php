<h1>Add Testimonial</h1>
<p>Use the form below to add a new testimonial.</p>
<div class="flashdata">
    <?php 
        if(validation_errors()) {
            echo '<div class="error_alert">' . "\n";
            echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
            echo '</div>' . "\n";
        }
        
        echo $this->session->flashdata('status_message');
    ?>
</div>

<?php echo form_open('admin/testimonials/add'); ?>
    <input type="hidden" name="dealer_id" value="0" />
    <div id="action_form_wrapper">
        <div class="action_form">
        	<label for="testimonial_copy">Testimonial Copy<?php echo required_text('testimonial_copy'); ?></label>
            <textarea name="testimonial_copy" class="textarea_text MCE"><?php echo set_value('testimonial_copy'); ?></textarea>
                        
        	<label for="name">Testimonial Name<?php echo required_text('testimonial_name'); ?></label>
            <input type="text" name="testimonial_name" class="input_text" value="<?php echo set_value('testimonial_name') ?>" />
            
            <label for="name">Testimonial Source<?php echo required_text('testimonial_source'); ?></label>
            <input type="text" class="input_text" name="testimonial_source" value="<?php echo set_value('testimonial_source'); ?>" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_testimonial" rel="add_testimonial" value="Add Testimonial" class="submit" /><a href="/admin/testimonials" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>