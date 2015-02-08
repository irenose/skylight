<?php
    $inactive_selected = FALSE;
    $active_selected = FALSE;
    $delete_selected = FALSE;
    
    $site_active = FALSE;
    $site_inactive = FALSE;
    
    $sells_vms_no = FALSE;
    $sells_vms_yes = FALSE;
    
    switch($dealer_array[0]->dealer_status) {
        case 'inactive':
            $inactive_selected = TRUE;
            break;
        case 'active':
            $active_selected = TRUE;
            break;
        case 'delete':
            $delete_selected = TRUE;
            break;
    }
    
    switch($dealer_array[0]->site_status) {
        case 'inactive':
            $site_inactive = TRUE;
            break;
        case 'active':
            $site_active = TRUE;
            break;
    }
    
    if( $dealer_array[0]->sells_vms == 'yes') {
        $sells_vms_yes = TRUE;
    } else {
        $sells_vms_no = TRUE;
    }
    
    $random = rand(100,999);
?>
<h1>Update Installer</h1>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
            echo validation_errors();
    		echo '</div>' . "\n";
		}
		
		echo $this->session->flashdata('status_message');
	?>
</div>

<?php echo form_open_multipart('admin/installers/update/' . $dealer_id); ?>
<input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>" />
<?php
    if(trim($dealer_array[0]->dealer_logo) != '') {
        echo '<input type="hidden" name="current_filename_base" value="' . $dealer_array[0]->dealer_logo . '" />';
        echo '<input type="hidden" name="current_filename" value="' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '" />';
    }
