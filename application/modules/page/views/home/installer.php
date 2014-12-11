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

<section class="page-row page-row--snug bg-grey installer-welcome-wrapper">
	<header class="intro-statement intro-statement--squeezed">
		<h2><?=$installer_array[0]->about_dealer_headline?></h2>
	</header>
	<div class="row installer-welcome">
		<div class="small-12 large-6 columns welcome-hero upgrade">
			<h1 class="reversed">Upgrade Your Home With An Upward View.</h1>
			<a href="" class="btn">Learn More</a>
		</div>
		<div class="small-12 large-6 columns featured-images">
			<div class="promotion-large fresh-air">
                <h5>Solar Powered “Fresh Air” Skylight</h5>
                <a href="">Learn More</a>
			</div>
		</div>
        <div class="promotions-small">
            <div class="promotion-small reversed dealer-promo">
                <h3>Save 20%</h3>
                <p>Dealer Managed Promo goes here</p>
                <a href="">Learn More</a>
            </div>
            <div class="promotion-small cta">
                <p class="reversed">Schedule A Consultation</p>
                <a href="">Learn More</a>
            </div>
        </div>
</section>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_products-short') : null );?>
<?php
    /*---------------------------------------------
        Show Testimonial if installer has any
    ----------------------------------------------*/
    if( isset($testimonials_array) && count($testimonials_array) > 0) {
?>
        <section class="page-row border-top-grey">
        	<div class="testimonial-carousel header-statement">
        		<div class="slick">
        			<div class="slick-list">
        				<div class="testimonial">
        					<p><?=filter_page_content($testimonials_array[0]->testimonial_copy)?></p>
        				</div>
        			</div>
        			<div class="testimonial-link">
        				<a href="<?=$installer_base_url?>/about#testimonials">View All Testimonials</a>
        			</div>
        		</div>
        	</div>
        </section>
<?php
    }
    /*---------------------------------------------
        End Optional Testimonial
    ----------------------------------------------*/
?>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_discover-more') : null );?>