<h1 class="clearfix">
	<div class="header_label">Literature</div>
    <div class="header_actions"><a href="/admin/literature/add" class="header_action">Add Literature</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<?php
	if(isset($literature_array) && count($literature_array) > 0) {
		$bg_color = 'gray';
		
		echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">' . "\n";
    	echo '<tr>' . "\n";
        echo '<td width="40%" class="table_header"><span class="table_header_text">Brochure</span></td>' . "\n";
        echo '<td width="10%" class="table_header"><span class="table_header_text">Status</span></td>' . "\n";
        echo '<td class="table_header"><span class="table_header_text">Actions</span></td>' . "\n";
    	echo '</tr>' . "\n";
		
		foreach($literature_array as $brochure) {
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			$class = $brochure->literature_status == 'active' ? 'active' : 'inactive';
			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td width="40%" class="td_border"><span>' . $brochure->name . '</span></td>' . "\n";
			echo '<td width="10%" class="td_border"><span class="' . $class . '">' . ucfirst($brochure->literature_status) . '</span></td>' . "\n";
			echo '<td class="td_border"><a href="/admin/literature/update/' . $brochure->literature_id . '" class="blue_button list_action">Update</a><a href="/admin/literature/delete/' . $brochure->literature_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";
			
		}
		echo '</table>' . "\n";
		
	} else {
		echo '<p>There are no brochures</p>' . "\n";
	}
?>
