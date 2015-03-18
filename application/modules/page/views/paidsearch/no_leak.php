<section class="page-row page-row--snug ps-welcome-wrapper">
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero vss-no-leak">
            <img src="<?=site_url('assets/images/ps/hero/no-leak-skylight.jpg')?>">
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
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey statement">
            <h2 class="ps-welcome-header">New, innovative VELUX skylights bring you fresh air, daylight and a tax credit.</h2>
            <h4 class="normal-weight">The revolutionary No Leak Solar Powered "Fresh Air" skylight is eligible for a 30% federal tax credit, saving eligible homeowners an average of $850 on product and installation.</h4>
            <img src="<?=asset_url('images/ps/skylight.png')?>" class="skylight" alt>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section benefits">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <h4 class="normal-weight">Benefits</h4>
            <ul class="ps-list">
                <li>Solar operated and requires no wiring</li>
                <li>Works on cloudy days and with indirect light</li>
                <li>Comes with the No Leak Promise&mdash;10-year installation warranty, 20 years on glass, 10 years on the skylight and 5 years on blinds and controls</li>
                <li>Add light control with factory-installed blinds, or choose from more than 100 special-order blinds</li>
                <li>Remote control lets you open and close skylights and blinds with the touch of a button</li>
                <li>Rain sensor that automatically closes skylight</li>
            </ul>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section clean-quite-safe">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/water-droplets.jpg')?>" alt>
            <h4 class="normal-weight">Clean, Quiet and Safe glass</h4>
            <ul class="ps-list">
                <li><span class="bold">Clean:</span> the Neat&reg; glass coating keeps skylights virtually spotless</li>
                <li><span class="bold">Quiet:</span> reduce unwanted outside noise</li>
                <li><span class="bold">Safe:</span> VELUX recommends, and building codes require, laminated glass for out-of-reach applications</li>
            </ul>
        </div>
    </div>
</section>
<?php
    $data['add_why_border'] = TRUE;
    $data['add_leak_border'] = TRUE;
    echo $this->load->view('partials/_paid-search-why-velux', $data);
    echo $this->load->view('partials/_paid-search-no-leak',$data);
?>
<section class="page-row short-top snug-bottom ps-section complete-system">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <img src="<?=asset_url('images/ps/complete-system.jpg')?>" alt>
            <h4 class="normal-weight">The Complete VELUX System</h4>
            <p>Whether it's skylights, roof windows, or all the accessories that go with them, you'll find everything you need to right here.</p>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section installation-methods">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding">
            <img src="<?=asset_url('images/ps/installation-methods.png')?>" alt>
            <h4 class="normal-weight">Skylight Installation Methods</h4>
            <p>Skylights are installed using a variety of different installation methods that vary based on geographic location; however, VELUX has developed products that make the installation process as easy as possible. The three most common installation methods are: deck-mounted, curb-mounted and self-flashed. Contact us today to schedule an appointment.</p>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>