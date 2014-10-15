<h1>Add User</h1>
<p>Use the form below to add a new administration user.</p>
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

<?php echo form_open('admin/users/add'); ?>

    <div id="action_form_wrapper">
        <div class="action_form">
            <label for="first_name" class="form_float_left">First Name<?php echo required_text('first_name'); ?></label>
            <input type="text" name="first_name" id="first_name" class="input_text" value="<?php echo set_value('first_name'); ?>" />
            
            
            <label for="last_name" class="form_float_left">Last Name<?php echo required_text('last_name'); ?></label>
            <input type="text" name="last_name" id="last_name" class="input_text" value="<?php echo set_value('last_name'); ?>" />
            
            <label for="username" class="form_float_left">E-mail Address<?php echo required_text('username'); ?></label>
            <input type="text" name="username" id="username" class="input_text" value="<?php echo set_value('username'); ?>" />
            
            <label for="password" class="form_float_left">Password<?php echo required_text('password'); ?></label>
            <input type="password" name="password" id="password" class="input_text" value="<?php echo set_value('password'); ?>" />
            
            <?php
                /*
        
            <label for="section" class="form_float_left">Set the Access Level</label><br />
            <div class="dropdown_area_block">
                <select name="permission_level" id="permission_level" class="<?php echo dropdown_error_class('permission_level'); ?>">
                    <option value="">Please Choose</option>
                    <?php
                        if( isset($permission_array) && count($permission_array) > 0) {
                            foreach($permission_array as $key => $value) {
                                echo '<option value="' . $key . '"' . set_select('permission_level', $key) . '>' . $value . '</option>';
                            }
                            
                        } 
                    ?>
                </select>
            </div>
             */
             ?>
            <input type="hidden" name="permission_level" value="1" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_user" rel="add_user" value="Add User" class="submit" /><a href="/admin/users" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
    
</form>
