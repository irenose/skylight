<?php 
	/******************************* INTRO COPY *************************/ 
?>
<section class="page-row intro-statement intro-statement--squeezed">
	<h2>Warranty</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
</section>

<section class="bg-grey-dark page-row reversed">
	<h2>The 10 Year Warranty</h2>
	<p class="text-columns-2 ten-year-warranty">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. <br><br>Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
	<a class="btn">Download PDF</a>
</section>

<?php
	/******************************* IF INSTALLER HAS SEPARATE WARRANTY INFO *************************/ 
	if( isset($warranty_array) && count($warranty_array) > 0) {
?>
	<section class="page-row">
		<h2><?= $installer_array[0]->name; ?> Warranty</h2>
		<p class="text-columns-2 installer-warranty"><?= filter_page_content($warranty_array[0]->dealer_warranty); ?></p>
	</section>
<?php
	}
?>

<!-- <section>
	<h2>Our Products</h2>
	<?php
		//SHOW PRODUCT CATEGORIES THAT DEALER OFFERS
		foreach($product_category_array as $category) {
			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
		}
	?>
</section> -->

<section class="border-top-grey page-row products--short">
	<div class="product-category-wrapper">
        <header class="header-statement">
        	<h2>Our Products</h2>
        </header>
        <div class="row">
            <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/residential-skylights-short.jpg')?>" alt>
                    </div>
                </a>
                <h5>Residential Skylights</h5>
                <p>VELUX residential skylights are a great way to add natural light and fresh air to your home. They not only improve your living space, but they also help improve energy efficiency.</p>
                <a class="btn">Learn More</a>
            </div>
            <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/sun-tunnel-skylights-short.jpg')?>" alt>
                    </div>
                </a>
                <h5>SUN TUNNEL Skylights</h5>
                <p>If you don't want a sky view or have a small space that needs natural light, choose a fixed skylight or a SUN TUNNEL™ skylight.</p>
                <a class="btn">Learn More</a>
            </div>
            <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/commercial-skylights-short.jpg')?>" alt>
                    </div>
                </a>
                <h5>Commercial Skylights</h5>
                <p>VELUX commercial skylights not only improve energy efficiency, but they also provide optimal lighting and fresh air to enhance your buildings architectural design and performance.</p>
                <a class="btn">Learn More</a>
            </div>
        </div>
    </div>
</section>
