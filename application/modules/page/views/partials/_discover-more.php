<section class="page-row bg-grey centered discover-more-container" id="discover-more">
    <h2 class="upper">Discover More</h2>
    <div class="row discover-more">
        <?php
            switch($discover_section) {
                case 'home':
                case 'installing':
                default:
                    echo '<div class="small-12 medium-4 columns">' . "\n";
                        echo '<div class="discover-card-container about-teaser">' . "\n";
                            echo '<div class="discover-card">' . "\n";
                                echo '<h4 class="reversed normal-weight">About Us Teaser</h4>' . "\n";
                                echo '<a href="' . $installer_base_url . '/about">Learn More</a>' . "\n";
                            echo '</div>' . "\n";
                        echo '</div>' . "\n";
                    echo '</div>' . "\n";
                    echo '<div class="small-12 medium-4 columns">' . "\n";
                        echo '<div class="discover-card-container skylight-planner">' . "\n";
                            echo '<div class="discover-card">' . "\n";
                                echo '<h4 class="reversed normal-weight">Why Skylights?</h4>' . "\n";
                                echo '<a href="' . $installer_base_url . '/why-skylights">Learn More</a>' . "\n";
                            echo '</div>' . "\n";
                        echo '</div>' . "\n";
                    echo '</div>' . "\n";
                    echo '<div class="small-12 medium-4 columns">' . "\n";
                        echo '<div class="discover-card-container tax-credit">' . "\n";
                            echo '<div class="discover-card">' . "\n";
                                echo '<h4 class="reversed normal-weight">Use a federal tax credit to replace your old skylight</h4>' . "\n";
                                echo '<a href="' . $installer_base_url . '/installing#tax-credits">Learn More</a>' . "\n";
                            echo '</div>' . "\n";
                        echo '</div>' . "\n";
                    echo '</div>' . "\n";
                    break;
            }
        ?>
    </div>
</section>