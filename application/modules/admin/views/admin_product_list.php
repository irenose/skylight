<h1 class="clearfix">
	<div class="header_label">Products</div>
    <div class="header_actions"><a href="/admin/products/add" class="header_action">Add Product</a></div>
</h1>

<div class="flashdata">
<?php 
	//Success/Error Flash Data
	echo $this->session->flashdata('status_message');
?>
</div>
<?php
	if(isset($product_category_array) && count($product_category_array) > 0) {
		
		foreach($product_category_array as $product_category) {
			$products_array = $this->admin_model->get_products_by_category($product_category->product_category_id, $product_status);
			if(count($products_array) > 0) {
				$bg_color = 'gray';
				echo '<h2>' . $product_category->product_category_name . '</h2>';
				echo '<table class="list_table" cellpadding="0" cellspacing="0" border="0">' . "\n";
				echo '<tr>' . "\n";
				echo '<td width="15%" class="table_header"><span class="table_header_text">Subcategory</span></td>' . "\n";
				echo '<td width="20%" class="table_header"><span class="table_header_text">Product</span></td>' . "\n";
				echo '<td width="10%" class="table_header"><span class="table_header_text">Model</span></td>' . "\n";
				 echo '<td width="10%" class="table_header"><span class="table_header_text">Status</span></td>' . "\n";
				echo '<td class="table_header"><span class="table_header_text">Actions</span></td>' . "\n";
				echo '</tr>' . "\n";
				foreach($products_array as $product) {
					$bg_color = $bg_color == 'white' ? 'gray' : 'white';
					$class = $product->product_status == 'active' ? 'active' : 'inactive';
					echo '<tr class="' . $bg_color . '">' . "\n";
					echo '<td width="15%" class="td_border"><span class="' . $class .'">' . $product->product_category_name . '</span></td>' . "\n";
					echo '<td width="20%" class="td_border"><span class="' . $class .'">' . $product->product_name . '</span></td>' . "\n";
					echo '<td width="10%" class="td_border"><span class="' . $class .'">' . $product->model_number . '</span></td>' . "\n";
					echo '<td width="10%" class="td_border"><span class="' . $class . '">' . ucfirst($product->product_status) . '</span></td>' . "\n";
					echo '<td class="td_border"><a href="/admin/products/update/' . $product->product_id . '" class="blue_button list_action">Update</a><a href="/admin/products/delete/' . $product->product_id . '" class="delete_confirm list_action">Delete</a></td>' . "\n";
					echo '</tr>' . "\n";
					
				}
				echo '</table>';
			}
		}

		
	} else {
		echo '<p>There are no products</p>' . "\n";
	}
?>
