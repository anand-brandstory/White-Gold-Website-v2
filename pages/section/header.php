<?php

$regions = [
	'ka' => 'Karnataka',
	'tn' => 'Tamil Nadu',
	'kl' => 'Kerala'
];

?>
<?php /* Store data in JavaScript */ ?>
<script type="text/javascript">
	window.__BFS = window.__BFS || { };
	window.__BFS.settings = window.__BFS.settings || { };
	window.__BFS.settings.region = "<?= REGION ?>";
</script>
<?php /* END: Store data in JavaScript */ ?>

<!-- Header Section -->
<section class="header-section space-100-top-bottom fill-blue-5" id="header-section" data-section-title="Header Section" data-section-slug="header-section">
	<div class="container">
		<div class="row">
			<div class="columns small-6 inline-middle">
				<a class="logo inline" href="/">
					<img class="block" src="../media/whitegold-logo-light.svg<?php echo $ver ?>">
				</a>
			</div>
			<div class="columns small-6 inline-middle text-right">
				<label class="select-region inline js_region_selector_container">
					<select class="select-region-option input-field js_region_selector">
						<?php foreach ( $regions as $regionCode => $regionName ) : ?>
							<option value="<?= $regionCode ?>" <?php if ( $regionCode === REGION ) : ?> selected <?php endif; ?>><?= $regionName ?></option>
						<?php endforeach; ?>
					</select>
					<span class="select-region-label p medium js_region_label"><?= $regions[ REGION ] ?></span>
				</label>
				<?php /* This menu is _semantically marked up_ and is "visually" hidden, yet accessible to crawlers (and screen readers) which is crucial for SEO and accessibility */ ?>
				<nav class="visuallyhidden js_region_nav">
					<ul>
						<?php foreach ( $regions as $regionCode => $regionName ) : ?>
							<li><a href="/<?= $regionCode ?>" data-region="<?= $regionCode ?>"><?= $regionName ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- END: Header Section -->


<!-- Menu Section -->
<section class="menu-section">
	<div class="container">
		<div class="row">
			<div class="menu columns small-12 medium-6 medium-offset-3 large-12 large-offset-0 fill-dark radius-50">
				<div class="row">
					<div class="menu-content columns small-12 large-9">
						<div class="row space-25">
							<div class="columns small-6 large-4 space-25">
								<a class="menu-button menu-button-large block fill-blue-4" href="">
									<span class="menu-button-bg" style="background-image: url('../media/background/find-branch.png<?php echo $ver ?>'); filter: brightness(0.9);" alt=""></span>
									<span class="menu-button-icon">
										<img class="block" src="../media/icon/location-white.svg<?php echo $ver ?>">
									</span>
									<span class="menu-button-label">Find Nearest <br class="hide-large hide-xlarge">Branch</span>
								</a>
							</div>
							<div class="columns small-6 large-4 space-25">
								<a class="menu-button menu-button-large block fill-yellow-2 text-light" href="">
									<span class="menu-button-bg fill-dark" style="background-image: url('../media/background/sell-gold.png<?php echo $ver ?>'); filter: brightness(0.5);" alt=""></span>
									<span class="menu-button-icon">
										<img class="block" src="../media/icon/rupee-white.svg<?php echo $ver ?>">
									</span>
									<span class="menu-button-label">Live Gold <br class="hide-large hide-xlarge">Rate</span>
								</a>
							</div>
							<div class="columns small-6 large-2 space-25">
								<a class="menu-button block fill-blue-5" href="">Sell Gold</a>
							</div>
							<div class="columns small-6 large-2 space-25">
								<a class="menu-button block fill-light" href="">Release Gold</a>
							</div>
						</div>
					</div>
					<div class="menu-head columns small-12 large-3">
						<div class="row space-25">
							<div class="whatsapp columns small-2 large-3 space-25">
								<a class="menu-button block fill-neutral-5" href="">
									<img class="block" src="../media/icon/whatsapp-outline.svg<?php echo $ver ?>">
								</a>
							</div>
							<div class="columns small-6 small-offset-1 large-9 large-offset-0 space-25">
								<a class="menu-button block fill-neutral-5" href="">+91 99860 99860</a>
							</div>
							<div class="menu-toggle columns small-2 small-offset-1 large-3 large-offset-0 space-25 hide-large hide-xlarge">
								<a class="menu-button block fill-neutral-5" href=""><span class="material-icons" data-icon="menu"></span></a>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</section>
<!-- END: Menu Section -->