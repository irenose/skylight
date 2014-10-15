<h1>Uploads</h1>
<div id="uploads_list_container">

	<div class="uploads_list_sm clearfix">
    	<h2>Images<a href="/admin/uploads/images/add" class="header_action">Add New Images</a></h2>
        
        <?php
			if(isset($image_list_array) && count($image_list_array) > 0) {
				echo '<table cellpadding="0" cellspacing="0" class="list_table">' . "\n";
        		echo '<tr>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Image</span></td>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">Image Name (filename)</span></td>' . "\n";
                echo '<td class="table_header" width="50%"><span class="table_header_text">Actions</span></td>' . "\n";
            	echo '</tr>';
				$bg_color = 'gray';
				$random = rand(100,999); //random number to avoid image caching if overwrite
				foreach($image_list_array as $image) {
					$bg_color = $bg_color == 'white' ? 'gray' : 'white';
					echo '<tr class="' . $bg_color . '">' . "\n";
					echo '<td class="td_border" ><div class="upload_image_thumb_container"><a href="/content_images/' . $image->image_file . '.' . $image->extension . '" class="lightbox" title="' . $image->image_name . '"><img src="/content_images/thumbs/' . $image->image_file . '_th.' . $image->extension . '?rand=' . $random . '" border="0" /><div class="image_zoom"></div></a></div></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/uploads/images/update/' . $image->image_id . '" class="image_name">' . $image->image_name . '</a><br /><span class="upload_image_filename">' . $image->image_file . '.' . $image->extension . '</span></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/uploads/images/update/' . $image->image_id . '" class="list_action">Update</a><a href="/admin/uploads/images/delete/' . $image->image_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
					echo '</tr>' . "\n";
				}
				echo '</table>' . "\n";
				
				
				echo '<div class="page_links view_all">' . "\n";
        		echo '<a href="/admin/uploads/images">View All Images &gt;</a>' . "\n";
        		echo '</div>' . "\n";
				
			} else {
				echo '<p>There are no images. <a href="/admin/uploads/images/add">Add one now.</a></p>';
				
			}
		?>
    </div>
    
    <div class="uploads_list_sm right clearfix">
    	<h2>Documents<a href="/admin/uploads/documents/add" class="header_action">Add New Documents</a></h2>
        
        <?php
			if(isset($document_list_array) && count($document_list_array) > 0) {
				echo '<table cellpadding="0" cellspacing="0" class="list_table">' . "\n";
        		echo '<tr>' . "\n";
                echo '<td class="table_header"><span class="table_header_text">File Name</span></td>' . "\n";
                echo '<td class="table_header" width="50%"><span class="table_header_text">Actions</span></td>' . "\n";
            	echo '</tr>';
				$bg_color = 'gray';
				foreach($document_list_array as $document) {
					$bg_color = $bg_color == 'white' ? 'gray' : 'white';
					switch($document->extension) {
						case 'xls':
							$icon = 'excel';
							break;
						case 'xlsx':
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
					echo '<td class="td_border_image" style="background-image:url(/_assets/images/admin/default/icons/icon_' . $icon . '_' . $bg_color . '.gif);"><a href="/content_documents/' . $document->document_file . '.' . $document->extension . '" class="image_name">' . $document->document_name . '</a><br /><span class="upload_image_filename">(' . $document->document_file . '.' . $document->extension . ')</span></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/uploads/documents/update/' . $document->document_id . '" class="blue_button list_action">Update</a><a href="/admin/uploads/documents/delete/' . $document->document_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
					echo '</tr>' . "\n";
				}
				echo '</table>' . "\n";
				
				
				echo '<div class="page_links view_all">' . "\n";
        		echo '<a href="/admin/uploads/documents">View All Documents &gt;</a>' . "\n";
        		echo '</div>' . "\n";
				
			} else {
				echo '<p>There are no documents. <a href="/admin/uploads/documents/add">Add one now.</a></p>';
				
			}
		?>
        
        
        
        
        
        <!--<table cellpadding="0" cellspacing="0" class="upload_list_table">
        	<tr>
                <td class="table_header" width="220"><span class="table_header_text">FILE NAME (file name)</span></td>
                <td class="table_header"><span class="table_header_text">ACTIONS</span></td>
            </tr>
            <tr>
                <td class="td_border_image" style="background-image:url(/_assets/images/admin/default/icons/icon_msword_white.gif);"><a href="" class="image_name">2010 Annual Report</a><br /><span class="upload_image_filename">(filename.doc)</span></td>
                <td class="td_border"><a href="/admin/uploads/documents/update"><img src="/_assets/images/admin/default/buttons/update_document_btn.gif" border="0" alt="Update Document" class="action_buttons" /></a><a href=""><img src="/_assets/images/admin/default/buttons/delete_btn.gif" border="0" alt="Delete" /></a></td>
            </tr>
            <tr class="gray">
                <td class="td_border_image" style="background-image:url(/_assets/images/admin/default/icons/icon_msword_gray.gif);"><a href="" class="image_name">2009 Annual Report</a><br /><span class="upload_image_filename">(filename.doc)</span></td>
                <td class="td_border"><a href="/admin/uploads/documents/update"><img src="/_assets/images/admin/default/buttons/update_document_btn.gif" border="0" alt="Update Document" class="action_buttons" /></a><a href=""><img src="/_assets/images/admin/default/buttons/delete_btn.gif" border="0" alt="Delete" /></a></td>
            </tr>
        </table>
        <div class="view_all">
        	<a href="/admin/uploads/documents">View All Documents &gt;</a>
        </div>-->
    </div>

<div class="clear"> </div>
</div>

