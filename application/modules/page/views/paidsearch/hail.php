
<section class="page-row page-row--snug ps-welcome-wrapper">
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero hail-damage">
            <img src="<?=site_url('assets/images/ps/hero/hail-damage.jpg')?>">
        </div>
        <div class="small-12 medium-4 columns ps-form" id="ps-form">
            <?php 
                /******************************* LOAD FORM *************************/
                echo $this->load->view('partials/_paid-search-form');
            ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section product-statement">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey statement blue-skylight">
            <img src="<?=asset_url('images/ps/blue-skylight.png')?>" alt>
            <h2 class="ps-welcome-header">Recover from the storm with brand new innovative VELUX skylights.</h2>
            <h4 class="normal-weight">Did the recent storm burst your bubble? Look no further for a revolutionary skylight replacement.</h4>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section tax-credit-row left-side">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
            <p>Install a No Leak Solar Powered "Fresh Air" skylight and you may be eligible for a 30% Federal tax credit on product and installation</p>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section clean-quite-safe right-side">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/water-droplets.jpg')?>" alt>
            <p>Newest VELUX models feature Clean, Quiet and Safe glass with Neat&reg; glass technology</p>
            <ul class="ps-list">
                <li><strong>Clean:</strong> the Neat&reg; glass coating keeps skylights virtually spotless</li>
                <li><strong>Quiet:</strong> reduce unwanted outside noise</li>
                <li><strong>Safe:</strong> VELUX recommends, and building codes require, laminated glass for out-of-reach applications</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section energy-performance">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <img src="<?=asset_url('images/ps/glass.jpg')?>" alt>
            <ul class="ps-list">
                <li>Current VELUX models come with a dual-paned, LoE3-coated glass, improving the energy performance rating by 35 percent over skylights from the early 1990s constructed with dual pane clear glass</li>
                <li>Energy performance is even greater with current VELUX skylights over acrylic bubble skylights</li>
            </ul>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section reroofing">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/installation-methods.png')?>" alt>
            <p>If you're reroofing, VELUX recommends replacing your skylights:</p>
            <ul class="ps-list">
                <li>Most cost-efficient time, as the roofer will be on the roof already to complete the job&mdash;no separate visit</li>
                <li>Synchronizes roof and skylight warranties</li>
                <li>Assurance that roofing material will match</li>
            </ul>
        </div>
    </div>
</section>
<?php
    $data['add_why_border'] = TRUE;
    $data['add_leak_cta'] = TRUE;
    echo $this->load->view('partials/_paid-search-why-velux', $data);
    echo $this->load->view('partials/_paid-search-no-leak',$data);
?>