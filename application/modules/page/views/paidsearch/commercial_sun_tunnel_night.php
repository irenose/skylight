
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">Put natural light to work for you.</h1>
    </header>
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero commercial-st">
            <img src="<?=site_url('assets/images/ps/hero/commercial-sun-tunnel.jpg')?>">
        </div>
        <div class="small-12 medium-4 columns welcome-list-wrapper">
            <div class="welcome-list">
                <div class="row">
                    <div class="small-12 columns">
                        <h4>Increase light and comfort while reducing costs. </h4>
                        <div class="form-grey-border"></div>
                        <ul class="ps-list">
                            <li>Cost-effective method to add daylight to commercial applications</li>
                            <li>Highly reflective tunnel lets maximum light pass through to space</li>
                            <li>Includes 20-year warranty</li>
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
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey statement">
            <h4 class="normal-weight no-image">All VELUX commercial SUN TUNNEL&trade; skylights provide a cost-effective method to pass natural daylight through the roof to help light the interior and reduce energy loads. They also improve the occupant's performance, mood and comfort.</h4>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section features">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/roof.png')?>" alt>
            <p><strong>All VELUX commercial SUN TUNNEL skylights feature:</strong></p>
            <ul class="ps-list">
                <li>99.99% silver reflective layer</li>
                <li>20-year warranty</li>
                <li>Total reflectance greater than 98%</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section design-text">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <p>VELUX commercial SUN TUNNEL skylights are designed for commercial flat roofs, or low-sloped applications, ideal for schools and retail spaces with suspended ceilings, interior spaces that require a longer light shaft or projects that require a cost-effective daylight solution without a view.</p>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section tcr-model">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/tcr-sun-tunnel.png')?>" alt>
            <p><strong>Features of the TCR model include:</strong></p>
            <ul class="ps-list">
                <li>Clear dome for maximum visible light transmission</li>
                <li>22" nominal curb mounted flashing for flat roofs, flashing clearance 31"x31"</li>
                <li>34" rigid top elbow, 30&deg; offset</li>
                <li>9" tall round-to-square adapter box for 2'x2' grid ceilings (other ceiling options available)</li>
            </ul>
        </div>
    </div>
</section>
<?= $this->load->view('partials/_paid-search-why-velux') ?>