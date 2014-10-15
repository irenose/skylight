<h1>Update Image</h1>
<p>Use the form below to update an image you previously uploaded.</p>
<?php
	$current_filename = $image_array[0]->image_file . '.' . $image_array[0]->extension;
	$current_filename_base = $image_array[0]->image_file;
	
	//Date Info for Modified By Section
	$mod_date = strtotime($image_array[0]->modification_date);
	$modified_date = date('m/d/y',$mod_date);
	$modified_time = date('g:i a',$mod_date);
	
	$random = rand(100,999); //random number to avoid image caching if overwrite
?>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		//Error returned if there is a problem with the attempted file upload
		echo $error;
		echo $this->session->flashdata('status_message');
	?>
</div>
<?php echo form_open_multipart('admin/uploads/images/update/' . $image_id); ?>
<input type="hidden" name="image_id" value="<?php echo $image_id; ?>" />
<input type="hidden" name="current_filename_base" value="<?php echo $current_filename_base; ?>" />

<div class="action_sidebar">
	 <input type="submit" name="action" id="upload_documents" rel="upload_documents" value="Update Image" class="" /><a href="/admin/uploads/images" class="cancel_button">Cancel</a>
     <div id="date_modified">
    	Last modified by:<br /><span class="data"><?php echo $image_array[0]->modified_by; ?></span><br /><span class="data"><?php echo $modified_date; ?></span> at <span class="data"><?php echo $modified_time; ?></span>
    </div>
</div>

<div id="action_form_wrapper">
    <div class="action_form">
    	<label>Image File</label>
        <input type="file" name="userfile" id="userfile" class="file_input" />
        <p>Current File: <a href="/content_images/<?php echo $current_filename; ?>?rand=<?php echo $random; ?>" class="lightbox"><?php echo $current_filename; ?></a></p>
        
        <label for="image_name">Image Title</label>
        <input type="text" name="image_name" id="image_name" class="input_text" value="<?php echo set_value('image_name',$image_array[0]->image_name); ?>" />
        <div class="error_message"><?php echo error_message('image_name'); ?> </div><br /><br />
        
        <input type="checkbox" name="confirm_overwrite" value="yes" /><span class="confirm_message"><strong>YES</strong>, overwrite this existing file</span>
    
    </div>
</div>

</form>

