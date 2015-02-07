<h1><?php echo $this->config->item('admin_client_name'); ?> Administration</h1>
<p>Please choose which site you are trying to access from the list below.</p>
<p>
<?php
	foreach($active_sites_array as $key => $site) {
		echo '<a href="/installer-admin/home/' . $site['dealer_id'] . '/user">' . $site['name'] . '</a> - ' . $site['city'] . '<br />';
	}
?>
</p>

