<form action="/contact" method="post">
    <div class="row">
        <div class="small-12 medium-6 columns">
            <label>Name<?=required_text('name'); ?></label>
            <input type="text" name="name" class="<?=error_class('name'); ?> full-width" value="<?=set_value('name');?>" />

            <label>Phone<?=required_text('phone'); ?></label>
            <input type="text" name="phone" class="<?=error_class('phone'); ?> full-width" value="<?=set_value('phone');?>" />

            <label>Email Address<?=required_text('email'); ?></label>
            <input type="text" name="email" class="<?=error_class('email'); ?> full-width" value="<?=set_value('email');?>" />

            <label>City</label>
            <input type="text" name="city" class="full-width" />

            <div class="row">
                <div class="small-12 medium-6 columns">
                    <label>Zip Code</label>
                    <input type="text" name="zip" class="full-width" />
                </div>
                <div class="small-12 medium-6 columns">
                    <label>State</label>
                    <div class="styled-select">
                        <select name="state" class="selectric">
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
            <label>What Can We Help You With?</label>
            <select name="help" class="selectric">
                <option value="default" selected>Please choose one</option>
                <option value="option-a">Option A</option>
                <option value="option-b">Option B</option>
                <option value="option-c">Option C</option>
            </select>

            <label>Message<?=required_text('comments'); ?></label>
            <textarea name="comments" class="<?=form_textarea_error('comments'); ?> full-width"><?=set_value('comments');?></textarea>

            <label class="updates"><input type="checkbox" name="iCheck" /> Yes, I would like to receive updates</label>
        </div>
    </div>

    <input type="submit" value="Submit Form" />
</form>