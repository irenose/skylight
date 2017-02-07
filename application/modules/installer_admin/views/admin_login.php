<div id="action_form_wrapper" class="login">
    <div class="action_form">
        <div class="login_box">
            <h1 class="system_login">System Login</h1>
            
            <?php 
                if(isset($error)) {
                    echo '<div class="error_alert">';
                    echo '<p>' . $error .'</p>';
                    echo '</div>';
                }
            ?>
        
            <form action="" method="post" class="login_form">
            <input type="hidden" name="login_submitted" value="yes" />
            <label for="username">Username<?php echo required_text('username'); ?></label>
            <input type="text" name="username" id="username" class="input_text" value="<?php echo set_value('username'); ?>" />

            <label for="password">Password<?php echo required_text('password'); ?></label>
            <input type="password" name="password" id="password" class="input_text" /><br /><br />
        
            <p class="login_center"><input type="submit" class="submit_btn login_submit" name="action" id="login" value="Log In" /><br /><br /><a href="/installer-admin/password">Forgot Password</a></p>
        
            
            </form>
        </div>
    </div>
</div>
