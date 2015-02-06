<?php if (isset($cta_type) && $cta_type == 'short'): ?>

    <section class="reversed card cta-find-installer" data-wallpaper='{"file":"us-map", "ext":"png"}'>
        <header class="centered">
            <i class="icon icon-pin--primary">
                <svg class="icon__svg">
                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-pin--primary"></use>
                </svg>
            </i>
            <h2 class="cta__heading">
                When why turns to how, contact an installer.
            </h2>
        </header>
        <form action="" method="post" class="centered">
            <label for="" class="hide-text">
                Enter your ZIP code<br>
            </label>
            <div class="fancy-search">
                <input type="hidden" name="installer_search" value="yes">
                <input type="search" name="zip" placeholder="ex: 90210">
                <button type="submit" class="btn" title="Search!">
                    <i class="icon icon-search--reversed">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-search--reversed"></use>
                        </svg>
                    </i>
                </button>
            </div>
        </form>
    </section>

<?php else: ?>

    <div class="cta-find-installer">
        <header class="centered">
            <i class="icon icon-pin--primary">
                <svg class="icon__svg">
                    <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-pin--primary"></use>
                </svg>
            </i>
            <h2 class="cta__heading">
                <span class="br">When why turns to how,</span> contact an installer.
            </h2>
            <p class="squeezed-3 cta__text">
                <?php
                    if( isset($bad_installer_message) && $bad_installer_message == TRUE) {
                        if( isset($former_installer_message) && $former_installer_message == TRUE) {
                            echo 'We are unable to find the installer you are looking for. Check out the search results below or enter your zip code to find the closest installers.';
                        } else {
                            echo 'We are unable to find the installer you are looking for. Enter your zip code below to find the closest installers.';
                        }
                    } else {
                        if( isset($no_results_message) && $no_results_message == TRUE) {
                            echo 'Unfortunately, there were no installers that matched your search criteria';
                        } else {
                            echo 'So you\'ve decided which room in your home needs a skylight. Now you need to find somebody to install it. Enter your zip code below to find the closest installers.';
                        }
                    }
                ?>
            </p>
        </header>
        <form action="" method="post" class="centered">
            <label for="" class="hide-text">
                Enter your ZIP code<br>
            </label>
            <div class="fancy-search">
                <input type="hidden" name="installer_search" value="yes">
                <input type="search" name="zip" placeholder="ex: 90210">
                <button type="submit" class="btn" title="Search!">
                    <i class="icon icon-search--reversed">
                        <svg class="icon__svg">
                            <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-search--reversed"></use>
                        </svg>
                    </i>
                </button>
            </div>
        </form>
    </div>

<?php endif; ?>