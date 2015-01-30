<h1 class="clearfix">
    <div class="header_label">Choose Products</div>
</h1>
<p>Check the boxes next to the products that you want to be visible to customers who visit your microsite. Deselect the boxes next to the products that you want to hide. Select one featured product, whose photo will appear on the homepage.</p>

<p>Remember to click the blue "update products" button at the bottom of this page to save your changes.</p>
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
<?php
    echo form_open('/installer-admin/products/update/' . $product_category_id);
    echo '<input type="hidden" name="dealer_id" value="' . $dealer_id . '">';
    $options_array = $this->installer_admin_model->get_dealer_options($dealer_id);
    echo '<input type="hidden" name="dealer_option_id" value="' . $options_array[0]->dealer_option_id . '">';
    $all_products_array = array();
    
    if(trim($options_array[0]->products) != '') {
        $inactive_array = explode(',',$options_array[0]->products);
    } else {
        $inactive_array = array();
    }
    
    $products_array = $this->installer_admin_model->get_products_by_category($product_category_id);
?>
    <div id="action_form_wrapper">
        <div class="action_form">
            <?php
                if(count($products_array) > 0) {
                    $cur_category = $products_array[0]->product_category_name;
                    $bg_color = 'white';
                    echo '<h2>' . $cur_category . '</h2>' . "\n";
                    echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">' . "\n";
                    echo '<tr>' . "\n";
                    echo '<td width="10%" class="table_header"><span class="table_header_text">Show</span></td>' . "\n";
                    echo '<td width="15%" class="table_header"><span class="table_header_text">Image</span></td>' . "\n";
                    echo '<td width="30%" class="table_header"><span class="table_header_text">Name</span></td>' . "\n";
                    echo '<td width="10%" class="table_header"><span class="table_header_text">Model</span></td>' . "\n";
                    echo '<td class="table_header"><span class="table_header_text">Featured</span></td>' . "\n";
                    echo '</tr>';
                    foreach($products_array as $product) {
                        if($product->product_category_name != $cur_category) {
                            echo '</table>';
                            echo '<h2>' . $product->product_category_name . '</h2>' . "\n";
                            $cur_category = $product->product_category_name;
                            $bg_color = 'white';
                            echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">' . "\n";
                            echo '<tr>' . "\n";
                            echo '<td width="10%" class="table_header"><span class="table_header_text">Show</span></td>' . "\n";
                            echo '<td width="15%" class="table_header"><span class="table_header_text">Image</span></td>' . "\n";
                            echo '<td width="30%" class="table_header"><span class="table_header_text">Name</span></td>' . "\n";
                            echo '<td width="10%" class="table_header"><span class="table_header_text">Model</span></td>' . "\n";
                            echo '<td class="table_header"><span class="table_header_text">Featured</span></td>' . "\n";
                            echo '</tr>';
                        }
                        $bg_color = $bg_color == 'white' ? 'gray' : 'white';
                        $all_products_array[] = $product->product_id;
                        if(in_array($product->product_id,$inactive_array)) {
                            $checked = '';
                        } else {
                            $checked = ' checked="checked"';    
                        }
                        echo '<tr class="' . $bg_color . '">' . "\n";
                        echo '<td width="10%" class="td_border"><input type="checkbox" name="products[]" value="' . $product->product_id . '"' . $checked . '></td>' . "\n";
                        echo '<td width="15%" class="td_border"><img src="' . $this->config->item('product_images_dir') . $product->product_image . '.' . $product->extension . '" border="0" style="width:75px;"></td>' . "\n";
                        echo '<td width="30%" class="td_border">' . $product->product_name . '</td>' . "\n";
                        echo '<td width="10%" class="td_border">' . $product->model_number . '</td>' . "\n";
                        
                        $radio_checked = '';
                        switch($product_category_id) {
                            case 1:
                                if($product->product_id == $options_array[0]->featured_suntunnel) {
                                    $radio_checked = ' checked="checked"';
                                }
                                $featured_field = 'featured_suntunnel';
                                break;
                            case 2:
                                if($product->product_id == $options_array[0]->featured_residential) {
                                    $radio_checked = ' checked="checked"';
                                }
                                $featured_field = 'featured_residential';
                                break;
                            case 3:
                                if($product->product_id == $options_array[0]->featured_commercial) {
                                    $radio_checked = ' checked="checked"';
                                }
                                $featured_field = 'featured_commercial';
                                break;
                        }
                        echo '<td class="td_border"><input type="radio" name="featured" value="' . $product->product_id . '"' . $radio_checked . '></td>' . "\n";
                        echo '</tr>' . "\n";
                        
                    }
                    echo '</table>' . "\n";
                    
                    $counter = 0;
                    $all_products = '';
                    foreach($all_products_array as $key => $value) {
                        $counter++;
                        if($counter == 1) {
                            $all_products .= $value;
                        } else {
                            $all_products .= ',' . $value;
                        }
                    }
                    echo '<input type="hidden" name="all_products_list" value="' . $all_products . '">' . "\n";
                    echo '<input type="hidden" name="featured_field" value="' . $featured_field . '">' . "\n";
                    
                } else {
                    echo 'There are no products';
                }
                
            ?>  
    
            <div class="action_form_submit_cancel clearfix">
                <input type="submit" name="action" id="update_products" rel="update_products" value="Update Products" class="submit" /><a href="/installer-admin/products" class="cancel_button">Cancel</a>
            </div>
        </div>
    </div>

</form>
