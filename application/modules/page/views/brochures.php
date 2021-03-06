<section class="page-row bg-grey">
    <header class="intro-statement intro-statement--snug">
        <h1 class="normal-weight">Brochures</h1>
        <p>We offer easy to understand downloads to help you choose the skylight that's perfect for you.</p>
    </header>
</section>
<section class="page-row brochures">
    <?php
        if( isset($brochures_array) && count($brochures_array) > 0) {
            $count = 0;
            echo '<div class="row">' . "\n";
            foreach($brochures_array as $brochure) {
                $count++;
                $greater_than_one = $count > 1 ? TRUE : FALSE;
                if( $greater_than_one && ($count-1) % 4 == 0) {
                    echo '</div>' . "\n";
                    echo '<div class="row">' . "\n"; //start new row
                }
                echo '<div class="brochure small-12 medium-6 large-3 columns">' . "\n";
                    echo '<div class="brochure__image">' . "\n";
                        echo '<img src="' . $this->config->item('brochure_assets_dir') . $brochure->thumbnail . '.' . $brochure->thumbnail_extension . '" alt="' . $brochure->name . '">' . "\n";
                    echo '</div>' . "\n";
                    echo '<h4 class="brochure__title normal-weight">' . $brochure->name . '</h4>' . "\n";
                    if( file_exists($this->config->item('resources_full_dir') . $brochure->filename . '.' . $brochure->extension)) {
                        echo '<a href="' . $this->config->item('resources_dir') . $brochure->filename . '.' . $brochure->extension . '" class="cta-text" target="_blank">Download</a>';
                    }
                echo '</div>' . "\n";
            }
            echo '</div>' . "\n"; //end row
        }
    ?>
</section>