<h1>Add Installer</h1>
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

<?php echo form_open_multipart('admin/installers/add'); ?>
<div id="action_form_wrapper">
    <div class="action_form">
    
        <label for="name">Name<?php echo required_text('name'); ?></label>
        <input type="text" name="name" id="name" class="input_text" value="<?php echo set_value('name'); ?>" />
        
        
        <label for="dealer_url">Installer URL<?php echo required_text('dealer_url'); ?></label>
        <input type="text" name="dealer_url" id="dealer_url" class="input_text" value="<?php echo set_value('dealer_url'); ?>" />

        <?php /* get validation working */ ?>
        <div id="url_validation"> </div>
        
        <label for="email" class="form_float_left">Account E-mail Address<?php echo required_text('email'); ?></label>
        <input type="text" name="email" id="email" class="input_text" value="<?php echo set_value('email'); ?>" />

        <div style="height:40px;"></div>

        <table cellpadding="0" cellspacing="0" border="0" width="98%">
            <tr valign="top">
                <td width="50%">
                    <label for="contact_first_name">Contact First Name<?php echo required_text('contact_first_name'); ?></label>
                    <input type="text" name="contact_first_name" id="contact_first_name" class="input_text" value="<?php echo set_value('contact_first_name'); ?>" />
                </td>
                <td>
                    <label for="contact_last_name">Contact Last Name<?php echo required_text('contact_last_name'); ?></label>
                    <input type="text" name="contact_last_name" id="contact_last_name" class="input_text" value="<?php echo set_value('contact_last_name'); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="address">Address<?php echo required_text('address'); ?></label>
                    <input type="text" address="address" id="address" class="input_text" value="<?php echo set_value('address'); ?>" />
                </td>
                <td>
                    <label for="address2">Address 2<?php echo required_text('address2'); ?></label>
                    <input type="text" name="address2" id="address2" class="input_text" value="<?php echo set_value('address2'); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="city">City<?php echo required_text('city'); ?></label>
                    <input type="text" name="city" id="city" class="input_text" value="<?php echo set_value('city'); ?>" />
                </td>
                <td>
                    <label for="state">State<?php echo required_text('state'); ?></label>
                    <select name="state" id="state_dropdown" class="input_dropdown">
                        <?php 
                            $state_array = get_data_array('state');
                            foreach($state_array as $key => $value) {
                                echo '<option value="' . $key . '"' . set_select('state',$key) . '>' . $value . '</option>' . "\n";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="zip">Zip<?php echo required_text('zip'); ?></label>
                    <input type="text" name="zip" id="zip" class="input_text" value="<?php echo set_value('zip'); ?>" />
                </td>
                <td>
                    <label for="region">Region<?php echo required_text('region'); ?></label>
                    <input type="text" name="region" id="region" class="input_text" value="<?php echo set_value('region'); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="phone1">Phone<?php echo required_text('phone1'); ?></label>
                    <input type="text" name="phone1" id="phone1" class="input_text" value="<?php echo set_value('phone1'); ?>" />
                </td>
                <td>
                    <label for="fax">Fax<?php echo required_text('fax'); ?></label>
                    <input type="text" fax="fax" id="fax" class="input_text" value="<?php echo set_value('fax'); ?>" />
                </td>
            </tr>
            <tr valign="top">
                <td width="50%">
                    <label for="website">Website<?php echo required_text('website'); ?></label>
                    <input type="text" name="website" id="website" class="input_text" value="<?php echo set_value('website'); ?>" />
                </td>
                <td>
                    <label for="paid_search_extension">Paid Search Extension<?php echo required_text('paid_search_extension'); ?></label>
                    <input type="text" name="paid_search_extension" id="paid_search_extension" class="input_text" value="<?php echo set_value('paid_search_extension'); ?>" />
                </td>
            </tr>
        </table>

        <label for="microsite_url">Solar Microsite URL<?php echo required_text('microsite_url'); ?></label>
        <input type="text" name="microsite_url" id="microsite_url" class="input_text" value="<?php echo set_value('microsite_url'); ?>" />

        <label for="dealer_hours">Installer Hours<?php echo required_text('dealer_hours'); ?></label>
        <textarea name="dealer_hours" id="dealer_hours" class="textarea_text"><?php echo set_value('dealer_hours'); ?></textarea>

        <label for="logo">Logo</label>
        <input type="file" name="userfile" />
        <br /><br />

        <label for="dealer_homepage_headline">Homepage Headline<?php echo required_text('dealer_homepage_headline'); ?></label>
        <input type="text" name="dealer_homepage_headline" id="dealer_homepage_headline" class="input_text" value="<?php echo set_value('dealer_homepage_headline', $site_default_array[0]->default_headline); ?>" />

        <label for="dealer_homepage_copy">Homepage Copy<?php echo required_text('dealer_homepage_copy'); ?></label>
        <textarea name="dealer_homepage_copy" id="dealer_homepage_copy" class="textarea_text"><?php echo set_value('dealer_homepage_copy', $site_default_array[0]->default_homepage_copy); ?></textarea>

        <label for="credentials">Installer Credentials<?php echo required_text('credentials'); ?></label>
        <textarea name="credentials" id="credentials" class="textarea_text"><?php echo set_value('credentials'); ?></textarea>

        <label for="about_dealer_headline">About Installer Headline<?php echo required_text('about_dealer_headline'); ?></label>
        <input type="text" name="about_dealer_headline" id="about_dealer_headline" class="input_text" value="<?php echo set_value('about_dealer_headline'); ?>" />

        <label for="about_dealer_text">About Installer Copy<?php echo required_text('about_dealer_text'); ?></label>
        <textarea name="about_dealer_text" id="about_dealer_text" class="textarea_text"><?php echo set_value('about_dealer_text'); ?></textarea>

        <label for="sells_vms">Sells VMS?<?php echo required_text('sells_vms'); ?></label>
        <select name="sells_vms" id="sells_vms_dropdown" class="input_dropdown">
            <option value="no" <?php echo set_select('sells_vms', 'no'); ?>>No</option>
            <option value="yes" <?php echo set_select('sells_vms', 'yes'); ?>>Yes</option>
        </select>

        
        <div class="action_form_submit_cancel clearfix">
            <input type="submit" name="action" id="add_installer" rel="add_installer" value="Add Installer" class="submit" /><a href="/admin/installers" class="cancel_button">Cancel</a>
        </div>

	</div>
</div>
</form>
