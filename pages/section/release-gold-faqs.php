<section class="release-gold-faqs-section fill-neutral-1 space-200-bottom js_section_release_gold_faqs" id="release-gold-faqs-section" data-section-title="Release Gold FAQs Section" data-section-slug="release-gold-faqs-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12 large-4">
				<div class="h2 strong text-neutral-3 space-100-bottom">Frequently Asked Questions</div>
			</div>
			<div class="columns small-12 large-8">
				<div class="row">
					<div class="videos-faqs columns small-12">
						<div class="videos-faqs-grid row">
							<?php foreach ( $releaseGoldVideos as $video ) : ?>
								<div class="watch-video block row fill-light js_modal_trigger" data-mod-id="youtube-video" data-src="<?= $video->get( 'video_embed_url' ) ?>">
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
						<input id="more-release-gold-faqs" type="checkbox" name="more-release-gold-faqs" class="more-faqs visuallyhidden">
						<div class="faqs">
							<?php foreach ( $releaseGoldFAQs as $faq ) : ?>
								<div class="faq">
									<input id="release-gold-faq-<?= $faq->get( 'ID' ) ?>" type="radio" name="release-gold-faq" class="visuallyhidden js_faq_toggle" checked>
									<label for="release-gold-faq-<?= $faq->get( 'ID' ) ?>" class="question block row space-25-top-bottom">
										<div class="title columns small-11 space-25">
											<div class="h6 medium"><?= $faq->get( 'post_title' ) ?></div>
										</div>
										<div class="toggle columns small-1"><div class="arrow"><span class="a1"></span><span class="a2"></span></div></div>
									</label>
									<div class="answer fill-neutral-2 radius-50">
										<div class="p space-50"><?= $faq->get( 'post_content' ) ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<label class="hide-faqs columns small-12 text-center" for="more-release-gold-faqs">
							<div class="button fill-neutral-2">Show All FAQs</div>
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
		 * ----- Allow the user to collapse an open FAQ in the Release Gold FAQs section
		 *
		 */
		var $releaseGoldFAQsSection = $( ".js_section_release_gold_faqs" );
		var currentlyToggledCardId = $releaseGoldFAQsSection.find( ".js_faq_toggle:checked" ).attr( "id" );
		$releaseGoldFAQsSection.on( "click", ".js_faq_toggle", function ( event ) {
			var domCardToggle = event.target;
			var newlyToggledCardId = domCardToggle.id;

			if ( currentlyToggledCardId !== newlyToggledCardId )
				return;

			domCardToggle.checked = false;
			currentlyToggledCardId = null;
		} );
		$releaseGoldFAQsSection.on( "change", ".js_faq_toggle", function ( event ) {
			currentlyToggledCardId = event.target.id;
		} );

	} );

</script>
