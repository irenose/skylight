<h1>Update Document</h1>
<p>Use the form below to update a document you previously uploaded.</p>
<?php
	$current_filename = $document_array[0]->document_file . '.' . $document_array[0]->extension;
	$current_filename_base = $document_array[0]->document_file;
	
	//Date Info for Modified By Section
	$mod_date = strtotime($document_array[0]->modification_date);
	$modified_date = date('m/d/y',$mod_date);
	$modified_time = date('g:i a',$mod_date);
?>
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
<?php echo form_open_multipart('admin/uploads/documents/update/' . $document_id); ?>
<input type="hidden" name="document_id" value="<?php echo $document_id; ?>" />
<input type="hidden" name="current_filename_base" value="<?php echo $current_filename_base; ?>" />


<div class="action_sidebar">
	 <input type="submit" name="action" id="upload_documents" rel="upload_documents" value="Update Document" class="" /><a href="/admin/uploads/documents" class="cancel_button">Cancel</a>
     <div id="date_modified">
    	Last modified by:<br /><span class="data"><?php echo $document_array[0]->modified_by; ?></span><br /><span class="data"><?php echo $modified_date; ?></span> at <span class="data"><?php echo $modified_time; ?></span>
    </div>
</div>

<div id="action_form_wrapper">
    <div class="action_form">
    
    	<label class="document_label" for="userfile">Document File</label>
        <input type="file" name="userfile" id="userfile" class="file_input" />
        <p>Current File: <a href="/content_documents/<?php echo $current_filename; ?>"><?php echo $current_filename; ?></a></p>
        
        
        <label for="document_name">Image Title</label>
        <input type="text" name="document_name" id="document_name" class="input_text" value="<?php echo set_value('document_name',$document_array[0]->document_name); ?>" />
        <div class="error_message"><?php echo error_message('document_name'); ?> </div><br /><br />
        
        <input type="checkbox" name="confirm_overwrite" value="yes" /><span class="confirm_message"><strong>YES</strong>, overwrite this existing file</span>
    
    </div>
</div>

</form>

