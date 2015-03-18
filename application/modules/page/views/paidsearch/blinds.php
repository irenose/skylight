
<section class="page-row page-row--snug ps-welcome-wrapper">
    <div class="row ps-welcome">
        <div class="small-12 medium-8 columns ps-hero skylight-blinds">
            <img src="<?=site_url('assets/images/ps/hero/skylight-blinds.jpg')?>">
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
            <h2 class="ps-welcome-header">Bring a little control and some more style to your skylit world.</h2>
            <h4 class="normal-weight">Blinds add the ultimate functionality to skylights by giving you control over the amount of light they bring into your home. Not to mention, they come in a variety of stylish designs to help reflect your home's personality.</h4>
            <img src="<?=asset_url('images/ps/blinds.png')?>" class="big-blinds" alt>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section tax-credit-row tax-credit--short">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet border-bottom-grey">
            <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
            <h4>Solar powered blinds are eligible for a 30% Federal tax credit.</h4>
        </div>
    </div>
</section>
<section class="page-row short-top snug-bottom ps-section blind-examples">
    <div class="row">
        <div class="small-12 medium-8 columns full-tablet cta-padding border-bottom-grey">
            <p>There are more than 65 styles of blinds available to choose from:</p>
            <div class="blinds-container">
                <div class="row">
                    <img src="<?=asset_url('images/ps/blinds/darkening.png')?>" alt>
                    <div class="blind-example">
                        <strong>Room darkening &ndash; double pleated blinds:</strong> Solar powered or manually operated, these blinds feature blackout cloth with a honeycomb structure that are energy-efficient and have a sleek design
                    </div>
                </div>
                <div class="row">
                    <img src="<?=asset_url('images/ps/blinds/filtering-pleat.png')?>" alt>
                    <div class="blind-example">
                        <strong>Light filtering &ndash; single pleated blinds:</strong> Solar powered or manually operated, these blinds let a soft light enter the room and come in 15 color options
                    </div>
                </div>
				<div class="row">
                    <img src="<?=asset_url('images/ps/blinds/blackout.png')?>" alt>
                    <div class="blind-example">
                        <strong>Blackout blinds &ndash; flat:</strong> Solar powered or manually operated, ideal for bedroom applications and come in more than 20 colors and patterns
                    </div>
                </div>
				<div class="row">
                    <img src="<?=asset_url('images/ps/blinds/filtering-flat.png')?>" alt>
                    <div class="blind-example">
                        <strong>Light filtering blinds &ndash; flat:</strong> Solar powered or manually operated, offers both protection and good looks with 15 colors and patterns to choose from
                    </div>
                </div>
				<div class="row">
                    <img src="<?=asset_url('images/ps/blinds/venetian.png')?>" alt>
                    <div class="blind-example">
                        <strong>Venetian blinds:</strong> Manually operated and available in eight colors, lets you control the direction of incoming light
                    </div>
                </div>
                <div class="row">
                    <div class="blind-example">If you order blinds with your skylight, choose from ten factory-installed blinds or choose from 65 special-order designer blinds. Special-order blinds will ship separately.
                    </div>
                </div>
            </div>
            <?= $this->load->view('partials/_paid-search-call-cta') ?>
        </div>
    </div>
</section>
<?= $this->load->view('partials/_paid-search-why-velux') ?>