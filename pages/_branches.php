<?php
/*
 *
 * This is the branch page.
 *
 */

require_once __ROOT__ . '/inc/header.php';

use BFS\CMS;
CMS::setupContext();

$postTitle = 'Find a White Gold Branch Near You';

$allBranches = CMS::getPostsOf( 'branch' );
$branches = array_values( array_filter( $allBranches, function ( $branch ) {
	return $branch->get( 'region' ) === REGION;
} ) );
$branches = array_map( function ( $branch ) {
	$image = $branch->get( 'branch_image' );
	if ( $image ) {
		$imageURL = $image[ 'sizes' ][ 'small' ] ?? $image[ 'sizes' ][ 'medium' ] ?? $image[ 'sizes' ][ 'large' ] ?? $image[ 'url' ];
		$branch->set( 'branch_image', $imageURL );
	}
	return $branch;
}, $branches );

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

<!-- ## Branches Page -->
<!-- Header Section -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<!-- END: Header Section -->


<!-- Find Branch Section -->
<section class="find-branch-section space-200-top">
	<div class="container">
		<div class="row">
			<div class="intro columns small-6 medium-4 large-3 space-100-bottom">
				<div class="title h2 strong text-blue-4">Find a <span class="no-wrap">White Gold</span> branch <br><span class="text-neutral-3">near you</span></div>
				<div class="char"><img class="block" src="../media/cutout/char-7.png<?php echo $ver ?>"></div>
			</div>
			<div class="branch-listing columns small-12 medium-7 medium-offset-1 large-6 large-offset-3">
				<input id="more-branches" type="checkbox" name="more-branches" class="more-branches visuallyhidden js_more_branches">
				<div class="branches space-50-bottom">
					<div class="branch-grid js_branches_container">
						<?php foreach ( $branches as $branch ) : ?>
							<!-- Branch -->
							<div class="branch fill-light js_branch">
								<div class="thumbnail fill-neutral-1 radius-25" <?php if ( $branch->get( 'branch_image' ) ) : ?>style="background-image: url( '<?= $branch->get( 'branch_image' ) ?>' );"<?php endif; ?>></div>
								<div class="title h6 strong"><?= $branch->get( 'branch_name' ) ?></div>
								<div class="timings p text-neutral-3 space-25-bottom">Open Mon to Sat</div>
								<div class="distance h4 text-neutral-3 js_distance_from_user hidden"></div>
								<div class="check-distance small medium text-uppercase text-blue-1 space-25 fill-blue-5 js_check_distance hidden">
									<span class="material-icons inline-middle" data-icon="my_location"></span>
									<span class="inline-middle">&nbsp;Check Distance</span>
								</div>
								<a class="gmaps-link button fill-blue-1" href="<?= $branch->get( 'google_maps' ) ?>" target="_blank">
									<span class="button-label">Open in Maps&nbsp;</span>
									<img class="button-icon tall" src="../media/icon/gmaps-tall-color.svg<?php echo $ver ?>">
								</a>
							</div>
							<!-- END: Branch -->
						<?php endforeach; ?>
					</div>
				</div>
				<div class="hide-branches columns text-center space-50-top space-200-bottom fill-light small-12">
					<button class="button fill-blue-1 more-branches js_show_more_branches">All Branches</button>&emsp;
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
