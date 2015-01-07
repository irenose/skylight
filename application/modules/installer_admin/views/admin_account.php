<h1 class="clearfix">
	<div class="header_label">Account Information</div>
    <div class="header_actions">
    	<a href="/installer-admin/account/update" class="header_action">Update Account</a>
    	<a href="/installer-admin/account/homepage" class="header_action">Update Homepage</a>
    	<a href="/installer-admin/account/about" class="header_action">Update About</a>
    	<a href="/installer-admin/account/promotion" class="header_action">Update Promotion</a>
    </div>
</h1>
<p>Click the blue update buttons to update account information, as well as information for your homepage and about us page.</p>
<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<div class="padded_block padded_block_gray">

<?php
	echo '<div class="current_logo">' . "\n";
		echo '<b>Logo</b><br />' . "\n";
		if(trim($dealer_array[0]->dealer_logo) != '') {
			echo '<img src="' . $this->config->item('dealer_assets_dir') . 'dealer-logos/' . $dealer_array[0]->dealer_logo . '.' . $dealer_array[0]->extension . '" border="0"><br /><br />';
		} else {
			echo '<i>No Logo Selected</i><br /><br />';	
		}
	echo '</div>';

	echo '<h2>Site Information</h2>';

	echo '<p><b>Dealer Name</b><br />' . "\n";
	echo $dealer_array[0]->name . '<br /><br />' . "\n";
    
    echo '<b>Account E-mail Address</b><br />' . "\n";
	echo $dealer_array[0]->email . '<br /><br />' . "\n";
    
    echo '<b>Site URL</b><br />' . "\n";
    echo base_url() . $dealer_array[0]->dealer_url . '<br /><br /></p>' . "\n";
?>
</div>
<div class="padded_block">
<?php
	
    echo '<h2>Contact Information</h2>' . "\n";
    
    echo '<p><b>Contact Name</b><br />' . "\n";
    echo $dealer_array[0]->contact_first_name . ' ' . $dealer_array[0]->contact_last_name . '<br /><br />' . "\n";
    
    echo '<b>Address</b><br />' . "\n";
    echo $dealer_array[0]->address;
	if(trim($dealer_array[0]->address2) != '') {
		echo trim($dealer_array[0]->address2);
	}
	echo '<br />';
	echo $dealer_array[0]->city . ', ' . $dealer_array[0]->state . ' ' . $dealer_array[0]->zip . '<br /><br />';
	
	echo '<b>Region:</b><br >' . "\n";
	if(trim($dealer_array[0]->region) == '') {
		$region = $dealer_array[0]->city;
	} else {
		$region = $dealer_array[0]->region;
	}
	echo $region . '<br /><br />';
	
	echo '<b>Phone:</b><br >' . "\n";
	echo $dealer_array[0]->phone1 . '<br /><br />';
	
	echo '<b>Fax:</b><br >' . "\n";
	echo $dealer_array[0]->fax . '<br /><br />';
	
	echo '<b>Website URL:</b><br >' . "\n";
	echo $dealer_array[0]->website . '<br /><br />';
	
	echo '<b>Hours:</b><br >' . "\n";
	echo $dealer_array[0]->dealer_hours . '<br /><br />';
	
	
	echo '<b>Dealer Credentials</b><br />' . "\n";
	echo nl2br($dealer_array[0]->credentials) . '<br /><br />' . "\n";
	
	echo '<div class="content_divider"> </div>' . "\n";
	echo '<h3>Contact Requests</h3>';
	
	echo '<b>Primary Recipient:</b><br >' . "\n";
	if($dealer_array[0]->primary_email == '') {
		echo $dealer_array[0]->email . ' <i>(This is your default account e-mail address)</i> <br /><br />';
	} else {
		echo $dealer_array[0]->primary_email . '<br /><br />';
	}
	
	echo '<b>Contact Form CC: Recipient(s):</b><br >' . "\n";
	if(trim($dealer_array[0]->cc_email == '')) {
		echo 'None';
	} else {
		echo nl2br($dealer_array[0]->cc_email) . '<br /><br />' . "\n";
	}
	echo '</p>';
	
?>
</div>

