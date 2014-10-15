<h1>Add Images</h1>
<p>You may upload up to 3 images at a time. Your image can be either .gif, .jpg, .png or .bmp</p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		
		echo $this->session->flashdata('status_message');
		echo $error;
	?>
</div>
<?php echo form_open_multipart('admin/images/add'); ?>

    <div id="action_form_wrapper">
        <div class="action_form">
        
        	<label for="userfile1">Image File</label>
            <input type="file" name="userfile1" id="userfile1" class="file_input" />
            
            <label for="image_title1">Image Title<?php echo required_text('image_title1'); ?></label>
            <input type="text" name="image_title1" id="image_title1" class="input_text" value="<?php echo set_value('image_title1'); ?>" />
            <br /><br />
            
            <label for="userfile2">Image File</label>
            <input type="file" name="userfile2" id="userfile2" class="file_input" />
            
            <label for="image_title2">Image Title<?php echo required_text('image_title2'); ?></label>
            <input type="text" name="image_title2" id="image_title2" class="input_text" value="<?php echo set_value('image_title2'); ?>" />
            <br /><br />
            
            <label for="userfile3">Image File</label>
            <input type="file" name="userfile3" id="userfile3" class="file_input" />
            
            <label for="image_title3">Image Title<?php echo required_text('image_title3'); ?></label>
            <input type="text" name="image_title3" id="image_title3" class="input_text" value="<?php echo set_value('image_title3'); ?>" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="upload_images" rel="upload_images" value="Upload Images" class="submit" /><a href="/admin/images" class="cancel_button">Cancel</a>
            </div>

    	</div>    
    </div>

</form>

