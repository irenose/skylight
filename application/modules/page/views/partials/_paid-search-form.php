<?php
    $ps_url = basename(str_replace('/night','',current_url()));
?>
<form action="<?=current_url();?>#ps-form-anchor" method="post" id="paid-search-form" <?php if(isset($modal_form)) { echo 'data-modal-form'; } ?>>
    <input type="hidden" name="dealer_id" value="<?=$installer_array[0]->dealer_id; ?>">
    <input type="hidden" name="ps_url" value="<?=$ps_url; ?>">
    <input type="hidden" name="ps_page_type" value="<?=$paid_search_page_type; ?>">
    <div id="ps-form-anchor"></div>
    <div class="row">
        <div class="small-12 columns">
            <h4>Get In Touch With Us:</h4>
            <div class="form-grey-border"></div>
            <label class="first-label" id="ps-name">Name<?=required_text('name'); ?></label>
            <input type="text" name="name" id="paid-search-name" class="<?=error_class('name'); ?> full-width" value="<?=set_value('name');?>" />

            <label id="ps-phone">Phone<?=required_text('phone'); ?></label>
            <input type="text" name="phone" id="paid-search-phone" class="<?=error_class('phone'); ?> full-width" value="<?=set_value('phone');?>" />

            <label id="ps-email">Email Address<?=required_text('email'); ?></label>
            <input type="text" name="email" id="paid-search-email" class="<?=error_class('email'); ?> full-width" value="<?=set_value('email');?>" />
            
            <div class="confirm_email">
                <label>Confirm Email Address</label>
                <input type="text" name="confirm_email" class="input-text full-width" value="" />
            </div>

            <label id="ps-comments">Message<?=required_text('comments'); ?></label>
            <textarea name="comments" id="paid-search-comments" class="<?=form_textarea_error('comments'); ?> full-width"><?=set_value('comments');?></textarea>
        </div>
    </div>

    <input type="submit" value="Contact Us" id="paid-search-submit" />
</form>