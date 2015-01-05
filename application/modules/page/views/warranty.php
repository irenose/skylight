<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row bg-grey intro-statement intro-statement--squeezed">
    <h3 class="normal-weight">Warranty</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
</section>

<?php 
    /******************************* 10 YEAR WARRANTY *************************/ 
?>
<section class="page-row bg-grey-dark reversed 10-year-warranty">
    <h3 class="normal-weight upper">The 10 Year Warranty</h3>
    <p class="text-columns-2 ten-year-warranty">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. <br><br>Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
    <a class="btn">Download PDF</a>
</section>

<?php
    /******************************* OPTIONAL INSTALLER WARRANTY *************************/ 
    if( isset($warranty_array) && count($warranty_array) > 0) {
?>
<?php
    /*---------------------------------------------
        Installer Warranty
    ----------------------------------------------*/
?> 
    <section class="page-row installer-warranty">
        <h3 class="normal-weight upper"><?= $installer_array[0]->name; ?> Warranty</h3>
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
