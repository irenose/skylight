<h1 class="clearfix">
	<div class="header_label">Users</div>
    <div class="header_actions"><a href="/admin/users/add" class="header_action">Add User</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<?php
	if(isset($user_listing_array) && count($user_listing_array) > 0) {
?>
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="25%" class="table_header"><span class="table_header_text">User</span></td>
        <td width="25%" class="table_header"><span class="table_header_text">E-mail Address</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
	<?php
		$bg_color = 'gray';
		foreach($user_listing_array as $user) {
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			
			if($user->user_status == 'inactive') {
				$span_class = ' class="inactive"';
			} else {
				$span_class = '';
			}
			
			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td width="25%" class="td_border"><span' . $span_class . '>' .  $user->first_name . ' ' . $user->last_name . '</span></td>' . "\n";
			echo '<td width="25%" class="td_border"><span' . $span_class . '>' .  $user->username . '</span></td>' . "\n";
			echo '<td class="td_border"><a href="/admin/users/update/' . $user->user_id . '" class="blue_button list_action">Update User</a><a href="/admin/users/reset-password/' . $user->user_id . '" class="reset_password list_action">Reset Password</a><a href="/admin/users/delete/' . $user->user_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";		
		
		}

	?>

</table>
<?php
	} else {
		echo '<p>There are no users. <a href="/admin/users/add">Add one now.</a></p>';
	}
?>
