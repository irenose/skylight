<?php
    $ps_url = basename(str_replace('/night','',current_url()));
    if(isset($modal_form)) {
        $form_id = 'paid-search-form-mobile';
        $submit_id = 'paid-search-submit-mobile';
        $form_attribute = ' data-modal-form';

    } else {
        $form_id = 'paid-search-form';
        $submit_id = 'paid-search-submit';
        $form_attribute = '';
    }
?>
<form action="<?=current_url();?>#ps-form-anchor" method="post" id="<?=$form_id;?>"<?=$form_attribute; ?>>
    <input type="hidden" name="dealer_id" value="<?=$installer_array[0]->dealer_id; ?>">
    <input type="hidden" name="ps_url" value="<?=$ps_url; ?>">
    <input type="hidden" name="ps_page_type" value="<?=$paid_search_page_type; ?>">
    <div id="ps-form-anchor"></div>
    <div class="row">
        <div class="small-12 columns">
            <h4>Get In Touch With Us:</h4>
            <div class="form-grey-border"></div>
            <label class="first-label"<?php if(isset($modal_form)) { echo ' id="ps-name"'; } ?>>Name*<?=required_text('name'); ?></label>
            <input type="text" name="name"<?php if(isset($modal_form)) { echo ' id="paid-search-name"'; } ?> class="<?=error_class('name'); ?> full-width" value="<?=set_value('name');?>" />

            <label<?php if(isset($modal_form)) { echo ' id="ps-phone"'; } ?>>Phone*<?=required_text('phone'); ?></label>
            <input type="text" name="phone"<?php if(isset($modal_form)) { echo ' id="paid-search-phone"'; } ?> class="<?=error_class('phone'); ?> full-width" value="<?=set_value('phone');?>" />

            <label<?php if(isset($modal_form)) { echo ' id="ps-email"'; } ?>>Email Address*<?=required_text('email'); ?></label>
            <input type="text" name="email"<?php if(isset($modal_form)) { echo ' id="paid-search-email"'; } ?> class="<?=error_class('email'); ?> full-width" value="<?=set_value('email');?>" />
            
            <div class="confirm-email">
                <label>Confirm Email Address</label>
                <input type="text" name="confirm_email" class="input-text full-width" value="" />
            </div>

            <label<?php if(isset($modal_form)) { echo ' id="ps-comments"'; } ?>>Message*<?=required_text('comments'); ?></label>
            <textarea name="comments"<?php if(isset($modal_form)) { echo ' id="paid-search-comments"'; } ?> class="<?=form_textarea_error('comments'); ?> full-width"><?=set_value('comments');?></textarea>
        </div>
    </div>
    <input type="submit" value="Contact Us" id="<?=$submit_id;?>" />
</form>