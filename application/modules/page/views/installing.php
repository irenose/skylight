<?=$this->load->view('partials/_navigation-secondary')?>
<a name="overview"></a>
<section class="page-row bg-grey">
    <header class="intro-statement intro-statement--squeezed">
        <h2 class="normal-weight">Installing Skylights</h2>
        <p>Come up on the roof with us, and see why VELUX skylights are the most dependable skylights you can have in your home.</p>
        <a href=<?php echo '"' . $installer_base_url . '/contact"'?> data-modal-open data-ajax-vars='{"view":"partials/_modal-content", "content-type":"contact"}'>Schedule A Consultation</a>
    </header>
</section>
<a name="what-to-expect"></a>
<section class="page-row page-row--extra-tall border-top-grey installing">
    <div class="row">
        <div class="small-12 medium-6 columns centered video">
            <?=$this->load->view('partials/_video')?>
        </div>
        <div class="small-12 medium-5 medium-offset-1 columns reversed what-to-expect">
            <h3>What Should You Expect During Installation?</h3>
            <p>A new skylight installation typically takes four to five hours per skylight and happens in two phases: rooftop and interior. The rooftop portion of the installation includes cutting the hole and fastening the skylight to the roof with the three layers of protection found in VELUX No Leak Skylights.</p>
        </div>
    </div>
</section>
<a name="skylight-orientation"></a>
<section class="page-row bg-grey border-top-grey">
    <header class="header-statement header-statement--squeezed">
        <h3 class="upper">Skylight Orientation and Utility Savings</h3>
        <p>Before your installer gets to work, they will determine the best location for skylights in your home. Orientation on your roof will affect how much light comes through your skylight and the role it will play in improving your home’s energy efficiency.</p>
    </header>
</section>
<section class="border-top-grey bg-grey skylight-orientation">
    <div class="row">
        <div class="small-12 medium-6 columns centered">
            <div class="centered-half centered-half--squeezed first">
                <i class="icon icon-compass icon-compass--north" aria-hidden="true">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-compass"></use>
                    </svg>
                </i>
                <h4>Northern Exposure</h4>
                <p>Homes in warmer climates can reduce lighting costs by maximizing natural lighting provided by skylights installed on a roof with a northern exposure.</p>
            </div>
        </div>
        <div class="small-12 medium-6 columns centered">
            <div class="centered-half centered-half--squeezed last">
                <i class="icon icon-compass icon-compass--south" aria-hidden="true">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-compass"></use>
                    </svg>
                </i>
                <h4>Southern Exposure</h4>
                <p>Studies show that homes located in cooler climates can reduce heating costs in the winter and lighting costs during warmer months with skylights installed on a roof with a southern exposure.</p>
            </div>
        </div>
    </div>
</section>
<a name="energy-efficiency"></a>
<section class="page-row border-top-grey centered">
    <div class="row statement-images--installing">
            <div class="small-12 medium-5 medium-push-1 columns text-right">
                <div class="statement-image-container polaroid--round old">
                    <img src="<?=asset_url('images/old.jpg')?>" class="statement-image" alt>
                </div>
            </div>
            <div class="small-12 medium-5 medium-pull-1 columns text-left">
                <div class="statement-image-container polaroid--round new">
                    <img src="<?=asset_url('images/new.jpg')?>" class="statement-image" alt>
                </div>
            </div>
    </div>
    <header class="header-statement header-statement--squeezed">
        <h3 class="upper">Improve Home Efficiency</h3>
        <p>Our current skylight models come standard with dual-paned LoE3 coated glass, which improves the energy performance rating by 35 percent over skylights from the early 1990s constructed with dual-paned clear glass. And if you have acrylic bubble skylights on your home, the energy performance gain is even greater. Our newest models also feature Clean, Quiet and Safe glass with Neat&reg; glass technology.</p>
        <a class="btn">Learn More</a>
    </header>
</section>
<a name="tax-credits"></a>
<section class="page-row page-row--tall replacing">
    <div class="row">
        <div class="small-12 medium-6 columns first">
            <h3 class="reversed upper">When Should You Replace An Older Skylight? A Federal Tax Credit Says “Now.”</h3>
            <p>VELUX skylights make saving energy a breeze. Not only will they help you save on heating and cooling, but you’ll also be eligible for a substantial tax credit when you replace or add a VELUX Solar Powered Skylight.</p>
            <a class="btn">Learn More</a>
        </div>
        <div class="small-12 medium-6 columns centered last">
            <div class="incentives">
                <div class="incentive"><span class="big">30%</span><br>Federal Tax<br>Credit</div>
                <div class="incentive"><span class="big">$100</span><br>average savings<br>to solar from<br>fixed</div>
                <div class="incentive"><span class="big">$340</span><br>savings with<br>solar over<br>manual</div>
            </div>
        </div>
    </div>
</section>
<section class="page-row snug-bottom after-installation">
    <div class="row">
        <div class="small-12 medium-6 medium-push-6 columns last">
            <div class="brochure">
                <img src="<?=asset_url('images/brochure.png')?>" class="" alt>
            </div>
        </div>
        <div class="small-12 medium-6 medium-pull-6 columns first reversed">
            <h3 class="upper">After Installation</h3>
            <p>Once your skylight is installed, rest assured that VELUX skylights are backed by a 10-year warranty on product and installation. So, sit back, relax and enjoy the view.</p>
            <a class="btn">Download</a>
        </div>
    </div>
</section>
<a name="discover-more"></a>
<?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_discover-more') : null );?>
