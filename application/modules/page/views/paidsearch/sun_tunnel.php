
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">The quick, easy way to bring natural light to any space.</h1>
    </header>
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero sun-tunnel"></div>
        <div class="small-12 medium-4 columns ps-form" id="ps-form">
            <?php 
                /******************************* LOAD FORM *************************/
                echo $this->load->view('partials/_paid-search-form');
            ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section product-statement sun-tunnel-statement">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey statement">
            <h4 class="normal-weight">If you have a small space that needs natural light and not a sky view, a SUN TUNNEL skylight is perfect.</h4>
            <img src="<?=asset_url('images/ps/sun-tunnel.png')?>" alt>
            <ul class="ps-list">
                <li>The most innovative tubular skylight in the industry features a new product design that delivers brighter natural light </li>
                <li>Installation can be completed, on average, in less than four hours</li>
                <li>Low profile, flat glass SUN TUNNEL skylight models have a sleek appearance for an integrated look with your roofline.</li>
                <li>Pitched SUN TUNNEL skylights are optimal for capturing light from all angles. </li>
            </ul>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section diffuser">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/diffuser.png')?>" alt>
            <p>Add a decorative diffuser, available in four different colors, to accent any d&eacute;cor</p>
        </div>
    </div>
</section>
<?= $this->load->view('partials/_paid-search-why-velux') ?>
