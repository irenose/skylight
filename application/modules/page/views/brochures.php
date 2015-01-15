<section class="page-row bg-grey">
    <header class="intro-statement intro-statement--snug">
        <h1 class="normal-weight">Brochures</h1>
        <p class="font-display">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam consectetur incidunt debitis porro voluptatibus quasi asperiores voluptas, accusantium nemo, quibusdam omnis neque! Quo odio iste voluptas deserunt perspiciatis ipsum quod.</p>
    </header>
</section>
<section class="page-row border-top-grey brochures">
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
                        echo '<img src="http://placehold.it/310x350" alt>' . "\n";
                    echo '</div>' . "\n";
                    echo '<h4 class="brochure__title">' . $brochure->name . '</h4>' . "\n";
                    echo '<p class="brochure__description">' . filter_page_content($brochure->description) . '</p>' . "\n";
                    if( file_exists($this->config->item('resources_full_dir') . 'resources/' . $brochure->filename . '.' . $brochure->extension)) {
                        echo '<a href="' . $this->config->item('resources_dir') . 'resources/' . $brochure->filename . '.' . $brochure->extension . '">Download</a>';
                    }
                echo '</div>' . "\n";
            }
            echo '</div>' . "\n"; //end row
        }
    ?>
    <?php /*
    <div class="row">
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
    </div>
    <div class="row">
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
        <div class="brochure small-12 medium-6 large-3 columns">
            <div class="brochure__image">
                <img src="http://placehold.it/310x350" alt>
            </div>
            <h4 class="brochure__title">Residential Skylights Brochure</h4>
            <p class="brochure__description">This brochure is an easy way for our residential customers to learn about everything VELUX. Find out about the benefits of natural light in your home, our history, as well as, all of the VELUX residential products.</p>
            <a href="">Download</a>
        </div>
    </div> */ ?>
</section>