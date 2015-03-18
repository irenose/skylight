
<section class="page-row page-row--snug ps-welcome-wrapper">
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero efficiency">
            <img src="<?=site_url('assets/images/ps/hero/no-leak-skylight.jpg')?>">
            <div class="energy-star-icon"><img src="<?=asset_url('images/ps/energy-star.jpg')?>" alt></div>
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
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey statement">
            <h2 class="ps-welcome-header">With innovative new VELUX skylights, you get daylight, fresh air, energy savings and a tax credit.</h2>
            <h4 class="normal-weight no-image">Replacing old skylights with VELUX skylights makes your home more energy efficient.</h4>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section energy-star">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/energy-star.jpg')?>" alt>
            <ul class="ps-list">
                <li>Most VELUX skylights are ENERGY STAR&reg; certified in all climate regions in the United States</li>
				<li>VELUX skylights come standard with energy-efficient, LoE3, argon-gas-injected, dual-pane glazing that helps keep your home warm in the winter and cool in the summer</li>
				<li>Select a "Fresh Air" model and help cool your home during the spring and fall while reducing the load on your air conditioner</li>
				<li>Add blinds for light control and improve your skylight's energy performance more than 34%</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section tax-credit-row">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
            <ul class="ps-list">
                <li>Install a No Leak Solar Powered "Fresh Air" skylight, and you may be eligible for a 30% Federal tax credit on product and installation</li>
            </ul>
        </div>
        <?= $this->load->view('partials/_paid-search-call-cta') ?>
    </div>
</section>
<?php
    $data['add_why_border'] = TRUE;
    $data['add_leak_cta'] = TRUE;
    echo $this->load->view('partials/_paid-search-why-velux', $data);
    echo $this->load->view('partials/_paid-search-no-leak',$data);
?>