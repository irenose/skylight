<?php 
    /******************************* INTRO COPY *************************/ 
?>
<section class="page-row products">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="alpha">Our Products</h1>
        <p>Want to let more light and fresh air into your home? You’re in the right place.</p>
    </header>

<?php 
    /******************************* OUR PRODUCTS *************************/ 
?>
<?php
    /*---------------------------------------------
        Product Categories
    ----------------------------------------------*/
?>
    <div class="product-category-wrapper">
        <?php
            if( isset($product_category_array) && count($product_category_array) > 0) {
                $count = 0;
                echo '<div class="row">' . "\n";
                    foreach($product_category_array as $category) {
                        $count++;
                        switch(count($product_category_array)) {
                            case 2:
                                $class = $count == 1 ? 'small-12 medium-6 large-4 large-push-2 columns product-category' : 'small-12 medium-6 large-4 large-pull-2 columns product-category';
                                break;
                            case 3:
                                $class = 'small-12 medium-4 columns product-category';
                                break;

                        }
                        echo '<div class="' . $class . '">' . "\n";
                            echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . "\n";
                                echo '<div class="polaroid">' . "\n";
                                    echo '<img src="' . asset_url('images/categories/' . $category->category_image . '.jpg') . '" alt="' . $category->product_category_name . '" class="desktop">' . "\n";
                                    echo '<img src="' . asset_url('images/categories/' . $category->category_image . '-short.jpg') . '" alt="' . $category->product_category_name . '" class="desktop-down">' . "\n";
                                echo '</div>' . "\n";
                            echo '</a>' . "\n";
                            echo '<h4 class="normal-weight">' . $category->product_category_name . '</h4>' . "\n";
                            echo '<p>' . filter_page_content($category->product_category_teaser) . '</p>' . "\n";
                            echo '<a class="btn" href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">Learn More</a>';
                        echo '</div>' . "\n";
                    }
                echo '</div>' . "\n";
            }
        ?>
    </div>
</section>
<?php
    /*---------------------------------------------
        End Product Categories
    ----------------------------------------------*/
?>
