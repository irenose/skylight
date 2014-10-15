<div id="list_page_header">
	<h1 class="users_header">USERS</h1>
</div>
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
<div class="clear" style="height:20px;"> </div>
<?php echo form_open('admin/users/update-password/' . $user_id); ?>
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />

    <div class="form_label"><label for="username" class="form_float_left">Username</label></div><br />
    <div class="input_small"><?php echo $user_data_array[0]->username; ?></div>
    <div class="form_clear" style="height:10px;"> </div>
    
    <div class="form_label"><label for="password" class="form_float_left">Password</label></div><br />
    <div class="<?php echo input_small_wrapper('password'); ?>">
        <div class="<?php echo input_left('password'); ?>"> </div>
        <div class="<?php echo input_right('password'); ?>"> </div>
        <div class="<?php echo input_bg('password'); ?>"><input type="password" name="password" id="password" class="<?php echo input_text_field('password'); ?>" value="<?php echo set_value('password'); ?>" /></div>
    </div>
    <div id="password_error" class="<?php echo error_class('password'); ?>"><?php echo error_message('password'); ?> </div>
    <div class="form_clear"> </div>
    
    <div class="form_label"><label for="password_confirm" class="form_float_left">Confirm Password</label></div><br />
    <div class="<?php echo input_small_wrapper('password_confirm'); ?>">
        <div class="<?php echo input_left('password_confirm'); ?>"> </div>
        <div class="<?php echo input_right('password_confirm'); ?>"> </div>
        <div class="<?php echo input_bg('password_confirm'); ?>"><input type="password" name="password_confirm" id="password_confirm" class="<?php echo input_text_field('password_confirm'); ?>" value="<?php echo set_value('password_confirm'); ?>" /></div>
    </div>
    <div id="password_confirm_error" class="<?php echo error_class('password_confirm'); ?>"><?php echo error_message('password_confirm'); ?> </div>
    <div class="form_clear"> </div>
    
    
    <div class="form_clear"> </div>
    <div id="form_submit_options">
        <a href="/admin/users"><img src="/_assets/images/admin/default/buttons/cancel_btn.gif" border="0" alt="Cancel" /></a>
        <div id="submit_options">
            <input type="image" src="/_assets/images/admin/default/buttons/update_user_submit_btn.gif" />
        </div>
        <div class="clear"> </div>
    </div>
    
</form>
