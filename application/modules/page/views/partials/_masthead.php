<section class="masthead-wrapper">
    <div class="masthead">
        <div class="masthead__section masthead__section--large push-left">
            <a href="<?=$installer_base_url?>" class="brand" title="Home">
                <img src="<?=asset_url('images/installer-logo.png')?>" alt>
                <!--<div>Joe's Plubming, Heating, A/C, and Ventilation Services</div>-->
            </a>
            <?=$this->load->view('partials/_navigation-header');?>
        </div>
        <div class="masthead__section masthead__section--small masthead__section--velux">
            <a class="velux-logo">
                <img src="<?=asset_url('images/velux-logo.jpg')?>" alt>
            </a>
        </div>
        <div class="masthead__section masthead__section--small masthead__section--phone">
            <?php
                if($show_installer_header_footer) {
                    echo '<div class="phone"><a href="tel:' . $installer_array[0]->phone1 . '" class="nav-header__link phone-number"><img src="' . asset_url('images/phone.png') . '" alt>' . $installer_array[0]->phone1 . '</a></div>';
                }
            ?>
        </div>
        <button class="nav-header-trigger" title="Menu">
            <i class="icon icon-hamburger navbar-icon-open"></i>
            <i class="icon icon-x navbar-icon-close">
                <svg class="icon__svg">
                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-x"></use>
                </svg>
            </i>
        </button>
    </div>
</section>