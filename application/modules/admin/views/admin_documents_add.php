<h1>Add Documents</h1>
<p>You may upload up to 3 documents at a time. Your document can be either .doc, .xls, .ppt or pdf</p>
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

<?php echo form_open_multipart('admin/documents/add'); ?>

    <div id="action_form_wrapper">
        <div class="action_form">
    		<label for="userfile1" class="document_label">Document File</label>
            <input type="file" name="userfile1" id="userfile1" class="file_input" />
            
            <label for="document_name1" class="document_label">Document Title</label>
            <input type="text" name="document_name1" id="document_name1" class="input_text" value="<?php echo set_value('document_name1'); ?>" />
            <div class="error_message"><?php echo error_message('document_name1'); ?> </div><br /><br />
            
            <label for="userfile2" class="document_label">Document File</label>
            <input type="file" name="userfile2" id="userfile2" class="file_input" />
            
            <label for="document_name2" class="document_label">Document Title</label>
            <input type="text" name="document_name2" id="document_name2" class="input_text" value="<?php echo set_value('document_name2'); ?>" />
            <div class="error_message"><?php echo error_message('document_name2'); ?> </div><br /><br />
            
            <label for="userfile3" class="document_label">Document File</label>
            <input type="file" name="userfile3" id="userfile3" class="file_input" />
            
            <label for="document_name3" class="document_label">Document Title</label>
            <input type="text" name="document_name3" id="document_name3" class="input_text" value="<?php echo set_value('document_name3'); ?>" />
            <div class="error_message"><?php echo error_message('document_name3'); ?> </div><br /><br />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="upload_documents" rel="upload_documents" value="Upload Documents" class="submit" /><a href="/admin/documents" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>


</form>

