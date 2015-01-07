<h1 class="clearfix">
    <div class="header_label">Update Homepage Copy</div>
</h1>
<p>You can write your own headline and copy that will appear below the photo on your homepage. Click "reset default" to return to the headline and copy provided by VELUX.</p>
<p>Be sure to click the "update homepage" button at the bottom of this page to save your changes.</p>
<p><b>NOTE:</b> <i>The bracketed terms [DEALER_CITY] and [DEALER_NAME] will automatically populate that area of text with your dealer city and company name respectively. You do not need to update these areas of text unless you want it to read differently.</i></p>

<div class="flashdata">
    <?php 
        if(validation_errors()) {
            echo '<div class="error_alert">' . "\n";
            echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
            echo '</div>' . "\n";
        }
        
        echo $this->session->flashdata('status_message');

        // Check to make sure dealer has added their own copy. If not, pull default
        $homepage_headline = (trim($dealer_array[0]->dealer_homepage_headline) != '') ? $dealer_array[0]->dealer_homepage_headline : $default_info_array[0]->default_headline;
        
        $homepage_copy = (trim($dealer_array[0]->dealer_homepage_copy) != '') ? $dealer_array[0]->dealer_homepage_copy : $default_info_array[0]->default_homepage_copy;
    ?>
</div>
	
<?php echo form_open('/installer-admin/account/homepage/' . $_SESSION['dealer_id']); ?>
	<input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">
    
            <label for="name">Homepage Headline<?php echo required_text('dealer_homepage_headline'); ?></label>
            <input type="text" class="input_text" name="dealer_homepage_headline" id="dealer_homepage_headline" value="<?php echo set_value('dealer_homepage_headline', $homepage_headline); ?>" /><br>
            <a href="#" class="text_replace" rel="default_headline" name="dealer_homepage_headline" style="font-weight:normal;font-size:11px;color:#ff0000;">Reset Default Headline</a>
            
            
            <label for="dealer_homepage_copy">Homepage Copy<?php echo required_text('dealer_homepage_copy'); ?></label>
            <textarea name="dealer_homepage_copy" id="dealer_homepage_copy" class="textarea_text"><?php echo set_value('dealer_homepage_copy', $homepage_copy); ?></textarea><br>
            <a href="#" class="text_replace" rel="default_copy" name="dealer_homepage_copy" style="font-weight:normal;font-size:11px;color:#ff0000;">Reset Default Homepage Copy</a>

            <div class="form_spacer"></div>
            
            <div id="default_headline" style="display:none;"><?php echo $default_info_array[0]->default_headline; ?></div>
            <div id="default_copy" style="display:none;"><?php echo $default_info_array[0]->default_homepage_copy; ?></div>
            
            <?php 
        		//ONLY SUPER ADMINS CAN UPDATE META DATA.
        		//IF THEY ARE SUPER ADMIN, SET HIDDEN VARIABLE FOR PROCESSING
        		if( $_SESSION['super_admin'] == 'yes') {
        		echo '<input type="hidden" name="process_meta" value="yes" />';
        	?>
                <div id="meta_stuff">
                    <label for="meta_title">META Page Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title', $dealer_array[0]->home_meta_title); ?>" /><br /><br />
                    
                    <label for="meta_description">META Description</label>
                    <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description', $dealer_array[0]->home_meta_description); ?></textarea><br /><br />
                    
                    <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label>
                    <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords', $dealer_array[0]->home_meta_keywords); ?></textarea>
                </div>

        	<?php
        		}
        	?>
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_homepage" rel="update_homepage" value="Update Homepage" class="submit" /><a href="/installer-admin/account" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
</form>