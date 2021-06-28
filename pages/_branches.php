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




<!-- Store data in JavaScript -->
<script type="text/javascript">

     window.__BFS = window.__BFS || { };
     window.__BFS.data = window.__BFS.data || { };
     window.__BFS.data.branches = <?= json_encode( array_map( function ( $branch ) {
          return $branch->get( 'acf' );
     }, $allBranches ) ) ?>;

</script>
<!-- END: Store data in JavaScript -->


<!-- Header Section -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<!-- END: Header Section -->


<!-- Find Branch Section -->
<section class="find-branch-section space-200-top-bottom">
     <div class="container">
          <div class="row">
               <div class="intro columns small-6 medium-4 large-3 space-100-bottom">
                    <div class="title h2 strong text-blue-2">Find a WhiteGold <br><span class="text-neutral-3">near you</span></div>
                    <div class="char"><img class="block" src="../media/character/char-7.png<?php echo $ver ?>"></div>
               </div>
               <div class="branch-listing columns small-12 medium-7 medium-offset-1 large-6 large-offset-3">
                    <div class="branch-grid">
                         <?php foreach ( $branches as $branch ) : ?>
                         <!-- Branch -->
                         <div class="branch fill-light">
                              <div class="thumbnail fill-neutral-1 radius-25" <?php if ( $branch->get( 'branch_image' ) ) : ?>style="background-image: url( '<?= $branch->get( 'branch_image' ) ?>' );"<?php endif; ?>></div>
                              <div class="title h6 strong space-50-top-bottom"><?= $branch->get( 'branch_name' ) ?></div>
                              <div class="distance h4 text-neutral-3 hidden"></div>
                              <div class="check-distance small medium text-uppercase text-blue-4 space-25 fill-neutral-1 js_check_distance hidden">
                                   <span class="material-icons inline-middle" data-icon="my_location"></span>
                                   <span class="inline-middle">&nbsp;Check Distance</span>
                              </div>
                              <div class="timings p text-neutral-3 space-50-bottom">Open Mon to Fri</div>
                              <a class="gmaps-link button" href="<?= $branch->get( 'google_maps' ) ?>" target="_blank">Open in Maps <!-- google maps icon --></a>
                         </div>
                         <!-- END: Branch -->
                         <?php endforeach; ?>
                    </div>
                    <div class="branch-more space-100-top-bottom">
                         <div class="button fill-blue-2">Show Nearest Branch</div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- END: Find Branch Section -->




<script type="text/javascript">

     $( function () {

          // If the GeoLocation API is not supported, do nothing and leave everything as it is.
          if ( ! navigator.geolocation )
               return;

          // If the user has already consented for their geo-location to be shared, query the location, calculate the distances and plug them in
          // If not, then ask the user about it if they click on the "Check distance" button
          $( document ).on( "click", ".js_check_distance", function ( event ) {
               //
          } );
     } );

     function userHasConsentedToSharingGeoLocation () {}

     /*
      * ----- Returns the user's geo-location
      *   ( or prompts the user for their consent if they haven't already )
      */
     // A wrapper around the native GeoLocation API
     function getCurrentPosition () {
          let options = {
               enableHighAccuracy: true
          }
          return new Promise( function ( resolve, reject ) {
               navigator.geolocation.getCurrentPosition(
                    resolve,
                    reject,
                    options
               );
          } )
     }

     /*
      * ----- Extracts and returns relevant data on successfully acquiring the user's location
      */
     function getLocationDetails ( rawData ) {
          return {
               timestamp: rawData.timestamp,
               accuracy: rawData.coords.accuracy,
               altitude: rawData.coords.altitude,
               altitudeAccuracy: rawData.coords.altitudeAccuracy,
               heading: rawData.coords.heading,
               latitude: rawData.coords.latitude,
               longitude: rawData.coords.longitude,
               speed: rawData.coords.speed
          }
     }

     /*
      * ----- Error handler: While attempting to acquire the user's location
      */
     function handleErrorWhileAcquiringLocation ( e ) {
          alert( "There was an issue in fetching your location. Please check your privacy settings for this website or try again after sometime." );
          console.log( e );
     }

     function getCurrentUserGeoLocation () {
          let rawGPS = async await getCurrentPosition()
          return getLocationDetails( rawGPS )
     }

     /*
      * ----- Given a reference points and a list of candidate points, this function returns the point that is the closest to the reference point
      */
     function getNearest ( referenceCoordinates, candidateCoordinates ) {
          return geolib.findNearest( referenceCoordinates, candidateCoordinates )
     }

     /*
      * ----- Given a reference points and a list of candidate points, this function returns the list of candidate points ordered by distance.
      */
     function getNearest ( referenceCoordinates, candidateCoordinates ) {
          return geolib.orderByDistance( referenceCoordinates, candidateCoordinates )
     }

     function calculateDistanceBetweenCoordinates ( source, destination ) {
          var distanceInMeters = geolib.getDistance( source, destination );
          var distanceInKm = Math.round( distanceInMeters / 1000 );
          var distanceInWords = "≈ ";

          if ( distanceInKm > 1 )
               distanceInWords = "≈ " + distanceInKm + "km";
          else
               distanceInWords = "less than 1km";

          distanceInWords += " away";

          return distanceInWords;
     }

     function renderBranches ( branches ) {}




</script>


<?php require_once __ROOT__ . '/inc/footer.php'; ?>
