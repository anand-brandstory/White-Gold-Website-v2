<?php
/*
 |
 | Gold Rate Parameters page
 |
 */

// require_once __ROOT__ . '/inc/utils.php';
require_once __ROOT__ . '/inc/cms.php';

use BFS\CMS;
CMS::setupContext();

if ( ! current_user_can( 'edit_gold_rate_parameters' ) )
	return;

$postTitle = 'Gold Rate Parameters';

$regions = [
	'test' => 'Test',
	'ka' => 'Karnataka',
	'tn' => 'Tamil Nadu',
	'kl' => 'Kerala'
];

require_once __ROOT__ . '/inc/header.php';

?>
<style type="text/css">

	body {
		background-color: transparent !important;
	}

</style>

<hr class="space-200-top">


<section class="space-200-top">
	<div class="row">
		<div class="container">
			<div class="columns small-12 large-4">
				<div class="h2 strong text-neutral-3 space-100-bottom">Gold Rate Parameters</div>
			</div>
			<?php foreach ( $regions as $regionCode => $regionName ) : ?>

			<div class="live-gold-quote columns small-12 large-8 large-offset-4 space-200-bottom">
				<div class="form-card row fill-light">
					<form class="form form-base js_<?= $regionCode ?>_rates_form" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<div class="h3 strong space-50-bottom"><?= $regionName ?></div>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="Stop loss" class="form-input-field block" id="js_<?= $regionCode ?>_rates_form_input_stop_loss">
								<span class="form-label-title medium fill-light cursor-pointer">Stop loss</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="Margin %" class="form-input-field block" id="js_<?= $regionCode ?>_rates_form_input_margin_percentage">
								<span class="form-label-title medium fill-light cursor-pointer">Margin %</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="22 Karat %" class="form-input-field block" id="js_<?= $regionCode ?>_rates_form_input_22_karat_percentage">
								<span class="form-label-title medium fill-light cursor-pointer">22 Karat %</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top" <?php if ( ! current_user_can( 'edit_gold_rate_pipeline' ) ) : ?> style="display: none;" <?php endif; ?>>
							<label class="form-label block">
								<input type="text" placeholder="Data Pipeline file" class="form-input-field block" id="js_<?= $regionCode ?>_rates_form_input_data_pipeline_filename" _disabled>
								<span class="form-label-title medium fill-light cursor-pointer">Data Pipeline file</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-light cursor-pointer">Submit</span>
								<button class="button fill-dark" type="submit">
									<span class="button-label js_submit_label">Save&ensp;</span>
									<img class="button-icon tall" src="/media/icon/sms-tall-green.svg<?= $ver ?>">
								</button>
							</label>
						</div>
					</form>
				</div>
			</div>

			<?php endforeach; ?>
		</div>
	</div>
</section>

<script type="text/javascript">

	window.__BFS.CONF.regions = <?= json_encode( $regions ) ?>

