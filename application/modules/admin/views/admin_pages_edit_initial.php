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
	

?>
<div id="list_page_header">
	<h1 class="pages_header">PAGES - EDIT PAGE</h1>
</div>
<div class="flashdata">
	<?php
		//Success/Error Flash Data
		echo $this->session->flashdata('status_message');
		
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		
		if($page_data_array[0]->publish_status == 'no') {
			echo '<div class="draft_notice">' . "\n";
			echo 'You are working with a page currently <span class="save_draft">saved as a draft</span>.' . "\n";
			echo '</div>';
		}
		
	?>
</div>
<div class="clear" style="height:20px;"> </div>
<?php 
	echo form_open('admin/pages/edit-initial/' . $page_id);
?>
	<input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id; ?>" />
    <label for="page_title">Page Title</label><br />
    <input type="text" name="page_title" id="page_title" class="input_text" value="<?php echo set_value('page_title', $page_data_array[0]->page_draft_title); ?>" />
    <div class="error_message"><?php echo error_message('page_title'); ?> </div><br /><br />
        
    <label for="page_url">Page URL</label><br />
    <div class="page_url"><?php echo $this->config->item('base_url')?>DEALER<span id="page_url"><?php echo $page_url_string; ?></span></div>
    
    <div class="clear" style="height:20px;"> </div>
    
    
    <label for="page_headline" class="form_float_left">Page Headline</label><br />
    <input type="text" name="page_headline" id="page_headline" class="input_text" value="<?php echo set_value('page_headline', $page_data_array[0]->page_draft_headline); ?>" />
    <div class="error_message"><?php echo error_message('page_headline'); ?> </div><br /><br />
    
    <?php
		if(isset($document_dropdown_array) && count($document_dropdown_array) > 0) {
			echo '<div id="document_dropdown_container">' . "\n";
			echo '<select name="document_dropdown" id="document_dropdown" class="input_dropdown">' . "\n";
			echo '<option value="">Choose</option>' . "\n";
			foreach($document_dropdown_array as $document) {
				echo '<option value="/content_documents/' . $document->document_file . '.' . $document->extension . '">' . $document->document_name . '</option>' . "\n";
			}
			echo '</select>' . "\n";
			echo '<label>Documents</label>';
			echo '</div>' . "\n";
		}
	?>
    
    <label for="page_content">Page Content</label><br />
    <div id="document_link"> </div>
    <div id="page_content_error" class="<?php echo error_class('page_content'); ?>"><?php echo error_message('page_content'); ?> </div>
    <textarea name="page_content" id="custom_textarea" class="textarea_text MCE"><?php echo set_value('page_content', $page_data_array[0]->page_draft_content); ?></textarea>
    <div class="form_clear"> </div>
    
    <?php 
		//Only display section dropdown if it is not currently a main page
		if($page_data_array[0]->primary_category == 'no') {
	?>
            <label for="section" class="form_float_left">Section <span class="label_small">(which section does this page belong to?)</span></label><br />
    		<table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                <div class="dropdown_area">
                    <select name="primary_category_id" id="primary_category_id" class="<?php echo dropdown_error_class('primary_category_id'); ?>">
                        <option value="">Please Choose</option>
                        <?php
                            if( isset($primary_nav_array) && count($primary_nav_array) > 0) {
                                foreach($primary_nav_array as $nav) {
                                    $selected = $page_data_array[0]->primary_category_id == $nav->page_id ? TRUE : FALSE;
                                    echo '<option value="' . $nav->page_id . '"' . set_select('primary_category_id', $page_data_array[0]->primary_category_id, $selected) . '>' . $nav->page_title . '</option>';
                                }
                                
                            } 
                        ?>
                        <optgroup label="Global Options">
                            <option value="main" <?php echo set_select('primary_category_id', $page_data_array[0]->page_location, $main_selected); ?>>Main Section</option>
                            <option value="footer" <?php echo set_select('primary_category_id', $page_data_array[0]->page_location, $footer_selected); ?>>Global Footer</option>
                            <option value="global" <?php echo set_select('primary_category_id', $page_data_array[0]->page_location, $global_selected); ?>>Global Page</option>
                        </optgroup>
                    </select>
                </div>
                </td>
                <td width="25"> </td>
                <td>
                
                <?php
					// For pre-population secondary nav dropdown - if $primary_category_error has a value
					// primary_category_id dropdown was left blank, and it failed validation
					$primary_category_error = error_message('primary_category_id');
					
                    if($page_data_array[0]->page_location == 'footer' || $page_data_array[0]->page_location == 'global') {
                        $style = ' style="display:none;"';
                        $dropdown = '<option value="">Please Choose</option>';
                    } else if($primary_category_error != '') {
						$style = ' style="display:none;"';
                        $dropdown = '<option value="">Please Choose</option>';
					} else {
                        $style = '';
                        $secondary_nav_array = $this->nav_model->get_subnavigation_dropdown($page_data_array[0]->primary_category_id, $page_data_array[0]->page_id);
                        $dropdown = '<option value="">Please Choose</option>';
                        foreach($secondary_nav_array as $secondary_nav) {
                            $selected = $page_data_array[0]->secondary_category_id == $secondary_nav->page_id ? TRUE : FALSE;
                            $dropdown .= '<option value="' . $secondary_nav->page_id . '"' . set_select('secondary_category_id', $secondary_nav->page_id, $selected) . '>' . $secondary_nav->page_title . '</option>' . "\n";
                            
                        }
                    }
                ?>
                
                <div class="dropdown_area" id="secondary_category_container"<?php echo $style; ?>>
                    <select name="secondary_category_id" id="secondary_category_dropdown" class="input_dropdown_sort">
                        <?php echo $dropdown; ?>
                    </select>
                </div>
                </td>
                </tr>
                </table>
                <div class="error_message"><?php echo error_message('primary_category_id'); ?> </div><br /><br />
    
    <?php 
		} else {
			echo '<input type="hidden" name="primary_category_id" value="main">' . "\n";
			echo '<input type="hidden" name="secondary_category_id" value="0">' . "\n";	
		}
	?>
    
    <div id="meta_data">
    	<div id="meta_header">
        	<div id="meta_show_hide"><img src="/_assets/images/admin/default/buttons/meta_hide_btn.gif" border="0" id="meta_show_hiden_btn" alt="Hide Meta Data" /></div>
        	<h1>META DATA</h1>
            <a href="" class="help_icon" id="meta_help"><img src="/_assets/images/admin/default/icons/icon_help.gif" border="0" class="meta_helper_icon" /></a>
        </div>
        <div class="clear"> </div>
        <div id="meta_elements">
            <div class="meta_container">
                <label for="meta_title">META Page Title</label><br />
                <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title', $page_data_array[0]->meta_title); ?>" />
                <div class="meta_form_clear"> </div>
                <label for="meta_description">META Description</label><br />
                <textarea name="meta_description" id="meta_description" class="textarea_text" style="height:125px;" /><?php echo set_value('meta_description', $page_data_array[0]->meta_description); ?></textarea>
            </div>
            <div class="meta_container">
                <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label><br />
                <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords', $page_data_array[0]->meta_keywords); ?></textarea>
            </div>
            <div class="clear"> </div>
        </div>
    </div>
    <div class="form_clear"> </div>
    <div id="date_modified">
    	This page was last modified by: <span class="data"><?php echo $page_data_array[0]->modified_by; ?></span> on <span class="data"><?php echo $modified_date; ?></span> at <span class="data"><?php echo $modified_time; ?></span>
    </div>
    <div class="form_clear"> </div>
    <div id="form_submit_options">
        <a href="/admin/pages" class="cancel_button submit">X CANCEL</a>
        <div id="submit_options">
            <input type="submit" name="action" value="PUBLISH" rel="publish" class="green_button main_action form_submit" />
            <input type="submit" name="action" value="SAVE AS DRAFT" rel="save_draft" class="draft_button main_action form_submit" />
        </div>
        <div class="clear"> </div>
    </div>
    
    <div class="form_clear"> </div>
</form>