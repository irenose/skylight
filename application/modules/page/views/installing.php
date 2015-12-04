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
            'title' => 'What to It takes ',
            'anchor-name' => 'what-to-expect',
        ),
        1 => array(
            'title' => 'Skylight Orientation',
            'anchor-name' => 'skylight-orientation',
        ),
        2 => array(
            'title' => 'Ceiling Style',
            'anchor-name' => 'ceiling-style',
        ),
        3 => array(
            'title' => 'Mounting',
            'anchor-name' => 'mounting',
        ),
        4 => array(
            'title' => 'Warranty',
            'anchor-name' => 'warranty',
        ),
    ),
);
?>
<?=$this->load->view('partials/_navigation-secondary', $data)?>

<section>
    <div class="page-row centered">
        <header class="intro-statement intro-statement--squeezed">
            <h1 class="normal-weight">
                Installation Is<br> a Breeze.
            </h1>
            <p class="squeezed-3">
                Come up on the roof with us, and see why VELUX skylights are the most dependable skylights you can have in your home.
            </p>
        </header>
        <a href="#<?=$data['secondary_nav_links']['main'][0]['anchor-name']?>" class="btn-scroll btn-scroll--bisect" title="Scroll" data-btn-scroll>
            <?=use_svg(array('classes' => 'icon icon-chevron--down--reversed', 'svg-node' => 'icon-chevron--down--reversed', 'aria-hidden' => 'true'))?>
        </a>
    </div>
</section>

<?php 
    /******************************* WHAT TO EXPECT *************************/ 
?>
<a name="<?=$data['secondary_nav_links']['main'][0]['anchor-name']?>"></a>
<?=$this->load->view('partials/_cta-what-to-expect')?>

<?php 
    /******************************* It takes about a half day *************************/ 
?>
<section class="find-installers">
    <div class="page-row bg-whitesmoke-dark">
        <div class="row">
            <div class="small-12 medium-6 columns">
                <p>
                    It takes about a half day per skylight to complete the interior portion of the installation, which includes drywall and painting. The type of ceiling in your home – vaulted or flat – will also affect the amount of time it takes to complete the interior portion of the installation.
                </p>
                <p>
                    Flat ceilings require more drywall work than vaulted ceilings. If you have a flat ceiling, your installer will use drywall to build a shaft from the skylight to direct the daylight into the room. Your installer will paint the light shaft to match the surrounding ceiling area.
                </p>
                <p>
                    Installers will make every effort to protect your home’s interior from dust and other installation debris. Often they will construct a curtain of plastic sheeting around the space in your ceiling where the skylight will be installed to contain dust.
                </p>
               
            </div>
            <div class="small-12 medium-5 medium-offset-1 end columns">
                <figure class="centered mobile-hide polaroid polaroid--round">
                    <img src="<?=asset_url('images/395x395/nailing-roof.jpg')?>" alt="installing a skylight" class="polaroid__item">
                </figure>
            </div>
        </div>
    </div>
</section>

<?php 
    /******************************* SKYLIGHT ORIENTATION *************************/ 
?>
<section class="page-row bg-grey border-top-grey skylight-orientation" id="skylight-orientation">
    <header class="header-statement header-statement--squeezed">
        <h2 class="upper normal-weight"><span class="br">Skylight Orientation </span>and Utility Savings</h2>
        <p>Before your installer gets to work, they will determine the best location for skylights in your home. Orientation on your roof will affect how much light comes through your skylight and the role it will play in improving your home’s energy efficiency.</p>
    </header>
</section>
<section class="border-top-grey bg-grey skylight-exposure">
    <div class="row">
        <div class="small-12 medium-6 columns centered">
            <div class="centered-half centered-half--squeezed first">
                <i class="icon icon-compass icon-compass--north" aria-hidden="true">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-compass"></use>
                    </svg>
                </i>
                <h3 class="normal-weight">Northern Exposure</h3>
                <p>Homes in warmer climates can reduce lighting costs by maximizing natural lighting provided by skylights installed on a roof with a northern exposure.</p>
            </div>
        </div>
        <div class="small-12 medium-6 columns centered">
            <div class="centered-half centered-half--squeezed last">
                <i class="icon icon-compass icon-compass--south" aria-hidden="true">
                    <svg class="icon__svg">
                        <use xlink:href="<?=asset_url('images/sprites/sprite.svg')?>#icon-compass--south"></use>
                    </svg>
                </i>
                <h3 class="normal-weight">Southern Exposure</h3>
                <p>Studies show that homes located in cooler climates can reduce heating costs in the winter and lighting costs during warmer months with skylights installed on a roof with a southern exposure.</p>
            </div>
        </div>
    </div>
