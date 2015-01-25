<h1>Add Photo</h1>
<p>Use the form below to add a photo to the gallery in your installer "About Us" section.</p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";

            if($this->input->post('gallery_asset_type') == 'video') {
                $photo_initial_display = 'display:none;';
                $video_initial_display = 'display:block;';
            }
		}
		
		echo $this->session->flashdata('status_message');
		if( isset($error) && $error != '') {
            echo $error;
        }
	?>
</div>
<?php echo form_open_multipart('installer-admin/photos/add'); ?>
<input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>">

    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="photo_image">Photo Image File</label>
            <input type="file" name="photo_image" class="file_input" />
     
            <label for="photo_title">Title<?php echo required_text('photo_title'); ?></label>
            <input type="text" name="photo_title" id="photo_title" class="input_text" value="<?php echo set_value('photo_title'); ?>" />

            <label for="photo_description">Description<?php echo required_text('photo_description'); ?></label>
            <textarea name="photo_description" class="textarea_text"><?php echo set_value('photo_description'); ?></textarea>

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_photo" rel="add_photo" value="Add Photo" class="submit" /><a href="/installer-admin/photos" class="cancel_button">Cancel</a>
            </div>

    	</div>    
    </div>

</form>

