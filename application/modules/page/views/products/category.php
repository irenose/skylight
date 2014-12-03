<!-- <?php 
	/******************************* CAROUSEL AND INTRO COPY *************************/ 
?>
<section>
	MANUALLY CREATED CAROUSEL OF <?= $product_category_array['category']->product_category_name; ?> PHOTOS
	<h1><?= $product_category_array['category']->product_category_name; ?></h1>
	<p><?= $product_category_array['category']->product_category_description; ?></p>
</section>

<?php 
	/******************************* PRODUCT AND SUBCATEGORY LISTING *************************/ 
	if( count( $product_category_array['subcategory_array']) > 0) {
		$subnav = '';
		$listing_content = '';

		foreach($product_category_array['subcategory_array'] as $subcategory) {
			//Add Subcategory to subnav
			$subnav .= '<a href="#' . $subcategory->subcategory_url . '">' . $subcategory->subcategory_name . '</a>&nbsp;&nbsp;';

			//Add Headline for Subcategory
			$listing_content .= '<h2 id="' . $subcategory->subcategory_url . '">' . $subcategory->subcategory_name . '</h2>';
			foreach($subcategory->subcategory_products as $product) {
				//Create a product listing
				$listing_content .= '<a href="' . $installer_base_url . '/products/' . $product->product_url . '">' . $product->product_name . '</a><br>';
			}
		}

		//Display Subnav
		echo $subnav; 
		//Display Product Listing
		echo $listing_content;
	}
?> -->

<div class="breadcrumb">
	<nav class="nav-breadcrumb">
		<a>Installer Name</a> / <a>Our Products</a> / Product Category
	</nav>
	<div class="breadcrumb-links">
		<a>Schedule a Consultation</a>
		<a><span class="dotted">Have Questions or Comments?</span></a>
	</div>
</div>
<section class="page-row page-row--tall hero hero--residential">
	<div class="row">
		<div class="small-12 large-6 columns">
			<div class="vcard">
				<h3>Residential Skylights</h3>
				<p>VELUX residential skylights are a great way to add natural light and fresh air to your home. They not only improve your living space, but they also help improve energy efficiency.</p>
			</div>
		</div>
	</div>
</section>
<?=$this->load->view('partials/_navigation-secondary')?>
<section class="page-row page-row--squeezed">
	<div class="header-statement">
		<h3>Solar Powered "Fresh Air" Skylights</h3>
	</div>
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
<section class="border-top-grey page-row page-row--squeezed">
	<div class="header-statement">
		<h3>Solar Powered "Fresh Air" Skylights</h3>
	</div>
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
<section class="border-top-grey page-row page-row--squeezed">
	<div class="header-statement">
		<h3>Solar Powered "Fresh Air" Skylights</h3>
	</div>
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
<section class="border-top-grey page-row page-row--squeezed">
	<div class="header-statement">
		<h3>Solar Powered "Fresh Air" Skylights</h3>
	</div>
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
<section class="page-row page-row--snug">
    <div class="header-statement">
        <h3>Accessories</h3>
    </div>
    <div class="row accessories">
        <div class="small-12 medium-6 large-3 columns">
            <a href=""><img src="<?=asset_url('images/blinds.png')?>" alt></a>
            <h5>Blinds</h5>
            <a href="">Learn More</a>
        </div>
        <div class="small-12 medium-6 large-3 columns">
            <a href=""><img src="<?=asset_url('images/glass.png')?>" alt></a>
            <h5>Clean, Quiet &amp; Safe Glass</h5>
            <a href="">Learn More</a>
        </div>
        <div class="small-12 medium-6 large-3 columns">
            <a href=""><img src="<?=asset_url('images/remotes.png')?>" alt></a>
            <h5>Remote Controls</h5>
            <a href="">Learn More</a>
        </div>
        <div class="small-12 medium-6 large-3 columns">
            <a href=""><img src="<?=asset_url('images/flashing.png')?>" alt></a>
            <h5>Flashing</h5>
            <a href="">Learn More</a>
        </div>
    </div>
</section>
