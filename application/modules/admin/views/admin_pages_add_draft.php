<h1>Add Draft</h1>
<div class="flashdata">
	<?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
	?>
</div>
<?php 
	echo form_open('admin/pages/add-draft/' . $page_id);
?>
	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>" />
    
<div class="action_sidebar">

	<input type="submit" name="action" value="Save Draft" rel="save_draft" class="form_submit" /><a href="/admin/pages" class="cancel_button">Cancel</a>
</div>


<div id="action_form_wrapper">
    <div class="action_form">
		<label for="page_title" class="form_float_left">Page Title</label>
        <input type="text" name="page_title" id="page_title" class="input_text" value="<?php echo set_value('page_title', $page_data_array[0]->page_title); ?>" />
        <div class="error_message"><?php echo error_message('page_title'); ?> </div>
        
        <label for="page_headline">Page Headline</label>
        <input type="text" name="page_headline" id="page_headline" class="input_text" value="<?php echo set_value('page_headline', $page_data_array[0]->page_headline); ?>" />
        <div class="error_message"><?php echo error_message('page_headline'); ?> </div>
        
        
		
		<label for="page_content">Page Content</label>
		<?php
            if(isset($document_dropdown_array) && count($document_dropdown_array) > 0) {
                echo '<div id="document_dropdown_container">' . "\n";
				echo '<label>Documents</label>';
                echo '<select name="document_dropdown" id="document_dropdown" class="input_dropdown">' . "\n";
                echo '<option value="">Choose</option>' . "\n";
                foreach($document_dropdown_array as $document) {
                    echo '<option value="/content_documents/' . $document->document_file . '.' . $document->extension . '">' . $document->document_name . '</option>' . "\n";
                }
                echo '</select>' . "\n";
				echo '<span id="document_link"> </span>';
                echo '</div>' . "\n";
            }
        ?>
        <div id="page_content_error" class="<?php echo error_class('page_content'); ?>"><?php echo error_message('page_content'); ?> </div>
        <textarea name="page_content" id="custom_textarea" class="textarea_text MCE"><?php echo set_value('page_content', $page_data_array[0]->page_content); ?></textarea>    
    
    </div>
</div>    

</form>