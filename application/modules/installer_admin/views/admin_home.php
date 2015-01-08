<h1><?php echo $this->config->item('admin_client_name'); ?> Administration</h1>
<p>
	Welcome to the <?php echo $this->config->item('admin_client_name'); ?> administration dashboard. Below, you will find a list of your current dealer microsites. You can click on the links below to jump to make changes to a particular dealer site, or you can use the links on the left to make changes to the microsite options.
</p>
<div class="form_spacer"></div>
<?php
	if( isset($site_updates_array) && count($site_updates_array) > 0) {
		$current_date = format_date($site_updates_array[0]->insert_date, 'DisplayNoTime');
		$count = 0;
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

