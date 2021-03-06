<?php
    //Load Bazaarvoice JS
    if(isset($display_bazaarvoice) && $display_bazaarvoice === TRUE) {
        echo $this->load->view('partials/_bz-javascript-init');
    }

    /******************************* BREADCRUMB *************************/
?>
<div class="bg-grey border-bottom-grey breadcrumb">
	<?=$this->load->view('partials/_breadcrumb')?>
</div>
<section class="page-row product-detail">
	<div class="row">
		<div class="small-12 medium-5 columns product-images">
			<?php
				echo '<img src="' . $this->config->item('product_images_dir') . $product_info_array[0]->product_image . '.' . $product_info_array[0]->extension . '" class="product-image" alt="' . $product_info_array[0]->product_name . '">';
			?>
            <div class="product-accreditations-wrapper">
                <ul class="product-accreditations">
                	<?php
                		if ($product_info_array[0]->no_leak_flag == 'yes') {
                			echo '<li>';
                			echo $this->load->view('partials/_svg-icon-no-leak');
                			echo '</li>' . "\n";
                		}
                		if ($product_info_array[0]->tax_credit == 'yes') {
                			echo '<li><div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div></li>' . "\n";
                		}
                	?>
                </ul>
            </div>
		</div>
		<div class="small-12 medium-7 columns product-description">
            <p class="product-category"><?=$product_info_array[0]->product_subcategory_name?></p>
			<?php
				echo '<h1 class="normal-weight">' . filter_page_content($product_info_array[0]->product_name) . '</h1>' . "\n";
                //echo '<div id="BVRRSummaryContainer"></div>';
				echo '<div class="product-description--text">' . filter_page_content($product_info_array[0]->product_description) . '</div>' . "\n";
			?>

            <?php if( !isset($hide_learn_more) || $hide_learn_more == FALSE) { ?>
			     <a href="<?=$installer_base_url?>/contact/product/<?=$product_info_array[0]->product_url?>" data-modal-open data-ajax-vars="{\'view\':\'partials/_modal-content\', \'content-type\':\'contact\'}" class="btn">Learn More</a>
            <?php } ?>
		</div>
	</div>
</section>

<?php
    /******************************* PRODUCT CARDS *************************/
    $product_cards_category_array = array(6,7,8,17);
    if (in_array($product_info_array[0]->primary_category_id, $product_cards_category_array) || $product_info_array[0]->product_id == 37) {

        if($product_info_array[0]->product_id == 37) {
            $data['display_group'] = 'instant-light-shaft';
        } else {
        	switch($product_info_array[0]->primary_category_id) {
        		case 6:
        			$data['display_group'] = 'electric-fresh-air';
        			break;
        		case 7:
        			$data['display_group'] = 'manual-fresh-air';
        			break;
        		case 8:
        			$data['display_group'] = 'fixed';
        			break;
        		case 17:
        			$data['display_group'] = 'solar-fresh-air';
        			break;

        	}
        }
?>
		<section class="page-row bg-grey top-shadow product-cards">
		    <div class="constrained">
                <div data-carousel-init="auto" data-carousel-type="product-cards" data-slides-to-show="3" data-equal-heights>
    				<?php
    					echo $this->load->view('partials/_product-cards',$data);
    				?>
                </div>
		    </div>
		</section>

<?php
	}
    if($product_info_array[0]->product_category_id == 2) {
    /******************************* TAX CREDITS *************************/
?>
        <section class="page-row page-row--extra-tall replacing">
            <div class="row">
                <div class="small-12 medium-6 columns reversed first">
                    <h2 class="upper normal-weight">Take advantage of a 30% federal tax credit</h2>
                    <p>The Solar Powered "Fresh Air" Skylight is the greatest value for your money, especially when you take advantage of the 30% federal tax credit. This tax credit is applicable on the skylight and installation of your Solar Powered "Fresh Air" Skylight. You could save an average of $850 with federal tax credit eligibility.</p>
                </div>
                <div class="small-12 medium-6 columns centered last">
                    <div class="incentives">
                        <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
                        <div class="incentive"><span class="big">$100</span><br>average savings<br>to solar from<br>fixed</div>
                        <div class="incentive"><span class="big">$340</span><br>savings with<br>solar over<br>manual</div>
                    </div>
                </div>
            </div>
        </section>

        <?php
            /******************************* SOLAR TAX CREDIT *************************/
        ?>
        <section class="page-row page-row--tall blinds">
        	<div class="row">
        		<div class="small-12 medium-5 medium-push-7 columns">
        			<h2 class="upper normal-weight">Add Solar Blinds for An Additional Tax Credit</h2>
        			<p>Add VELUX solar blinds – also powered by a small PV solar panel – and receive another 30 percent tax credit on product and installation. In addition to savings, solar blinds give you control over the light and improve your skylight's energy performance.</p>
        			<a href="<?=$installer_base_url?>/products/blinds" class="btn">More On Blinds</a>
        		</div>
        	</div>
        </section>

<?php
    }
    /******************************* NO LEAK *************************/
    if($product_info_array[0]->product_category_id == 2 || $product_info_array[0]->product_category_id == 1) {
?>
        <section class="page-row page-row--tall centered reversed no-leak">
        	<header class="header-statement header-statement--squeezed">
        		<?=$this->load->view('partials/_svg-icon-no-leak.php');?>
                <h2 class="upper normal-weight">The Velux No Leak Skylight Gives You Peace of Mind</h2>
                <p class="reversed">As the world leader in roof windows and skylights, we stand behind our products with a promise of lasting service and quality. We do offer the VELUX 20/10/5 years limited product warranty for specific product coverage issues. If you have concerns about your VELUX products that may require a warranty claim, the warranty brochure includes specific steps for you to follow that will help VELUX better assist you.</p>
                <a class="btn" href="<?=$installer_base_url?>/warranty">Learn More</a>
        	</header>
        </section>
<?php
    }
    if( isset($display_bazaarvoice) && $display_bazaarvoice === TRUE) {
        
        echo '<section class="page-row page-row--tall">' . "\n";
            echo '<div class="row">' . "\n";
                echo '<div class="small-12">' . "\n";
                    $data['product'] = $product_info_array[0];
                    $data['bz_product_url'] = $canonical_url;
                    echo $this->load->view('partials/_bz-product-reviews', $data);
                echo '</div>' . "\n";
            echo '</div>' . "\n";
        echo '</section>' . "\n";
        
    }
?>
