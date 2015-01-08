<h1 class="clearfix">
    <div class="header_label">Update Testimonial</div>
</h1>
<p>You may revise your testimonial to correct misspellings or other errors in the box below. Click the blue "update testimonial" button to save your changes.</p>
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
<?php echo form_open('/installer-admin/testimonials/update/' . $testimonial_id); ?>
    <input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>" />
    <input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">
    
            <label for="testimonial_copy">Testimonial Copy<?php echo required_text('testimonial_copy'); ?></label>
            <textarea name="testimonial_copy" class="textarea_text"><?php echo set_value('testimonial_copy',$testimonial_array[0]->testimonial_copy); ?></textarea>
                        
            <label for="testimonial_name">Testimonial Name<?php echo required_text('testimonial_name'); ?></label>
            <input type="text" name="testimonial_name" class="input_text" value="<?php echo set_value('testimonial_name', $testimonial_array[0]->testimonial_name) ?>" />
            
            <label for="testimonial_source">Testimonial Source<?php echo required_text('testimonial_source'); ?></label>
            <input type="text" class="input_text" name="testimonial_source" value="<?php echo set_value('testimonial_source', $testimonial_array[0]->testimonial_source); ?>" />


            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_testimonial" rel="update_testimonial" value="Update Testimonial" class="submit" /><a href="/installer-admin/testimonials" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>