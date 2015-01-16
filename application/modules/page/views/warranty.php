<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row bg-grey intro-statement intro-statement--squeezed">
    <h1 class="normal-weight">Warranty</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
</section>

<?php 
    /******************************* 10 YEAR WARRANTY *************************/ 
?>
<section class="page-row bg-grey-dark reversed 10-year-warranty after-installation">
    <h2 class="normal-weight upper">The VELUX 10 Year Warranty</h2>
    <p class="text-columns-2 ten-year-warranty">As the world leader in skylights, we’ve stood behind our products for over 50 years with a promise of lasting service and quality. And we still do to this day with our VELUX 20/10/5 years limited product warranties for specific product coverage issues. As well as, a 10-year “No Leak” installation warranty on deck mounted skylights. This covers correct skylight and flashing installation (product and labor) against leaks. If you have any questions about these warranties, want to read all the details or have concerns about your VELUX products that may require a warranty claim, or ask your 5-Star Skylight Specialist.</p>
    <a href="<?=site_url('content-uploads/resources/product-warranty.pdf')?>" class="btn">Download PDF</a>
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
        <h2 class="normal-weight upper"><?= $installer_array[0]->name; ?> Warranty</h2>
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
