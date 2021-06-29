<?php
/*
 *
 * This is the branch page.
 *
 */

require_once __ROOT__ . '/inc/header.php';

use BFS\CMS;
CMS::setupContext();

$allBranches = CMS::getPostsOf( 'branch' );
$branches = array_filter( $allBranches, function ( $branch ) {
	return $branch->get( 'region' ) === REGION;
} );

?>





<?php /* Store data in JavaScript */ ?>
<script type="text/javascript">

	window.__BFS = window.__BFS || { };
	window.__BFS.settings = window.__BFS.settings || { };
	window.__BFS.settings.region = "<?= REGION ?>";
	window.__BFS.data = window.__BFS.data || { };
	window.__BFS.data.branches = <?= json_encode( array_map( function ( $branch ) {
		return $branch->get( 'acf' );
	}, $allBranches ) ) ?>;
	window.__BFS.data.branchesInRegion = window.__BFS.data.branches.filter( function ( branch ) {
		return branch.region === window.__BFS.settings.region
	} );

</script>
<?php /* END: Store data in JavaScript */ ?>


<!-- Header Section -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<!-- END: Header Section -->


<!-- Find Branch Section -->
<section class="find-branch-section space-200-top-bottom">
	<div class="container">
		<div class="row">
			<div class="intro columns small-6 medium-4 large-3 space-100-bottom">
				<div class="title h2 strong text-blue-4">Find a WhiteGold <br><span class="text-neutral-3">near you</span></div>
				<div class="char"><img class="block" src="../media/cutout/char-7.png<?php echo $ver ?>"></div>
			</div>
			<div class="branch-listing columns small-12 medium-7 medium-offset-1 large-6 large-offset-3">
				<div class="branch-grid js_branches_container">
					<?php foreach ( $branches as $branch ) : ?>
						<!-- Branch -->
						<div class="branch fill-light js_branch">
							<div class="thumbnail fill-neutral-1 radius-25" <?php if ( $branch->get( 'branch_image' ) ) : ?>style="background-image: url( '<?= $branch->get( 'branch_image' ) ?>' );"<?php endif; ?>></div>
							<div class="title h6 strong space-50-top-bottom"><?= $branch->get( 'branch_name' ) ?></div>
							<div class="distance h4 text-neutral-3 js_distance_from_user hidden"></div>
							<div class="check-distance small medium text-uppercase text-blue-4 space-25 fill-neutral-1 js_check_distance hidden">
								<span class="material-icons inline-middle" data-icon="my_location"></span>
								<span class="inline-middle">&nbsp;Check Distance</span>
							</div>
							<div class="timings p text-neutral-3 space-50-bottom">Open Mon to Fri</div>
							<a class="gmaps-link button fill-blue-1" href="<?= $branch->get( 'google_maps' ) ?>" target="_blank">Open in Maps <!-- google maps icon --></a>
						</div>
						<!-- END: Branch -->
					<?php endforeach; ?>
				</div>
				<div class="branch-more space-100-top-bottom">
					<button class="button fill-blue-5 order-by-nearest js_order_branches">Show Nearest Branch</button>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Find Branch Section -->




<script type="text/javascript" src="/plugins/geolib/geolib-v3.3.1.min.js"></script>
<script type="text/javascript" src="/js/pages/branch-finder.js"></script>

</script>


<?php require_once __ROOT__ . '/inc/footer.php'; ?>
