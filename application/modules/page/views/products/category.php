<?php 
    /******************************* BREADCRUMB *************************/ 
?>
<?=$this->load->view('partials/_breadcrumb')?>

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
				<h3><?= $product_category_array['category']->product_category_name; ?></h3>
				<p class="font-display"><?= filter_page_content($product_category_array['category']->product_category_description); ?></p>
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
?>
<?=$this->load->view('partials/_navigation-secondary')?>

<?php 
    /******************************* PRODUCT ROWS *************************/ 
?>
<?php
    /*---------------------------------------------
        Generate Product Rows for Category
    ----------------------------------------------*/
    if( count( $product_category_array['subcategory_array']) > 0) {
    	foreach($product_category_array['subcategory_array'] as $subcategory) {
    		echo '<section class="page-row page-row--squeezed border-top-grey product-row-container">' . "\n";
	    		echo '<header class="header-statement">' . "\n";
					echo '<h3 class="upper">' . $subcategory->subcategory_name . '</h3>' . "\n";
				echo '</header>' . "\n";
				echo '<div class="row product-row">' . "\n";
					$count = 0;
					foreach($subcategory->subcategory_products as $product) {
						if($count % 2 == 0) {
							echo '</div>' . "\n";
							echo '<div class="row product-row">' . "\n";
						}
						$count++;
						echo '<div class="small-12 medium-6 columns centered">' . "\n";
							echo '<a href="' . $installer_base_url . '/products/' . $product->product_url . '" class="product-image"><img src="' . asset_url('images/solar-powered-1.jpg') . '" alt></a>' . "\n";
							echo '<a href="' . $installer_base_url . '/products/' . $product->product_url . '" class="product-title">' . $product->product_name . '</a>' . "\n";
							//echo '<p>Curb mounted skylight</p>' . "\n";
							//echo '<img src="' . asset_url('images/stars.png') . '" alt>' . "\n";
						echo '</div>' . "\n";
					}
				echo '</div>' . "\n";
			echo '</section>' . "\n";
    	}
    }
?>

<!--
<section class="page-row page-row--squeezed border-top-grey product-row-container">
	<header class="header-statement">
		<h3 class="upper">Solar Powered "Fresh Air" Skylights</h3>
	</header>
	<div class="row product-row">
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-1.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VCS)</a>
			<p>Curb mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-2.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VSS)</a>
			<p>Deck mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
	</div>
</section>
<?php
    /*---------------------------------------------
        End Product Rows
    ----------------------------------------------*/
?>
<section class="page-row page-row--squeezed border-top-grey product-row-container">
	<header class="header-statement">
		<h3 class="upper">Solar Powered "Fresh Air" Skylights</h3>
	</header>
	<div class="row product-row">
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-1.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VCS)</a>
			<p>Curb mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-2.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VSS)</a>
			<p>Deck mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
	</div>
</section>
<section class="page-row page-row--squeezed border-top-grey product-row-container">
	<header class="header-statement">
		<h3 class="upper">Solar Powered "Fresh Air" Skylights</h3>
	</header>
	<div class="row product-row">
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-1.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VCS)</a>
			<p>Curb mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-2.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VSS)</a>
			<p>Deck mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
	</div>
</section>
<section class="page-row page-row--squeezed border-top-grey product-row-container">
	<header class="header-statement">
		<h3 class="upper">Solar Powered "Fresh Air" Skylights</h3>
	</header>
	<div class="row product-row">
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-1.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VCS)</a>
			<p>Curb mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
		<div class="small-12 medium-6 columns centered">
			<a href="" class="product-image"><img src="<?=asset_url('images/solar-powered-2.jpg')?>" alt></a>
			<a class="product-title">Solar Powered "Fresh Air" Skylight (VSS)</a>
			<p>Deck mounted skylight</p>
			<img src="<?=asset_url('images/stars.png')?>" alt>
		</div>
	</div>
</section>
-->

<?php 
    /******************************* ACCESSORIES *************************/ 
?>
<div class="border-top-grey"></div>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_accessories') : null );?>