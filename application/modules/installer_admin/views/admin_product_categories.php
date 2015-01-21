<h1 class="clearfix">
    <div class="header_label">Products</div>
</h1>
<p>You may customize your microsite to show only the products you sell. To hide entire categories of products click the green "deactivate" button below the product category photo. To select individual products to hide, click the blue "choose products" button, which will navigate to a detailed list of products.</p>
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

    $options_array = $this->installer_admin_model->get_dealer_options($dealer_id);
    if(trim($options_array[0]->product_categories) != '') {
        $inactive_array = explode(',',$options_array[0]->product_categories);
    } else {
        $inactive_array = array();
    }
?>
<table class="list_table" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="35%" class="table_header"><span class="table_header_text">Product Category</span></td>
        <td width="10%" class="table_header"><span class="table_header_text">Status</span></td>
        <td class="table_header"><span class="table_header_text">Actions</span></td>
    </tr>
<?php
    $bg_color = 'white';
    foreach($product_categories_array as $category) {
        $bg_color = $bg_color == 'white' ? 'gray' : 'white';

        if( in_array($category->product_category_id,$inactive_array)) {
            $span_class = ' class="inactive"';
            $activate_link = '<a href="/installer-admin/products/activate/' . $category->product_category_id . '" class="list_action">Activate Category</a>';
            $status = 'Inactive';
        } else {
            $span_class = ' class="active"';
            $activate_link = '<a href="/installer-admin/products/deactivate/' . $category->product_category_id . '" class="list_action">De-Activate Category</a>';
            $status = 'Active';
        }

        echo '<tr class="' . $bg_color . '">' . "\n";
        echo '<td width="35%" class="td_border"><span>' .  $category->product_category_name  . '</span></td>' . "\n";
        echo '<td width="10%" class="td_border"><span' . $span_class . '>' .  $status . '</span></td>' . "\n";
        echo '<td class="td_border"><a href="/installer-admin/products/update/' . $category->product_category_id . '" class="list_action">Update Products</a>' . $activate_link . '</td>' . "\n";
        echo '</tr>' . "\n";
    }
?>
</table>
        
<div class="form_clear"> </div>
