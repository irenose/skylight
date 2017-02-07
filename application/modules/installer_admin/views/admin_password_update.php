<div id="action_form_wrapper" class="login">
    <div class="action_form">
        <div class="login_box">
            <h1 class="system_login">Password Reset</h1>
            <?php               
                echo $this->session->flashdata('status_message');
            ?>
            <p class="login_copy"><strong>Username:</strong> <?php echo $user_data_array[0]->username; ?></p>

            <form action="/installer-admin/password/update/<?php echo $user_id; ?>" method="post" class="login_form">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                <label for="password">Password<?php echo required_text('password'); ?></label>
                <input type="password" name="password" id="password" class="input_text" value="" /><br /><br />

                <label for="password_confirm">Confirm Password<?php echo required_text('password_confirm'); ?></label>
                <input type="password" name="password_confirm" id="password_confirm" class="input_text" value="" /><br /><br />

                 <p class="login_center"><input type="submit" name="action" id="update_password" rel="update_password" value="Update Password" class="submit_btn login_submit" /></p>
                
            </form>
        </div>
    </div>
</div>
