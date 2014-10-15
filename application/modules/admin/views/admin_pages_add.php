<h1>Add Page</h1>
<p>Use the form below to add a new content page.</p>
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

<?php echo form_open('admin/pages/add'); ?>

<div class="action_sidebar">
    
</div>

<div id="action_form_wrapper">
    <div class="action_form">

        <label for="page_title" class="form_float_left">Page Title<?php echo required_text('page_title'); ?></label>
        <input type="text" name="page_title" id="page_title" class="input_text" value="<?php echo set_value('page_title'); ?>" />

        <label for="page_url" class="form_float_left">Page URL<?php echo required_text('page_url'); ?></label>
        <input type="text" name="page_url" id="page_url" class="input_text" value="<?php echo set_value('page_url'); ?>" />
        
        <label for="page_headline" class="form_float_left">Page Headline<?php echo required_text('page_headline'); ?></label>
        <input type="text" name="page_headline" id="page_headline" class="input_text" value="<?php echo set_value('page_headline'); ?>" />
        
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
        <textarea name="page_content" id="custom_textarea" class="textarea_text MCE"><?php echo set_value('page_content'); ?></textarea>
        
        <label for="section" class="form_float_left">Section <span class="label_small">(which section does this page belong to?)</span><?php echo required_text('primary_category_id'); ?></label>
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>
                <div class="dropdown_area">
                    <select name="primary_category_id" id="primary_category_id" class="input_dropdown_sort">
                        <option value="">Please Choose</option>
                        <?php
                            if( isset($primary_nav_array) && count($primary_nav_array) > 0) {
                                foreach($primary_nav_array as $nav) {
                                    echo '<option value="' . $nav->page_id . '"' . set_select('primary_category_id', $nav->page_id) . '>' . $nav->page_title . '</option>';
                                }
                                
                            } 
                        ?>
                        <optgroup label="Global Options">
                            <option value="main" <?php echo set_select('primary_category_id', 'main'); ?>>New Section</option>
                            <option value="footer" <?php echo set_select('primary_category_id', 'footer'); ?>>Global Footer</option>
                            <option value="global" <?php echo set_select('primary_category_id', 'global'); ?>>Global Page</option>
                        </optgroup>
                    </select>
                </div>
                </td>
                <td width="25"> </td>
                <td>
                <div class="dropdown_area" id="secondary_category_container" style="display:none;">
                    <select name="secondary_category_id" id="secondary_category_dropdown" class="input_dropdown_sort">
                        <option value="">Please Choose</option>
                    </select>
                </div>
                </td>
            </tr>
        </table>
        
        <div id="meta_stuff">
            <label for="meta_title">META Page Title</label><br />
            <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title'); ?>" /><br /><br />
            
            <label for="meta_description">META Description</label><br />
            <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description'); ?></textarea><br /><br />
            
            <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label><br />
            <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords'); ?></textarea>
        </div>


        <label for="page_status">Status</label>
        <select name="page_status" class="input_dropdown">
            <option value="">Choose Status</option>
            <option value="active"<?php echo set_select('page_status', 'active'); ?>>Active</option>
            <option value="inactive"<?php echo set_select('page_status', 'inactive'); ?>>Inactive</option>
        </select>

        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="add_page" rel="add_page" value="Add Page" class="submit" /><a href="/admin/pages" class="cancel_button">Cancel</a>
        </div>

    </div>
</div>
</form>