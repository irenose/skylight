<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row bg-grey">
    <header class="intro-statement intro-statement--squeezed">
        <img src="<?=asset_url('images/installer-logo-large.png')?>" alt>
        <h2><?= $installer_array[0]->about_dealer_headline; ?></h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt accusamus itaque deleniti iusto, doloribus eligendi et, voluptas ea. Beatae, voluptate.</p>
        <a href="<?= $installer_base_url; ?>/contact">Schedule A Consulation</a>
    </header>
</section>

<?php 
    /******************************* ABOUT INSTALLER COPY *************************/ 
?>
<section class="page-row about-dealer">
    <h2 class="about-dealer-title">Our Company</h2>
    <img src="<?=asset_url('images/about-dealer-placeholder.png')?>" alt>
    <p class="text-columns-2 about-dealer-text"><?= $installer_array[0]->about_dealer_text; ?></p>
</section>

<?php
    /******************************* IF INSTALLER HAS PHOTO GALLERY *************************/ 
?>
<section class="page-row page-row--snug bg-grey">
    <div class="slick">
        <div class="slick-list">
            <div class="gallery-item centered">
                <img src="<?=asset_url('images/gallery-placeholder.png')?>" alt>
            </div>
        </div>
    </div>
</section>

<?php 
    /******************************* IF INSTALLER HAS TESTIMONIALS *************************/ 
?>
<section id="testimonials">
    <?php
        if( isset($testimonials_array) && count($testimonials_array) > 0) {
            echo '<section class="page-row border-top-grey"><div class="testimonial-carousel header-statement"><div class="slick"><div class="slick-list"><div class="testimonial">';
            foreach($testimonials_array as $testimonial) {
                echo '<p>"' . filter_page_content($testimonial->testimonial_copy) . '"</p>';
            }
            echo '</div></div><div class="testimonial-link"><a href="">View All Testimonials</a></div></div></div></section>';
        }
    ?>
</section>

<?php 
    /******************************* STATIC ABOUT VELUX *************************/ 
?>
<section class="page-row bg-grey about-velux">
    <div class="centered">
        <a href=""><img src="<?=asset_url('images/velux-logo.jpg')?>" alt></a>
    </div>
    <p class="text-columns-3 font-display">Founded on a vision of daylight, fresh air and quality of life, for over 60 years, we have created energy-efficient daylighting solutions for commercial and residential clients across the globe.<br><br>And today, we lead the industry in our commitment to developing and manufacturing architectural-grade products that provide and control daylight and fresh air. This, of course, is no coincidence. It is a result of our intense focus on offering the highest quality and most energy-efficient daylighting products on the market.<br><br>We're as equally dedicated to upholding our tradition of quality and craftsmanship as we are to reducing the environmental impact of the manufacture, use and disposal of our products. Because our activities use some natural resources, this gives us a direct obligation towards the environment we rely on.</p>
</section>

<?php 
    /******************************* STATIC OUR PRINCIPLES *************************/ 
?>
<section class="page-row our-principles">
    <header class="header-statement header-statement--squeezed">
        <h2>Our Principles</h2>
        <p class="font-display">To do our part in helping take care of the world we all share, we're committed to the following principles:</p>
    </header>
    <div class="principles">
        <div class="row">
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/environment.png')?>" alt>
                    <p>We will design our products so that their environmental impact during manufacture, use and disposal is diminished.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/checklist.png')?>" alt>
                    <p>We will use raw materials, water and energy more efficiently in order to diminish our effect on the environment.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/trees.png')?>" alt>
                    <p>We will reduce emissions and waste in all our activities.</p>
                </div>
            </div>
        </div>
        <div class="row row-2">
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/people.png')?>" alt>
                    <p>We will maintain high standards of safety at work for our employees and partners.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/graph.png')?>" alt>
                    <p>We will cooperate with our suppliers, customers and business partners to achieve higher environmental standards at every step.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <img src="<?=asset_url('images/atom.png')?>" alt>
                    <p>We will seek out new ways to improve the environmental sustainability of our products and manufacturing methods.</p>
                </div>
            </div>
        </div>
    </div>
</section>
