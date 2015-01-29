<?php
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
			<?php
				/*
					HIDING FOR NOW 1-20-15
		            <div class="product-icon-wrapper">
		                <ul class="product-icons">
		                    <li><img src="<?=asset_url('images/cards/new.jpg')?>" alt></li>
		                    <li><img src="<?=asset_url('images/cards/water-droplets.jpg')?>" alt></li>
		                </ul>
		            </div>
            	*/
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
				echo '<h1>' . filter_page_content($product_info_array[0]->product_name) . '</h1>' . "\n";
				echo '<div class="product-description--text">' . filter_page_content($product_info_array[0]->product_description) . '</div>' . "\n";
			?>
			<a href="' . $installer_base_url . '/contact" data-modal-open data-ajax-vars="{\'view\':\'partials/_modal-content\', \'content-type\':\'contact\'}" class="btn">Learn More</a>
		</div>
	</div>
</section>
<section class="page-row blinds-carousel">
    <header class="centered">
        <h2 class="reversed text-shadow upper">
            Types of skylight blinds
        </h2>
    </header>
    <ul class="slick" data-carousel-init="auto" data-carousel-type="benefits" data-slides-to-show="4" data-equal-heights>
        <?php foreach ($blinds_array as $value): ?>
        <li class="slick__item">
            <div class="card shadowed">
                <div class="card__body">
                    <span class="img-wrapper">
                        <img src="<?=$value['img']['src']?>" alt="<?=$value['img']['alt']?>">
                    </span>
                    <h3>
                        <?=$value['heading']?>
                    </h3>
                    <p>
                        <?=$value['text']?>
                    </p>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php
    $swatches = $this->blinds->get_swatches(array('categorized' => false));
    $my_swatches = array();
    $swatch_keys = array_rand($swatches, 20);

    foreach ($swatch_keys as $key) {
        $my_swatches[] = $swatches[$key];
    }
?>
<section class="page-row snug-bottom swatch-carousel">
    <header class="header-statement header-statement--squeezed centered">
        <h2 class="upper">
            <span class="br">Reflect your home's</span> personality and style
        </h2>
        <p>
            Regardless of which VELUX skylight model you select, you'll receive a choice of eight different factory installed blinds, or choose from more than 80 special order blinds.
        </p>
    </header>
    <div class="push-top--half push-bottom--half">
        <ul class="slick" data-carousel-init="auto" data-carousel-type="swatches" data-slides-to-show="7" style="max-height: 250px;">
            <?php foreach ($my_swatches as $_file): ?>
            <?php $label = $this->blinds->format_swatch_label($_file); ?>
            <li class="centered slick__item">
                <img src="<?=asset_url('images/blinds/swatches/'.$_file)?>" alt="">
                <span class="swatch-number">
                    <?=$label['number']?>
                </span>
                <span class="swatch-name">
                    <?=$label['name']?>
                </span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php
    /******************************* NO LEAK *************************/
?>
<section class="page-row page-row--tall centered reversed no-leak">
	<header class="header-statement header-statement--squeezed">
		<?=$this->load->view('partials/_svg-icon-no-leak.php');?>
        <h2 class="upper normal-weight">The Velux No Leak Skylight Gives You Peace of Mind</h2>
        <p class="reversed">As the world leader in roof windows and skylights, we stand behind our products with a promise of lasting service and quality. We do offer the VELUX 20/10/5 years limited product warranty for specific product coverage issues. If you have concerns about your VELUX products that may require a warranty claim, the warranty brochure includes specific steps for you to follow that will help VELUX better assist you.</p>
        <a class="btn" href="<?=$installer_base_url?>/warranty">Learn More</a>
	</header>
</section>