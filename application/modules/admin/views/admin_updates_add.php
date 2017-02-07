<h1>Add Update</h1>
<p>Use the form below to add a new site update.</p>
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

<?php echo form_open('admin/updates/add'); ?>

    <div id="action_form_wrapper">
        <div class="action_form">
            <label for="update_text">Update Text<?php echo required_text('update_text'); ?></label>
            <textarea name="update_text" id="custom_textarea" class="textarea_text"><?php echo set_value('update_text'); ?></textarea>

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_update" rel="add_update" value="Add Site Update" class="submit" /><a href="/admin/updates" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
    
</form>
