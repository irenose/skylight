<?php
	if( ! isset($page_title)) {
		$page_title = 'Administration';
	}
	
	if( ! isset($logout_link)) {
		$logout_link = '/admin/logout';
	}
	
	if( ! isset($current_section)) {
		$current_section = '';
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
    <title><?php echo $page_title; ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Karla:400,700,700italic' rel='stylesheet' type='text/css'>
	<link href="/src/admin/assets/css/colorbox.css" type="text/css" rel="stylesheet">
    <link href="/src/admin/assets/css/admin_styles.css" rel="stylesheet" type="text/css" />
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script src="/src/admin/assets/js/modernizr-2.6.2.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/src/admin/assets/js/jquery-1.7.1.min.js"><\/script>')</script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
    <script>
		$(document).ready(function() {
			$('.form_submit').click(function() {
				var button_value = $(this).attr('rel');
				$('form').append('<input type="hidden" name="action_value" value="' + button_value + '" />').submit();							 							 
			});
			
		});
	</script>
</head>
<body>
<!-- Help Dialogue Window -->
<div id="help_content">

</div>
<!-- End Help Dialogue Window -->

<div id="global">
	<div id="logo">
    	<a href="/admin/home">
        	<?php
				if($this->config->item('admin_client_logo') != '') {
					echo '<img src="' . $this->config->item('admin_client_logo') . '" alt="' . $this->config->item('admin_client_name') . '" border="0" />';
				} else {
					echo $this->config->item('admin_client_name');
				}
			?>
        </a>
    </div>
<?php 
	//Hide Navigation From Non-Logged In User
	if( ! isset($hide_navigation) || $hide_navigation == FALSE) { 
?>
<div id="welcome_logout"><span class="welcome_messaging">WELCOME <span class="admin_username"><?php echo $_SESSION['first_name']; ?></span></span> | 
	<?php 
		if($_SESSION['uid'] != '' && $_SESSION['uid'] != '99999') { 
			echo '<span class="welcome_messaging"><a href="/admin/profile/update-password/' . $_SESSION['uid'] . '">Change Password</a></span> | ';
		}
	?>
	<span class="welcome_messaging"><a href="<?php echo $logout_link; ?>" class="logout">log out</a></span>
</div>
<?php 
	//End Hide Navigation for Non-Logged In User
	} 
?>
</div>

<div id="wrapper">

	<div id="container" class="clearfix">
	
        <!-- BEGIN HEADER AREA -->
    
        <nav id="nav">
            <?php 
                //Hide Navigation From Non-Logged In User
                if( ! isset($hide_navigation) || $hide_navigation == FALSE) { 
            ?>
                <ul id="menu">
                	<li class="main<?php if($current_section == 'home') { echo ' selected'; } ?>"><a href="/admin/home" class="section">Home</a></li>
                	<li class="main<?php if($current_section == 'updates') { echo ' selected'; } ?>"><a href="/admin/updates" class="section">Updates</a></li>
                	<li class="main<?php if($current_section == 'pages') { echo ' selected'; } ?>"><a href="/admin/pages" class="section">Pages</a></li>
					<li class="main<?php if($current_section == 'installers') { echo ' selected'; } ?>"><a href="/admin/installers" class="section">Installers</a></li>
					<li class="main<?php if($current_section == 'products') { echo ' selected'; } ?>"><a href="/admin/products" class="section">Products</a></li>
					<li class="main<?php if($current_section == 'testimonials') { echo ' selected'; } ?>"><a href="/admin/testimonials" class="section">Testimonials</a></li>
					<li class="main<?php if($current_section == 'literature') { echo ' selected'; } ?>"><a href="/admin/literature" class="section">Literature</a></li>
					<li class="main<?php if($current_section == 'contact') { echo ' selected'; } ?>"><a href="/admin/contact" class="section">Contact</a></li>
                    <li class="main<?php if($current_section == 'users') { echo ' selected'; } ?>"><a href="/admin/users" class="section">Users</a>
                    
                </ul>
            
            <?php 
                //End Hide Navigation for Non-Logged In User
                } 
            ?>
            
        </nav>
        
        <!-- END HEADER AREA -->
    
        <!-- BEGIN BODY AREA -->
        <div id="body_container"<?php if( ! isset($hide_navigation) || $hide_navigation == FALSE)  { echo ' class="interior"'; } ?>>
            
            <?php echo $this->load->view($page_content); ?>
            
        </div>
        <!-- END BODY AREA -->
        
        <div class="clearfix"></div>
        
    </div><!-- END #container -->
    
<!-- End #wrapper -->
</div>

<!-- BEGIN FOOTER -->
<footer id="footer" class="clearfix">
    
</footer>


<script type="text/javascript" src="/src/admin/assets/js/admin_functions.js"></script>
<script type="text/javascript" src="/src/admin/assets/js/jquery.colorbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$('#nav li.main').not('.selected').hover(function() {
		$(this).addClass('selected');
	 }, function() {
		 $(this).removeClass('selected');
	 });
	
	
	$('.form_submit').click(function() {
		var button_value = $(this).attr('rel');
		$('form').append('<input type="hidden" name="action_value" value="' + button_value + '" />').submit();							 							 
	});
	

});
</script>
<script type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "specific_textareas",
        editor_selector : "MCE",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,image,cleanup,help,code",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,
		width: "94%",
		height:"350",

        // Example content CSS (should be your site CSS)
        content_css : "/src/admin/assets/css/tinymce.css?" + new Date().getTime(),
		
        external_image_list_url : "/admin/image_list"


});

</script>
</body>
</html>