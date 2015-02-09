<?php
    //Set Values for Meta Data - Provide default data if not set
    $meta_title = isset($meta_array) && $meta_array['title'] != '' ? $meta_array['title']  : $this->config->item('title', 'default_meta_array');
    $meta_description = isset($meta_array) && $meta_array['description'] != '' ? $meta_array['description']  : $this->config->item('description', 'default_meta_array');
    $meta_keywords = isset($meta_array) && $meta_array['keywords'] != '' ? $meta_array['keywords']  : $this->config->item('keywords', 'default_meta_array');
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en" itemscope itemtype="http://schema.org/Article"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en" itemscope itemtype="http://schema.org/Article"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $meta_title; ?></title>
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <?php
        if(in_array($url_page_name, $hidden_page_array) || in_array($installer_url, $hidden_dealers_array)) {
            echo '<meta name="robots" content="noindex,nofollow">' . "\n";
        }
    ?>
    <?=$this->load->view('partials/_favicons');?>
    <link rel="canonical" href="<?php echo $canonical_url; ?>" />
    <?=$this->load->view('partials/_social-meta');?>

    <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=asset_url('css/styles.min.css')?>">
    <?=get_additional_scripts('css', $additional_css)?>

    <!-- modernizr (html5shiv, matchMedia), respond, svg4everybody -->
    <!--[if lte IE 8]>
    <script src="<?=site_url('dist/public/js/vendor/modernizr.custom.89282.js')?>"></script>
    <script src="<?=site_url('bower_components/respond/dest/respond.min.js')?>"></script>
    <script src="<?=site_url('bower_components/svg4everybody/svg4everybody.ie8.min.js')?>"></script>
    <![endif]-->
</head>
<body>
    <?= $this->load->view('partials/_google-analytics')?>
    <!-- HEADER -->
    <div class="page">
        <section class="masthead-wrapper">
            <div class="branding">
                <img src="<?=asset_url('images/velux-logo.png')?>" alt="VELUX Skylights">
            </div>
        </section>

        <main role="main">
        <?php
            echo $this->load->view($page_view);
        ?>
        </main>
    </div>
    <div class="is-hidden">
        <?=$this->load->view('partials/_svg-icon-loader');?>
    </div>


    <!-- jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
    if (typeof jQuery == 'undefined') {
        document.write(unescape("%3Cscript src='<?=site_url('bower_components/jquery/dist/jquery.min.js')?>' type='text/javascript'%3E%3C/script%3E"));
    }
    </script>
    <?=get_additional_scripts('js', $additional_js)?>
    <script src="<?=site_url('bower_components/imagesloaded/imagesloaded.pkgd.min.js')?>"></script>
    <script src="<?=asset_url('js/scripts.min.js')?>"></script>
</body>
</html>