<h1>Add Literature</h1>
<p>Use the form below to add a new brochure. The image file must be either .gif, .jpg or .png. The download file must be .pdf</p>
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

<?php echo form_open_multipart('admin/literature/add'); ?>
    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="thumbnail">Brochure Thumbnail Image<?php echo required_text('thumbnail'); ?></label>
            <input type="file" name="thumbnail" id="thumbnail" class="file_input" />
            
            <label for="filename">Download File<?php echo required_text('filename'); ?></label>
            <input type="file" name="filename" id="filename" class="file_input" />

            <div class="form_spacer"></div>

            <label for="name">Brochure Name<?php echo required_text('name'); ?></label>
            <input type="text" name="name" id="name" class="input_text" value="<?php echo set_value('name'); ?>" />
            
            <label for="description">Description<?php echo required_text('description'); ?></label>
   			<textarea name="description" class="textarea_text MCE"><?php echo set_value('description'); ?></textarea>
            
            <label for="analytics_url">Analytics URL (e.g. /brochures/brochure_name)<?php echo required_text('analytics_url'); ?></label>
            <input type="text" name="analytics_url" id="analytics_url" class="input_text" value="<?php echo set_value('analytics_url'); ?>" />

            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_literature" rel="add_literature" value="Add Literature" class="submit" /><a href="/admin/literature" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>
