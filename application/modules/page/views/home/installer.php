<!-- <?php 
	/******************************* OUR PRODUCTS SECTION *************************/ 
?>
<section>
	<h2>Our Products</h2>
	<?php
		//SHOW PRODUCT CATEGORIES THAT DEALER OFFERS
		foreach($product_category_array as $category) {
			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
		}
?> -->


<?php
	/******************************* STATIC WELCOME AREA *************************/ 
?>

<section class="page-row page-row--snug bg-grey installer-welcome-wrapper">
<?php
    /*---------------------------------------------
        Intro Copy Headline
    ----------------------------------------------*/
?>
    <header class="intro-statement intro-statement--squeezed">
        <h2 class="normal-weight"><?=$installer_array[0]->about_dealer_headline?></h2>
	</header>
<?php
    /*---------------------------------------------
        End Intro Copy Headline
    ----------------------------------------------*/
?>
	<div class="row installer-welcome">
		<div class="small-12 large-6 columns welcome-hero upgrade">
			<h1 class="reversed upper">Upgrade Your Home With An Upward View.</h1>
			<a href="" class="btn">Learn More</a>
		</div>
		<div class="small-12 large-6 columns featured-images">
			<div class="promotion-large fresh-air">
                <h5 class="normal-weight">Solar Powered “Fresh Air” Skylight</h5>
                <a href="">Learn More</a>
                <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
			</div>
		</div>
        <div class="promotions-small">
            <div class="promotion-small reversed dealer-promo">
                <h3 class="normal-weight">Save 20%</h3>
                <p>Dealer Managed Promo goes here</p>
                <a href="">Learn More</a>
            </div>
            <div class="promotion-small cta">
                <p class="reversed font-display">Schedule A Consultation</p>
                <a href="" data-modal-open data-ajax-vars='{"view":"partials/_modal-content", "content-type":"contact"}'>Learn More</a>
            </div>
        </div>
    </div>
</section>

<?php
    /******************************* OUR PRODUCTS SECTION *************************/ 
?>

<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_products-short') : null );?>

<?php
    /******************************* OPTIONAL TESTIMONIALS SECTION *************************/ 
?>
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

<?php
    /******************************* DISCOVER MORE SECTION *************************/ 
?>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_discover-more') : null );?>