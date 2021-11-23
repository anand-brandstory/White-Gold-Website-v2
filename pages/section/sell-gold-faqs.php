<section class="sell-gold-faqs-section fill-blue-5 space-200-bottom js_section_sell_gold_faqs" id="sell-gold-faqs-section" data-section-title="Sell Gold FAQs Section" data-section-slug="sell-gold-faqs-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12 large-4">
				<div class="h2 strong text-blue-3 space-100-bottom">Frequently Asked Questions</div>
			</div>
			<div class="columns small-12 large-8">
				<div class="row">
					<div class="videos-faqs columns small-12">
						<div class="videos-faqs-grid row">
							<?php foreach ( $sellGoldVideos as $video ) : ?>
								<div class="watch-video block row fill-blue-4 js_modal_trigger" data-mod-id="youtube-video" data-src="<?= $video->get( 'video_embed_url' ) ?>">
									<div class="columns small-12 medium-6">
										<div class="thumbnail" style="background-image: url( '<?= $video->get( 'image' ) ?>' );"></div>
									</div>
									<div class="info columns small-12 medium-6 space-25-left-right">
										<div class="title h6 medium space-25-top-bottom"><?= $video->get( 'post_title' ) ?></div>
										<div class="timestamp small"><?= $video->get( 'video_embed_duration' ) ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="articles-faqs columns small-12">
						<input id="more-sell-gold-faqs" type="checkbox" name="more-sell-gold-faqs" class="more-faqs visuallyhidden">
						<div class="faqs">
							<?php foreach ( $sellGoldFAQs as $faq ) : ?>
								<div class="faq">
									<input id="sell-gold-faq-<?= $faq->get( 'ID' ) ?>" type="radio" name="sell-gold-faq" class="visuallyhidden js_faq_toggle">
									<label for="sell-gold-faq-<?= $faq->get( 'ID' ) ?>" class="question block row space-25-top-bottom">
										<div class="title columns small-11 space-25">
											<div class="h6 medium"><?= $faq->get( 'post_title' ) ?></div>
										</div>
										<div class="toggle columns small-1"><div class="arrow"><span class="a1"></span><span class="a2"></span></div></div>
									</label>
									<div class="answer fill-blue-4 radius-50">
										<div class="p space-50"><?= $faq->get( 'post_content' ) ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<label class="hide-faqs columns small-12 text-center" for="more-sell-gold-faqs">
							<div class="button fill-blue-3">Show All FAQs</div>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">

	$( function () {

		/*
		 *
		 * ----- Allow the user to collapse an open FAQ in the Sell Gold FAQs section
		 *
		 */
		var $sellGoldFAQsSection = $( ".js_section_sell_gold_faqs" );
		var currentlyToggledCardId = $sellGoldFAQsSection.find( ".js_faq_toggle:checked" ).attr( "id" );
		$sellGoldFAQsSection.on( "click", ".js_faq_toggle", function ( event ) {
			var domCardToggle = event.target;
			var newlyToggledCardId = domCardToggle.id;

			if ( currentlyToggledCardId !== newlyToggledCardId )
				return;

			domCardToggle.checked = false;
			currentlyToggledCardId = null;
		} );
		$sellGoldFAQsSection.on( "change", ".js_faq_toggle", function ( event ) {
			currentlyToggledCardId = event.target.id;
		} );

	} );

</script>
