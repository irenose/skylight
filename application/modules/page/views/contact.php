<h1>
    <?php echo $page_headline; ?>
</h1>
<?php
    echo $page_content;

	if (validation_errors()) {
		echo '<div class="error-alert">' . "\n";
		echo '<p>You have encountered some errors on this page:</p>' . "\n";
		echo '</div>' . "\n";
	}
?>
<form action="/contact" method="post">
    <label>Name<?php echo required_text('name'); ?></label>
    <input type="text" name="name" class="<?php echo error_class('name'); ?>" value="<?php echo set_value('name');?>" />

    <label>Company<?php echo required_text('company'); ?></label>
    <input type="text" name="company" class="<?php echo error_class('company'); ?>" value="<?php echo set_value('company');?>" />

    <label>Email Address<?php echo required_text('email'); ?></label>
    <input type="text" name="email" class="<?php echo error_class('email'); ?>" value="<?php echo set_value('email');?>" />

    <label>Phone<?php echo required_text('phone'); ?></label>
    <input type="text" name="phone" class="<?php echo error_class('phone'); ?>" value="<?php echo set_value('phone');?>" />

    <label>How can we help?<?php echo required_text('comments'); ?></label>
    <textarea name="comments" class="<?php echo form_textarea_error('comments'); ?>"><?php echo set_value('comments');?></textarea><br />

    <input type="submit" value="Contact Us" />
</form>
