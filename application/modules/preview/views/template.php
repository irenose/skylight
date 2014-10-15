<?php
	//Set Values for Meta Data - Provide default data if not set
	if( ! isset($meta_array) || $meta_array['title'] == '') {
		if(isset($page_title)) {
			$meta_title = $page_title;
		} else {
			$meta_title = 'Welcome to the Girl Scouts, Hornets\' Nest Council.';
		}
	} else {
		$meta_title = $meta_array['title'];
	}
	if( ! isset($meta_array) || $meta_array['keywords'] == '') {
		$meta_keywords = 'Hornets\' Nest, GSHNC, cookies, Girls Are IT, Hornets\' Nest Council, Thin Mint Sprint, Cookies for the Troops, GSI';
	} else {
		$meta_keywords = $meta_array['keywords'];
	}
	if( ! isset($meta_array) || $meta_array['description'] == '') {
		$meta_description = 'Girl Scouts, Hornets\' Nest Council is part of the world\'s preeminent organization dedicated solely to girls where, in an accepting and nurturing environment, girls build character and skills for success in the real world. In partnership with committed adults, girls develop qualities that will serve them all their lives: strong values, social conscience, and conviction of their own self-worth.';
	} else {
		$meta_description = $meta_array['description'];
	}
	
	if( !isset($category_url)) {
		$category_url = 'home';
	} else {
		$category_url = $category_url;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $meta_title; ?></title>
<meta name="keywords" content="<?php echo $meta_keywords; ?>" />
<meta name="desciption" content="<?php echo $meta_description; ?>" />
<link href="/_assets/css/gs_styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="/_assets/css/lightbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script type="text/javascript" src="/_assets/js/lightbox.js"></script>
<script type="text/javascript" src="/_assets/js/swfobject.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.lightbox').lightbox();
	$('.hover_content').hide();
	$('.hover_link').hover(function() {
		var this_div = $(this).attr('rel');
		$('#' + this_div).slideDown('fast');
	}, function() {
		var this_div = $(this).attr('rel');
		$('#' + this_div).slideUp('fast');	
	});
	
	$('.nav_arrow').click(function() {
		var current_arrow = $(this);
		var current_div = $(this).attr('rel');
		$('#' + current_div).slideToggle('fast', function() {
			if($('#' + current_div).css('display') == 'none') {
				$(current_arrow).html('<img src="/_assets/images/site/nav_arrow.gif" border="0" />');
			} else {
				$(current_arrow).html('<img src="/_assets/images/site/nav_arrow_down.gif" border="0" />');
			}
														  
		});
		return false;
								   
	});
	$('.nav_arrow').hover(function() {
	   	   $(this).addClass('cursor_hand');						   
	   }, function() {
		   $(this).removeClass('cursor_hand');
	   });
});
</script>
</head>
<body>
<div id="container">
	
	<div id="header">
    	<a href="/" alt="Click to return to the homepage" title="Click to return to the homepage"><img src="/_assets/images/site/gs_logo.gif" border="0" class="logo" /></a>
        <ul>
        	<li class="hover_link" rel="follow_box">
            	<a href=""><img src="/_assets/images/site/follow_us_btn.gif" border="0" /></a>
                <div class="hover_content" id="follow_box">
                    <div class="link_area" style="width:120px;">
                   	  <a href="http://facebook.com/pages/Girl-Scouts-Hornets-Nest-Council/49660806772" target="_blank">Facebook</a>
                   	  <a href="http://twitter.com/GSHNC" target="_blank">Twitter</a>
                    </div>
                </div>
            </li>
            <li class="hover_link" style="margin-right:239px;">
            	<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=hngirlscouts"><img src="/_assets/images/site/share_btn.gif" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=hngirlscouts"></script>
            </li>
            <li class="hover_link" rel="forms_box">
            	<a href="/forms"><img src="/_assets/images/site/forms_btn.gif" border="0" /></a>
            	<div class="hover_content" id="forms_box">
                	<div class="link_area">
                    <?php
						if( isset($forms_dropdown_display) && $forms_dropdown_display != '') {
							echo $forms_dropdown_display;
						}
					?>
                    </div>
                </div>
            </li>
            <li class="hover_link" rel="pubs_box">
            	<a href="/publications"><img src="/_assets/images/site/publications_btn.gif" border="0" /></a>
            	<div class="hover_content" id="pubs_box">
                	<div class="link_area">
                    <?php
						if( isset($publications_dropdown_display) && $publications_dropdown_display != '') {
							echo $publications_dropdown_display;
						}
					?>
                    </div>
                </div>
            </li>
            <li class="search">
            	<?php echo form_open('search/results'); ?>
            	<div id="search_box_container"><input type="text" class="search_box" name="search_query" /></div>
                <input type="submit" value="SEARCH" class="search_submit_btn" />
                </form>
            </li>
        </ul>
    </div>
  	<div class="clear"> </div>
    <div id="flash">
		<?php 
				echo '<div class="non_js_nav">' . "\n";
				echo '<div class="nav_tabs">';
				echo '<a href="/girls"><img src="/_assets/images/site/girls_button_nonjs.gif" border="0"></a><a href="/parents-volunteers"><img src="/_assets/images/site/parents_button_nonjs.gif" border="0"></a><a href="/alumnae"><img src="/_assets/images/site/alumnae_button_nonjs.gif" border="0"></a><a href="/support-girl-scouts"><img src="/_assets/images/site/support_button_nonjs.gif" border="0"></a><a href="/council-information-properties"><img src="/_assets/images/site/council_button_nonjs.gif" border="0"></a><a href=""><img src="/_assets/images/site/shop_button_nonjs.gif" border="0"></a><a href="/cookies-more"><img src="/_assets/images/site/cookies_button_nonjs.gif" border="0"></a>' . "\n";
				echo '</div>';
				echo '<div class="flash_banner">' . "\n";
				echo '<img src="/_assets/images/site/cloud_banner_nonjs.gif" border="0">';
				echo '</div>' . "\n";
				echo '</div>' . "\n";
		?>

    </div>
    <div class="clear"> </div>
    <!-- Interior Template -->
    <div id="body_container">
    	<div id="left_side">
    		<div id="side_navigation">
            <?php 
				if( isset($sub_menu_display)) {
					
					if($sub_menu_display != '') {
						echo $sub_menu_display;
					} else {
						echo '<img src="/_assets/images/site/side_cloud_holder.jpg" style="margin-left:5px;" border="0" />';
					}
				} else {
					echo '<img src="/_assets/images/site/side_cloud_holder.jpg" style="margin-left:5px;" border="0" />';
				}
			?>
            </div>
            <div id="badge_side_container">
                <div class="badge">
                    <a href="https://pink.secure-host.com/hngirlscouts/Store/"><img src="/_assets/images/site/badge_shopping_btn_interior.jpg" border="0" /></a>
                </div>
                <div class="badge">
                    <a href="/newsletter"><img src="/_assets/images/site/badge_newsletter_btn_interior.jpg" border="0" /></a>
                </div>
                <div class="badge">
                    <a href="/donate"><img src="/_assets/images/site/badge_donate_btn_interior.jpg" border="0" /></a>
                </div>
            </div>
        </div>
        <div id="right_side">
        	<?php
				if( isset($section_header_image) && $section_header_image != '') {
        			echo '<div id="interior_header">' . "\n";
            		echo '<img src="/content_images/headers/' . $section_header_image . '" border="0" />';
            		echo '</div>' . "\n";
				} else {
					echo '<div id="interior_header">' . "\n";
            		echo '<img src="/_assets/images/site/universal_header.jpg" border="0" />';
            		echo '</div>' . "\n";
				}
			?>
        	<div id="content_area">
        		<div id="content_top">&nbsp;</div>
				<div id="content_body">
					<?php echo $this->load->view($page_content); ?>
                </div>
                <div id="content_bottom">&nbsp;</div>
            </div>
        </div>  
        <div class="clear"> </div>  
    </div>
	<!-- End Interior Template -->
