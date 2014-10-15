<h1>Update Password</h1>
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

<?php echo form_open('admin/profile/update-password/' . $user_id); ?>
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

<div class="action_sidebar">
	
</div>

<div id="action_form_wrapper">
    <div class="action_form">

        <label for="username" class="form_float_left">Username</label>
        <p><?php echo $user_data_array[0]->username; ?></p>
        
        <label for="password">Password<?php echo required_text('password'); ?></label>
        <input type="password" name="password" id="password" class="input_text" value="" />
        
        <label for="password_confirm">Confirm Password<?php echo required_text('password_confirm'); ?></label>
        <input type="password" name="password_confirm" id="password_confirm" class="input_text" value="" />

        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="update_password" rel="update_password" value="Update Password" class="blue_button submit submit" /><a href="/admin/home" class="cancel_button">Cancel</a>
        </div>

    </div>
</div>
    
</form>