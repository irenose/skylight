<?php
	$inactive_selected = FALSE;
	$active_selected = FALSE;
	$delete_selected = FALSE;
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
	
	$random = rand(100,999);
?>
<h1 class="clearfix">
    <div class="header_label">Update Account Information</div>
</h1>
<p>This form allows you to enter information about your business, including your business' name, phone number, street address, website, company logo and credentials (professional organization memberships). Don't forget to click the "update profile" button at the bottom of this page to save your changes.</p>
    
<p><b>NOTE:</b> <i>The ability to update your phone number has been disabled. Please alert VELUX if you need to change your phone number for any reason.</i></p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		if(isset($error)) {
			echo $error;
		}
		echo $this->session->flashdata('status_message');
	?>
</div>

<?php echo form_open_multipart('installer-admin/account/update/' . $_SESSION['dealer_id']); ?>
	<input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />
    <input type="hidden" name="phone1" value="<?php echo $dealer_array[0]->phone1; ?>" />
    <?php
		if(trim($dealer_array[0]->dealer_logo) != '') {
			echo '<input type="hidden" name="current_filename_base" value="' . $dealer_array[0]->dealer_logo . '" />';
			echo '<input type="hidden" name="current_filename" value="' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '" />';
		}
	?>

    <div id="action_form_wrapper">
        <div class="action_form">

        	<label for="name">Dealer Name<?php echo required_text('name'); ?></label>
            <input type="text" name="name" class="input_text" value="<?php echo set_value('name', $dealer_array[0]->name); ?>" />
            
            <label for="name">Account E-mail Address<?php echo required_text('email'); ?></label>
            <input type="text" class="input_text" name="email" value="<?php echo set_value('email', $dealer_array[0]->email); ?>" /><br />
            
            <div class="form_spacer"></div>

            <h2>Contact Information</h2>
            
            <table cellpadding="0" cellspacing="0" border="0" width="98%">
            	<tr valign="top">
                	<td width="48%">
            
                        <label for="name">Contact First Name<?php echo required_text('contact_first_name'); ?></label>
                        <input type="text" class="input_text" name="contact_first_name" value="<?php echo set_value('contact_first_name', $dealer_array[0]->contact_first_name); ?>" />
                    </td>
                    <td>  	
                        <label for="name">Contact Last Name<?php echo required_text('contact_last_name'); ?></label>
                        <input type="text" class="input_text" name="contact_last_name" value="<?php echo set_value('contact_last_name', $dealer_array[0]->contact_last_name); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                	<td width="48%">
                        <label for="name">Address<?php echo required_text('address'); ?></label>
                        <input type="text" class="input_text" name="address" value="<?php echo set_value('address', $dealer_array[0]->address); ?>" />
                    </td>
                    <td>
                    	<label for="name">Address 2<?php echo required_text('address2'); ?></label>
            			<input type="text" class="input_text" name="address2" value="<?php echo set_value('address2', $dealer_array[0]->address2); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                	<td width="48%">
            			<label for="name">City<?php echo required_text('city'); ?></label>
            			<input type="text" class="input_text" name="city" value="<?php echo set_value('city', $dealer_array[0]->city); ?>" />
                    </td>
                    <td>
                        <label for="state">State<?php echo required_text('state'); ?></label>
                        <select name="state" class="input_dropdown">
                            <option value="">Please choose</option>
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
                	<td width="48%">
                        <label for="name">ZIP<?php echo required_text('zip'); ?></label>
                        <input type="text" class="input_text" name="zip" value="<?php echo set_value('zip', $dealer_array[0]->zip); ?>" />
                    </td>
                    <td>
                    	<label for="name">Region<?php echo required_text('region'); ?></label>
                        <input type="text" class="input_text" name="region" value="<?php echo set_value('region', $dealer_array[0]->region); ?>" />
            		</td>
                </tr>
                <tr valign="top">
                	<td>
                        <label for="name">Phone</label><br />
                        <?php
        					/*
        					<input type="text" class="input_text" name="phone1" value="<?php echo set_value('phone1', $dealer_array[0]->phone1); ?>" disabled /><br />
        					<div class="error_message"><?php echo error_message('phone1'); ?> </div><br /><br />
        					*/
        					echo '<p><b>' . $dealer_array[0]->phone1 . '</b></p>';
        				?>
                        
                    </td>
                    <td>
                        <label for="name">Fax<?php echo required_text('fax'); ?></label>
                        <input type="text" class="input_text" name="fax" value="<?php echo set_value('fax', $dealer_array[0]->fax); ?>" />
                    </td>
                </tr>
                
                <tr valign="top">
                	<td>
                        <label for="name">Website URL<?php echo required_text('website'); ?></label>
                        <input type="text" class="input_text" name="website" value="<?php echo set_value('website', $dealer_array[0]->website); ?>" /><br />
                    </td>
                    <td>
                    	<label for="microsite_url">Solar Microsite URL<?php echo required_text('microsite_url'); ?></label>
                        <input type="text" class="input_text" name="microsite_url" value="<?php echo set_value('microsite_url', $dealer_array[0]->microsite_url); ?>" /><br />
            		</td>
                </tr>
            </table>
            
            <label for="dealer_hours">Dealer Hours<?php echo required_text('dealer_hours'); ?></label>
            <textarea name="dealer_hours" class="textarea_text"><?php echo set_value('dealer_hours', $dealer_array[0]->dealer_hours); ?></textarea>
            
            <div class="form_spacer"> </div>

            <div class="padded_block padded_block_gray">

                <h2>Company Logo</h2>
                <p class="instruction">Logos should be one of the following formats: .jpg, .png or .gif. If your logo exceeds 115px in height, it will be resized automatically. <b>Images for upload must be less than 1.5MB in file size</b>.</p>
                
                <label for="logo">Logo</label>
                <input type="file" name="userfile" />
                <?php
            		if(trim($dealer_array[0]->dealer_logo) != '') {
            			echo '&nbsp;&nbsp;Current Logo: <a href="' . $this->config->item('dealer_assets_dir') . 'dealer-logos/' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '?rand=' . $random . '" target="_blank">' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '</a>';
            			echo '<br><br><a href="/installer-admin/account/delete-logo/' . $dealer_array[0]->dealer_id . '" style="margin-top:10px;" class="delete_confirm delete_link">Delete Logo</a>';
            		}
            	?>
                <br /><br />
            </div>
            
            <div class="form_spacer"> </div>

            <h2>Contact Request</h2>
            <p class="instruction">Customer information requests from the "contact us" form on the homepage and the "contact us" page will e-mailed to you. Enter the e-mail addresses of employees who should receive these e-mails.</p>
            
            <p class="instruction" style="margin-top:15px;"><b>NOTE:</b> <i>If "Primary Contact Form Recipient" is left blank, e-mails will be sent to the main e-mail address associated with your account</i></p>
            
            <label for="primary_email">Primary Contact Form Recipient<?php echo required_text('primary_email'); ?></label>
            <input type="text" class="input_text" name="primary_email" value="<?php echo set_value('primary_email', $dealer_array[0]->primary_email); ?>" />
            
            <label for="cc_email">Contact form CC: Recipients (separate with commas)<?php echo required_text('cc_email'); ?></label>
            <textarea name="cc_email" class="textarea_text"><?php echo set_value('cc_email', $dealer_array[0]->cc_email); ?></textarea>
            
            <div class="form_spacer"> </div>

            <h2>Credentials/Affiliations</h2>
            <label for="name">Dealer Credentials<?php echo required_text('credentials'); ?></label>
            <textarea name="credentials" class="textarea_text"><?php echo set_value('credentials', $dealer_array[0]->credentials); ?></textarea>

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_account" rel="update_account" value="Update Account" class="submit" /><a href="/installer-admin/account" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>