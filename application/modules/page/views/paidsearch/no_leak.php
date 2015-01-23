
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
            <h4 class="normal-weight">The revolutionary No Leak Solar Powered "Fresh Air" skylight is eligible for a 30% Federal tax credit, saving eligible homeowners an average of $850 on product and installation. </h4>
            <img src="<?=asset_url('images/ps/skylight.png')?>" alt>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section benefits">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <h4 class="normal-weight underlined color-primary">Benefits</h4>
            <ul class="ps-list">
                <li>Solar operated and requires no wiring</li>
                <li>Works on cloudy days and with indirect light</li>
                <li>Comes with the No Leak Promise – 10-year installation warranty, 20 years on glass, 10 years on the skylight and 5 years on blinds and controls</li>
                <li>Add light control with factory installed blinds, or choose from more than 100 special order blinds</li>
                <li>Remote control lets you open and close skylights and blinds with the touch of a button</li>
                <li>Feature Clean, Quiet and Safe glass with Neat&reg; glass technology</li>
                    <ul>
                        <li>Clean: the Neat® glass coating keeps skylights virtually spotless</li>
                        <li>Quiet: reduce unwanted outside noise</li>
                        <li>Safe: VELUX recommends, and building codes require, laminated glass for out of reach applications</li>

                    </ul>
                <li>Rain sensor that automatically closes skylight</li>
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
<section class="page-row short-top snug-bottom ps-section complete-system">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/complete-system.jpg')?>" alt>
            <h4 class="normal-weight underlined color-primary">The Complete VELUX System</h4>
            <p>Whether it's skylights, roof windows, or all the accessories that go with it, you'll find everything you need to right here.</p>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section installation-methods">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <img src="<?=asset_url('images/ps/installation-methods.png')?>" alt>
            <h4 class="normal-weight underlined color-primary">Skylight Installation Methods</h4>
            <p>Skylights are installed using a variety of different installation methods that vary based on geographic location, however VELUX has developed products that make the installation process as easy as possible. The three most common installation methods are: deck mounted, curb mounted and self-flashed. Contact us today to schedule an appointment.</p>
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