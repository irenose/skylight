<h1 class="clearfix">
	<div class="header_label">Pages</div>
    <div class="header_actions"><a href="/admin/pages/add" class="header_action">Add Page</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>	
		
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
	<tr>
        <td width="40%" class="table_header"><span class="table_header_text">Page</span></td>
        <td width="10%" class="table_header"><span class="table_header_text">Status</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
<?php
	$total_primary_count = count($primary_nav_array);
	$counter = 0;
	foreach($primary_nav_array as $primary_nav) {
		$counter++;
		if($primary_nav->page_status == 'active') {
			$link_class = 'active_page_link';
			$span_class = 'active';
			$span_label = 'Active';
		} else {
			$link_class = 'inactive_page_link';
			$span_class = 'inactive';
			$span_label = 'Inactive';
		}
		
		$page_title = $primary_nav->page_title;
		$update_link = 'update';
		
		if($primary_nav->page_content != '') {
			
			if($primary_nav->page_status == 'active') {
				$published_button = '<a href="/admin/pages/update/' . $primary_nav->page_id . '" class="list_action">Update Published</a>';
			} else {
				$published_button = '<a href="/admin/pages/update/' . $primary_nav->page_id . '" class="list_action">Update Page</a>';
			}
		} else {
			$published_button = '<img src="/_assets/images/admin/default/spacer.gif" border="0" width="91" height="1" class="action_buttons" />';
		}
		
		if($primary_nav->page_draft_content != '') {
			if($primary_nav->publish_status == 'yes') {
				$draft_button = '<a href="/admin/pages/update-draft/' . $primary_nav->page_id . '" class="draft_button list_action">update Draft</a>';
			} else {
				$draft_button = '<a href="/admin/pages/update-initial/' . $primary_nav->page_id . '" class="draft_button list_action">update Draft</a>';	
			}
			
		} else {
			$draft_button = '<a href="/admin/pages/add-draft/' . $primary_nav->page_id . '" class="list_action">New Draft</a>';
		}

		echo '<tr class="gray">' . "\n";
		echo '<td class="section"><a href="/admin/pages/' . $update_link . '/' . $primary_nav->page_id . '" class="' . $link_class . '">' . $page_title . '</a></td>' . "\n";
		echo '<td class="padding_left"><span class="' . $span_class . '">' . $span_label . '</span></td>' . "\n";
		echo '<td class="padding_left">' . $published_button . $draft_button . '<a href="/admin/pages/delete/' . $primary_nav->page_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
		echo '</tr>' . "\n";
		
		//Check for subpages
		$secondary_nav_array = $this->admin_model->get_secondary_nav_array($primary_nav->page_id, $page_status);
		$bg_color = 'gray';
		if(count($secondary_nav_array) > 0) {
			foreach($secondary_nav_array as $secondary_nav) {
				$bg_color = $bg_color == 'white' ? 'gray' : 'white';
				if($secondary_nav->page_status == 'active') {
					$link_class = 'active_page_link';
					$span_class = 'active';
					$span_label = 'Active';
				} else {
					$link_class = 'inactive_page_link';
					$span_class = 'inactive';
					$span_label = 'Inactive';
				}
				
				//If page has never been published, it doesn't have a page_title, so replace it with draft title. Also change path of update link to "update-initial" if they click on the title of the page.
				if($secondary_nav->publish_status == 'no') {
					$page_title = $secondary_nav->page_draft_title;
					$update_link = 'update-initial';
				} else {
					$page_title = $secondary_nav->page_title;
					$update_link = 'update';
				}
				
				if($secondary_nav->page_content != '') {
					if($secondary_nav->page_status == 'active') {
						$published_button = '<a href="/admin/pages/update/' . $secondary_nav->page_id . '" class="list_action">Update Published</a>';
					} else {
						$published_button = '<a href="/admin/pages/update/' . $secondary_nav->page_id . '" class="list_action">Update Page</a>';
					}
				} else {
					$published_button = '<img src="/_assets/images/admin/default/spacer.gif" border="0" width="91" height="1" class="action_buttons" />';
				}
				
				if($secondary_nav->page_draft_content != '') {
					if($secondary_nav->publish_status == 'yes') {
						$draft_button = '<a href="/admin/pages/update-draft/' . $secondary_nav->page_id . '" class="draft_button list_action">update Draft</a>';
					} else {
						$draft_button = '<a href="/admin/pages/update-initial/' . $secondary_nav->page_id . '" class="draft_button list_action">update Draft</a>';
					}
					
				} else {
					$draft_button = '<a href="/admin/pages/add-draft/' . $secondary_nav->page_id . '" class="draft_button list_action">New Draft</a>';
				}
				echo '<tr class="' . $bg_color . '">' . "\n";
				echo '<td class="page"><div class="subpage_level_one_' . $bg_color . '"><a href="/admin/pages/' . $update_link . '/' . $secondary_nav->page_id . '" class="' . $link_class . '">' . $page_title . '</a></div></td>' . "\n";
				echo '<td class="padding_left"><span class="' . $span_class . '">' . $span_label . '</span></td>' . "\n";
				echo '<td class="padding_left">' . $published_button . $draft_button . '<a href="/admin/pages/delete/' . $secondary_nav->page_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
				echo '</tr>' . "\n";
				
				//Check for sub-subpages
				$third_nav_array = $this->admin_model->get_third_nav_array($secondary_nav->page_id, $page_status);
				if(count($third_nav_array) > 0) {
					foreach($third_nav_array as $third_nav) {
						$bg_color = $bg_color == 'white' ? 'gray' : 'white';
						if($third_nav->page_status == 'active') {
							$link_class = 'active_page_link';
							$span_class = 'active';
							$span_label = 'Active';
						} else {
							$link_class = 'inactive_page_link';
							$span_class = 'inactive';
							$span_label = 'Inactive';
						}
						
						//If page has never been published, it doesn't have a page_title, so replace it with draft title. Also change path of update link to "update-initial" if they click on the title of the page.
						if($third_nav->publish_status == 'no') {
							$page_title = $third_nav->page_draft_title;
							$update_link = 'update-initial';
						} else {
							$page_title = $third_nav->page_title;
							$update_link = 'update';
						}
						
						if($third_nav->page_content != '') {
							if($third_nav->page_status == 'active') {
								$published_button = '<a href="/admin/pages/update/' . $third_nav->page_id . '" class="list_action">Update Published</a>';
							} else {
								$published_button = '<a href="/admin/pages/update/' . $third_nav->page_id . '" class="list_action">Update Page</a>';
							}
						} else {
							$published_button = '<img src="/_assets/images/admin/default/spacer.gif" border="0" width="91" height="1" class="action_buttons" />';
						}
						
						if($third_nav->page_draft_content != '') {
							if($third_nav->publish_status == 'yes') {
								$draft_button = '<a href="/admin/pages/update-draft/' . $third_nav->page_id . '" class="draft_button list_action">update Draft</a>';
							} else {
								$draft_button = '<a href="/admin/pages/update-initial/' . $third_nav->page_id . '" class="draft_button list_action">update Draft</a>';
							}
							
						} else {
							$draft_button = '<a href="/admin/pages/add-draft/' . $third_nav->page_id . '" class="draft_button list_action">New Draft</a>';
						}
						echo '<tr class="' . $bg_color . '">' . "\n";
						echo '<td class="page"><div class="subpage_level_two_' . $bg_color . '"><a href="/admin/pages/' . $update_link . '/' . $third_nav->page_id . '" class="' . $link_class . '">' . $page_title . '</a></div></td>' . "\n";
						echo '<td class="padding_left"><span class="' . $span_class . '">' . $span_label . '</span></td>' . "\n";
						echo '<td class="padding_left">' . $published_button . $draft_button . '<a href="/admin/pages/delete/' . $third_nav->page_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
						echo '</tr>' . "\n";
					}
					//End Sub-Subpage  Loops
				}
			}
		}
		
		if($counter < $total_primary_count) {
			echo '<!-- Spacer -->' . "\n";
			echo '<tr>' . "\n";
			echo '<td class="table_header">&nbsp;</td>' . "\n";
			echo '<td class="padding_left">&nbsp;</td>' . "\n";
			echo '<td class="padding_left">&nbsp;</td>' . "\n";
			echo '</tr>' . "\n";
			echo '<!-- End Spacer -->' . "\n";
		}
	}
	
	
	/******************************* FOOTER PAGES ***************************************************/
	if(count($footer_nav_array) > 0) {
		
		$counter = 0;
		
		echo '<!-- Spacer -->' . "\n";
		echo '<tr>' . "\n";
		echo '<td class="table_header">&nbsp;</td>' . "\n";
		echo '<td class="padding_left">&nbsp;</td>' . "\n";
		echo '<td class="padding_left">&nbsp;</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<!-- End Spacer -->' . "\n";
		
		echo '<tr class="gray">' . "\n";
		echo '<td class="table_header"" colspan="3"><span class="table_header_text">Footer</span></td>' . "\n";
		echo '</tr>' . "\n";
		
		
		$bg_color = 'gray';		
		foreach($footer_nav_array as $footer_nav) {
			$counter++;
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			if($footer_nav->page_status == 'active') {
				$link_class = 'active_page_link';
				$span_class = 'active';
				$span_label = 'Active';
			} else {
				$link_class = 'inactive_page_link';
				$span_class = 'inactive';
				$span_label = 'Inactive';
			}
			
			//If page has never been published, it doesn't have a page_title, so replace it with draft title
			if($footer_nav->publish_status == 'no') {
				$page_title = $footer_nav->page_draft_title;
			} else {
				$page_title = $footer_nav->page_title;
			}
			
			if($footer_nav->page_content != '') {
				
				if($footer_nav->page_status == 'active') {
					$published_button = '<a href="/admin/pages/update/' . $footer_nav->page_id . '" class="list_action">Update Published</a>';
				} else {
					$published_button = '<a href="/admin/pages/update/' . $footer_nav->page_id . '" class="list_action">Update Page</a>';
				}
			} else {
				$published_button = '<img src="/_assets/images/admin/default/spacer.gif" border="0" width="91" height="1" class="action_buttons" />';
			}
			
			if($footer_nav->page_draft_content != '') {
				if($footer_nav->publish_status == 'yes') {
					$draft_button = '<a href="/admin/pages/update-draft/' . $footer_nav->page_id . '" class="draft_button list_action">update Draft</a>';
				} else {
					$draft_button = '<a href="/admin/pages/update-initial/' . $footer_nav->page_id . '" class="draft_button list_action">update Draft</a>';	
				}
				
			} else {
				$draft_button = '<a href="/admin/pages/add-draft/' . $footer_nav->page_id . '" class="draft_button list_action">New Draft</a>';
			}

			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td class="page"><a href="/admin/pages/update/' . $footer_nav->page_id . '" class="' . $link_class . '">' . $page_title . '</a></td>' . "\n";
        	echo '<td class="padding_left"><span class="' . $span_class . '">' . $span_label . '</span></td>' . "\n";
        	echo '<td class="padding_left">' . $published_button . $draft_button . '<a href="/admin/pages/delete/' . $footer_nav->page_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
		
		
		}	
	
	}
	
	
	/******************************* GLOBAL PAGES ***************************************************/
	if(count($global_page_array) > 0) {
		$counter = 0;
		
		echo '<!-- Spacer -->' . "\n";
		echo '<tr>' . "\n";
		echo '<td class="table_header">&nbsp;</td>' . "\n";
		echo '<td class="padding_left">&nbsp;</td>' . "\n";
		echo '<td class="padding_left">&nbsp;</td>' . "\n";
		echo '</tr>' . "\n";
		echo '<!-- End Spacer -->' . "\n";
		
		echo '<tr class="gray">' . "\n";
		echo '<td class="table_header"" colspan="3"><span class="table_header_text">Global Pages</span></td>' . "\n";
		echo '</tr>' . "\n";
		
		
		$bg_color = 'gray';		
		foreach($global_page_array as $global_page) {
			$counter++;
			$bg_color = $bg_color == 'white' ? 'gray' : 'white';
			if($global_page->page_status == 'active') {
				$link_class = 'active_page_link';
				$span_class = 'active';
				$span_label = 'Active';
			} else {
				$link_class = 'inactive_page_link';
				$span_class = 'inactive';
				$span_label = 'Inactive';
			}
			
			//If page has never been published, it doesn't have a page_title, so replace it with draft title
			if($global_page->publish_status == 'no') {
				$page_title = $global_page->page_draft_title;
			} else {
				$page_title = $global_page->page_title;
			}
			
			if($global_page->page_content != '') {
				
				if($global_page->page_status == 'active') {
					$published_button = '<a href="/admin/pages/update/' . $global_page->page_id . '" class="list_action">Update Published</a>';
				} else {
					$published_button = '<a href="/admin/pages/update/' . $global_page->page_id . '" class="list_action">Update Page</a>';
				}
			} else {
				$published_button = '<img src="/_assets/images/admin/default/spacer.gif" border="0" width="91" height="1" class="action_buttons" />';
			}
			
			if($global_page->page_draft_content != '') {
				if($global_page->publish_status == 'yes') {
					$draft_button = '<a href="/admin/pages/update-draft/' . $global_page->page_id . '" class="draft_button list_action">update Draft</a>';
				} else {
					$draft_button = '<a href="/admin/pages/update-initial/' . $global_page->page_id . '" class="draft_button list_action">update Draft</a>';	
				}
				
			} else {
				$draft_button = '<a href="/admin/pages/add-draft/' . $global_page->page_id . '" class="draft_button list_action">New Draft</a>';
			}

			echo '<tr class="' . $bg_color . '">' . "\n";
			echo '<td class="page"><a href="/admin/pages/update/' . $global_page->page_id . '" class="' . $link_class . '">' . $page_title . '</a></td>' . "\n";
        	echo '<td class="padding_left"><span class="' . $span_class . '">' . $span_label . '</span></td>' . "\n";
        	echo '<td class="padding_left">' . $published_button . $draft_button . '<a href="/admin/pages/delete/' . $global_page->page_id . '" class="delete_confirm delete_button list_action">Delete</a></td>' . "\n";
			echo '</tr>' . "\n";
		}
	
	}
 ?>
</table>
