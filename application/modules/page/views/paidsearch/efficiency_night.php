
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">With innovative new VELUX skylights, you get daylight, fresh air and a whole lot of energy savings.</h1>
    </header>
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero efficiency">
            <div class="energy-star-icon"><img src="<?=asset_url('images/ps/energy-star.jpg')?>" alt></div>
        </div>
        <div class="small-12 medium-4 columns welcome-list-wrapper">
            <div class="welcome-list">
                <div class="row">
                    <div class="small-12 columns">
                        <h4>Skylight innovation and energy efficiency go hand-in-hand.</h4>
                        <div class="form-grey-border"></div>
                        <ul class="ps-list">
                            <li>More than 90% of VELUX products are ENERGY STAR&reg; qualified </li>
							<li>"Fresh Air" models help cool home and reduce reliance on air conditioning</li>
							<li>Add blinds for additional energy-efficiency savings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section product-statement energy-star">
    <div class="ps-form" id="ps-form">
        <?php 
            /******************************* LOAD FORM *************************/
            echo $this->load->view('partials/_paid-search-form');
        ?>
    </div>
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey statement">
            <img src="<?=asset_url('images/ps/energy-star.jpg')?>" alt>
            <h4 class="normal-weight no-image">Replacing old skylights with VELUX skylights makes your home more energy efficient. </h4>
            <ul class="ps-list">
                <li>Most VELUX skylights are ENERGY STAR&reg; certified in all climate regions in the United States</li>
                <li>VELUX skylights come standard with energy-efficient, LoE3, Argon-gas-injected, dual-pane glazing that helps keep your home warm in the winter and cool in the summer</li>
                <li>Select a "Fresh Air" model and help cool your home during the spring and fall while reducing the load on your air conditioner</li>
                <li>Add blinds for light control and improve your skylight's energy performance more than 34%</li>
                <li>Install the No Leak Solar Powered "Fresh Air" skylight and you may be eligible for a 30% Federal tax credit on product and installation</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section tax-credit-row">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
            <ul class="ps-list">
                <li>Install a No Leak Solar Powered "Fresh Air" skylight and you may be eligible for a 30% Federal tax credit on product and installation</li>
            </ul>
        </div>
    </div>
</section>
<?= $this->load->view('partials/_paid-search-why-velux') ?>
<?= $this->load->view('partials/_paid-search-no-leak') ?>