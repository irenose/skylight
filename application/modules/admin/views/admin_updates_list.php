<h1 class="clearfix">
	<div class="header_label">Updates</div>
    <div class="header_actions"><a href="/admin/updates/add" class="header_action">Add Update</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<?php
	if(isset($update_array) && count($update_array) > 0) {
?>
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="10%" class="table_header"><span class="table_header_text">Date</span></td>
        <td width="35%" class="table_header"><span class="table_header_text">Update</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
	<?php
		$bg_color = 'gray';
		foreach($update_array as $update) {
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			$span_class = '';
			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td width="25%" class="td_border"><span' . $span_class . '>' .  format_date($update->modification_date, 'DisplayNoTime') . '</span></td>' . "\n";
			echo '<td width="25%" class="td_border"><span' . $span_class . '>' .  word_limiter($update->update_text, 30) . '</span></td>' . "\n";
			echo '<td class="td_border"><a href="/admin/updates/delete/' . $update->update_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";		
		
		}

	?>
</table>
<?php
	} else {
		echo '<p>There are no updates. <a href="/admin/updates/add">Add one now.</a></p>';
	}
?>
