<h1 class="clearfix">
	<div class="header_label">Installers</div>
    <div class="header_actions"><a href="/admin/installers/add" class="header_action">Add Installer</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<?php
	if(isset($dealer_listing_array) && count($dealer_listing_array) > 0) {
?>
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="25%" class="table_header"><span class="table_header_text">Name</span></td>
        <td width="10%" class="table_header"><span class="table_header_text">URL</span></td>
        <td width="10%" class="table_header"><span class="table_header_text">Site Status</span></td>
        <td width="10%" class="table_header"><span class="table_header_text">Installer Status</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
	<?php
		$bg_color = 'gray';
		foreach($dealer_listing_array as $dealer) {
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			$span_class = $dealer->dealer_status == 'active' ? 'active' : 'inactive';
			$site_class = $dealer->site_status == 'active' ? 'active' : 'inactive';

			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td width="25%" class="td_border"><span' . $span_class . '>' .  $dealer->name . '</span></td>' . "\n";
			echo '<td width="10%" class="td_border"><span' . $span_class . '>' .  $dealer->dealer_url . '</span></td>' . "\n";
			echo '<td width="10%" class="td_border"><span class="' . $site_class . '">' .  ucfirst($dealer->site_status) . '</span></td>' . "\n";
			echo '<td width="10%" class="td_border"><span class="' . $span_class . '">' .  ucfirst($dealer->dealer_status) . '</span></td>' . "\n";
			echo '<td class="td_border"><a href="/admin/installers/update/' . $dealer->dealer_id . '" class="blue_button list_action">Update</a><a href="/admin/installers/delete/' . $dealer->dealer_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";		
		
		}

	?>
</table>
<?php
	} else {
		echo '<p>There are no installers. <a href="/admin/installers/add">Add one now.</a></p>';
	}
?>
