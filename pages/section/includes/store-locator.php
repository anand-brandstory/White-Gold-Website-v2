<?php
/*
 *
 * This is the branch page.
 *
 */

use \BFS\Types\Branches;

$branchesInRegion = Branches::getByRegion( REGION );



// $postTitle = 'Find a White Gold Branch Near You';


?>


<?php /* Store data in JavaScript */ ?>
<script type="text/javascript">

	window.__BFS = window.__BFS || { };
	window.__BFS.settings = window.__BFS.settings || { };
	window.__BFS.settings.region = "<?= REGION ?>";
	window.__BFS.data = window.__BFS.data || { };
	window.__BFS.data.branchesInRegion = <?= json_encode( array_map( function ( $branch ) {
		return array_merge( $branch->get( 'acf' ), $branch->get( '__custom' ) );
	}, $branchesInRegion ) ) ?>;

</script>
<?php /* END: Store data in JavaScript */ ?>

<!-- ## Branches Page -->
<!-- Header Section -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<!-- END: Header Section -->


<!-- Find Branch Section -->


<div class="branch-custom-section space-100-bottom bg-grey space-100-top">
<section class="branch-section find-branch-section">
<div class="container-fluid container-lg">
<div class="text-center mt-4 mb-4">
    <h2>Our Store Locator</h2>
</div><div class="branch-listing space-200-bottom">
<div class="branch-slider">

						<?php foreach ( $branchesInRegion as $branch ) : ?>
                                                  <div class="branch-grid js_branches_container">
							<!-- Branch -->
							<div class="branch fill-light js_branch">
								<div onclick="window.location='<?= $branch->get( 'add_page_link' ) ?>';" class="thumbnail fill-neutral-1 radius-25" <?php if ( $branch->get( 'branchImage' ) ) : ?>style="background-image: url( '<?= $branch->get( 'branchImage' ) ?>' );"<?php endif; ?>></div>
                                   <a href="<?= $branch->get( 'add_page_link' ) ?>"><div class="title h6 strong"><?= $branch->get( 'branch_name' ) ?></div></a>
                                
                                    <a class="explore-link" href="<?= $branch->get( 'add_page_link' ) ?>"><div class="explore">Explore Now</div></a>
								<div class="timings p text-neutral-3 space-25-bottom">Open Mon to Sat</div>
								<div class="distance h4 text-neutral-3 js_distance_from_user hidden"></div>
								<div class="check-distance small medium text-uppercase text-blue-1 space-25 fill-blue-5 js_check_distance hidden">
									<span class="material-icons inline-middle" data-icon="my_location"></span>
									<span class="inline-middle">&nbsp;Check Distance</span>
								</div>
								<a class="gmaps-link button fill-blue-1" href="<?= $branch->get( 'google_maps' ) ?>" target="_blank">
									<span class="button-label">Open in Maps&nbsp;</span>
									<img class="button-icon tall" src="/media/icon/gmaps-tall-color.svg<?php echo $ver ?>">
								</a>
							</div>
							<!-- END: Branch --></div>
						<?php endforeach; ?>
</div></div>

</div>

</section>
</div>

<style>
.explore::after {
    position: relative;
    content: url(https://whitegold.money/cms/../content/cms/explore.svg);
	left: 5px;
    top: 1px;
}
.explore::after:hover{
	text-decoration:underline;
}
.explore-link:hover{
	text-decoration:underline;
}
.explore{
font-weight: 500;	
color:#11309A;
font-size:14px;
}
.explore-link {
	min-height: calc( var(--h6) * 2 );
display: block;
}
.find-branch-section .branch-listing .branch-grid .branch .title {
   min-height:0px;
}
</style>
