
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
<section class="page-row short-top snug-bottom ps-section why-velux">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <h4 class="normal-weight underlined color-primary">Why VELUX</h4>
            <img src="<?=asset_url('images/velux-logo.png')?>" alt>
            <ul class="ps-list">
                <li>VELUX is a leader of innovation and is also the preferred skylight brand for American contractors, according to every national survey of building professionals.</li>
                <li>VELUX holds more than 300 patents in roof window and skylight designs.</li>
                <li><?=$installer_array[0]->name;?>  has gone through extensive training to become a VELUX certified 5-star skylight specialist.</li>
            </ul>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section no-leak-skylight">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <?=$this->load->view('partials/_svg-icon-no-leak.php');?>
            <h4 class="normal-weight underlined color-primary">The No Leak Skylight</h4>
            <p>With The No Leak Skylight, we promise you no leaks and no worries because our revolutionary product is built with three powerful layers of protection. That's why we offer a 10-year product and installation warranty.</p>
        </div>
    </div>
</section>