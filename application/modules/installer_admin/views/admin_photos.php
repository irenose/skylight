<h1 class="clearfix">
    <div class="header_label">Photos</div>
    <div class="header_actions">
        <a href="/installer-admin/photos/add" class="header_action">Add Photo</a>
        <?php
            if(isset($photos_listing_array) && count($photos_listing_array) > 0) {
                echo '<a href="/installer-admin/photos/sort" class="header_action">Update Photo Order</a>';
            }
        ?>
    </div>
</h1>

<div class="flashdata">
<?php 
    //Success/Error Flash Data
    echo $this->session->flashdata('status_message');
?>
</div>
<?php
    if(isset($photos_listing_array) && count($photos_listing_array) > 0) {
?>
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="15%" class="table_header"><span class="table_header_text">Image</span></td>
        <td width="30%" class="table_header"><span class="table_header_text">Title</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
    <?php
        $bg_color = 'gray';
        foreach($photos_listing_array as $photo) {
            $bg_color = $bg_color == 'white' ? 'gray' : 'white';
            
            if($photo->photo_status == 'inactive') {
                $span_class = ' class="inactive"';
            } else {
                $span_class = '';
            }
            
            echo '<tr class="' . $bg_color . '">' . "\n";
            if($photo->photo_image != '' && file_exists($this->config->item('gallery_images_full_dir') . $photo->photo_image . '.' . $photo->extension)) {
                $photo_image = '<img src="' . $this->config->item('gallery_images_dir') . $photo->photo_image . '.' . $photo->extension . '" style="height:65px;">';
            } else {
                $photo_image = '';
            }
            echo '<td width="15%" class="td_border"><span' . $span_class . '>' .  $photo_image . '</span></td>' . "\n";
            echo '<td width="30%" class="td_border"><span' . $span_class . '>' .  $photo->photo_title . '</span></td>' . "\n";
            echo '<td class="td_border"><a href="/installer-admin/photos/update/' . $photo->photo_id . '" class="list_action">Update Photo</a><a href="/installer-admin/photos/delete/' . $photo->photo_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
            echo '</tr>' . "\n";        
        
        }

    ?>

</table>
<?php
    } else {
        echo '<p>You currently have no photos in your photo gallery. <a href="/installer-admin/photos/add">Add one now.</a></p>';
    }
?>
