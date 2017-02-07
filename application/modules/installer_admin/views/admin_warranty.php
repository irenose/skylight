<h1 class="clearfix">
    <div class="header_label">Update Warranty</div>
</h1>
<p>Your microsite will automatically display information about the warranty provided by VELUX, including a link to download a PDF of the warranty document. If you offer a warranty above and beyond the VELUX warranty, you may add information about it for display alongside the VELUX warranty information. After adding your warranty details, be sure to click the "update warranty" button at the bottom of this page.</p>
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
<?php echo form_open_multipart('/installer-admin/warranty/' . $_SESSION['dealer_id']); ?>
	<input type="hidden" name="dealer_id" value="<?php echo $_SESSION['dealer_id']; ?>" />

	<div id="action_form_wrapper">
        <div class="action_form">

		    <label for="dealer_warranty">Warranty Copy<?php echo required_text('dealer_warranty'); ?></label>
		    <textarea name="dealer_warranty" class="textarea_text"><?php echo set_value('dealer_warranty', $dealer_array[0]->dealer_warranty); ?></textarea>

		    <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_warranty" rel="update_warranty" value="Update Warranty" class="submit" /><a href="/installer-admin/home" class="cancel_button">Cancel</a>
            </div>
		</div>
	</div>
</form>