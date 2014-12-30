<?php
$video_id = '22439234';
$oembed_object = oembed_vimeo($video_id, 462);
$video_poster = asset_url('images/video.jpg');
$data = array();
?>

<div class="centered" data-video-wrapper='{"v_ratio":"<?=$oembed_object->width / $oembed_object->height?>"}'>
    <a href="https://vimeo.com/<?=$video_id?>" data-video-trigger>
        <img src="<?=$video_poster?>" class="full-width">
        <span class="btn-play btn-play--centered">
            <i class="icon-play"></i>
        </span>
    </a>
</div>