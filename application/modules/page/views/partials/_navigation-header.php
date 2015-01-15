<div class="nav-header" role="navigation">
    <?php
        if($show_installer_header_footer) {
            //SHOW INSTALLER SPECIFIC CONTENT
            echo '<nav class="nav-major"><div class="products-dropdown">';
            $products_active = $current_section == 'products' ? ' is-active' : '';
            if( isset($product_categories_nav_array) ) {
                if( count($product_categories_nav_array) > 1) {
                    echo '<a href="' . $installer_base_url . '/products" class="nav-header__link first subnav-trigger' . $products_active . '">Products<span class="nav-arrow nav-arrow--products"></span></a>';
                    echo '<nav class="nav-major__subnav">';
                    foreach($product_categories_nav_array as $product_category) {
                        echo '<a href="' . $installer_base_url . '/products/category/' . $product_category->product_category_url . '">' . $product_category->product_category_name . '</a>';
                    }
                    echo '</nav></div>';
                } else {
                    echo '<a href="' . $installer_base_url . '/products/category/' . $product_categories_nav_array[0]->product_category_url . '" class="nav-header__link first subnav-trigger' . $products_active . '">Products</a>';
                }
            }
            $why_active = $current_section == 'why-skylights' ? ' is-active' : '';
            $installing_active = $current_section == 'installing' ? ' is-active' : '';
            $about_active = $current_section == 'about' ? ' is-active' : '';
            $warranty_active = $current_section == 'warranty' ? ' is-active' : '';
            $brochures_active = $current_section == 'brochures' ? ' is-active' : '';
            $contact_active = $current_section == 'contact' ? ' is-active' : '';

            echo '<a href="' . $installer_base_url . '/why-skylights" class="nav-header__link' . $why_active . '">Why Skylights</a>';
            echo '<a href="' . $installer_base_url . '/installing" class="nav-header__link last' . $installing_active . '">Installing</a></nav><nav class="nav-minor">';
            echo '<a href="' . $installer_base_url . '/about" class="nav-header__link first' . $about_active . '">About</a>';
            echo '<a href="' . $installer_base_url . '/warranty" class="nav-header__link' . $warranty_active . '">Warranty</a>';
            echo '<a href="' . $installer_base_url . '/brochures" class="nav-header__link' . $brochures_active . '">Brochures</a>';
            echo '<a href="' . $installer_base_url . '/contact" class="nav-header__link last' . $contact_active . '">Contact</a><a href="" class="nav-header__link popout-velux-logo"><img src="' . asset_url('images/velux-logo-mobile.png') . '" alt></a></nav>';
        }
    ?>
</div>