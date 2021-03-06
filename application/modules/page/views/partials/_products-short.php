<section class="page-row products--short">
    <div class="product-category-wrapper">
        <header class="header-statement">
            <h2 class="upper normal-weight">Our Products</h2>
        </header>
        <?php
            if( isset($product_category_array) && count($product_category_array) > 0) {
                $count = 0;
                echo '<div class="row">' . "\n";
                    foreach($product_category_array as $category) {
                        $count++;
                        switch(count($product_category_array)) {
                            case 2:
                                $class = $count == 1 ? 'small-12 medium-5 medium-push-1 columns product-category' : 'small-12 medium-5 medium-pull-1 columns product-category';
                                break;
                            case 3:
                                $class = 'small-12 medium-4 columns product-category';
                                break;
                            default:
                                $class = 'small-12 medium-6 medium-push-3 columns product-category centered';
                                break;

                        }
                        echo '<div class="' . $class . '">' . "\n";
                            if( ! isset($hide_learn_more_links) || $hide_learn_more_links == FALSE) {
                                echo '<a href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">' . "\n";
                            }
                                echo '<div class="polaroid">' . "\n";
                                    echo '<img src="' . asset_url('images/categories/' . $category->category_image . '-short.jpg') . '" alt="' . $category->product_category_name . '">' . "\n";
                                echo '</div>' . "\n";
                            if( ! isset($hide_learn_more_links) || $hide_learn_more_links == FALSE) {
                                echo '</a>' . "\n";
                            }
                            echo '<h4 class="normal-weight">' . $category->product_category_name . '</h4>' . "\n";
                            echo '<p>' . filter_page_content($category->product_category_teaser) . '</p>' . "\n";
                            if( ! isset($hide_learn_more_links) || $hide_learn_more_links == FALSE) {
                                echo '<a class="btn" href="' . $installer_base_url . '/products/category/' . $category->product_category_url . '">Learn More</a>';
                            }
                        echo '</div>' . "\n";
                    }
                echo '</div>' . "\n";
            }
        ?>
    </div>
</section>