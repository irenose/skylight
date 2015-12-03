<?php
    /******************************* INTRO COPY *************************/
?>
<section class="page-row bg-grey">
    <header class="intro-statement">
<?php
    /*---------------------------------------------
        Dealer Headline
    ----------------------------------------------*/
?>
        <h1 class="alpha">
            <?php
                $headline = $installer_array[0]->about_dealer_headline != '' ? $installer_array[0]->about_dealer_headline : 'About Us';
                echo $headline;
            ?>
        </h1>
<?php
    /*---------------------------------------------
        End Dealer Headline
    ----------------------------------------------*/
?>
        <p>We will help advise you on skylight products and installation in order to provide you with the perfect daylight solution. We take pride in quality customer service and installation so you can relax and bask in your home’s newfound daylight.</p>
        <a href="<?= $installer_base_url; ?>/contact#contact-form" class="cta-text" data-modal-open data-ajax-vars='{"view":"partials/_modal-content", "content-type":"contact"}'>Schedule A Consultation</a>
    </header>
</section>

<?php
    /******************************* ABOUT INSTALLER COPY *************************/
    if ($installer_array[0]->about_dealer_text != '') {
?>
        <section class="page-row centered about-dealer">
            <?php
                if ($about_dealer_image != '') {
                    echo '<div class="polaroid about-dealer-image"><img src="' . $about_dealer_image . '" alt></div>';
                }
            ?>
            <header class="intro-statement intro-statement--squeezed">
                <h2 class="about-dealer-title upper normal-weight">Our Company</h2>
                <p class="about-dealer-text"><?= filter_page_content($installer_array[0]->about_dealer_text); ?></p>
                <?php
                    if(trim($installer_array[0]->credentials) != '') {
                        echo '<h3 class="normal-weight credentials-title">Our Credentials</h3>' . "\n";
                        echo '<p>' . filter_page_content(nl2br(trim($installer_array[0]->credentials))) . '</p>' . "\n";
                    }
                ?>
            </header>
        </section>
<?php
    /*---------------------------------------------
        End About Dealer Text
    ----------------------------------------------*/
    }

?>


<?php
    /******************************* OPTIONAL PHOTO GALLERY *************************/
    if (isset($gallery_array) && count($gallery_array) > 0) {
?>
        <section class="page-row bg-grey gallery">
            <div class="mobile-gallery-instruction"><p>Swipe images below to view gallery</p></div>
            <div class="slick-carousel slick-photo-gallery" data-carousel-init="auto" data-carousel-type="photo-gallery" data-slides-to-show="1">
                <?php
                    if($gallery_array[0]->photo_description != '') {
                        $initial_caption = '<p>' . $gallery_array[0]->photo_description . '</p>';
                        $add_class = '';
                    } else {
                        $initial_caption = '';
                        $add_class = ' caption-empty';
                    }
                    echo '<div id="gallery-caption" class="gallery-caption' . $add_class . '">' . $initial_caption . '</div>';
                    foreach($gallery_array as $photo) {
                        if($photo->photo_image != '' && file_exists($this->config->item('gallery_images_full_dir') . $photo->photo_image . '.' . $photo->extension)) {
                            echo '<div class="slick__item centered">' . "\n";
                                echo '<img src="' . $this->config->item('gallery_images_dir') . $photo->photo_image . '.' . $photo->extension . '" alt="' . $photo->photo_title . '" data-caption="' . ascii_to_entities($photo->photo_description) . '">';
                            echo '</div>' . "\n";
                        }
                    }
                ?>
            </div>
        </section>

<?php
    }
    /******************************* OPTIONAL TESTIMONIALS *************************/
?>
<a name="testimonials"></a>
<?php
    /*---------------------------------------------
        Testimonails
    ----------------------------------------------*/
?>
    <?php
        if (isset($testimonials_array) && count($testimonials_array) > 0) {
            echo '<section class="page-row"><header class="intro-statement intro-statement--squeezed"><h2 class="about-dealer-title upper normal-weight">Testimonials</h2></header><div class="testimonial-carousel header-statement"><div class="slick"><div class="slick-list"><div class="testimonial">';
            foreach($testimonials_array as $testimonial) {
                echo '<p>';
                echo '"' . filter_page_content($testimonial->testimonial_copy) . '"';
                $line_started = FALSE;
                if(trim($testimonial->testimonial_name) != '' || trim($testimonial->testimonial_source != '')) {
                    echo '<span class="testimonial-name-source">' . "\n";
                        if(trim($testimonial->testimonial_name) != '') {
                            $line_started = TRUE;
                            echo '<br>' . $testimonial->testimonial_name;
                        }
                        if(trim($testimonial->testimonial_source) != '') {
                            if($line_started) {
                                echo ', ';
                            }
                            echo $testimonial->testimonial_source;
                        }
                    echo '</span>' . "\n";
                }
                echo  '</p>';
            }
            echo '</div></div></div></div></section>';
        }
    ?>
<?php
    /*---------------------------------------------
        End Testimonails
    ----------------------------------------------*/
?>

<?php
    /******************************* STATIC ABOUT VELUX *************************/
?>
<section class="page-row bg-grey about-velux">
    <div class="centered">
        <a href=""><img src="<?=asset_url('images/velux-logo.png')?>" alt></a>
    </div>
    <p class="text-columns-3">Founded on a vision of daylight, fresh air and quality of life, for over 60 years, we have created energy-efficient daylighting solutions for commercial and residential clients across the globe.<br><br>And today, we lead the industry in our commitment to developing and manufacturing architectural-grade products that provide and control daylight and fresh air. This, of course, is no coincidence. It is a result of our intense focus on offering the highest quality and most energy-efficient daylighting products on the market.<br><br>We're as equally dedicated to upholding our tradition of quality and craftsmanship as we are to reducing the environmental impact of the manufacture, use and disposal of our products. Because our activities use some natural resources, this gives us a direct obligation towards the environment we rely on.</p>
</section>

<?php
    /******************************* STATIC OUR PRINCIPLES *************************/
?>
<section class="page-row our-principles">
    <header class="header-statement header-statement--squeezed">
        <h2 class="upper normal-weight">Our Principles</h2>
        <p>To do our part in helping take care of the world we all share, we're committed to the following principles:</p>
    </header>
    <div class="principles">
        <div class="row">
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-world">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-world"></use>
                        </svg>
                    </i>
                    <p>We will design our products so that their environmental impact during manufacture, use and disposal is diminished.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-notepad">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-notepad"></use>
                        </svg>
                    </i>
                    <p>We will use raw materials, water and energy more efficiently in order to diminish our effect on the environment.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-mountains">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-mountains"></use>
                        </svg>
                    </i>
                    <p>We will reduce emissions and waste in all our activities.</p>
                </div>
            </div>
        </div>
        <div class="row row-2">
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-people">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-people"></use>
                        </svg>
                    </i>
                    <p>We will maintain high standards of safety at work for our employees and partners.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-chart">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-chart"></use>
                        </svg>
                    </i>
                    <p>We will cooperate with our suppliers, customers and business partners to achieve higher environmental standards at every step.</p>
                </div>
            </div>
            <div class="small-12 large-4 columns principle-container">
                <div class="principle">
                    <i class="icon icon-about icon-atom">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-atom"></use>
                        </svg>
                    </i>
                    <p>We will seek out new ways to improve the environmental sustainability of our products and manufacturing methods.</p>
                </div>
            </div>
        </div>
    </div>
</section>
