<h1>Sort Photos</h1>
<p>Use the form below to order the photos as they are seen on your site.</p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		
		echo $this->session->flashdata('status_message');
		if( isset($error) && $error != '') {
            echo $error;
        }
	?>
</div>
<?php echo form_open_multipart('installer-admin/photos/sort/' . $dealer_id); ?>
<input type="hidden" name="sort_images" value="yes">
<input type="hidden" name="dealer_id" value="<?php echo $dealer_id; ?>">
    <div id="action_form_wrapper">
        <div class="action_form">
            <?php
                if( count($photos_array) > 0) {
                    echo '<div class="sortable_options_container">' . "\n";
                        echo '<div id="sort_status_response" class="sort_status"></div>' . "\n";

                        echo '<ul id="sortable">' . "\n";
                            foreach($photos_array as $photo) {
                                echo '<li class="clearfix gallery">' . "\n";
                                echo '<img src="' . $this->config->item('gallery_images_dir') . $photo->photo_image . '.' . $photo->extension . '" style="height:65px;">';
                                echo '<label><span class="gallery_image_label">' . $photo->photo_title . '</span></label>';
                                echo '<input type="hidden" name="photo_item[]" value="' . $photo->photo_id . '">';
                                echo '</li>' . "\n";
                            }
                        echo '</ul>' . "\n";

                    echo '</div>' . "\n";

                } else {
                    echo '<p>There are no photos. <a href="/installer-admin/photos/add">Add one now.</a></p>' . "\n";
                }
            ?>
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_sort" rel="update_sort" value="Update Sort" class="submit" /><a href="/installer-admin/photos" class="cancel_button">Cancel</a>
            </div>

    	</div>    
    </div>

</form>

