
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">SUN TUNNEL Night</h1>
    </header>
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
        </div>
        <div class="small-12 medium-4 columns welcome-list-wrapper">
            <div class="welcome-list">
                <div class="row">
                    <div class="small-12 columns">
                        <h4>Small space, big impact.</h4>
                        <div class="form-grey-border"></div>
                        <ul class="ps-list">
                            <li>Innovative skylight delivers brighter natural light</li>
                            <li>Quick and easy installation</li>
                            <li>Ideal application for small spaces that crave daylight</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section product-statement">
        <div class="ps-form" id="ps-form">
            <?php 
                /******************************* LOAD FORM *************************/
                echo $this->load->view('partials/_paid-search-form');
            ?>
        </div>
        <div class="row">
            <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
                <h4 class="normal-weight underlined color-primary">If you have a small space that needs natural light and not a sky view, a SUN TUNNEL skylight is perfect.</h4>
                <ul class="ps-list">
                    <li>The most innovative skylight in the industry features a new product design that delivers brighter natural light </li>
                    <li>Installation can be completed, on average, in less than four hours</li>
                    <li>Low profile, flat glass SUN TUNNEL skylight models have a sleek appearance for an integrated look with your roofline.</li>
                    <li>Pitched SUN TUNNEL skylights are optimal for capturing light from all angles. </li>
                    <li>Add a decorative diffuser, available in four different colors, to accent any d&eacute;cor (((JOSH, CONSIDER USING A DECORATIVE DIFFUSER IMAGE – PRODUCT OR BEAUTY SHOT)))</li>
                </ul>
                <a class="ps-cta">
                    <div class="phone">
                        <i class="icon icon-phone">
                            <svg class="icon__svg">
                                <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-phone"></use>
                            </svg>
                        </i>
                    </div>
                    <div class="cta">Call today for a free consultation<span class="number"><?= $installer_array[0]->phone1 ?></span></div>
                </a>
            </div>
        </div>
</section>
<?= $this->load->view('partials/_paid-search-why-velux') ?>
<?= $this->load->view('partials/_paid-search-no-leak') ?>