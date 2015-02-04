<section class="footer-wrapper<?php if(isset($current_section) && $current_section == 'paid-search') { echo ' ps-footer'; } ?>">
    <div class="footer-container">
        <div class="row footer-row footer-row--top">
            <div class="logo">
                <a href="<?=$installer_base_url?>" title="Home">
                    <?= $dealer_logo_display; ?>
                </a>
            </div>
            <div class="dealer-info-container">
                <?php
                    if($show_installer_header_footer) {
                        //SHOW INSTALLER SPECIFIC CONTENT
                        echo '<div class="dealer-info"><div class="address"><span class="dealer-info__header">' . $installer_array[0]->name . '</span><br>' . $installer_array[0]->address . '<br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '</div><div class="numbers"><span class="dealer-info__header">Get in Touch</span><br>Ph: <a href="tel:' . $installer_array[0]->phone1 . '">' . $installer_array[0]->phone1 . '</a>';

                        if($installer_array[0]->fax != '') {
                            echo '<br>Fax: ' . $installer_array[0]->fax;
                        }
                        echo  '</div></div>';

                        if($installer_array[0]->dealer_hours != '') {
                            echo '<div class="hours"><span class="dealer-info__header">Hours</span><br>' . nl2br($installer_array[0]->dealer_hours) . '</div>';
                        }
                    }
                ?>
            </div>
            <div class="five-star five-star--top">
                <?=$this->load->view('partials/_svg-icon-five-star.php');?>
            </div>
        </div>
        <div class="row footer-row footer-row--bottom">
            <div class="five-star five-star--bottom">
                <?=$this->load->view('partials/_svg-icon-five-star.php');?>
            </div>
            <div class="copyright"><span>&#169; Copyright <?php echo date("Y") ?></span></div>
            <div class="social">
                <a href="https://twitter.com/VELUXAmerica" target="_blank" class="social__link">
                    <i class="icon icon-twitter">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-twitter"></use>
                        </svg>
                    </i>
                </a>
                <a href="https://facebook.com/VELUXAmerica" target="_blank" class="social__link">
                    <i class="icon icon-facebook">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-facebook"></use>
                        </svg>
                    </i>
                </a>
                <a href="https://www.pinterest.com/veluxamerica" target="_blank" class="social__link">
                    <i class="icon icon-pinterest">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-pinterest"></use>
                        </svg>
                    </i>
                </a>
                <a href="http://www.houzz.com/pro/velux/velux" target="_blank" class="social__link">
                    <i class="icon icon-tie-fighter">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-tie-fighter"></use>
                        </svg>
                    </i>
                </a>
            </div>
            <?php
                if($show_installer_header_footer) {
                    //SHOW INSTALLER SPECIFIC CONTENT
                    echo '<div class="nav-footer"><div class="nav-footer__container"><nav class="nav-major"><a href="' . $installer_base_url . '/products">Products</a>';
                    //echo '<a href="' . $installer_base_url . '/gallery">Gallery</a>';
                    echo '<a href="' . $installer_base_url . '/why-skylights">Why Skylights</a>';
                    echo '<a href="' . $installer_base_url . '/installing">Installing</a></nav>';
                    echo '<nav class="nav-minor"><a href="' . $installer_base_url . '/about">About</a>';
                    echo '<a href="' . $installer_base_url . '/warranty">Warranty</a>';
                    echo '<a href="' . $installer_base_url . '/brochures">Brochures</a>';
                    echo '<a href="' . $installer_base_url . '/contact">Contact</a></nav></div></div>';
                }
            ?>
            
        </div>
    </div>
</section>