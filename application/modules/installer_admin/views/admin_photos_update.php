<h1>Update Photo Title/Description</h1>
<p>Use the form below to update the photo title and/or caption.</p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		
		echo $this->session->flashdata('status_message');
		if( isset($error) && $error != '') {
            echo $error;
        }
	?>
</div>
<?php echo form_open_multipart('installer-admin/photos/update/' . $photo_id); ?>
<input type="hidden" name="photo_id" value="<?php echo $photo_id; ?>">
    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="photo_title">Title<?php echo required_text('photo_title'); ?></label>
            <input type="text" name="photo_title" id="photo_title" class="input_text" value="<?php echo set_value('photo_title', $photo_array[0]->photo_title); ?>" />

            <label for="photo_description">Description<?php echo required_text('photo_description'); ?></label>
            <textarea name="photo_description" class="textarea_text"><?php echo set_value('photo_description',$photo_array[0]->photo_description); ?></textarea>

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_photo" rel="update_photo" value="Update Photo" class="submit" /><a href="/installer-admin/photos" class="cancel_button">Cancel</a>
            </div>

    	</div>    
    </div>

</form>

