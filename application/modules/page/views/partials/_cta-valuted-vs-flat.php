<?php
    $video_id = '136948725';
    $oembed_object = oembed_vimeo($video_id, 462);
    // $video_poster = $oembed_object->thumbnail_url;
    $video_poster = asset_url('images/placeholders/vault-vs-flat.jpg');
    $data = array();
?>

    <div class="small-12">
        <div class="centered" data-video-wrapper='{"v_ratio":"<?=$oembed_object->width / $oembed_object->height?>"}'>
            <a href="https://vimeo.com/<?=$video_id?>" data-video-trigger>
                <img src="<?=$video_poster?>" class="full-width">
                <span class="btn-play btn-play--centered">
                    <?=use_svg(array('classes' => 'icon icon-play', 'svg-node' => 'icon-play', 'aria-hidden' => 'true'))?>
                </span>
            </a>
        </div>
    </div>
