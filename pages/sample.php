<?php
/*
 *
 * This is a sample page you can copy and use as boilerplate for any new page.
 *
 */

use BFS\CMS;
CMS::setupContext();
$thePost = CMS::getThisPost();
$postContent = $thePost->get( 'post_content' ) ?: 'Not sure.';

require_once __ROOT__ . '/inc/header.php';

?>





<!-- Sample Section -->
<section class="sample-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<div class="h3 space-half-top space-min-bottom">Here is a sample.</div>
				<div class="h5">
					<?= $postContent ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Sample Section -->





<?php require_once __ROOT__ . '/inc/footer.php'; ?>
