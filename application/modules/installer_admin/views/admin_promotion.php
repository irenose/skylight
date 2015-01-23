<?php
    $active_selected = $dealer_array[0]->promotion_status == 'active' ? TRUE : FALSE;
    $inactive_selected = $dealer_array[0]->promotion_status == 'inactive' ? TRUE : FALSE;
?>
<h1 class="clearfix">
    <div class="header_label">Update Promotion</div>
</h1>
<p>Use the form below to create/edit a promotion that you want to display on the site.</p>

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
	
<?php echo form_open('/installer-admin/promotion/' . $_SESSION['dealer_id']); ?>
	<input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">
    
            <label for="name">Promotion Headline<?php echo required_text('promotion_headline'); ?></label>
            <input type="text" class="input_text" name="promotion_headline" id="promotion_headline" value="<?php echo set_value('promotion_headline', $dealer_array[0]->promotion_headline); ?>" />
            
            <label for="promotion_callout_copy">Promotion Callout Copy<?php echo required_text('promotion_callout_copy'); ?></label>
            <input type="text" class="input_text" name="promotion_callout_copy" id="promotion_callout_copy" value="<?php echo set_value('promotion_callout_copy', $dealer_array[0]->promotion_callout_copy); ?>" />

            <label for="promotion_page_copy">Promotion Page Copy<?php echo required_text('promotion_page_copy'); ?></label>
            <textarea name="promotion_page_copy" id="promotion_page_copy" class="textarea_text"><?php echo set_value('promotion_page_copy', $dealer_array[0]->promotion_page_copy); ?></textarea>

            <label for="promotion_status">Status<?php echo required_text('promotion_status'); ?></label>
            <select name="promotion_status" class="input_dropdown">
                <option value="">Choose Status</option>
                <option value="active"<?php echo set_select('promotion_status', 'active', $active_selected); ?>>Active</option>
                <option value="inactive"<?php echo set_select('promotion_status', 'inactive', $inactive_selected); ?>>Inactive</option>
            </select>
            
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_promotion" rel="update_promotion" value="Update Promotion" class="submit" /><a href="/installer-admin/home" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
</form>