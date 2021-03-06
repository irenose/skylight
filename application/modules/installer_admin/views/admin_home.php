<h1><?php echo $dealer_info_array[0]->name; ?> Microsite Administration</h1>
<p>
	Welcome to your administrator dashboard, the starting point for customizing your VELUX 5-Star Skylight Specialist microsite. Please navigate through the sections to the left to customize features on your site.
</p>
<div class="form_spacer"></div>
<div class="padded_block padded_block_gray">
	<div style="width:48%; margin-right:2%; float:left;">
		<h2 style="margin-top:0;">Site Status</h2>
		<?php
			echo '<p>Your current site status is: <span class="' . strtolower($dealer_info_array[0]->site_status) . '">' . ucfirst($dealer_info_array[0]->site_status) . '</span></p>';
			if($dealer_info_array[0]->site_status == 'active') {
				echo '<a href="/installer-admin/status/deactivate" class="header_action site_status">De-Activate Site</a>';
			} else {
				echo '<a href="/installer-admin/status/activate" class="header_action site_status">Activate Site</a>';
			}
		?>
	</div>
	<div style="width:48%; float:left;">
		<h2 style="margin-top:0;">Promotion Status</h2>
		<?php
			echo '<p>Your current promotion status is: <span class="' . strtolower($dealer_info_array[0]->promotion_status) . '">' . ucfirst($dealer_info_array[0]->promotion_status) . '</span></p>';
			echo '<a href="/installer-admin/promotion" class="header_action site_status">Update Promotion</a>';
		?>
	</div>
	<div class="clearfix"></div>
</div>
<?php
	if( isset($site_updates_array) && count($site_updates_array) > 0) {
		$current_date = format_date($site_updates_array[0]->insert_date, 'DisplayNoTime');
		$count = 0;
		echo '<h2>Recent Updates</h2>';
		echo '<div class="update"><div class="update_date">' . $current_date . '</div>';
		foreach($site_updates_array as $update) {
			$count++;
			if($current_date != format_date($update->insert_date, 'DisplayNoTime')) {
				echo '</div><div class="update"><div class="update_date">' . format_date($update->insert_date, 'DisplayNoTime') . '</div>';
				$current_date = format_date($update->insert_date, 'DisplayNoTime');
				$count = 1;
			} else {
				if($count > 1) {
					//To separate notes from the same day that were inserted separately
					echo '<br />';
				}
			}
			echo nl2br($update->update_text);
		}
		echo '</div>';
	}
?>

