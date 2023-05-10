<?php if( have_rows('top_career_section') ): ?>
<section class="sell-gold-section fill-blue-5 space-200-top space-80-bottom js_section_sell_gold" id="sell-gold-section" data-section-title="Sell Gold Section" data-section-slug="sell-gold-section">
	<div class="container">
		<div class="row">
			<div class="intro columns small-12 large-4">
				<div class="h2 strong text-white-2">Growth Ladder At White Gold</div>
				<img src="<?php the_field('add_left_sec_img');?>" alt="Growth Ladder At White Gold" class="img-fluid d-none d-md-block mt-50">		
	</div>
			<div class="step-cards columns small-12 large-8 pl-15 pr-15">
				<div class="step-card-grid row">
					<div class="step-break columns small-12 space-75-left-right">
						<div class="row text-blue-3 space-75-top">
							<div class="label strong text-uppercase columns small-6"></div>
							<div class="p strong columns small-6 text-right"></div>
						</div>
					</div>
					
					
					<?php while( have_rows('top_career_section') ): the_row(); ?>
					<div class="card sgs<?php the_sub_field('add_sl_no');?> columns small-12 fill-blue-4">
						<input id="sgs<?php the_sub_field('add_sl_no');?>" type="radio" name="sell-gold-step" class="visuallyhidden js_card_toggle">
						<label for="sgs<?php the_sub_field('add_sl_no');?>" class="card-head row block">
							<div class="columns small-1"><span class="index h6 medium"><?php the_sub_field('add_sl_no');?></span></div>
							<div class="title h4 strong text-light columns small-10 space-50-left-right"><?php the_sub_field('add_job_title');?></div>
							<div class="toggle columns small-1">
								<div class="arrow"><span class="a1"></span><span class="a2"></span></div>
							</div>
						</label>
						<div class="card-content">
							<div class="row space-50-left-right">
								<div class="columns small-12 medium-12 small-offset-1 space-50-left-right space-20-top-bottom space-100-bottom">
								
									<div class="p space-100-right"><?php the_sub_field('add_job_description');?>
<a class="btn-custom-primary" href="<?php the_sub_field('apply_now_link'); ?>">Apply Now</a>	
</div>
								</div>
							</div>
						
						</div>
					</div>
					<?php endwhile; ?>


				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
