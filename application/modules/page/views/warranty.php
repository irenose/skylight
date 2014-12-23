<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row intro-statement intro-statement--squeezed">
    <h2 class="normal-weight">Warranty</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
</section>

<?php 
    /******************************* 10 YEAR WARRANTY *************************/ 
?>
<section class="page-row bg-grey-dark reversed 10-year-warranty">
    <h2 class="normal-weight">The 10 Year Warranty</h2>
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
        <h2 class="normal-weight"><?= $installer_array[0]->name; ?> Warranty</h2>
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

<!-- <section>
    <h2>Our Products</h2>
    <?php
        //SHOW PRODUCT CATEGORIES THAT DEALER OFFERS
        foreach($product_category_array as $category) {
            echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . $category->product_category_name . '</a><br>';
        }
    ?>
</section> -->

<?php 
    /******************************* OUR PRODUCTS *************************/ 
?>
<div class="border-top-grey"></div>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_products-short') : null );?>
