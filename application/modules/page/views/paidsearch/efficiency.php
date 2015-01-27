
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">With innovative new VELUX skylights, you get daylight, fresh air and a whole lot of energy savings.</h1>
    </header>
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
        </div>
        <div class="small-12 medium-4 columns ps-form" id="ps-form">
            <?php 
                /******************************* LOAD FORM *************************/
                echo $this->load->view('partials/_paid-search-form');
            ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom product-statement">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey statement">
            <h4 class="normal-weight">Replacing old skylights with VELUX skylights makes your home more energy efficient.  </h4>
            <img src="<?=asset_url('images/ps/skylight.png')?>" alt>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section benefits">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <ul class="ps-list">
                <li>Most VELUX skylights are ENERGY STAR® certified in all climate regions in the United States ((JOSH: USE ENERGY STAR LOGO))</li>
				<li>VELUX skylights come standard with energy-efficient, LoE3, Argon-gas-injected, dual-pane glazing that helps keep your home warm in the winter and cool in the summer</li>
				<li>Select a “Fresh Air” model and help cool your home during the spring and fall while reducing the load on your air conditioner</li>
				<li>Add blinds for light control and improve your skylight’s energy performance more than 34%</li>
				<li>Install the No Leak Solar Powered “Fresh Air” skylight and you may be eligible for a 30% Federal tax credit on product and installation</li>

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