</script>
<script type="text/javascript" src="/js/modules/cupid/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/forms.js<?= $ver ?>"></script>
<script type="text/javascript">

	function fetchPipelineData ( pipelineName ) {

		var apiEndpoint = __BFS.CONF.goldRates.apiEndpoint;
		var url = apiEndpoint + `/v1/pipelines/${pipelineName}/parameters`;

		var ajaxRequest = $.ajax( {
			url: url,
			method: "GET",
			contentType: "application/json",
			dataType: "json",
			// xhrFields: {
			// 	withCredentials: true
			// }
		} );

		return new Promise( function ( resolve, reject ) {
			ajaxRequest.done( function ( response ) {
				resolve( response.data );
			} );
			ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
				var errorResponse = window.__CUPID.utils.getErrorResponse( jqXHR, textStatus, e );
				reject( errorResponse );
			} );
		} );
	}

	function setPipelineData ( name, path, context ) {

		var data = {
			name,
			path,
			context
		}

		var apiEndpoint = __BFS.CONF.goldRates.apiEndpoint;
		var url = apiEndpoint + `/v1/pipelines`;

		var ajaxRequest = $.ajax( {
			url: url,
			method: "POST",
			data: JSON.stringify( data ),
			contentType: "application/json",
			dataType: "json",
			// xhrFields: {
			// 	withCredentials: true
			// }
		} );

		return new Promise( function ( resolve, reject ) {
			ajaxRequest.done( function ( response ) {
				resolve( response );
			} );
			ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
				var errorResponse = window.__CUPID.utils.getErrorResponse( jqXHR, textStatus, e );
				reject( errorResponse );
			} );
		} );
	}

	( async function main () {

		// Set up the namespace
		window.__BFS = window.__BFS || { };
		window.__BFS.UI = window.__BFS.UI || { };


		/*
		 * ----- Set up the Gold Rate Parameters forms for the various regions
		 */

		let regions = window.__BFS.CONF.regions
		Object.keys( regions ).forEach( function ( regionCode ) {

			window.__BFS.UI[ regionCode + "RatesForm" ] = window.__BFS.UI[ regionCode + "RatesForm" ] || { };
			window.__BFS.UI[ regionCode + "RatesForm" ].bfsFormInstance = new BFSForm( "js_" + regionCode + "_rates_form" );

			// Cache some references
			var rateParametersForm = window.__BFS.UI[ regionCode + "RatesForm" ].bfsFormInstance
				var domInputStopLoss = document.getElementById( `js_${regionCode}_rates_form_input_stop_loss` );
				var domInputMarginPercentage = document.getElementById( `js_${regionCode}_rates_form_input_margin_percentage` );
				var domInput22KaratPercentage = document.getElementById( `js_${regionCode}_rates_form_input_22_karat_percentage` );
				var domInputDataPipelineFilename = document.getElementById( `js_${regionCode}_rates_form_input_data_pipeline_filename` );

			rateParametersForm.fetchAndSetExistingData = async function fetchAndSetExistingData () {
				let pipelineData = await fetchPipelineData( regionCode )
				if ( ! pipelineData )
					return

				domInputStopLoss.value = pipelineData.context.stopLoss
				domInputMarginPercentage.value = pipelineData.context.marginPercentage
				domInput22KaratPercentage.value = pipelineData.context[ "22KaratPercentage" ]
				domInputDataPipelineFilename.value = pipelineData.path
			};

				// Stop loss
			rateParametersForm.addField( "stopLoss", domInputStopLoss, function ( values ) {
				var stopLoss = values[ 0 ].trim();

				if ( stopLoss === "" )
					throw new Error( "Please provide a stop loss, else explicitly set it to 0." );

				stopLoss = parseInt( stopLoss, 10 );
				if ( Number.isNaN( stopLoss ) )
					throw new Error( "Please provide a valid stop loss number." );

				return stopLoss;
			} );

				// Margin percentage
			rateParametersForm.addField( "marginPercentage", domInputMarginPercentage, function ( values ) {
				var marginPercentage = values[ 0 ].trim();

				if ( marginPercentage.length === 0 )
					throw new Error( "Please provide a margin percentage, else explicitly set it to 0." );

				marginPercentage = parseFloat( marginPercentage, 10 );
				if ( Number.isNaN( marginPercentage ) )
					throw new Error( "Please provide a valid margin percentage." );
				else if ( marginPercentage < 0 || marginPercentage > 100 )
					throw new Error( "Please provide a valid margin percentage, within a range of 0 to 100." );

				return marginPercentage;
			} );

				// 22 Karat percentage
			rateParametersForm.addField( "22KaratPercentage", domInput22KaratPercentage, function ( values ) {
				var twentyTwoKaratPercentage = values[ 0 ].trim();

				if ( twentyTwoKaratPercentage.length === 0 )
					throw new Error( "Please provide a percentage for 22 Karat gold." );

				twentyTwoKaratPercentage = parseFloat( twentyTwoKaratPercentage, 10 );
				if ( Number.isNaN( twentyTwoKaratPercentage ) )
					throw new Error( "Please provide a valid percentage for 22 Karat gold." );
				else if ( twentyTwoKaratPercentage < 0 || twentyTwoKaratPercentage > 100 )
					throw new Error( "Please provide a valid percentage for 22 Karat gold, within a range of 0 to 100." );

				return twentyTwoKaratPercentage;
			} );

				// Data pipeline filename
			rateParametersForm.addField( "dataPipelineFilename", domInputDataPipelineFilename, function ( values ) {
				var dataPipelineFilename = values[ 0 ]
									.trim()
									.replace( /\/+/g, "/" )
									.replace( /(^\/|\/$)/g, "" )

				if ( dataPipelineFilename.length === 0 )
					throw new Error( "Please provide the name of the data pipeline file, one that exists on the server." );


				try {
					new window.URL( "file://" + dataPipelineFilename );
				}
				catch ( e ) {
					throw new Error( "Please provide a valid data pipeline filename, one that exists on the server." );
				}

				return dataPipelineFilename;
			} );



			rateParametersForm.submit = function submit ( data ) {

				let dataPipelineFilename = data.dataPipelineFilename
				delete data.dataPipelineFilename
				return setPipelineData( regionCode, dataPipelineFilename, data )

			}



			rateParametersForm.fetchAndSetExistingData()

			/*
			 * ----- Form submission event handler
			 */
			$( document ).on( "submit", `.js_${regionCode}_rates_form`, function ( event ) {

				/*
				 * ----- Prevent default browser behaviour
				 */
				event.preventDefault();

				/*
				 * ----- Prevent interaction with the form
				 */
				rateParametersForm.disable();

				/*
				 * ----- Provide feedback to the user
				 */
				rateParametersForm.giveFeedback( "Sending..." );

				/*
				 * ----- Extract data (and report issues if found)
				 */
				var data;
				try {
					data = rateParametersForm.getData();
				} catch ( error ) {
					alert( error.message )
					console.error( error.message )
					rateParametersForm.enable();
					rateParametersForm.setSubmitButtonLabel();
					return;
				}

				/*
				 * ----- Submit data
				 */
				rateParametersForm.submit( data )
					.then( function ( response ) {
						/*
						 * ----- Provide further feedback to the user
						 */
						 rateParametersForm.giveFeedback( "Saved." );

						setTimeout( function () {
							rateParametersForm.setSubmitButtonLabel();
							rateParametersForm.enable();
						}, 1500 )

					} )

			} );

		} );

	}() );

</script>
