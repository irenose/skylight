<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row bg-grey intro-statement intro-statement--squeezed">
    <h1 class="normal-weight">Warranty</h1>
    <p>We believe the best warranty is the one you never have to use; therefore, we build quality into every product. However, if you should have an issue, please reference the warranty information below. </p>
</section>

<?php 
    /******************************* 10 YEAR WARRANTY *************************/ 
?>
<section class="page-row snug-bottom bg-grey-dark reversed 10-year-warranty after-installation">
    <div class="small-12 medium-6 medium-push-6 columns last">
        <div class="brochure">
            <img src="<?=asset_url('images/brochure.png')?>" class="" alt>
        </div>
    </div>
    <div class="small-12 medium-6 medium-pull-6 columns first reversed">
        <h2 class="upper normal-weight">The VELUX Warranty</h2>
        <p class="ten-year-warranty">As the world leader in roof windows and skylights, we stand behind our products with a promise of lasting service and quality. We do offer the VELUX 20/10/5 years limited product warranty for specific product coverage issues. If you have concerns about your VELUX products that may require a warranty claim, the warranty brochure includes specific steps for you to follow that will help VELUX better assist you.</p>
        <a href="<?=site_url('content-uploads/resources/product-warranty.pdf')?>" class="btn" target="_blank">Download PDF</a>
    </div>
</section>

<?php
    /******************************* OPTIONAL INSTALLER WARRANTY *************************/ 
    if( isset($warranty_array) && count($warranty_array) > 0 && trim($warranty_array[0]->dealer_warranty) != '') {
?>
<?php
    /*---------------------------------------------
        Installer Warranty
    ----------------------------------------------*/
?> 
    <section class="page-row installer-warranty">
        <h2 class="upper normal-weight"><?= $installer_array[0]->name; ?> Warranty</h2>
        <p class="text-columns-2 installer-warranty"><?= filter_page_content($warranty_array[0]->dealer_warranty); ?></p>
    </section> 
<?php
    /*---------------------------------------------
        End Installer Warranty
    ----------------------------------------------*/
?>
<?php
    }
?>

<div class="border-top-grey"></div>

<?php
    /******************************* OUR PRODUCTS *************************/ 

    /*---------------------------------------------
        Only show product categories if installer
        has more than 1
    ----------------------------------------------*/
    if( isset($product_category_array) && count($product_category_array) > 1) {
        echo $this->load->view('partials/_products-short');
    }

?>
