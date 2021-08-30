<?php

$regions = [
	'ka' => 'Karnataka',
	'tn' => 'Tamil Nadu',
	'kl' => 'Kerala'
];

require_once __ROOT__ . '/pages/snippet/menu.php'; 

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
					<img class="block" src="/media/whitegold-logo-light.svg<?php echo $ver ?>">
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


<!-- Sticky Menu Section -->
<section class="sticky-menu-section">
	<div class="container">
		<div class="row">
			<?php navigationMenuComponent('-sticky', $contactNumbersForRegions); ?>
		</div>
	</div>
</section>
<!-- END: Sticky Menu Section -->