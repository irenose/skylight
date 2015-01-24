
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
<section class="page-row short-top snug-bottom ps-section benefits">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <h4 class="normal-weight underlined color-primary">Upgrading your skylight can make a major impact in your home's energy efficiency and appearance.  </h4>
            <ul class="ps-list">
                <li>Current VELUX models come with a dual paned, LoE3 coated glass, improving the energy performance rating by 35 percent over skylights from the early 1990s constructed with dual pane clear glass</li>
				<li>Energy performance is even greater with current VELUX skylights over acrylic bubble skylights</li>
				<li>Newest VELUX models feature Clean, Quiet and Safe glass with Neat® glass technology</li>
				<ul class="ps-list">
					<li>Clean: the Neat&reg; glass coating keeps skylights virtually spotless</li>
					<li>Quiet: reduce unwanted outside noise </li>
					<li>Safe: VELUX recommends, and building codes require, laminated glass for out of reach applications</li>
				</ul>
				<li>Upgrade to the No Leak Solar Powered "Fresh Air" skylight and you may be eligible for a 30% Federal tax credit on product and installation </li>

            </ul>
            <h4 class="normal-weight underlined color-primary">If you're reroofing, VELUX recommends replacing your skylights: </h4>
            <ul class="ps-list">
                <li>Most cost efficient time, as the roofer will be on the roof already to complete the job – no separate visit</li>
				<li>Synchronizes roof and skylight warranties</li>
				<li>Assurance that roofing material will match</li>
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