?>
<div id="action_form_wrapper">
    <div class="action_form">
    
        <label for="name">Name<?php echo required_text('name'); ?></label>
        <input type="text" name="name" id="name" class="input_text" value="<?php echo set_value('name', $dealer_array[0]->name); ?>" />
        
        
        <label for="dealer_url">Installer URL<?php echo required_text('dealer_url'); ?></label>
        <input type="text" name="dealer_url" id="dealer_url" class="input_text" value="<?php echo set_value('dealer_url', $dealer_array[0]->dealer_url); ?>" />
        
        <?php /* get validation working */ ?>
        <div id="url_validation"> </div>
        
        <label for="email" class="form_float_left">Account E-mail Address<?php echo required_text('email'); ?></label>
        <input type="text" name="email" id="email" class="input_text" value="<?php echo set_value('email', $dealer_array[0]->email); ?>" />


        <label for="dealer_status">Installer Status<?php echo required_text('dealer_status'); ?></label>
        <select name="dealer_status" id="dealer_status_dropdown" class="input_dropdown">
            <option value="active" <?php echo set_select('dealer_status', 'active', $active_selected); ?>>Active</option>
            <option value="inactive" <?php echo set_select('dealer_status', 'inactive', $inactive_selected); ?>>Inactive</option>
             <option value="delete" <?php echo set_select('dealer_status', 'delete', $delete_selected); ?>>Delete</option>
        </select>

        <label for="site_status">Site Status<?php echo required_text('site_status'); ?></label>
        <select name="site_status" id="site_status_dropdown" class="input_dropdown">
            <option value="active" <?php echo set_select('site_status', 'active', $site_active); ?>>Active</option>
            <option value="inactive" <?php echo set_select('site_status', 'inactive', $site_inactive); ?>>Inactive</option>
        </select>

        <div class="clearfix"></div>

        <table cellpadding="0" cellspacing="0" border="0" width="98%">
            <tr valign="top">
                <td width="50%">
                    <label for="contact_first_name">Contact First Name<?php echo required_text('contact_first_name'); ?></label>
                    <input type="text" name="contact_first_name" id="contact_first_name" class="input_text" value="<?php echo set_value('contact_first_name', $dealer_array[0]->contact_first_name); ?>" />
                </td>
                <td>
                    <label for="contact_last_name">Contact Last Name<?php echo required_text('contact_last_name'); ?></label>
                    <input type="text" name="contact_last_name" id="contact_last_name" class="input_text" value="<?php echo set_value('contact_last_name', $dealer_array[0]->contact_last_name); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="address">Address<?php echo required_text('address'); ?></label>
                    <input type="text" name="address" id="address" class="input_text" value="<?php echo set_value('address', $dealer_array[0]->address); ?>" />
                </td>
                <td>
                    <label for="address2">Address 2<?php echo required_text('address2'); ?></label>
                    <input type="text" name="address2" id="address2" class="input_text" value="<?php echo set_value('address2', $dealer_array[0]->address2); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="city">City<?php echo required_text('city'); ?></label>
                    <input type="text" name="city" id="city" class="input_text" value="<?php echo set_value('city', $dealer_array[0]->city); ?>" />
                </td>
                <td>
                    <label for="state">State<?php echo required_text('state'); ?></label>
                    <select name="state" id="state_dropdown" class="input_dropdown">
                        <?php 
                            $state_array = get_data_array('state');
                            foreach($state_array as $key => $value) {
                                $selected = $dealer_array[0]->state == $key ? TRUE : FALSE;
                                echo '<option value="' . $key . '"' . set_select('state',$key,$selected) . '>' . $value . '</option>' . "\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="zip">Zip<?php echo required_text('zip'); ?></label>
                    <input type="text" name="zip" id="zip" class="input_text" value="<?php echo set_value('zip', $dealer_array[0]->zip); ?>" />
                </td>
                <td>
                    <label for="region">Region<?php echo required_text('region'); ?></label>
                    <input type="text" name="region" id="region" class="input_text" value="<?php echo set_value('region', $dealer_array[0]->region); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="phone1">Phone<?php echo required_text('phone1'); ?></label>
                    <input type="text" name="phone1" id="phone1" class="input_text" value="<?php echo set_value('phone1', $dealer_array[0]->phone1); ?>" />
                </td>
                <td>
                    <label for="fax">Fax<?php echo required_text('fax'); ?></label>
                    <input type="text" name="fax" id="fax" class="input_text" value="<?php echo set_value('fax', $dealer_array[0]->fax); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="website">Website<?php echo required_text('website'); ?></label>
                    <input type="text" name="website" id="website" class="input_text" value="<?php echo set_value('website', $dealer_array[0]->website); ?>" />
                </td>
                <td>
                    <label for="paid_search_extension">Paid Search Extension<?php echo required_text('paid_search_extension'); ?></label>
                    <input type="text" name="paid_search_extension" id="paid_search_extension" class="input_text" value="<?php echo set_value('paid_search_extension', $dealer_array[0]->paid_search_extension); ?>" />
                </td>
            </tr>
        </table>

        <label for="dealer_hours">Installer Hours<?php echo required_text('dealer_hours'); ?></label>
        <textarea name="dealer_hours" id="dealer_hours" class="textarea_text"><?php echo set_value('dealer_hours', $dealer_array[0]->dealer_hours); ?></textarea>

        <label for="logo">Logo
        <?php
            if(trim($dealer_array[0]->dealer_logo) != '') {
                echo '&nbsp;&nbsp;Current Logo: <a class="lightbox" href="/dealer_assets/dealer_logos/' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '?rand=' . $random . '">' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '</a>';
            }
        ?>
        </label>
        <input type="file" name="userfile" />
        <br /><br />
        <?php 
            $headline = trim($dealer_array[0]->dealer_homepage_headline) != '' ? $dealer_array[0]->dealer_homepage_headline : $default_info_array[0]->default_headline;
            $homepage_copy = trim($dealer_array[0]->dealer_homepage_copy) != '' ? $dealer_array[0]->dealer_homepage_copy : $default_info_array[0]->default_homepage_copy;
        ?>

        <label for="dealer_homepage_headline">Homepage Headline<?php echo required_text('dealer_homepage_headline'); ?></label>
        <input type="text" name="dealer_homepage_headline" id="dealer_homepage_headline" class="input_text" value="<?php echo set_value('dealer_homepage_headline', $headline); ?>" />

        <label for="credentials">Installer Credentials<?php echo required_text('credentials'); ?></label>
        <textarea name="credentials" id="credentials" class="textarea_text"><?php echo set_value('credentials', $dealer_array[0]->credentials); ?></textarea>

        <label for="about_dealer_headline">About Installer Headline<?php echo required_text('about_dealer_headline'); ?></label>
        <input type="text" name="about_dealer_headline" id="about_dealer_headline" class="input_text" value="<?php echo set_value('about_dealer_headline', $dealer_array[0]->about_dealer_headline); ?>" />

        <label for="about_dealer_text">About Installer Copy<?php echo required_text('about_dealer_text'); ?></label>
        <textarea name="about_dealer_text" id="about_dealer_text" class="textarea_text"><?php echo set_value('about_dealer_text', $dealer_array[0]->about_dealer_text); ?></textarea>

        <label for="sells_vms">Sells VMS?<?php echo required_text('sells_vms'); ?></label>
        <select name="sells_vms" id="sells_vms_dropdown" class="input_dropdown">
            <option value="no" <?php echo set_select('sells_vms', 'no', $sells_vms_no); ?>>No</option>
            <option value="yes" <?php echo set_select('sells_vms', 'yes', $sells_vms_yes); ?>>Yes</option>
        </select>

        
        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="update_installer" rel="update_installer" value="Update Installer" class="submit" /><a href="/admin/installers" class="cancel_button">Cancel</a>
        </div>

	</div>
</div>
</form>
