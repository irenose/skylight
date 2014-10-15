<?php
	//Pre-select dropdown box on page load
	$active_selected = $user_data_array[0]->user_status == 'active' ? TRUE : FALSE;
	$inactive_selected = $user_data_array[0]->user_status == 'inactive' ? TRUE : FALSE;
?>
<h1>Update User<a href="/admin/users/reset-password/<?php echo $user_id; ?>" class="reset_password header_action">Reset Password</a><a href="/admin/users/delete/<?php echo $user_id; ?>" class="header_action delete_confirm">Delete User</a></h1>
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

<?php echo form_open('admin/users/update/' . $user_id); ?>
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

<div class="action_sidebar">
	
</div>

<div id="action_form_wrapper">
    <div class="action_form">
    

        
        <label for="first_name">First Name<?php echo required_text('first_name'); ?></label>
        <input type="text" name="first_name" id="first_name" class="input_text" value="<?php echo set_value('first_name', $user_data_array[0]->first_name); ?>" />
        
        
        <label for="last_name">Last Name<?php echo required_text('last_name'); ?></label>
        <input type="text" name="last_name" id="last_name" class="input_text" value="<?php echo set_value('last_name', $user_data_array[0]->last_name); ?>" />
        
        <label for="username" class="form_float_left">E-mail Address<?php echo required_text('username'); ?></label>
        <input type="text" name="username" id="username" class="input_text" value="<?php echo set_value('username', $user_data_array[0]->username); ?>" />
        
        
        
        <input type="hidden" name="permission_level" value="1" />

        <label for="user_status">Status<?php echo required_text('user_status'); ?></label>
        <select name="user_status" id="user_status_dropdown" class="input_dropdown">
            <option value="active" <?php echo set_select('user_status', $user_data_array[0]->user_status, $active_selected); ?>>Active</option>
            <option value="inactive"  <?php echo set_select('user_status', $user_data_array[0]->user_status, $inactive_selected); ?>>Inactive</option>
        </select>
        
        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="add_user" rel="add_user" value="Update User" class="submit" /><a href="/admin/users" class="cancel_button">Cancel</a>
        </div>

	</div>
</div>
</form>
