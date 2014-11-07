<?php 
	/******************************* INTRO COPY *************************/ 
?>
<section>
	<h1>Warranty</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
</section>

<section>
	<h1>The 10 Year Warranty</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
	<p><a href="">Download PDF</a></p>
</section>

<?php
	/******************************* IF INSTALLER HAS SEPARATE WARRANTY INFO *************************/ 
	if( isset($warranty_array) && count($warranty_array) > 0) {
?>
	<section>
		<h2><?= $installer_array[0]->name; ?> Warranty</h2>
		<?= filter_page_content($warranty_array[0]->dealer_warranty); ?>
	</section>
<?php
	}
?>

<section>
	<h2>Our Products</h2>
	<?php
		//SHOW PRODUCT CATEGORIES THAT DEALER OFFERS
		foreach($product_category_array as $category) {
			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
		}
	?>
</section>