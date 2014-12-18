<?php
$video_id = '22439234';
$oembed_object = oembed_vimeo($video_id, 462);
$video_poster = asset_url('images/video.jpg');
$data = array();
?>

<a href="https://vimeo.com/<?=$video_id?>" class="video-embed-trigger">
    <img src="<?=asset_url('images/video.jpg')?>" class="full-width">
    <span class="btn-play btn-play--centered">
        <i class="icon-play"></i>
    </span>
</a>