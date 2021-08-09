<?php

add_action( 'admin_menu', function () {

	add_menu_page(
		'Gold Rate Parameters',	// page title
		'Gold Rate Parameters',	// menu title
		'edit_gold_rate_parameters',	// capability
		'gold-rate-parameters',	// menu slug
		'goldRateParametersPage',	// callable function
		'dashicons-money-alt',	// dashicon or icon URL
		4	// menu position
	);

	function goldRateParametersPage () {
		?>

		<iframe src="/admin/gold-rate-parameters" name="bfs" class="js_bfs_page_iframe" style="width: 100%;"></iframe>

		<script>

			( function () {

				/*
				 |
				 | Ensure that the `iframe` element is always as tall as the page it's referencing
				 |
				 */
				let domIframe = document.getElementsByClassName( "js_bfs_page_iframe" )[ 0 ]
				window.frames.bfs.onload = function () {
					matchIframeDimensionsWithItsContent( domIframe )
				}
				window.addEventListener( "resize", function () {
					matchIframeDimensionsWithItsContent( domIframe )
				} )
				matchIframeDimensionsWithItsContent( domIframe )

				function matchIframeDimensionsWithItsContent ( domIframe ) {
					domIframe.style.height = domIframe.contentWindow.document.body.scrollHeight + "px";
				}

			}() )

		</script>

		<?php
	}

} );