</section>

<?php 
    /******************************* SKYLIGHTS & YOUR CEILING STYLE *************************/ 
?>
<a name="<?=$data['secondary_nav_links']['main'][2]['anchor-name']?>"></a>
<section>
    <div class="page-row underlap" data-wallpaper='{"file":"clouds", "ext":"jpg"}'>
        <header>
            <div class="centered">
                <h2 class="beta reversed text-shadow">
                    Skylights &amp; Your Ceiling Style
                </h2>
                <p class="squeezed-3 color-montana">
                    Your skylight installer is the best person to evaluate your home’s daylighting needs. They can recommend where skylights should be installed, so you can reap maximum benefit from the natural light and fresh air they provide. Skylights can be installed in flat or vaulted ceilings.
                </p>
            
            </div>
        </header>
        <div class="push-top--half constrained">
            <ul class="slick" data-carousel-init="auto" data-carousel-type="ceiling-types" data-slides-to-show="2" data-equal-heights>
                <li class="slick__item ceiling-style__item">
                    <div class="card shadowed">
                        <figure>
                            <div class="card__figure">
                                <img src="<?=asset_url('images/510x385/apples-and-wine.jpg')?>" alt="a room with a flat ceiling">
                            </div>
                            <figcaption>
                                <div class="card__body">
                                    <h3 class="gamma">
                                        Flat Ceilings
                                    </h3>
                                    <p>
                                        For flat ceilings, your installer will build a shaft or light well using drywall to connect your skylight from the roof through the attic space to the room below. Shafts can take a variety of shapes and sizes, which will affect the way daylight is delivered to the room.
                                    </p>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </li>
                <li class="slick__item ceiling-style__item">
                    <div class="card shadowed">
                        <figure>
                            <div class="card__figure">
                                <img src="<?=asset_url('images/510x385/adjusting-the-thermostat.jpg')?>" alt="a room with a vaulted ceiling">
                            </div>
                            <figcaption>
                                <div class="card__body">
                                    <h3 class="gamma">
                                        Vaulted Ceilings
                                    </h3>
                                    <p>
                                        For vaulted ceilings, your installer will not need to build a light shaft, but will complete a small amount of interior drywall work in your ceiling.
                                    </p>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php 
    /******************************* WHICH SKYLIGHT INSTALLATION IS RIGHT FOR YOU? *************************/ 
?>

<section>
    <div class="page-row bg-zircon">
        <header class="centered">
            <h2 class="beta">
                <span class="br">Which skylight installation</span> is right for you?
            </h2>
            <p class="squeezed-2">
                <em>
                    VELUX "Fresh Air" and fixed skylights come in both deck mounted and curb mounted styles. Your skylight installer is the best person to decide which style works for your home.
                </em>
            </p>
        </header>
        <div class="constrained vs">
            <div class="vs__item first">
                <h3 class="gamma vs__heading">
                    Deck Mounted
                </h3>
                <p>
                    The skylight’s deck seal is nailed directly to your roof deck for a low profile, energy-efficient installation. Deck mounted skylights are best for roofs with a pitch between 14 and 85 degrees.
                </p>
            </div>
            <span class="vs__symbol">
                VS.
            </span>
            <div class="vs__item last">
                <h3 class="gamma vs__heading">
                    Curb Mounted
                </h3>
                <p>
                    The skylight’s deck seal is nailed directly to your roof deck for a low profile, energy-efficient installation. Deck mounted skylights are best for roofs with a pitch between 14 and 85 degrees.
                </p>
            </div>
            <div class="vs__caret"></div>
        </div>
    </div>
</section>

<?php 
    /******************************* AFTER INSTALLATION *************************/ 
?>
<section class="page-row snug-bottom after-installation">
    <div class="row">
        <div class="small-12 medium-6 medium-push-6 columns last">
            <div class="brochure">
                <img src="<?=asset_url('images/brochure.png')?>" class="" alt>
            </div>
        </div>
        <div class="small-12 medium-6 medium-pull-6 columns first reversed">
            <h2 class="upper normal-weight">After Installation</h2>
            <p>Once your skylight is installed, rest assured that VELUX skylights are backed by a 10-year warranty on product and installation. So, sit back, relax and enjoy the view.</p>
            <a href="<?=site_url('content-uploads/resources/product-warranty.pdf')?>" class="btn" target="_blank">Download</a>
        </div>
    </div>
</section>

<?php 
    /******************************* DISCOVER MORE *************************/ 
    $data['discover_section'] = 'installing';
    echo $this->load->view('partials/_discover-more',$data);
?>

