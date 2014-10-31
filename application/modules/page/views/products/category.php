<?php 
	/******************************* CAROUSEL AND INTRO COPY *************************/ 
?>
<section>
	MANUALLY CREATED CAROUSEL OF <?= $product_category_array['category']->product_category_name; ?> PHOTOS
	<h1><?= $product_category_array['category']->product_category_name; ?></h1>
	<p><?= $product_category_array['category']->product_category_description; ?></p>
</section>

<?php 
	/******************************* PRODUCT AND SUBCATEGORY LISTING *************************/ 
	if( count( $product_category_array['subcategory_array']) > 0) {
		$subnav = '';
		$listing_content = '';

		foreach($product_category_array['subcategory_array'] as $subcategory) {
			//Add Subcategory to subnav
			$subnav .= '<a href="#' . $subcategory->subcategory_url . '">' . $subcategory->subcategory_name . '</a>&nbsp;&nbsp;';

			//Add Headline for Subcategory
			$listing_content .= '<h2 id="' . $subcategory->subcategory_url . '">' . $subcategory->subcategory_name . '</h2>';
			foreach($subcategory->subcategory_products as $product) {
				//Create a product listing
				$listing_content .= '<a href="' . $installer_base_url . '/products/' . $product->product_url . '">' . $product->product_name . '</a><br>';
			}
		}

		//Display Subnav
		echo $subnav; 
		//Display Product Listing
		echo $listing_content;
	}
?>