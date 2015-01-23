<?php 
    /******************************* BREADCRUMB *************************/ 
?>
<div class="bg-grey border-bottom-grey">
	<?=$this->load->view('partials/_breadcrumb')?>
</div>

<?php 
    /******************************* STATIC CATEGORY HERO WITH CARD *************************/ 
?>
<?php
    /*---------------------------------------------
        Hero Image With Category Card
    ----------------------------------------------*/
?>
<section class="page-row page-row--extra-tall hero hero--residential">
	<div class="row">
		<div class="small-12 large-6 columns">
			<div class="card">
                <div class="card-container">
    				<h2><?= $product_category_array['category']->product_category_name; ?></h2>
    				<p class="font-display"><?= filter_page_content($product_category_array['category']->product_category_description); ?></p>
                </div>
                <div class="bg-grey border-top-grey category-scroll-bar">
                    <?php
                        /*---------------------------------------------
                            Link To First Product Row
                        ----------------------------------------------*/
                        echo "<a href='#" . "'" . " data-btn-scroll>";
                    ?>
                        <div class="category-scroll-button" id="category-scroll-button" data-category-scroll>
                            <i class="icon icon-chevron--down--reversed">
                                <svg class="icon__svg">
                                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-chevron--down--reversed"></use>
                                </svg>
                            </i>
                        </div>
                        <span class="upper no-underline category-scroll-link">View <?= $product_category_array['category']->product_category_name;?></span>
                    </a>
                </div>
			</div>
		</div>
	</div>
</section>
<?php
    /*---------------------------------------------
        End Hero Image With Category Card
    ----------------------------------------------*/
?>

<?php 
    /******************************* SECONDARY NAV *************************/ 
    //Removed 1/16/2015
    //echo $this->load->view('partials/_navigation-secondary');
?>

<?php 
    /******************************* PRODUCT ROWS *************************/ 
?>
<?php
    /*---------------------------------------------
        Generate Product Rows for Category
    ----------------------------------------------*/
    if( count( $product_category_array['subcategory_array']) > 0) {
    	foreach($product_category_array['subcategory_array'] as $subcategory) {
    		//Only display if it has products
    		if(count($subcategory->subcategory_products) > 0) {
	    		$section_id = url_title($subcategory->subcategory_name,'dash',TRUE);
	    		echo '<section class="page-row page-row--category border-top-grey product-row-container" id="' . $section_id . '">' . "\n";
		    		echo '<header class="header-statement">' . "\n";
						echo '<h2 class="upper">' . $subcategory->subcategory_name . '</h2>' . "\n";
					echo '</header>' . "\n";
					echo '<div class="row product-row">' . "\n";
						$count = 0;
						$product_count = count($subcategory->subcategory_products);

						foreach($subcategory->subcategory_products as $product) {
							if($count % 4 == 0) {
								echo '</div>' . "\n";
								echo '<div class="row product-row">' . "\n";
							}
							$count++;

							/*---------------------------------------------
						        Center last product if odd number
						    ----------------------------------------------*/
							/*if($count == $product_count) {
								$last_product_class = $product_count % 2 == 0 ? '' : ' medium-push-3';
							} else {
								$last_product_class = '';
							}*/
							echo '<div class="small-12 medium-3' /*. $last_product_class */. ' columns centered">' . "\n";
								echo '<a href="' . $installer_base_url . '/products/' . $product->product_url . '" class="product-image"><img src="' . $this->config->item('product_images_dir') . $product->product_image . '.' . $product->extension . '" alt></a>' . "\n";
								echo '<a href="' . $installer_base_url . '/products/' . $product->product_url . '" class="product-title">' . $product->product_name . '</a>' . "\n";
								//echo '<p>Curb mounted skylight</p>' . "\n";
								//echo '<img src="' . asset_url('images/stars.png') . '" alt>' . "\n";
							echo '</div>' . "\n";
						}
					echo '</div>' . "\n";
				echo '</section>' . "\n";
			}
    	}
    }
?>

