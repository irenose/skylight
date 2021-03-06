<h1><?php echo $this->config->item('admin_client_name'); ?> Administration</h1>
<p>
	Welcome to the <?php echo $this->config->item('admin_client_name'); ?> administration dashboard. Below, you will find a list of your current dealer microsites. You can click on the links below to jump to make changes to a particular dealer site, or you can use the links on the left to make changes to the microsite options.
</p>
<div class="form_spacer"></div>
<?php
	if( isset($dealer_list_array) && count($dealer_list_array) > 0) {
		$count = 0;
		foreach($dealer_list_array as $dealer) {
			$count++;
			if($dealer->dealer_status != 'delete') {
				if($dealer->site_status == 'active') {
					$status = '<span class="active" style="font-weight:bold;">Active</span>';
				} else {
					$status = '<span class="inactive">Inactive</span>';
				}
				
				
				echo '<div class="dealer_link" style="float:left;width:33%;font-family:arial;font-size:12px;"><b><a href="/installer-admin/home/' . $dealer->dealer_id . '">' . $dealer->name  . '</a></b><br /><i>' . $dealer->city . ', ' . $dealer->state . '</i><br />Site Status: ' . $status . '</div>';
			}
			if($count == 3) {
				echo '<div class="clearfix" style="height:75px;"> </div>';
				$count = 0;
			}
		}
	}
?>

