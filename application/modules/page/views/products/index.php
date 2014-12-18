<?php 
    /******************************* OUR PRODUCTS SECTION *************************/ 
?>
<section class="page-row products">
    <header class="intro-statement intro-statement--squeezed">
        <h2 class="normal-weight">Our Products</h2>
        <p>Want to let more light and fresh air into your home? You’re in the right place.</p>
    </header>
    <div class="product-category-wrapper">
        <!-- <?php
        	if( isset($product_category_array) && count($product_category_array) > 0) {
        		foreach($product_category_array as $category) {
        			echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
        			echo filter_page_content($category->product_category_teaser) . '<br><br>';
        		}
        	}
        ?> -->

        <div class="row">
            <!-- <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/residential-skylights.jpg')?>" class="desktop" alt>
                        <img src="<?=asset_url('images/residential-skylights-short.jpg')?>" class="desktop-down" alt>
                    </div>
                </a>
                <h5>Residential Skylights</h5>
                <p>VELUX residential skylights are a great way to add natural light and fresh air to your home. They not only improve your living space, but they also help improve energy efficiency.</p>
                <a class="btn">Learn More</a>
            </div>
            <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/sun-tunnel-skylights.jpg')?>" class="desktop" alt>
                        <img src="<?=asset_url('images/sun-tunnel-skylights-short.jpg')?>" class="desktop-down" alt>
                    </div>
                </a>
                <h5>SUN TUNNEL Skylights</h5>
                <p>If you don't want a sky view or have a small space that needs natural light, choose a fixed skylight or a SUN TUNNEL™ skylight.</p>
                <a class="btn">Learn More</a>
            </div>
            <div class="small-12 medium-4 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/commercial-skylights.jpg')?>" class="desktop" alt>
                        <img src="<?=asset_url('images/commercial-skylights-short.jpg')?>" class="desktop-down" alt>
                    </div>
                </a>
                <h5>Commercial Skylights</h5>
                <p>VELUX commercial skylights not only improve energy efficiency, but they also provide optimal lighting and fresh air to enhance your buildings architectural design and performance.</p>
                <a class="btn">Learn More</a>
            </div> -->
            <div class="small-12 medium-6 large-4 large-push-2 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/residential-skylights.jpg')?>" class="desktop" alt>
                        <img src="<?=asset_url('images/residential-skylights-short.jpg')?>" class="desktop-down" alt>
                    </div>
                </a>
                <h5>Residential Skylights</h5>
                <p>VELUX residential skylights are a great way to add natural light and fresh air to your home. They not only improve your living space, but they also help improve energy efficiency.</p>
                <a class="btn">Learn More</a>
            </div>
            <div class="small-12 medium-6 large-4 large-pull-2 columns product-category">
                <a href="">
                    <div class="polaroid">
                        <img src="<?=asset_url('images/commercial-skylights.jpg')?>" class="desktop" alt>
                        <img src="<?=asset_url('images/commercial-skylights-short.jpg')?>" class="desktop-down" alt>
                    </div>
                </a>
                <h5>Commercial Skylights</h5>
                <p>VELUX commercial skylights not only improve energy efficiency, but they also provide optimal lighting and fresh air to enhance your buildings architectural design and performance.</p>
                <a class="btn">Learn More</a>
            </div>
        </div>
    </div>
</section>

<?php 
    /******************************* ACCESSORIES SECTION *************************/ 
?>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_accessories') : null );?>