<!--<?php 
	/******************************* INTRO COPY HEADLINE *************************/ 
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
</section>-->

<section class="bg-grey page-row page-row--snug installer-welcome-wrapper">
	<header class="intro-statement intro-statement--squeezed">
		<h2>A brief installer welcome message can go in this space</h2>
	</header>
	<div class="row installer-welcome">
		<div class="small-12 medium-8 columns welcome-hero">
			<h1 class="reversed">Upgrade Your Home With An Upward View.</h1>
			<button>Learn More</button>
		</div>
		<div class="small-12 medium-4 columns featured-images">
			<div class="promotion-large">
			</div>
			<div class="promotions-small">
				<div class="promotion-small">
				</div>
				<div class="promotion-small">
					<a href=""><img src="<?=asset_url('images/cta.jpg')?>" alt></a>
				</div>
			</div>
		</div>
</section>
<section class="page-row homepage-products">
	<div class="product-category-wrapper">
        <!-- <?php
        	if( isset($product_category_array) && count($product_category_array) > 0) {
        		foreach($product_category_array as $category) {
        			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
        			echo filter_page_content($category->product_category_teaser) . '<br><br>';
        		}
        	}
        ?> -->

        <header class="header-statement">
        	<h2>Our Products</h2>
        </header>
        <div class="product-category">
            <a href="">
                <div class="polaroid">
                    <img src="<?=asset_url('images/residential-skylights-short.jpg')?>" alt>
                </div>
            </a>
            <h5>Residential Skylights</h5>
            <p>VELUX residential skylights are a great way to add natural light and fresh air to your home. They not only improve your living space, but they also help improve energy efficiency.</p>
            <button>Learn More</button>
        </div>
        <div class="product-category">
            <a href="">
                <div class="polaroid">
                    <img src="<?=asset_url('images/sun-tunnel-skylights-short.jpg')?>" alt>
                </div>
            </a>
            <h5>SUN TUNNEL Skylights</h5>
            <p>If you don't want a sky view or have a small space that needs natural light, choose a fixed skylight or a SUN TUNNEL™ skylight.</p>
            <button>Learn More</button>
        </div>
        <div class="product-category">
            <a href="">
                <div class="polaroid">
                    <img src="<?=asset_url('images/commercial-skylights-short.jpg')?>" alt>
                </div>
            </a>
            <h5>Commercial Skylights</h5>
            <p>VELUX commercial skylights not only improve energy efficiency, but they also provide optimal lighting and fresh air to enhance your buildings architectural design and performance.</p>
            <button>Learn More</button>
        </div>
    </div>
</section>
<section class="page-row border-top-grey header-statement header-statement--squeezed">
</section>
<section class="page-row bg-grey centered">
    <h3>Discover More</h3>
    <div class="row discover-more">
    	<div class="small-12 medium-4 columns">
	        <a href="" class="discover-card">
	            <img src="<?=asset_url('images/dealer-locator.jpg')?>" class="" alt>
	        </a>
        </div>
        <div class="small-12 medium-4 columns">
	        <a href="" class="discover-card">
	            <img src="<?=asset_url('images/skylight-planner.jpg')?>" class="" alt>
	        </a>
        </div>
        <div class="small-12 medium-4 columns">
	        <a href="" class="discover-card">
	            <img src="<?=asset_url('images/articles.jpg')?>" class="" alt>
	        </a>
        </div>
    </div>
</section>