<section class="footer-wrapper">
    <div class="footer">
        <div class="logo">
            <a>
                <img src="<?=asset_url('images/installer-logo-footer.png')?>" alt>
            </a>
        </div>
        <div class="copyright">&copy;2014 Installer Name</div>
        <div class="social">
            <a href="#" class="social__link">
                <i class="icon icon-twitter--reversed">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/icon-twitter--reversed.svg')?>#icon-twitter--reversed"></use>
                    </svg>
                </i>
            </a>
            <a href="#" class="social__link">
                <i class="icon icon-twitter--reversed">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/icon-facebook--reversed.svg')?>#icon-facebook--reversed"></use>
                    </svg>
                </i>
            </a>
        </div>
        <?php
            if($show_installer_header_footer) {
                //SHOW INSTALLER SPECIFIC CONTENT
                echo '<div class="nav-footer"><nav class="nav-major"><a href="' . $installer_base_url . '/products">Products</a>';
                echo '<a href="' . $installer_base_url . '/gallery">Gallery</a>';
                echo '<a href="' . $installer_base_url . '/why-skylights">Why Skylights</a>';
                echo '<a href="' . $installer_base_url . '/installing">Installing</a></nav>';
                echo '<nav class="nav-minor"><a href="' . $installer_base_url . '/about">About</a>';
                echo '<a href="' . $installer_base_url . '/warranty">Warranty</a>';
                echo '<a href="' . $installer_base_url . '/brochures">Brochures</a>';
                echo '<a href="' . $installer_base_url . '/contact">Contact</a></nav></div>';
            }
        ?>
        <div class="center-border"></div>
        <div class="dealer-info">
            <?php
                if($show_installer_header_footer) {
                    //SHOW INSTALLER SPECIFIC CONTENT
                    echo '<div class="address"><span class="dealer-info__header">' . $installer_array[0]->name . '</span><br>' . $installer_array[0]->address . '<br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '</div>';
                    if($installer_array[0]->dealer_hours != '') {
                        echo '<div class="hours"><span class="dealer-info__header">Hours</span><br>' . nl2br($installer_array[0]->dealer_hours) . '</div>';
                    }
                }
            ?>
        </div>
        <div class="accreditations">
            <img src="<?=asset_url('images/5-star.png')?>" alt>
        </div>
    </div>
</section>