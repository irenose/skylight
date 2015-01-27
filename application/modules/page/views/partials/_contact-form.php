<form action="<?=$installer_base_url; ?>/contact#contact-form" method="post" id="contact-form" <?php if(isset($modal_form)) { echo 'data-modal-form'; } ?>>
    <input type="hidden" name="dealer_id" value="<?=$installer_array[0]->dealer_id; ?>">
    <div class="row">
        <div class="small-12 medium-6 columns">
            <label id="label-name">Name*<?=required_text('name'); ?></label>
            <input type="text" name="name" id="contact-name" class="<?=error_class('name'); ?> full-width" value="<?=set_value('name');?>" />

            <label id="label-phone">Phone*<?=required_text('phone'); ?></label>
            <input type="text" name="phone" id="contact-phone" class="<?=error_class('phone'); ?> full-width" value="<?=set_value('phone');?>" />

            <label id="label-email">Email Address*<?=required_text('email'); ?></label>
            <input type="text" name="email" id="contact-email" class="<?=error_class('email'); ?> full-width" value="<?=set_value('email');?>" />

            <label>City</label>
            <input type="text" name="city" id="contact-city" class="full-width" />

            <div class="row">
                <div class="small-12 medium-6 columns">
                    <label>Zip Code</label>
                    <input type="text" name="zip" id="contact-zip" class="full-width" />
                </div>
                <div class="small-12 medium-6 columns">
                    <label>State</label>
                    <div class="styled-select">
                        <select name="state" class="selectric" id="contact-state">
                            <option value="">&nbsp;</option>
                            <?php 
                                $state_array = get_data_array('state');
                                foreach($state_array as $key => $value) {
                                    echo '<option value="' . $key . '">' . $key . '</option>' . "\n";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-12 medium-6 columns">
            <label id="label-subject">What Can We Help You With?*<?=required_text('subject'); ?></label>
            <select name="subject" class="selectric" id="contact-subject">
                <option value="">Please choose one</option>
                <option value="General Information"<?= set_select('subject', 'General Information'); ?>>General Information</option>
                <option value="Schedule Consultation"<?= set_select('subject', 'Schedule Consultation'); ?>>Schedule Consultation</option>
                <option value="Request a Quote"<?= set_select('subject', 'Request a Quote'); ?>>Request a Quote</option>
                <option value="Installation"<?= set_select('subject', 'Installation'); ?>>Installation</option>
                <option value="Repair or Replacement"<?= set_select('subject', 'Repair or Replacement'); ?>>Repair/Replacement</option>
                <?php
                    foreach($contact_products_array as $product) {
                        $product_name = ascii_to_entities($product->product_name);
                        $product_name = $product->model_number != '' ? $product_name . ' (' . $product->model_number . ')' : $product_name;
                        $selected = (isset($selected_contact_product) && $selected_contact_product == $product_name) ? TRUE : FALSE;
                        echo '<option value="' . $product_name . '"' . set_select('subject',$product_name,$selected) . '>' . $product_name . '</option>'.  "\n";
                    }
                ?>
            </select>

            <label id="label-message">Message*<?=required_text('comments'); ?></label>
            <textarea name="comments" id="contact-comments" class="<?=form_textarea_error('comments'); ?> full-width"><?=set_value('comments');?></textarea>

            <label class="updates"><input type="checkbox" name="receive_more_info" value="yes" <?= set_checkbox('receive_more_info','yes'); ?> /> Yes, I would like to receive updates</label>
        </div>
    </div>

    <input type="submit" value="Contact Us" id="contact-submit" />
</form>