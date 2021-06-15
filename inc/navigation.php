<?php

/*
 *
 * Build out the data-structure driving the page navigation markup
 *
 */
$navigationMenuItems = \BFS\CMS::getNavigation( 'Primary' );

?>

<!-- Header Section -->
<section class="header-section">
	<div class="container">
		<div class="header row">
			<div class="columns small-3">
				<a class="logo" href="/">
					<img src="/media/logo.svg<?= $ver ?>">
				</a>
			</div>
			<div class="text-right columns small-9">
				<div class="navigation inline">
					<?php foreach ( $navigationMenuItems as $item ) : ?>
						<a class="button js_nav_button" href="<?= $item[ 'url' ] ?>"><?= $item[ 'title' ] ?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section> <!-- END : Header Section -->
