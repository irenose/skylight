
<section class="page-row page-row--snug bg-grey ps-welcome-wrapper">
    <header class="intro-statement intro-statement--squeezed">
        <h1 class="normal-weight">Welcome to a whole new world of fresh air and daylight</h1>
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
<section class="page-row snug-bottom product-statement">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey statement">
            <h4 class="normal-weight">Blinds add the ultimate functionality to skylights by giving you control over the amount of light they bring into your home. Not to mention, they come in variety of stylish designs to help reflect your home's personality.</h4>
            <h4 class="normal-weight">Solar powered blinds are eligible for the 30% Federal tax credit.</h4>
            <img src="<?=asset_url('images/ps/skylight.png')?>" alt>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section benefits">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <h4 class="normal-weight underlined color-primary">There are more than 100 styles of blinds available to choose from: </h4>
            <ul class="ps-list">
                <li><strong>Room darkening &ndash; double pleated blinds:</strong> Solar powered or manually operated, these blinds feature blackout cloth with a honeycomb structure that are energy efficient and have a sleek design</li>
                <li><strong>Light filtering &ndash; single pleat blinds:</strong> Solar powered or manually operated, these blinds let a soft light enter the room and come in 15 color options</li>
				<li><strong>Blackout blinds &ndash; flat:</strong> Solar powered or manually operated, ideal for bedroom applications and come in more than 20 colors and patterns</li>
				<li><strong>Light filtering blinds &ndash; flat:</strong> Solar powered or manually operated, offers both protection and good looks with 15 colors and patterns to choose from</li>
				<li><strong>Venetian blinds:</strong> Manually operated and available in eight colors, lets you control the direction of incoming light</li>
            </ul>
            <p>If you order blinds with your skylight, choose from ten factory-installed blinds or choose from nearly 100 special order designer blinds. Special order blinds will ship separately.  </p>
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