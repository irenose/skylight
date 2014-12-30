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
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" itemscope itemtype="http://schema.org/Article"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $meta_title; ?></title>
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="canonical" href="<?php echo $canonical_url; ?>" />

    <?php
        /*-------------------------------
            REQUESTED HEADER TAGS FOR SEO
            Will configure closer to launch
        --------------------------------*/
    ?>

    <!-- Google Authorship and Publisher Markup --> 
    <link rel="author" href=" https://plus.google.com/[Google+_Profile]/posts"/>
    <link rel="publisher" href="https://plus.google.com/[Google+_Page_Profile]"/>

    <!-- Schema.org markup for Google+ --> 
    <meta itemprop="name" content="The Name or Title Here"> 
    <meta itemprop="description" content="This is the page description"> 
    <meta itemprop="image" content=" http://www.example.com/image.jpg">

    <!-- Twitter Card data --> 
    <meta name="twitter:card" content="summary_large_image"> 
    <meta name="twitter:site" content="@publisher_handle"> 
    <meta name="twitter:title" content="Page Title"> 
    <meta name="twitter:description" content="Page description less than 200 characters"> 
    <meta name="twitter:creator" content="@author_handle"> 
    <!-- Twitter summary card with large image must be at least 280x150px --> 
    <meta name="twitter:image:src" content=" http://www.example.com/image.html">

    <!-- Open Graph data --> 
    <meta property="og:title" content="Title Here" /> 
    <meta property="og:type" content="article" /> 
    <meta property="og:url" content=" http://www.example.com/" />
    <meta property="og:image" content=" http://example.com/image.jpg" />
    <meta property="og:description" content="Description Here" /> 
    <meta property="og:site_name" content="Site Name, i.e. Moz" /> 
    <meta property="article:published_time" content="2013-09-17T05:59:00+01:00" /> 
    <meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" /> 
    <meta property="article:section" content="Article Section" /> 
    <meta property="article:tag" content="Article Tag" /> 
    <meta property="fb:admins" content="Facebook numberic ID" />

    <?php
        /*-------------------------------
            END SEO TAGS
        --------------------------------*/
    ?>

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
    <!-- HEADER -->
    <div class="page">
        <?=( $this->uri->segment(1) != 'styleguide' ? $this->load->view('partials/_masthead') : null );?>

        <main role="main">
        <?php
            echo $this->load->view($page_view);
        ?>
        </main>
        <?=$this->load->view('partials/_footer');?>
    </div>
    <!-- FOOTER -->
    <?=$this->load->view('partials/_modal');?>
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
    <script src="<?=asset_url('js/scripts.min.js')?>"></script>

    <!-- LiveReload (development only) -->
    <?=get_livereload()?>
</body>
</html>