<?php
	//Set Values for Meta Data - Provide default data if not set
	if ( ! isset($meta_array) || $meta_array['title'] == '') {
		if (isset($page_title)) {
			$meta_title = $page_title;
		} else {
			$meta_title = '';
		}
	} else {
		$meta_title = $meta_array['title'];
	}
	if ( ! isset($meta_array) || $meta_array['keywords'] == '') {
		$meta_keywords = '';
	} else {
		$meta_keywords = $meta_array['keywords'];
	}
	if ( ! isset($meta_array) || $meta_array['description'] == '') {
		$meta_description = '';
	} else {
		$meta_description = $meta_array['description'];
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $meta_title; ?></title>
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">
    <meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
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
    <div class="page">
        <main role="main">
        <?php
            echo $this->load->view($page_view);
        ?>
        </main>
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