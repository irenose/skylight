<?php
    $ps_url = basename(str_replace('/night','',current_url()));
?>
<form action="<?=current_url();?>" method="post">
    <input type="hidden" name="dealer_id" value="<?=$installer_array[0]->dealer_id; ?>">
    <input type="hidden" name="ps_url" value="<?=$ps_url; ?>">
    <input type="hidden" name="ps_page_type" value="<?=$paid_search_page_type; ?>">
    <div class="row">
        <div class="small-12 columns">
            <h4>Get In Touch With Us</h4>
            <div class="form-grey-border"></div>
            <label class="first-label">Name<?=required_text('name'); ?></label>
            <input type="text" name="name" class="<?=error_class('name'); ?> full-width" value="<?=set_value('name');?>" />

            <label>Phone<?=required_text('phone'); ?></label>
            <input type="text" name="phone" class="<?=error_class('phone'); ?> full-width" value="<?=set_value('phone');?>" />

            <label>Email Address<?=required_text('email'); ?></label>
            <input type="text" name="email" class="<?=error_class('email'); ?> full-width" value="<?=set_value('email');?>" />
            
            <div class="confirm_email">
                <label>Confirm Email Address</label>
                <input type="text" name="confirm_email" class="input-text full-width" value="" />
            </div>

            <label>Message<?=required_text('comments'); ?></label>
            <textarea name="comments" class="<?=form_textarea_error('comments'); ?> full-width"><?=set_value('comments');?></textarea>
        </div>
    </div>

    <input type="submit" value="Submit" />
</form>