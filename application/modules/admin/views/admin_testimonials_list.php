<h1 class="clearfix">
	<div class="header_label">Testimonials</div>
    <div class="header_actions"><a href="/admin/testimonials/add" class="header_action">Add Testimonial</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>

<?php
	if(isset($testimonials_array) && count($testimonials_array) > 0) {
		
		echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">' . "\n";
		echo '<tr>' . "\n";
		echo '<td width="40%" class="table_header"><span class="table_header_text">Testimonial</span></td>' . "\n";
		echo '<td width="10%" class="table_header"><span class="table_header_text">Status</span></td>' . "\n";
		echo '<td class="table_header"><span class="table_header_text">Actions</span></td>' . "\n";
		echo '</tr>' . "\n";
		
		$bg_color = 'gray';
		foreach($testimonials_array as $testimonial) {
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			$class = $testimonial->testimonial_status == 'active' ? 'active' : 'inactive';
				
			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td width="40%" class="td_border"><span>' . word_limiter($testimonial->testimonial_copy,15) . '</span></td>' . "\n";
			echo '<td width="10%" class="td_border"><span class="' . $class . '">' . ucfirst($testimonial->testimonial_status) . '</span></td>' . "\n";
			echo '<td class="td_border"><a href="/admin/testimonials/update/' . $testimonial->testimonial_id . '" class="blue_button list_action">Update</a><a href="/admin/testimonials/delete/' . $testimonial->testimonial_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";

		}
		echo '</table>';
		
	} else {
		echo '<p>There are no testimonials</p>' . "\n";
	}
?>
