<?php
	$inactive_selected = FALSE;
	$active_selected = FALSE;
	$delete_selected = FALSE;
	switch($testimonial_array[0]->testimonial_status) {
		case 'inactive':
			$inactive_selected = TRUE;
			break;
		case 'active':
			$active_selected = TRUE;
			break;
	}
?>
<h1>Update Testimonial</h1>
<p>Use the form below to update a testimonial.</p>
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

<?php echo form_open('admin/testimonials/update/' . $testimonial_id); ?>
	<input type="hidden" name="dealer_id" value="0" />
    <input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id; ?>" />
    <div id="action_form_wrapper">
        <div class="action_form">
            
        	<label for="testimonial_copy">Testimonial Copy<?php echo required_text('testimonial_copy'); ?></label>
            <textarea name="testimonial_copy" class="textarea_text MCE"><?php echo set_value('testimonial_copy',$testimonial_array[0]->testimonial_copy); ?></textarea>
                        
        	<label for="name">Testimonial Name<?php echo required_text('testimonial_name'); ?></label>
            <input type="text" name="testimonial_name" class="input_text" value="<?php echo set_value('testimonial_name', $testimonial_array[0]->testimonial_name) ?>" />
            
            <label for="name">Testimonial Source<?php echo required_text('testimonial_source'); ?></label>
            <input type="text" class="input_text" name="testimonial_source" value="<?php echo set_value('testimonial_source', $testimonial_array[0]->testimonial_source); ?>" />

            <label for="testimonial_status">Testimonial Status<?php echo required_text('testimonial_status'); ?></label>
            <select name="testimonial_status" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="active"<?php echo set_select('testimonial_status','active',$active_selected);?>>Active</option>
                <option value="inactive"<?php echo set_select('testimonial_status','inactive',$inactive_selected);?>>Inactive</option>
            </select>


            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_testimonial" rel="update_testimonial" value="Update Testimonial" class="submit" /><a href="/admin/testimonials" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>