<!-- <?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row bg-grey">
    <header class="intro-statement intro-statement--squeezed">
        <h2><?= $installer_array[0]->about_dealer_headline; ?></h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
        <a href="<?= $installer_base_url; ?>/contact">Schedule A Consulation</a>
    </header>
</section>

<?php 
    /******************************* ABOUT INSTALLER COPY *************************/ 
?>
<section class="page-row">
    <h2 class="about-dealer-title">About Our Company</h2>
    <p class="text-columns about-dealer-text"><?= $installer_array[0]->about_dealer_text; ?></p>
</section>

<?php 
    /******************************* IF INSTALLER HAS PHOTO GALLERY *************************/ 
?>
<section>

</section>

<?php 
    /******************************* IF INSTALLER HAS TESTIMONIALS *************************/ 
?>
<section>
    <?php
        if( isset($testimonials_array) && count($testimonials_array) > 0) {
            echo '<h2>Testimonials</h2>';
            foreach($testimonials_array as $testimonial) {
                echo '<p>"' . $testimonial->testimonial_copy . '"</p>';
            }
        }
    ?>
</section>

<?php 
    /******************************* STATIC ABOUT VELUX *************************/ 
?> -->
<section class="page-row">
    <h2>About VELUX</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est debitis natus at laboriosam molestiae recusandae architecto porro magni itaque esse necessitatibus molestias earum vel ipsam, ex explicabo nostrum dicta, facere culpa quos, dolores sed enim veniam aspernatur aliquam. Quibusdam eligendi quidem dignissimos, tempora fugit exercitationem ullam doloremque iure iste laboriosam modi vitae et, dolores sapiente ipsam quod, suscipit, nobis ipsum eveniet deserunt officia pariatur perspiciatis at ut? Doloribus nulla nam accusantium repellat, dolorem quibusdam porro aspernatur perferendis? Unde modi iusto autem nam tenetur! Blanditiis consectetur, perferendis asperiores est hic, tempora provident consequatur libero similique, saepe natus, cumque! Accusamus ut, dolorem?</p>
</section>

<?php 
    /******************************* STATIC OUR PRINCIPLES *************************/ 
?>
<section class="page-row">
    <header class="header-statement header-statement--squeezed">
        <h2>Our Principles</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est debitis natus at laboriosam molestiae recusandae architecto porro magni itaque esse necessitatibus molestias earum vel ipsam, ex explicabo nostrum dicta, facere culpa quos, dolores sed enim veniam aspernatur aliquam.</p>
    </header>
</section>
