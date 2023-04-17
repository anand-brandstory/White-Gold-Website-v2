<?php
/*
 |
 | Components | Home page
 |
 |
 */

namespace C;





function VideoChip ( $title, $duration, $videoId, $imageURL, $className = 'fill-blue-1', $bgColor = 'rgba( 229, 234, 245, 0.8 )' ) {
?>
<div class="<?= "watch-video block row ${className} js_modal_trigger" ?>" style="background-color: <?= $bgColor ?>" data-mod-id="youtube-video" data-src="https://youtube.com/watch?v=<?= $videoId ?>" data-autoplay="true" role="button" tabIndex="1">
	<div class="columns small-6">
		<div class="thumbnail" style="background-image: url('<?= $imageURL ?>');"></div>
	</div>
	<div class="columns small-6 space-50-left space-25-right space-25-top">
		<div class="p md:h6 medium"><?= $title ?></div>
		<div class="mt-min small md:p"><?= $duration ?></div>
	</div>
</div>
<?php
}
