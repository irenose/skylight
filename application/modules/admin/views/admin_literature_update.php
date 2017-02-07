<?php
	$inactive_selected = FALSE;
	$active_selected = FALSE;
	$delete_selected = FALSE;
	switch($literature_array[0]->literature_status) {
		case 'inactive':
			$inactive_selected = TRUE;
			break;
		case 'active':
			$active_selected = TRUE;
			break;
		case 'delete':
			$delete_selected = TRUE;
			break;
	}

	$random = rand(100,999);
?>
<h1>Update Literature</h1>
<p>Use the form below to update a brochure. The image file must be either .gif, .jpg or .png. The download file must be .pdf</p>
<div class="flashdata">
    <?php
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}

		echo $this->session->flashdata('status_message');
		echo $error;
	?>
</div>
<?php echo form_open_multipart('admin/literature/update/' . $literature_id); ?>
<input type="hidden" name="literature_id" value="<?php echo $literature_id; ?>" />
<input type="hidden" name="file_prefix" value="<?php echo $literature_array[0]->filename; ?>" />
    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="thumbnail">Brochure Thumbnail Image<?php echo required_text('thumbnail'); ?></label>
            <input type="file" name="thumbnail" id="thumbnail" class="file_input" />
            <?php
				if(trim($literature_array[0]->thumbnail) != '') {
					echo '&nbsp;&nbsp;Current Download File: <a href="' . $this->config->item('brochure_assets_dir') . $literature_array[0]->thumbnail . '.' . $literature_array[0]->thumbnail_extension . '" target="_blank">' . $literature_array[0]->thumbnail . '.' . $literature_array[0]->thumbnail_extension . '</a>';
				}
			?>

            <label for="filename">Download File<?php echo required_text('filename'); ?></label>
            <input type="file" name="filename" id="filename" class="file_input" />
            <?php
				if(trim($literature_array[0]->filename) != '') {
					echo '&nbsp;&nbsp;Current Download File: <a href="' . $this->config->item('resources_dir') . $literature_array[0]->filename . '.' . $literature_array[0]->extension . '" target="_blank">' . $literature_array[0]->filename . '.' . $literature_array[0]->extension . '</a>';
				}
			?>
            <div class="form_spacer"></div>

            <label for="name">Brochure Name<?php echo required_text('name'); ?></label>
            <input type="text" name="name" id="name" class="input_text" value="<?php echo set_value('name',$literature_array[0]->name); ?>" />

            <label for="description">Description<?php echo required_text('description'); ?></label>
   			<textarea name="description" class="textarea_text MCE"><?php echo set_value('description', $literature_array[0]->description); ?></textarea>

            <label for="analytics_url">Analytics URL (e.g. /brochures/brochure_name)<?php echo required_text('analytics_url'); ?></label>
            <input type="text" name="analytics_url" id="analytics_url" class="input_text" value="<?php echo set_value('analytics_url', $literature_array[0]->analytics_url); ?>" />

            <label for="literature_status">Status<?php echo required_text('status'); ?></label>
            <select name="literature_status" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="active"<?php echo set_select('literature_status','active',$active_selected);?>>Active</option>
                <option value="inactive"<?php echo set_select('literature_status','inactive',$inactive_selected);?>>Inactive</option>
            </select>

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_literature" rel="add_literature" value="Add Literature" class="submit" /><a href="/admin/literature" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
</form>
