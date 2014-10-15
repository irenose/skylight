<?php
	//Pre-select dropdown box on page load
	$active_selected = $page_data_array[0]->page_status == 'active' ? TRUE : FALSE;
	$inactive_selected = $page_data_array[0]->page_status == 'inactive' ? TRUE : FALSE;

	$main_selected = FALSE;
	$footer_selected = FALSE;
	$global_selected = FALSE;

	
	if($page_data_array[0]->page_location == 'main') {
		if($page_data_array[0]->primary_category == 'yes') {
			$main_selected = TRUE;
		}
	}
	if($page_data_array[0]->page_location == 'footer') {
		$footer_selected = TRUE;
	}
	if($page_data_array[0]->page_location == 'global') {
		$global_selected = TRUE;
	}
	
	//Date Info for Modified By Section
	$mod_date = strtotime($page_data_array[0]->modification_date);
	$modified_date = date('m/d/y',$mod_date);
	$modified_time = date('g:i a',$mod_date);
	
	$random_number = rand(100,2500);

	//If this page has sub-pages below it, create hidden input to alert them if they try and make it inactive
	if(count($children_array) > 0) {
		$has_children = 'yes';
	} else {
		$has_children = 'no';
	}
	

?>

<h1>Update Page</h1>
<p>Use the form below to update the current content page.</p>
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

<?php echo form_open_multipart('admin/pages/update/' . $page_id); ?>
<input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id; ?>" />
<input type="hidden" name="has_children" id="has_children" value="<?php echo $has_children; ?>" />

<div class="action_sidebar">
    
</div>

<div id="action_form_wrapper">
    <div class="action_form">
		<div id="date_modified">
    	Last modified by: <span class="data"><?php echo $page_data_array[0]->modified_by; ?></span> on <span class="data"><?php echo $modified_date; ?></span> at <span class="data"><?php echo $modified_time; ?></span>
    </div>


    	<label for="page_title" class="form_float_left">Page Title<?php echo required_text('page_title'); ?></label>
        <input type="text" name="page_title" id="page_title" class="input_text" value="<?php echo set_value('page_title', $page_data_array[0]->page_title); ?>" />

        <label for="page_url" class="form_float_left">Page URL<?php echo required_text('page_url'); ?></label>
        <?php echo base_url(); ?>&nbsp;&nbsp;<input type="text" name="page_url" id="page_url" class="input_text" value="<?php echo set_value('page_url', $page_data_array[0]->page_url); ?>" style="width:50%;" />
        
        <label for="page_headline" class="form_float_left">Page Headline<?php echo required_text('page_headline'); ?></label>
        <input type="text" name="page_headline" id="page_headline" class="input_text" value="<?php echo set_value('page_headline', $page_data_array[0]->page_headline); ?>" />
        
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

    			echo '</div>' . "\n";
    		}
    	?>
        
        <label for="page_content">Page Content</label>
        <div id="document_link"> </div>
        <div id="page_content_error" class="<?php echo error_class('page_content'); ?>"><?php echo error_message('page_content'); ?> </div>
        <textarea name="page_content" id="custom_textarea" class="textarea_text MCE"><?php echo set_value('page_content', $page_data_array[0]->page_content); ?></textarea>

       
        <?php 
            //Only display section dropdown if it is not currently a main page
            if($page_data_array[0]->primary_category == 'no') {
				if($page_data_array[0]->page_location == 'global') {
                	echo '<input type="hidden" name="primary_category_id" value="global">' . "\n";
				} else {
					echo '<input type="hidden" name="primary_category_id" value="'. $page_data_array[0]->primary_category_id . '">' . "\n";
				}
                echo '<input type="hidden" name="secondary_category_id" value="' . $page_data_array[0]->secondary_category_id . '">' . "\n";	 
            } else {
				echo '<input type="hidden" name="primary_category_id" value="main">' . "\n";
                echo '<input type="hidden" name="secondary_category_id" value="0">' . "\n";	
            }
        ?>




	    <div id="meta_stuff">
            <label for="meta_title">META Page Title</label>
            <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title', $page_data_array[0]->meta_title); ?>" /><br /><br />
            
            <label for="meta_description">META Description</label>
            <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description', $page_data_array[0]->meta_description); ?></textarea><br /><br />
            
            <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label>
            <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords', $page_data_array[0]->meta_keywords); ?></textarea>
        </div>


        <label for="page_status">Status</label>
        <select name="page_status" class="input_dropdown">
            <option value="">Choose Status</option>
            <option value="active"<?php echo set_select('page_status', 'active', $active_selected); ?>>Active</option>
            <option value="inactive"<?php echo set_select('page_status', 'inactive', $inactive_selected); ?>>Inactive</option>
        </select>

        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="update_page" rel="update_page" value="Update Page" class="submit" /><a href="/admin/pages" class="cancel_button">Cancel</a>
        </div>
    
	</div>
</div>
</form>