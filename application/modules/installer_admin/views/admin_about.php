<h1 class="clearfix">
    <div class="header_label">Update About Us Copy</div>
</h1>
<p>You can write your own company description or use the description provided by VELUX. Upload a photo of your business' owner to give customers a sense of who you are.</p>
<div class="flashdata">
    <?php 
		if(validation_errors()) {
			echo '<div class="error_alert">' . "\n";
    		echo '<p>You have encountered some errors on this page, please review below.</p>' . "\n";
    		echo '</div>' . "\n";
		}
		if(isset($error)) {
			echo $error;
		}
		echo $this->session->flashdata('status_message');
	?>
</div>
<?php echo form_open_multipart('/installer-admin/about'); ?>
	<input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />

	<div id="action_form_wrapper">
        <div class="action_form">

		    <?php
				if(trim($dealer_array[0]->about_image) != '') {
					echo '<input type="hidden" name="current_filename_base" value="' . $dealer_array[0]->about_image . '" />';
					echo '<input type="hidden" name="current_filename" value="' . $dealer_array[0]->about_image . '.' . $dealer_array[0]->about_extension . '" />';
				}
			?>
		    
		    <label for="name">About Dealer Headline<?php echo required_text('about_dealer_headline'); ?></label>
		    <input type="text" class="input_text" name="about_dealer_headline" id="about_dealer_headline" value="<?php echo set_value('about_dealer_headline', $dealer_array[0]->about_dealer_headline); ?>" /><br />
		    
		    <label for="about_dealer_text">About Dealer Copy<?php echo required_text('about_dealer_text'); ?></label>
		    <textarea name="about_dealer_text" class="textarea_text" id="custom_textarea"><?php echo set_value('about_dealer_text', $dealer_array[0]->about_dealer_text); ?></textarea>

		    <div class="form_spacer"></div>

		    <div class="padded_block padded_block_gray">
			    <label for="logo">About Us Image</label>
			    <input type="file" name="userfile" />
			    <br><br>
			    <?php
					$random = rand(100,999);
					if(trim($dealer_array[0]->about_image) != '' && file_exists($this->config->item('dealer_assets_full_dir') . 'about-images/' . $dealer_array[0]->about_image . '.' . $dealer_array[0]->about_extension)) {
						echo '<img src="' . $this->config->item('dealer_assets_dir') . 'about-images/' . $dealer_array[0]->about_image . '.' . $dealer_array[0]->about_extension . '?rand=' . $random . '" style="width:200px;">';
						echo '<br><br><a href="/installer-admin/about/delete-image/' . $dealer_array[0]->dealer_id . '" style="margin-top:10px;" class="delete_confirm delete_link">Delete Image</a>';
					}
				?>

			    <p class="instruction"><i>Photo must be one of the following file formats: jpg, png or gif. If your image exceeds 200px wide, it will be re-sized. <b>Images for upload must be less than 1.5MB in file size</b>.</i></p>
			</div>
		    
		    <div class="form_spacer"></div>
		    
		    <?php 
				//ONLY SUPER ADMINS CAN UPDATE META DATA.
				//IF THEY ARE SUPER ADMIN, SET HIDDEN VARIABLE FOR PROCESSING
				if( $_SESSION['super_admin'] == 'yes') {
				echo '<input type="hidden" name="process_meta" value="yes" />';
			?>
				<div id="meta_stuff">
		            <label for="meta_title">META Page Title</label>
		            <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title', $dealer_array[0]->about_meta_title); ?>" /><br /><br />
		            
		            <label for="meta_description">META Description</label>
		            <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description', $dealer_array[0]->about_meta_description); ?></textarea><br /><br />
		            
		            <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label>
		            <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords', $dealer_array[0]->about_meta_keywords); ?></textarea>
		        </div>
			
		    <?php
				}
			?>

		    <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_about" rel="update_about" value="Update About Us" class="submit" /><a href="/installer-admin/home" class="cancel_button">Cancel</a>
            </div>
		</div>
	</div>
</form>