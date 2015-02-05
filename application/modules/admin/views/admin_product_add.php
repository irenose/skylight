<h1>Add Product</h1>
<p>Use the form below to add a new product.</p>
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

<?php echo form_open_multipart('admin/products/add'); ?>
    <div id="action_form_wrapper">
        <div class="action_form">

            <label for="product_name" class="form_float_left">Product Name<?php echo required_text('product_name'); ?></label>
            <input type="text" name="product_name" id="product_name" class="input_text" value="<?php echo set_value('product_name'); ?>" />

            <label for="product_name_short">Product Name - Short<?php echo required_text('product_name_short'); ?></label>
            <input type="text" class="input_text" name="product_name_short" value="<?php echo set_value('product_name_short'); ?>" />
            
            <label for="model_number">Model Number<?php echo required_text('model_number'); ?></label>
            <input type="text" class="input_text" name="model_number" value="<?php echo set_value('model_number'); ?>" />
            
            <label for="product_category_id">Product Category<?php echo required_text('product_category_id'); ?></label>
            <table cellpadding="0" cellspacing="0" border="0">
            <tr>
            	<td>
                	<div class="dropdown_area">
                    	<select name="product_category_id" id="product_category_id" class="input_dropdown_sort" style="width:300px;">
                        <option value="">Please choose</option>
                    <?php
                        foreach($product_category_array as $product_category) {
                            echo '<option value="' . $product_category->product_category_id . '">' . $product_category->product_category_name . '</option>';
                        }
                    ?>
                    	</select>
                    </div>
                </td>
                <td width="25"> </td>
                <td>
         
                    <div class="dropdown_area" id="secondary_category_container">
                        <select name="primary_category_id" id="secondary_category_dropdown" class="input_dropdown_sort" style="width:300px;">
                            <option value=""> </option>
                        </select>
                    </div>
                </td>
            </tr>
            </table>
   
            <label for="product_description">Product Description<?php echo required_text('product_description'); ?></label>
            <textarea name="product_description" class="textarea_text MCE" id="custom_textarea"><?php echo set_value('product_description'); ?></textarea>
            
            <label for="green_friendly_flag">Green Friendly?<?php echo required_text('green_friendly_flag'); ?></label>
            <select name="green_friendly_flag" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="yes"<?php echo set_select('green_friendly_flag','yes'); ?>>Yes</option>
                <option value="no"<?php echo set_select('green_friendly_flag','no'); ?>>No</option>
            </select>
            
            <label for="no_leak_flag">No Leak?<?php echo required_text('no_leak_flag'); ?></label>
            <select name="no_leak_flag" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="yes"<?php echo set_select('no_leak_flag','yes'); ?>>Yes</option>
                <option value="no"<?php echo set_select('no_leak_flag','no'); ?>>No</option>
            </select>
            
            <label for="tax_credit">Tax Credit?<?php echo required_text('tax_credit'); ?></label>
            <select name="tax_credit" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="yes"<?php echo set_select('tax_credit','yes'); ?>>Yes</option>
                <option value="no"<?php echo set_select('tax_credit','no'); ?>>No</option>
            </select>
            
            <label for="energy_star">Energy Star?<?php echo required_text('energy_star'); ?></label>
            <select name="energy_star" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="yes"<?php echo set_select('energy_star','yes'); ?>>Yes</option>
                <option value="no"<?php echo set_select('energy_star','no'); ?>>No</option>
            </select>

            <label for="remote_flag">Remote Callout?<?php echo required_text('remote_flag'); ?></label>
            <select name="remote_flag" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="yes"<?php echo set_select('remote_flag','yes'); ?>>Yes</option>
                <option value="no"<?php echo set_select('remote_flag','no'); ?>>No</option>
            </select>

            <div class="form_spacer"></div>

            <div id="meta_stuff">
                <label for="meta_title">META Page Title</label>
                <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title'); ?>" /><br /><br />
                
                <label for="meta_description">META Description</label>
                <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description'); ?></textarea><br /><br />
                
                <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label>
                <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords'); ?></textarea>
            </div>
            
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="add_product" rel="add_product" value="Add Product" class="submit" /><a href="/admin/products" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>
</form>