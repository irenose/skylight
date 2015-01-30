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
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight"><?= filter_custom_tags('city', $installer_array[0]->dealer_homepage_headline, $installer_array[0]->city); ?></h1>
    </header>
    <div class="row installer-welcome">
        <div class="welcome-hero upgrade">
            <h1 class="reversed upper mega-heading">Add beauty with daylight and fresh air</h1>
        </div>
        <div class="welcome-promotions">
            <div class="promotions-large">
                <?php 
                    //SHOW COMMERCIAL PROMO
                    if(count($product_category_array) == 1 && $product_category_array[0]->product_category_id == 3) {
                        echo '<div class="promotion-large commercial-promo">' . "\n";
                            echo '<h4 class="normal-weight reversed">Create Clean, Comfortable, Bright Work Spaces With VELUX SUN TUNNEL&trade; Skylights.</h4>' . "\n";
                        echo '</div>' . "\n";
                    } else {
                        echo '<div class="promotion-large residential-promo">' . "\n";
                            echo '<h4 class="normal-weight">Add daylight and fresh air for less with the Solar Powered "Fresh Air" skylight</h4>' . "\n";
                            echo '<div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>' . "\n";
                        echo '</div>' . "\n";
                    }
                ?>
            </div>
            <div class="promotions-small">
                <?php
                    if($installer_array[0]->promotion_status == 'active' && trim($installer_array[0]->promotion_headline) != '') {
                        echo '<div class="promotion-small reversed dealer-promo">' . "\n";
                            echo '<h3 class="normal-weight">' . trim($installer_array[0]->promotion_headline) . '</h3>' . "\n";
                            if(trim($installer_array[0]->promotion_callout_copy) != '') {
                                echo '<p>' . trim($installer_array[0]->promotion_callout_copy) . '</p>';
                            }
                            if(trim($installer_array[0]->promotion_page_copy) != '') {
                                echo ' <a href="' . $installer_base_url . '/promotions" class="cta-text">Learn More</a>' . "\n";
                            }
                        echo ' </div>' . "\n";
                        echo '<div class="promotion-small cta schedule-consult">' . "\n";
                            echo '<p class="reversed font-display">Schedule A Consultation</p>' . "\n";
                            echo '<a href="' . $installer_base_url . '/contact/#contact-form" class="cta-text" data-modal-open data-ajax-vars=\'{"view":"partials/_modal-content", "content-type":"contact"}\'>Learn More</a>' . "\n";
                        echo '</div>' . "\n";
                    } else {
                        echo '<div class="promotion-small one-promotion cta schedule-consult">' . "\n";
                            echo '<p class="reversed font-display">Schedule A Consultation</p>' . "\n";
                            echo '<a href="' . $installer_base_url . '/contact/#contact-form" class="cta-text" data-modal-open data-ajax-vars=\'{"view":"partials/_modal-content", "content-type":"contact"}\'>Learn More</a>' . "\n";
                        echo '</div>' . "\n";
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
    /******************************* OUR PRODUCTS *************************/ 

    /*---------------------------------------------
        Only show product categories if installer
        has more than 1
    ----------------------------------------------*/
    if( isset($product_category_array) && count($product_category_array) > 1) {
        echo $this->load->view('partials/_products-short');
    }

    /******************************* OPTIONAL TESTIMONIALS *************************/ 
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
                        <a href="<?=$installer_base_url?>/about#testimonials" class="cta-text">View All Testimonials</a>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
    /*---------------------------------------------
        End Optional Testimonial
    ----------------------------------------------*/
    
    /******************************* DISCOVER MORE *************************/ 
    $data['discover_section'] = 'home';
    echo $this->load->view('partials/_discover-more',$data);
?>
