<section class="masthead-wrapper">
    <div class="branding">
        <a href="<?=$installer_base_url?>" class="brand" title="Home">
            <?= $dealer_logo_display; ?>
        </a>
    </div>
    <div class="masthead" data-fixie>
        <div class="masthead__section masthead__section--large push-left">
            <?=$this->load->view('partials/_navigation-header');?>
        </div>
        <div class="masthead__section masthead__section--small masthead__section--velux">
            <div class="velux-logo">
                <img src="<?=asset_url('images/velux-logo.png')?>" alt>
            </div>
        </div>
        <div class="masthead__section masthead__section--small masthead__section--phone">
            <?php
                if($show_installer_header_footer) {
                    echo '<div class="phone"><a href="tel:' . $installer_array[0]->phone1 . '" class="nav-header__link phone-number"><i class="icon icon-phone"><svg class="icon__svg"><use xlink:href="' . asset_url('images/sprites/sprite.svg') . '#icon-phone"></use></svg></i>' . $installer_array[0]->phone1 . '</a></div>';
                }
            ?>
        </div>
        <?php if($show_installer_header_footer) { ?>
            <button class="nav-header-trigger" title="Menu">
                <i class="icon icon-hamburger navbar-icon-open"></i>
                <i class="icon icon-x navbar-icon-close">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-x"></use>
                    </svg>
                </i>
            </button>
        <?php } ?>
    </div>
</section>