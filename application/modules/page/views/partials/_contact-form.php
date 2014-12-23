<form action="/contact" method="post">
    <div class="row">
        <div class="small-12 medium-6 columns">
            <label>Name<?php echo required_text('name'); ?></label>
            <input type="text" name="name" class="<?php echo error_class('name'); ?> full-width" value="<?php echo set_value('name');?>" />

            <label>Phone<?php echo required_text('phone'); ?></label>
            <input type="text" name="phone" class="<?php echo error_class('phone'); ?> full-width" value="<?php echo set_value('phone');?>" />

            <label>Email Address<?php echo required_text('email'); ?></label>
            <input type="text" name="email" class="<?php echo error_class('email'); ?> full-width" value="<?php echo set_value('email');?>" />

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
                            <option>AL</option>
                            <option>AK</option>
                            <option>AZ</option>
                            <option>AR</option>
                            <option>CA</option>
                            <option>CO</option>
                            <option>CT</option>
                            <option>DE</option>
                            <option>FL</option>
                            <option>GA</option>
                            <option>HI</option>
                            <option>ID</option>
                            <option>IL</option>
                            <option>IN</option>
                            <option>IA</option>
                            <option>KS</option>
                            <option>KY</option>
                            <option>LA</option>
                            <option>ME</option>
                            <option>MD</option>
                            <option>MA</option>
                            <option>MI</option>
                            <option>MN</option>
                            <option>MS</option>
                            <option>MO</option>
                            <option>MT</option>
                            <option>NE</option>
                            <option>NV</option>
                            <option>NH</option>
                            <option>NJ</option>
                            <option>NM</option>
                            <option>NY</option>
                            <option>NC</option>
                            <option>ND</option>
                            <option>OH</option>
                            <option>OK</option>
                            <option>OR</option>
                            <option>PA</option>
                            <option>RI</option>
                            <option>SC</option>
                            <option>SD</option>
                            <option>TN</option>
                            <option>TX</option>
                            <option>UT</option>
                            <option>VT</option>
                            <option>VA</option>
                            <option>WA</option>
                            <option>WV</option>
                            <option>WI</option>
                            <option>WY</option>
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

            <label>Message<?php echo required_text('comments'); ?></label>
            <textarea name="comments" class="<?php echo form_textarea_error('comments'); ?> full-width"><?php echo set_value('comments');?></textarea>

            <label class="updates"><input type="checkbox" name="iCheck" /> Yes, I would like to receive updates</label>
        </div>
    </div>

    <input type="submit" value="Submit Form" />
</form>