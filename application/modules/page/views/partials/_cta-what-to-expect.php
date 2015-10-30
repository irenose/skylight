<?php
    $video_id = '86988931';
    $oembed_object = oembed_vimeo($video_id, 462);
    // $video_poster = $oembed_object->thumbnail_url;
    $video_poster = asset_url('images/placeholders/video.jpg');
    $data = array();
?>
<section class="page-row page-row--tall underlap reversed" data-wallpaper='{"file":"working-on-roof", "ext":"jpg"}'>
    <div class="small-12 large-5 columns">
        <div class="centered" data-video-wrapper='{"v_ratio":"<?=$oembed_object->width / $oembed_object->height?>"}'>
            <a href="https://vimeo.com/<?=$video_id?>" data-video-trigger>
                <img src="<?=$video_poster?>" class="full-width">
                <span class="btn-play btn-play--centered">
                    <?=use_svg(array('classes' => 'icon icon-play', 'svg-node' => 'icon-play', 'aria-hidden' => 'true'))?>
                </span>
            </a>
        </div>
    </div>
    <div class="small-12 large-6 large-offset-1 columns">
        <h2 class="beta">
            <span class="br">What should you expect</span> during installation?
        </h2>
        <p>
            A skylight installation happens in two phases: rooftop and interior. Depending on the circumstances such as roof pitch, interior light shaft depth and shape and weather, installations can take between a half day and three days. The rooftop portion of the installation includes cutting the hole and fastening the skylight to the roof with the three layers of protection found in VELUX No Leak Skylights.
        </p>
        <?php
            // don't show button if on Installing overview
            $link = site_url('installing');
            if (current_url() != $link):
        ?>
            <a href="<?=$link?>" class="btn">
                Learn More
            </a>
        <?php endif; ?>
    </div>
</section>