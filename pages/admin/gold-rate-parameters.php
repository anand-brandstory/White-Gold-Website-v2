<?php
/**
 |
 | Gold Rate Parameters page
 |
 | This is the template for the "Gold Rate Parameters" page on the WordPress backend
 |
 */

require_once __ROOT__ . '/lib/providers/wordpress.php';

\BFS\CMS\WordPress::setupContext();

if ( ! current_user_can( 'edit_gold_rate_parameters' ) )
	return;

$postTitle = 'Gold Rate Parameters';

$regions = array_merge(
	[ 'test' => 'Test' ],
	REGIONS
);

require_once __ROOT__ . '/pages/partials/header.php';

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
					<form class="form form-base js_rate_parameters_form" data-region-code="<?= $regionCode ?>" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<div class="h3 strong space-50-bottom"><?= $regionName ?></div>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="Stop loss" class="form-input-field block js_form_input_stop_loss">
								<span class="form-label-title medium fill-light cursor-pointer">Stop loss</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="Margin %" class="form-input-field block js_form_input_margin_percentage">
								<span class="form-label-title medium fill-light cursor-pointer">Margin %</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="22 Karat %" class="form-input-field block js_form_input_22_karat_percentage">
								<span class="form-label-title medium fill-light cursor-pointer">22 Karat %</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top" <?php if ( ! current_user_can( 'edit_gold_rate_pipeline' ) ) : ?> style="display: none;" <?php endif; ?>>
							<label class="form-label block">
								<input type="text" placeholder="Data Pipeline file" class="form-input-field block js_form_input_data_pipeline_filename">
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
<script type="text/javascript" src="/plugins/base64/base64.js__v3.7.2.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/plugins/js-cookie/js-cookie__v3.0.1.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
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

	$( function main () {

		// Set up the namespace
		window.__BFS = window.__BFS || { };
		window.__BFS.UI = window.__BFS.UI || { };

		// Imports
		let BFSForm = window.__BFS.exports.BFSForm

		/*
		 * ----- Set up the Gold Rate Parameters forms for the various regions
		 */
		let rateParametersForm = new BFSForm( ".js_rate_parameters_form" )
		window.__BFS.UI[ "rateParametersForm" ] = { bfsFormInstance: rateParametersForm }

			// Stop loss
		rateParametersForm.addField( "stopLoss", ".js_form_input_stop_loss", function ( values ) {
			var stopLoss = values[ 0 ].trim();

			if ( stopLoss === "" )
				throw new Error( "Please provide a stop loss, else explicitly set it to 0." );

			stopLoss = parseInt( stopLoss, 10 );
			if ( Number.isNaN( stopLoss ) )
				throw new Error( "Please provide a valid stop loss number." );

			return stopLoss;
		} );

			// Margin percentage
		rateParametersForm.addField( "marginPercentage", ".js_form_input_margin_percentage", function ( values ) {
			var marginPercentage = values[ 0 ].trim();

			if ( marginPercentage.length === 0 )
				throw new Error( "Please provide a margin percentage, else explicitly set it to 0." );

			marginPercentage = parseFloat( marginPercentage, 10 );
			if ( Number.isNaN( marginPercentage ) )
				throw new Error( "Please provide a valid margin percentage." );
			else if ( marginPercentage < 0 || marginPercentage > 100 )
				throw new Error( "Please provide a valid margin percentage, within a range of 0 to 100." );

			return marginPercentage;
		} )

			// 22 Karat percentage
		rateParametersForm.addField( "22KaratPercentage", ".js_form_input_22_karat_percentage", function ( values ) {
			var twentyTwoKaratPercentage = values[ 0 ].trim();

			if ( twentyTwoKaratPercentage.length === 0 )
				throw new Error( "Please provide a percentage for 22 Karat gold." );

			twentyTwoKaratPercentage = parseFloat( twentyTwoKaratPercentage, 10 );
			if ( Number.isNaN( twentyTwoKaratPercentage ) )
				throw new Error( "Please provide a valid percentage for 22 Karat gold." );
			else if ( twentyTwoKaratPercentage < 0 || twentyTwoKaratPercentage > 100 )
				throw new Error( "Please provide a valid percentage for 22 Karat gold, within a range of 0 to 100." );

			return twentyTwoKaratPercentage;
		} )

			// Data pipeline filename
		rateParametersForm.addField( "dataPipelineFilename", ".js_form_input_data_pipeline_filename", function ( values ) {
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
		} )

		rateParametersForm.fetchAndSetExistingData = async function fetchAndSetExistingData () {
			let regionCode = this.getFormNode().data( "regionCode" )
			let pipelineData = await fetchPipelineData( regionCode )
			if ( ! pipelineData )
				return

			this.fields[ "stopLoss" ].set( pipelineData.context.stopLoss )
			this.fields[ "marginPercentage" ].set( pipelineData.context.marginPercentage )
			this.fields[ "22KaratPercentage" ].set( pipelineData.context[ "22KaratPercentage" ] )
			this.fields[ "dataPipelineFilename" ].set( pipelineData.path )
		}

		rateParametersForm.submit = function submit ( data ) {

			let dataPipelineFilename = data.dataPipelineFilename
			delete data.dataPipelineFilename

			let $form = this.getFormNode()
			let regionCode = this.getFormNode().data( "regionCode" )

			return setPipelineData( regionCode, dataPipelineFilename, data )

		}


		/*
		 * ----- Form submission event handler
		 */
		$( document ).on( "submit", `.js_rate_parameters_form`, function ( event ) {
			let $targetForm = $( event.target ).closest( "form" )
			let form = rateParametersForm.bind( $targetForm )

			/*
			 * ----- Prevent default browser behaviour
			 */
			event.preventDefault();

			/*
			 * ----- Prevent interaction with the form
			 */
			form.disable();

			/*
			 * ----- Provide feedback to the user
			 */
			form.giveFeedback( "Sending..." );

			/*
			 * ----- Extract data (and report issues if found)
			 */
			var data;
			try {
				data = form.getData();
			} catch ( error ) {
				alert( error.message )
				console.error( error.message )
				form.enable();
				form.setSubmitButtonLabel();
				form.fields[ error.fieldName ].focus()
				return;
			}

			/*
			 * ----- Submit data
			 */
			form.submit( data )
				.then( function ( response ) {
					/*
					 * ----- Provide further feedback to the user
					 */
					 form.giveFeedback( "Saved." );

					setTimeout( function () {
						form.setSubmitButtonLabel();
						form.enable();
					}, 1500 )

				} )

		} )


		/*
		 |
		 | Fetch and set the data for each form
		 |
		 */
		rateParametersForm.getFormNode().each( function ( _i, domForm ) {
			let form = rateParametersForm.bind( domForm )
			rateParametersForm.fetchAndSetExistingData.call( form )
		} )

	} );

</script>
