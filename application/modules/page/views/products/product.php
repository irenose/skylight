<?php 
    /******************************* BREADCRUMB *************************/ 
?>
<div class="bg-grey border-bottom-grey">
<?=$this->load->view('partials/_breadcrumb')?>
</div>
<section class="page-row product-detail">
	<div class="row">
		<div class="small-12 medium-5 columns product-images">
			<?php
				echo '<img src="' . $this->config->item('product_images_dir') . $product_info_array[0]->product_image . '.' . $product_info_array[0]->extension . '" class="product-image" alt="' . $product_info_array[0]->product_name . '">';
			?>
            <div class="product-icon-wrapper">
                <ul class="product-icons">
                    <li><img src="<?=asset_url('images/cards/new.jpg')?>" alt></li>
                    <li><img src="<?=asset_url('images/cards/water-droplets.jpg')?>" alt></li>
                </ul>
            </div>
            <div class="product-accreditations-wrapper">
                <ul class="product-accreditations">
                    <li>
                        <?=$this->load->view('partials/_svg-icon-no-leak.php');?>
                    </li>
                    <li>
                        <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
                    </li>
                </ul>
            </div>
		</div>
		<div class="small-12 medium-7 columns product-description">
            <p class="product-category">Fresh Air Skylights</p>
			<?php
				echo '<h1>' . filter_page_content($product_info_array[0]->product_name) . '</h1>' . "\n";
				echo '<p>' . filter_page_content($product_info_array[0]->product_description) . '</p>' . "\n";
				//echo '<p><a href="' . $installer_base_url . '/contact" data-modal-open data-ajax-vars="{\'view\':\'partials/_modal-content\', \'content-type\':\'contact\'}">Contact Us (Modal)</a></p>';
			?>
			<a href="#" class="btn">Learn More</a>
		</div>
	</div>
</section>

<?php 
    /******************************* PRODUCT CARDS *************************/ 
?>
<section class="bg-grey top-shadow product-cards">
    <div class="constrained slick-carousel-cards">
		<div class="product-card-wrapper small-12 medium-4 columns">
			<div class="product-card">
				<span class="img-wrapper"><img src="<?=asset_url('images/cards/new.jpg')?>" alt></span>
				<h3>Easily Replace an<br>Old Skylight</h3>
				<p>Solar Powered “Fresh Air” skylights can easily replace a fixed or manual skylight easily because no wiring is required.</p>
			</div>
		</div>
		<div class="product-card-wrapper small-12 medium-4 columns">
			<div class="product-card">
				<span class="img-wrapper"><img src="<?=asset_url('images/cards/water-droplets.jpg')?>" alt></span>
				<h3>Clean, Quiet &#38;<br>Safe Glass</h3>
				<p>All Solar Powered “Fresh Air” skylights come standard with Clean, Quiet &#38; Safe glass.</p>
			</div>
		</div>
		<div class="product-card-wrapper small-12 medium-4 columns">
			<div class="product-card">
				<span class="img-wrapper"><img src="<?=asset_url('images/cards/pick-and-click.jpg')?>" alt></span>
				<h3>Easy Pick&#38;Click&#153;<br>Blind Installations</h3>
				<p>A sunscreen accessory tray for standard site-built curbs allows for installation of VELUX Pick&#38;Click!&#153; blinds.</p>
			</div>
        </div>
    </div>
</section>

<?php 
    /******************************* TAX CREDITS *************************/ 
?>
<section class="page-row page-row--extra-tall replacing">
    <div class="row">
        <div class="small-12 medium-6 columns reversed first">
            <h2 class="upper">Take advantage of a 30% federal tax credit</h2>
            <p>The Solar Powered “Fresh Air” Skylight is the greatest value for your money, especially when you take advantage of the 30% federal tax credit. This tax credit is applicable on the skylight and installation of your Solar Powered “Fresh Air” Skylight. You could save an average of $850 with federal tax credit eligibility.</p>
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
    /******************************* TAX CREDITS *************************/ 
?>
<section class="page-row page-row--tall blinds">
	<div class="row">
		<div class="small-12 medium-5 medium-push-7 columns">
			<h2 class="upper">Add Solar Blinds for An Addational Tax Credit</h2>
			<p>Add VELUX solar blinds – also powered by a small PV solar panel – and receive another 30 percent tax credit on product and installation. In addition to savings, solar blinds give you control over the light and improve your skylight's energy performance.</p>
			<a href="#" class="btn">More On Blinds</a>
		</div>
	</div>
</section>

<?php 
    /******************************* NO LEAK *************************/ 
?>
<section class="page-row page-row--tall centered reversed no-leak">
	<header class="header-statement header-statement--squeezed">
		<?=$this->load->view('partials/_svg-icon-no-leak.php');?>
        <h2 class="upper">The Velux No Leak Skylight Gives You Peace of Mind</h2>
        <p class="reversed">The Solar Powered “Fresh Air” Skylight comes with the No Leak Promise, a 10-year warranty on product and installation, so you’ll never have to worry.</p>
        <a href="#" class="btn">Learn More</a>
	</header>
</section>
<section>
	RATINGS
</section>