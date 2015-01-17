<section class="paid-search-masthead-wrapper">
    <div class="paid-search-branding--mobile">
        <a href="<?=$installer_base_url?>" class="brand" title="Home">
            <?= $dealer_logo_display; ?>
        </a>
    </div>
    <div class="paid-search-masthead" data-fixie>
        <div class="paid-search-branding--desktop">
            <a href="<?=$installer_base_url?>" class="brand" title="Home">
                <?= $dealer_logo_display; ?>
            </a>
        </div>
        <div class="masthead__section masthead__section--velux">
            <div class="velux-logo">
                <img src="<?=asset_url('images/velux-logo.png')?>" alt>
            </div>
        </div>
        <div class="masthead__section masthead__section--info">
            <div class="info-wrapper">
                <?php
                    if($show_installer_header_footer) {
                        //SHOW INSTALLER SPECIFIC CONTENT
                        echo '<div class="dealer-info"><span class="dealer-info__header">' . $installer_array[0]->name . '</span><br>' . $installer_array[0]->city . ', ' . $installer_array[0]->state . ' ' . $installer_array[0]->zip . '</div>';
                    }
                ?>
                <?php
                    if($show_installer_header_footer) {
                        echo '<div class="phone"><a href="tel:' . $installer_array[0]->phone1 . '" class="nav-header__link phone-number"><img class="phone-icon" src="' . asset_url('images/phone.png') . '" alt><span class="number">' . $installer_array[0]->phone1 . '</span></a></div>';
                    }
                ?>
            </div>
        </div>
    </div>
</section>