<?php 
    //Load Bazaarvoice JS
    if(isset($display_bazaarvoice) && $display_bazaarvoice === TRUE) {
        echo $this->load->view('partials/_bz-javascript-init');
    }

    /*---------------------------------------------
        Carousel Photos
    ----------------------------------------------*/
    switch($product_category_array['category']->product_category_id) {
        case 1:
            $carousel_array = array('hero--suntunnel-1','hero--suntunnel-2');
            break;
        case 2:
            $carousel_array = array('hero--residential-1','hero--residential-2','hero--residential-3');
            break;
        case 3:
            $carousel_array = array('hero--commercial-1','hero--commercial-2');
            break;
    }
    /******************************* BREADCRUMB *************************/ 

if( count( $product_category_array['subcategory_array']) > 0) :
?>
<script>
    $BV.ui( 'rr', 'inline_ratings', {
        productIds : {
<?php
        $count = 0;
        foreach($product_category_array['subcategory_array'] as $subcategory) :
            foreach($subcategory->subcategory_products as $product) :
                $count++;
?>

        'productId-prod-<?=$product->product_id?>' : {
            url : '<?=$installer_base_url?>/products/<?=$product->product_url?>',
            containerId : 'BVRRInlineRating-prod-<?=$product->product_id?>'
        },
<?php 
            endforeach;
        endforeach;
?>

        },
    });
</script>
<?php
    endif;
?>

<div class="bg-grey border-bottom-grey breadcrumb">
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
<section>
    <div class="row hero">
        <div class="slick slick__category">
            <?php 
                foreach($carousel_array as $key => $value) {
                    echo '<div class="page-row slick__item ' . $value . '"></div>';
                }
            ?>
        </div>
        <div class="card card--carousel">
            <div class="card-container">
                <h2 class="normal-weight"><?= $product_category_array['category']->product_category_name; ?></h2>
                <p><?= filter_page_content($product_category_array['category']->product_category_description); ?></p>
            </div>
            <div class="bg-grey border-top-grey category-scroll-bar">
                <?php
                    /*---------------------------------------------
                        Link To First Product Row
                    ----------------------------------------------*/
                    if( count($product_category_array['subcategory_array']) > 0) {
                        echo '<a href="#' . url_title($product_category_array['subcategory_array'][0]->subcategory_name, 'dash', TRUE) . '" data-btn-scroll>';
                    ?>
                        <div class="category-scroll-button" id="category-scroll-button" data-category-scroll>
                            <i class="icon icon-chevron--down--reversed">
                                <svg class="icon__svg">
                                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-chevron--down--reversed"></use>
                                </svg>
                            </i>
                        </div>
                        <span class="upper no-underline category-scroll-link">View <?= $product_category_array['category']->product_category_name;?></span>
                    <?php
                        echo '</a>';
                        }
                    ?>
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
                if($subcategory->subcategory_id != '18' || ($subcategory->subcategory_id == 18 && $installer_array[0]->sells_vms == 'yes')) {
    	    		$section_id = url_title($subcategory->subcategory_name,'dash',TRUE);
    	    		echo '<section class="page-row page-row--category border-top-grey product-row-container" id="' . $section_id . '">' . "\n";
    		    		echo '<header class="header-statement">' . "\n";
    						echo '<h2 class="upper normal-weight">' . $subcategory->subcategory_name . '</h2>' . "\n";
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

                                    //Bazaarvoice Container
                                    echo '<div id="BVRRInlineRating-prod-' . $product->product_id . '" class="centered" style="background:#000;"></div>';
    							echo '</div>' . "\n";
    						}
    					echo '</div>' . "\n";
    				echo '</section>' . "\n";
                } //END VMS Check
			}
    	}
    }
?>