<div class="clear"> </div>
    <div id="footer_tabs">
        <div id="tabs_left">
            <a href="/service-unit-managers"><img src="/_assets/images/site/service_managers_btn.jpg" border="0" /></a>
            <a href="/troop-leaders"><img src="/_assets/images/site/troop_leaders_btn.jpg" border="0" /></a>
            <a href="/trainers"><img src="/_assets/images/site/trainers_btn.jpg" border="0" /></a>
        </div>
        <div id="tabs_right">
            <a href="/contact-us"><img src="/_assets/images/site/contact_us_btn.jpg" border="0" /></a>
            <a href="/en-espanol"><img src="/_assets/images/site/espanol_btn.jpg" border="0" /></a>
        </div>
        <div class="clear"> </div>
    </div>
<!-- End container -->
</div>
<div id="footer">
    <div id="footer_nav">
    	<div id="nav_column_container">
           <?php 
			if( isset($page_list_display)) {
				echo $page_list_display;
			}
			?>
            <div class="clear"> </div>
        </div>
    </div>
    <div id="footer_contact_container">
    	<div id="footer_contact_info">
        	<div class="footer_url">
            	<a href="/">hngirlscouts.org</a>
            </div>
         	<div class="contact_column">
            	Girl Scouts, Hornets' Nest Council<br />
                <span class="address">7007 Idlewild Road</span><br />
				<span class="address">Charlotte, North Carolina 28212</span>
            </div>
            <div class="contact_column">
            	Phone: 704.731.6500
            </div>
            <div class="contact_column">
            	Toll Free: 1.800.868.0528
            </div>
            <div class="contact_column">
            	Fax: 704.567.0598
            </div>
			<div class="clear"> </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var flashvars = { _thisPage: "<?php echo $category_url; ?>"};
	var params = {wmode: "transparent"};
	swfobject.embedSWF("/_assets/swf/gsTopNav.swf", "flash", "970", "160", "9.0.0", "", flashvars, params);
	swfobject.createCSS("#flash","outline:none");
</script>
<!--<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12838302-1");
pageTracker._trackPageview();
} catch(err) {}</script>-->
</body>
</html>


