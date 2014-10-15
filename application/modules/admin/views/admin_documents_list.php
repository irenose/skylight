<h1 class="clearfix">
	<div class="header_label">Documents</div>
    <div class="header_actions"><a href="/admin/documents/add" class="header_action">Add Documents</a></div>
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
			if(isset($document_list_array) && count($document_list_array) > 0) {
				echo '<table cellpadding="0" cellspacing="0" class="list_table">' . "\n";
        		echo '<tr>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Type</span></td>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Document Name</span></td>' . "\n";
                echo '<td class="table_header" width="30%"><span class="table_header_text">Filename</span></td>' . "\n";
                echo '<td class="table_header" width="30%"><span class="table_header_text">Actions</span></td>' . "\n";
            	echo '</tr>';
				$bg_color = 'gray';
				foreach($document_list_array as $document) {
					$bg_color = $bg_color == 'white' ? 'gray' : 'white';
					switch($document->extension) {
						case 'xls':
							$icon = 'excel';
							break;
						case 'doc':
							$icon = 'msword';
							break;
						case 'docx':
							$icon = 'msword';
							break;
						case 'pdf':
							$icon = 'pdf';
							break;
						default:
							$icon = 'msword';
							break;
					}
					echo '<tr class="' . $bg_color . '">' . "\n";
					echo '<td class="td_border" ><img src="/_assets/images/admin/default/icons/icon_' . $icon . '_' . $bg_color . '.gif" border="0" /></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/documents/update/' . $document->document_id . '" class="image_name">' . $document->document_name . '</a></td>' . "\n";
					echo '<td class="td_border"><span class="upload_image_filename">' . $document->document_file . '.' . $document->extension . '</span></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/documents/update/' . $document->document_id . '" class="blue_button list_action">Update Document</a><a href="/admin/documents/delete/' . $document->document_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
					echo '</tr>' . "\n";
				}
				echo '</table>' . "\n";
				
			} else {
				echo '<p>You do not have any documents. <a href="/admin/documents/add">Upload some now.</a></p>';
			}
		?>
        <div id="pagination">
            <div class="page_links">
            	<?php echo $page_links; ?>
            </div>
        </div>
    </div>

</div>

