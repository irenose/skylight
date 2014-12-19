<div class="nav-header" role="navigation">
    <?php
        if($show_installer_header_footer) {
            //SHOW INSTALLER SPECIFIC CONTENT
            echo '<nav class="nav-major"><div class="products-dropdown">';
            if( isset($product_categories_nav_array) ) {
                if( count($product_categories_nav_array) > 1) {
                    echo '<a href="' . $installer_base_url . '/products" class="nav-header__link first subnav-trigger">Products<span class="nav-arrow nav-arrow--products"></span></a>';
                    echo '<nav class="nav-major__subnav">';
                    foreach($product_categories_nav_array as $product_category) {
                        echo '<a href="' . $installer_base_url . '/products/category/' . $product_category->product_category_url . '">' . $product_category->product_category_name . '</a>';
                    }
                    echo '</nav></div>';
                } else {
                    echo '<a href="' . $installer_base_url . '/products/category/' . $product_categories_nav_array[0]->product_category_url . '" class="nav-header__link first subnav-trigger">Products</a>';
                }
            }
            echo '<a href="' . $installer_base_url . '/why-skylights" class="nav-header__link">Why Skylights</a>';
            echo '<a href="' . $installer_base_url . '/installing" class="nav-header__link last">Installing</a></nav><nav class="nav-minor">';
            echo '<a href="' . $installer_base_url . '/about" class="nav-header__link first">About</a>';
            echo '<a href="' . $installer_base_url . '/warranty" class="nav-header__link">Warranty</a>';
            echo '<a href="' . $installer_base_url . '/brochures" class="nav-header__link">Brochures</a>';
            echo '<a href="' . $installer_base_url . '/contact" class="nav-header__link last">Contact</a><a href="" class="hav-header__link popout-velux-logo"><img src="' . asset_url('images/velux-logo.jpg') . '" alt></a></nav>';
        }
    ?>
</div>