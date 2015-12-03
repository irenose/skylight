<?php 
    /******************************* SECONDARY NAV *************************/ 
    /*
        REMOVED 1-19-15
        $this->load->view('partials/_navigation-secondary');
    */
?>

<?php 
    /******************************* INTRO COPY *************************/ 
?>

<?php
    $data['secondary_nav_links'] = array(
        'return' => null,
        'main' => array(
            0 => array(
                'title' => 'Replacing',
                'anchor-name' => 'replacing',
            ),
            1 => array(
                'title' => 'Tax Credit Savings',
                'anchor-name' => 'tax-credit-savings',
            ),
            2 => array(
                'title' => 'Solar Blinds',
                'anchor-name' => 'solar-blinds',
            ),
            3 => array(
                'title' => 'No-Leak Warranty',
                'anchor-name' => 'no-leak-warranty',
            ),
        ),
    );
   // var_export($data);
?>


<section>
    <div class="page-row">
        <header>
            <div class="centered">
                <h1 class="alpha">
                    <span class="br">When Should You</span> Replace a Skylight?   
                </h1>
                <p class="squeezed-3">
                    We recommend replacing your skylights when you reroof. It’s the most cost-efficient way, and it allows you to synchronize your roof and skylight warranties.
                </p>
            </div>
        </header>
        <a href="#<?=$data['secondary_nav_links']['main'][0]['anchor-name']?>" class="btn-scroll btn-scroll--bisect" title="Scroll" data-btn-scroll>
            <?=use_svg(array('classes' => 'icon icon-chevron--down--reversed', 'svg-node' => 'icon-chevron--down--reversed', 'aria-hidden' => 'true'))?>
        </a>
    </div>
</section>

<a name="<?=$data['secondary_nav_links']['main'][0]['anchor-name']?>"></a>
<section>
    <div class="page-row reversed bg-house-at-dusk">
        <div class="row push-bottom">
            <div class="small-12 medium-6 large-5 columns">
                <h2 class="beta">
                    <span class="br">VELUX Skylights</span> are Energy Efficient
                </h2>
                <p>
                    If a new roof isn’t in your near future, consider replacing an older skylight to improve the energy efficiency of your home. At VELUX, we improve the energy performance of our skylights with each new model, so even if you have an older VELUX skylight that works fine, it is often worth replacing it with a newer model.
                </p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="page-row bg-zircon">
        <div class="pull-top improve-old-new">
            <div class="row">
                <div class="atomic">
                    <div class="atomic__item first">
                        <figure>
                            <div class="polaroid polaroid--round">
                                <img src="<?=asset_url('images/286x286/roof-skylights-old.jpg')?>" alt="old skylights" class="polaroid__item">
                                <figcaption>
                                    <div class="atomic__caption">
                                        Old
                                    </div>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                    <div class="atomic__item last">
                        <figure>
                            <div class="polaroid polaroid--round">
                                <img src="<?=asset_url('images/286x286/roof-skylights-new.jpg')?>" alt="new skylights" class="polaroid__item">
                                <figcaption>
                                    <div class="atomic__caption">
                                        New
                                    </div>
                                </figcaption>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <header class="centered push-top--half">
                <h2 class="beta">
                    Improve Home Efficiency
                </h2>
                <p class="squeezed-2">
                    Our current skylight models come standard with dual paned, LoE3 coated glass, which improves the energy performance rating by 35 percent over skylights from the early 1990s constructed with dual pane clear glass. And if you have acrylic bubble skylights on your home, the energy performance gain is even greater. Our newest models also feature Clean, Quiet and Safe glass with Neat<sup>®</sup> glass technology.
                </p>
            </header>
        </div>
    </div>
</section>

<a name="<?=$data['secondary_nav_links']['main'][1]['anchor-name']?>"></a>
<section>
    <div class="page-row page-row--tall snug-bottom reversed" data-wallpaper='{"file":"solar-skylight-on-roof", "ext":"jpg"}'>
        <div class="row">
            <div class="small-12 large-5 columns">
                <h2 class="beta">
                    <span class="br">Tax Credits and</span> <span class="br">Solar Power Mean</span> Savings for You
                </h2>
                <p>
                    VELUX No Leak Solar Powered “Fresh Air” Skylights qualify for a 30% federal tax credit on product and installation. If you have an older fixed skylight, upgrade to a Solar Powered “Fresh Air” Skylight and bring fresh air as well as natural light into your home for an average of just $100 more than a standard fixed skylight after tax credit eligibility. Available through Dec. 31, 2016, this tax credit is a direct debit of the taxpayer’s total tax liability. If you’re considering a replacement Manual “fresh Air” Skylight, you could upgrade to the Solar Powered “Fresh Air” Skylight and save about $140 after tax credit eligibility.
                </p>
                
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                <div class="info-boxes">
                    <div class="info-boxes__item">
                        <span class="beta info-boxes__item__heading">
                            30%
                        </span>
                        <span class="info-boxes__item__note"><span class="br">Federal</span> Tax Credit</span>
                    </div>
                    <div class="info-boxes__item">
                        <span class="beta info-boxes__item__heading">
                            $100<span class="asterisk">*</span>
                        </span>
                        <span class="info-boxes__item__note"><span class="br">average savings to</span> solar from fixed</span>
                    </div>
                    <div class="info-boxes__item">
                        <span class="beta info-boxes__item__heading">
                            $140<span class="asterisk">*</span>
                        </span>
                        <span class="info-boxes__item__note"><span class="br">savings with solar</span> over manual</span>
                    </div>
                    <span class="info-boxes__caption">
                        <span class="asterisk">*</span> After tax credit eligibility<br>
                        <span class="asterisk">*</span> Solar powered Fresh Air Deck Mounted Skylight shown
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<a name="<?=$data['secondary_nav_links']['main'][2]['anchor-name']?>"></a>
<?=$this->load->view('partials/_cta-blinds');?>


<a name="<?=$data['secondary_nav_links']['main'][3]['anchor-name']?>"></a>
<?=$this->load->view('partials/_cta-warranty-no-leak-promise');?>


<?php 
    /******************************* DISCOVER MORE *************************/ 
    $data['discover_section'] = 'installing';
    echo $this->load->view('partials/_discover-more',$data);
?>

