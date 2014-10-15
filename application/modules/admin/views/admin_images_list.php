<h1 class="clearfix">
	<div class="header_label">Images</div>
    <div class="header_actions"><a href="/admin/images/add" class="header_action">Add Images</a></div>
</h1>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		
		echo $this->session->flashdata('status_message');
	?>
</div>
<div id="uploads_list_container">

	<div class="uploads_list_full">
        
        <?php
			if(isset($image_list_array) && count($image_list_array) > 0) {
				echo '<table cellpadding="0" cellspacing="0" class="list_table">' . "\n";
        		echo '<tr>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Image</span></td>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Image Name</span></td>' . "\n";
                echo '<td class="table_header" width="30%"><span class="table_header_text">Filename</span></td>' . "\n";
                echo '<td class="table_header" width="30%"><span class="table_header_text">Actions</span></td>' . "\n";
            	echo '</tr>';
				$bg_color = 'gray';
				foreach($image_list_array as $image) {
					$bg_color = $bg_color == 'white' ? 'gray' : 'white';
					echo '<tr class="' . $bg_color . '">' . "\n";
					echo '<td class="td_border" ><div class="upload_image_thumb_container"><a href="/content_images/' . $image->image_file . '.' . $image->extension . '" class="lightbox" title="' . $image->image_name . '"><img src="/content_images/thumbs/' . $image->image_file . '_th.' . $image->extension . '" border="0" /><div class="image_zoom"></div></a></div></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/images/update/' . $image->image_id . '" class="image_name">' . $image->image_name . '</a></td>' . "\n";
					echo '<td class="td_border"><span class="upload_image_filename">' . $image->image_file . '.' . $image->extension . '</span></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/images/update/' . $image->image_id . '" class="blue_button list_action">Update Image</a><a href="/admin/images/delete/' . $image->image_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
					echo '</tr>' . "\n";
				}
				echo '</table>' . "\n";
				
			} else {
				echo '<p>You do not have any images. <a href="/admin/images/add">Upload some now.</a></p>';
			}
		?>

        <div id="pagination">
            <div class="page_links">
            	<?php echo $page_links; ?>
            </div>
        </div>
    </div>
</div>

