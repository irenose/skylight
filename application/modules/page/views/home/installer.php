<?php 
	/******************************* INTRO COPY HEADLINE *************************/ 
	_a($installer_array);
?>
<h1><?= $installer_array[0]->about_dealer_headline; ?></h1>

<?php 
	/******************************* OUR PRODUCTS SECTION *************************/ 
?>
<section>
	<h2>Our Products</h2>
	<?php
		//SHOW PRODUCT CATEGORIES THAT DEALER OFFERS
		foreach($product_category_array as $category) {
			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
		}

		//SHOW TESTIMONIALS IF DEALER HAS ANY
		if( isset($testimonials_array) && count($testimonials_array) > 0) {
			echo '<p>"' . $testimonials_array[0]->testimonial_copy . '"<br><a href="' . $installer_base_url . '/about#testimonials">View All Testimonials</a></p>';
		}
	?>
</section>

<?php 
	/******************************* STATIC CAROUSEL FOR OTHER SECTIONS *************************/ 
?>
<section>
	Carousel with Teasers - Static
</section>
