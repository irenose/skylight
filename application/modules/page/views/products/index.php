<h1>Our Products</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, sit! Iure minima et quis incidunt illo perferendis asperiores nobis, mollitia.</p>
<?php
	if( isset($product_category_array) && count($product_category_array) > 0) {
		foreach($product_category_array as $category) {
			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
			echo filter_page_content($category->product_category_teaser) . '<br><br>';
		}
	}
?>