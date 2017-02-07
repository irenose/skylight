<?php
    /*-------------------------------
        REQUESTED HEADER TAGS FOR SEO
        Will configure closer to launch
    --------------------------------*/
?>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?=$social_meta_array['title']?>">
<meta itemprop="description" content="<?=$social_meta_array['description']?>">
<meta itemprop="image" content="<?=$social_meta_array['image']?>">

<!-- Twitter Card data -->
<!-- <meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@publisher_handle">-->
<meta name="twitter:title" content="<?=$social_meta_array['title']?>">
<meta name="twitter:description" content="<?=$social_meta_array['description']?>">
<!-- <meta name="twitter:creator" content="@publisher_handle"> -->
<!-- Twitter summary card with large image must be at least 280x150px KEY IMAGE ON PAGE -->
<meta name="twitter:image:src" content="<?=$social_meta_array['image']?>">

<!-- Open Graph data -->
<meta property="og:title" content="<?=$social_meta_array['title']?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?=$social_meta_array['url']?>" />
<meta property="og:image" content="<?=$social_meta_array['image']?>" />
<meta property="og:description" content="<?=$social_meta_array['description']?>" />
<meta property="og:site_name" content="5-Star Skylight Specialists" />

<?php
    /*-------------------------------
        END SEO TAGS
    --------------------------------*/
?>