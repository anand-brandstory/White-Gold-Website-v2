<?php if( have_rows('faq_careers') ): ?>

<section class="release-gold-faqs-section fill-neutral-1 space-200-top space-200-bottom js_section_release_gold_faqs" id="release-gold-faqs-section" data-section-title="Release Gold FAQs Section" data-section-slug="release-gold-faqs-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12 large-4">
				<div class="h2 strong text-neutral-3 space-100-bottom">Frequently Asked Questions</div>
			</div>
			<div class="columns small-12 large-8">

				<div class="row">
<p class="mb-5" style="font-size:16px;"><?php the_field('add_faq_sub_content');?></p>
					<div class="videos-faqs columns small-12">
						<div class="videos-faqs-grid row">
													</div>
					</div>
					<div class="articles-faqs columns small-12">
						<input id="more-release-gold-faqs" type="checkbox" name="more-release-gold-faqs" class="more-faqs visuallyhidden">
						<div class="faqs">
												
              <?php while( have_rows('faq_careers') ): the_row(); ?>	
															<div class="faq">
									<input id="release-gold-faq-<?php the_sub_field('add_title');?>" type="radio" name="release-gold-faq" class="visuallyhidden js_faq_toggle" checked="">
									<label for="release-gold-faq-<?php the_sub_field('add_title');?>" class="question block row space-25-top-bottom">
										<div class="title columns small-11 space-25">
											<div class="h6 medium" style="font-weight: 800;"><?php the_sub_field('add_title');?></div>
										</div>
										<div class="toggle columns small-1"><div class="arrow"><span class="a1"></span><span class="a2"></span></div></div>
									</label>
									<div class="answer fill-neutral-2 radius-50">
										<div class="p space-50"><!-- wp:paragraph {"placeholder":"Type in a detailed answer here..."} -->
<p><?php the_sub_field('add_description');?></p>
</div>
									</div>
								</div>
                <?php endwhile; ?>
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
<?php endif; ?>
