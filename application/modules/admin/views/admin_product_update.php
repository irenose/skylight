<?php
	$inactive_selected = FALSE;
	$active_selected = FALSE;
	$delete_selected = FALSE;
	switch($product_array[0]->product_status) {
		case 'inactive':
			$inactive_selected = TRUE;
			break;
		case 'active':
			$active_selected = TRUE;
			break;
	}
	
	$random = rand(100,999);
	
	//Date Info for Modified By Section
	$mod_date = strtotime($product_array[0]->modification_date);
	$modified_date = date('m/d/y',$mod_date);
	$modified_time = date('g:i a',$mod_date);
?>
<h1>Update Product</h1>
<p>Use the form below to update a current product.</p>
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
<div id="date_modified">
    This page was last modified by: <span class="data"><?php echo $product_array[0]->modified_by; ?></span> on <span class="data"><?php echo $modified_date; ?></span> at <span class="data"><?php echo $modified_time; ?></span>
</div>
<?php echo form_open_multipart('admin/products/update/' . $product_id); ?>
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />

    <div id="action_form_wrapper">
        <div class="action_form">
    
            <label for="product_name" class="form_float_left">Product Name<?php echo required_text('product_name'); ?></label>
            <input type="text" name="product_name" id="product_name" class="input_text" value="<?php echo set_value('product_name', $product_array[0]->product_name); ?>" />

            <label for="product_url">Product URL<?php echo required_text('product_url'); ?></label>
            <input type="text" class="input_text" name="product_url" value="<?php echo set_value('product_url', $product_array[0]->product_url); ?>" />

            <label for="product_name_short">Product Name - Short<?php echo required_text('product_name_short'); ?></label>
            <input type="text" class="input_text" name="product_name_short" value="<?php echo set_value('product_name_short', $product_array[0]->product_name_short); ?>" />
            
            <label for="model_number">Model Number<?php echo required_text('model_number'); ?></label>
            <input type="text" class="input_text" name="model_number" value="<?php echo set_value('model_number', $product_array[0]->model_number); ?>" />
    
    
            <label for="product_category_id">Product Category<?php echo required_text('product_category_id'); ?></label>
            <table cellpadding="0" cellspacing="0" border="0">
            <tr>
            	<td>
                	<div class="dropdown_area">
                    	<select name="product_category_id" id="product_category_id" class="input_dropdown_sort" style="width:300px;">
                        <option value="">Please choose</option>
                    <?php
                        foreach($product_category_array as $product_category) {
        					$selected = $product_array[0]->product_category_id == $product_category->product_category_id ? TRUE : FALSE;
                            echo '<option value="' . $product_category->product_category_id . '"' . set_select('product_category_id',$product_category->product_category_id, $selected) . '>' . $product_category->product_category_name . '</option>';
                        }
                    ?>
                    	</select>
                    </div>
                </td>
                <td width="25"> </td>
                <td>
         
                    <div class="dropdown_area" id="secondary_category_container">
                        <select name="primary_category_id" id="secondary_category_dropdown" class="input_dropdown_sort" style="width:300px;">
                            <option value="">Please Choose</option>
                            <?php
        						$subcategories_array = $this->admin_model->get_product_subcategories($product_array[0]->product_category_id);
        						foreach($subcategories_array as $sub) {
        							$selected = $product_array[0]->primary_category_id == $sub->product_category_id ? TRUE : FALSE;
                            echo '<option value="' . $sub->product_category_id . '"' . set_select('primary_category_id', $sub->product_category_id, $selected) . '>' . $sub->product_category_name . '</option>';	
        						}
        					?>
                        </select>
                    </div>
                </td>
            </tr>
            </table>

            <label for="product_description">Product Description<?php echo required_text('product_description'); ?></label>
            <textarea name="product_description" class="textarea_text MCE" id="custom_textarea"><?php echo set_value('product_description', $product_array[0]->product_description); ?></textarea>
            
            <label for="no_leak_flag">No Leak?<?php echo required_text('no_leak_flag'); ?></label>
            <select name="no_leak_flag" class="input_dropdown_sort">
                <?php 
        			$yes_selected = $product_array[0]->no_leak_flag == 'yes' ? TRUE : FALSE;
        			$no_selected = $product_array[0]->no_leak_flag == 'no' ? TRUE : FALSE;
                ?>
                <option value="yes"<?php echo set_select('no_leak_flag','yes',$yes_selected); ?>>Yes</option>
                <option value="no"<?php echo set_select('no_leak_flag','no',$no_selected); ?>>No</option>
            </select>
            
            <label for="tax_credit">Tax Credit?<?php echo required_text('tax_credit'); ?></label>
            <select name="tax_credit" class="input_dropdown_sort">
                <?php 
        			$yes_selected = $product_array[0]->tax_credit == 'yes' ? TRUE : FALSE;
        			$no_selected = $product_array[0]->tax_credit == 'no' ? TRUE : FALSE;
                ?>
                <option value="yes"<?php echo set_select('tax_credit','yes',$yes_selected); ?>>Yes</option>
                <option value="no"<?php echo set_select('tax_credit','no',$no_selected); ?>>No</option>
            </select>
 

            <div class="form_spacer"></div>

            <div class="padded_block padded_block_gray">

                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" />
                <br><br>
                <?php
            		if(trim($product_array[0]->product_image) != '') {
            			echo '<img src="' . $this->config->item('product_images_dir') . $product_array[0]->product_image . '.' . $product_array[0]->extension . '?rand=' . $random . '" style="height:100px;">';
            		}
            	?>
            </div>

            <div class="form_spacer"></div>

            <div id="meta_stuff">
                <label for="meta_title">META Page Title</label>
                <input type="text" name="meta_title" id="meta_title" class="input_text" value="<?php echo set_value('meta_title', $product_array[0]->meta_title); ?>" /><br /><br />
                
                <label for="meta_description">META Description</label>
                <textarea name="meta_description" id="meta_description" class="textarea_text"  /><?php echo set_value('meta_description', $product_array[0]->meta_description); ?></textarea><br /><br />
                
                <label for="meta_keywords">META Keywords <span class="label_small">(separate with commas)</span></label>
                <textarea name="meta_keywords" id="meta_keywords" class="textarea_text" /><?php echo set_value('meta_keywords', $product_array[0]->meta_keywords); ?></textarea>
            </div>
    
            <label for="product_status">Product Status</label>
            <select name="product_status" class="input_dropdown_sort">
                <option value="">Please choose</option>
                <option value="active"<?php echo set_select('product_status','active',$active_selected);?>>Active</option>
                <option value="inactive"<?php echo set_select('product_status','inactive',$inactive_selected);?>>Inactive</option>
                <?php
                    if($product_array[0]->product_status == 'delete') {
                ?>
                    <option value="delete"<?php echo set_select('product_status','delete', $delete_selected);?>>Delete</option>
                <?php
                    }
                ?>
            </select>

	        <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_product" rel="update_product" value="Update Product" class="submit" /><a href="/admin/products" class="cancel_button">Cancel</a>
            </div>

        </div>
    </div>
</form>