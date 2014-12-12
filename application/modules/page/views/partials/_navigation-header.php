<div class="nav-header" role="navigation">
    <?php
        if($show_installer_header_footer) {
            //SHOW INSTALLER SPECIFIC CONTENT
            echo '<nav class="nav-major"><div class="products-dropdown">';
            echo '<a href="' . $installer_base_url . '/products" class="nav-header__link first subnav-trigger">Products<span class="nav-arrow nav-arrow--products"></span></a>';
            echo '<nav class="nav-major__subnav"><a>Residential Skylights</a><a>Product Details</a><a>SUN TUNNEL Skylights</a><a>Product Details</a><a>Commercial Skylights</a><a>Product Details</a></nav></div>';
            echo '<a href="' . $installer_base_url . '/why-skylights" class="nav-header__link">Why Skylights</a>';
            echo '<a href="' . $installer_base_url . '/installing" class="nav-header__link last">Installing</a></nav><nav class="nav-minor">';
            echo '<a href="' . $installer_base_url . '/about" class="nav-header__link first">About</a>';
            echo '<a href="' . $installer_base_url . '/warranty" class="nav-header__link">Warranty</a>';
            echo '<a href="' . $installer_base_url . '/brochures" class="nav-header__link">Brochures</a>';
            echo '<a href="' . $installer_base_url . '/contact" class="nav-header__link last">Contact</a><a href="" class="hav-header__link popout-velux-logo"><img src="' . asset_url('images/velux-logo.jpg') . '" alt></a></nav>';
        }
    ?>
</div>