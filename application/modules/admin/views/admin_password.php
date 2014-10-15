<div id="action_form_wrapper" class="login">
    <div class="action_form">
        <div class="login_box">
            <h1 class="system_login">Password Reset</h1>
            <p class="login_copy">Fill in your username below and you will be emailed instructions on resetting your password.</p>
        	<?php 				
				echo $this->session->flashdata('status_message');
			?>
			<form action="/admin/password" method="post" class="login_form">
                <label for="username">Username<?php echo required_text('username'); ?></label>
                <input type="text" name="username" id="username" class="input_text" value="<?php echo set_value('username'); ?>" /><br /><br />

                 <p class="login_center"><input type="submit" name="action" id="reset_password" rel="reset_password" value="Reset Password" class="submit_btn login_submit" /></p>
                
            </form>
        </div>
    </div>
</div>
