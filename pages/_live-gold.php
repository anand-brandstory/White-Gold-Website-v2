<?php
/*
 *
 * This is the Live Gold page.
 *
 */

$postTitle = 'View the Real-time Gold Rate';

require_once __ROOT__ . '/inc/utils.php';
require_once __ROOT__ . '/inc/cms.php';

use BFS\CMS;
CMS::setupContext();

require_once __ROOT__ . '/inc/header.php';

?>

<!-- ## Live Gold Page -->
<!-- Header Section -->
<?php require_once __ROOT__ . '/pages/section/header.php'; ?>
<!-- END: Header Section -->


<!-- Live Gold Section -->
<section class="live-gold-section fill-dark">
	<div class="container space-200-top-bottom js_live_gold_form_section hidden">
		<div class="row sell-gold-form">
			<div class="columns small-9 medium-5 large-3">
				<div class="form-card row fill-light">
					<form class="form form-base js_live_gold_form" onsubmit="event.preventDefault()">
						<div class="columns small-10 space-50-bottom">
							<div class="h5 strong">Get a guaranteed ‘Gold Rate’ in any White Gold branch in your city</div>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="phone-verify form-label block">
								<input type="text" class="form-input-field phone-number block" id="js_live_gold_form_input_phone">
								<select class="form-input-field country-code js_phone_country_code">
									<?php require __ROOT__ . '/inc/phone-country-codes.php' ?>
								</select>
								<input type="text" disabled="" class="form-input-field country-code-label js_phone_country_code_label" value="+91" id="js_live_gold_form_input_phone_country_code">
								<span class="country-code-divider material-icons" data-icon="unfold_more"></span>
								<span class="form-label-title medium fill-light cursor-pointer">Mobile Number</span>
							</label>
						</div>
						<div class="row space-25-top space-50-left-right">
							<div class="small text-neutral-3">I hereby authorise, WHITE GOLD to call me on this number.</div>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-light cursor-pointer">Submit</span>
								<button class="button fill-dark" type="submit">
									<span class="button-label">Get OTP&ensp;</span>
									<img class="button-icon tall" src="../media/icon/sms-tall-green.svg<?php echo $ver ?>">
								</button>
							</label>
						</div>
					</form>
					<form class="form form-otp js_otp_form js_otp_form_live_gold" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<label class="form-label block">
								<input type="text" placeholder="Enter OTP" class="form-input-field block" id="js_form_input_otp_live_gold">
								<span class="form-label-title medium fill-light cursor-pointer">Enter OTP</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-light cursor-pointer">Submit</span>
								<button class="button fill-blue-1" type="submit">Submit OTP</button>
							</label>
						</div>
					</form>
					<div class="form form-thankyou">
						<div class="columns small-12">
							<div class="h4 strong space-50-bottom">Launching on <br>31st July, 2021.</div>
							<div class="p">The Live Gold Rate Feature will ensure that you get the same gold rate across all our branches.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="inline-modal">
		<div class="container">
			<div class="row">
				<div class="otp-verify">
					<!-- insert text -->
				</div>
				<div class="off-hrs">
					<!-- insert text -->
				</div>
				<div class="holiday">
					<!-- insert text -->
				</div>
				<div class="number-blocked">
					<!-- insert text -->
				</div>
			</div>
		</div>
	</div>
	<div class="live-gold space-200-top-bottom">
		<div class="row">
			<div class="container">
				<div class="live-gold-data columns small-12 medium-5 large-4 space-200-bottom">
					<div class="title h2 strong space-25-bottom">White Gold <br><span class="text-yellow-2">Live Gold Rate</span></div>
					<div class="date label space-150-bottom">12 June 2021&ensp;&bull;&ensp;9:45:00 AM IST</div>
					<div class="data inline">
						<div class="24k space-50-bottom">
							<div class="h6 text-yellow-2">24 Karat Gold</div>
							<div class="live-rate">
								<span class="rate h2 medium text-yellow-2 inline">₹ 5,011.4</span>
								<span class="trend inline space-25-left-right">
									<img src="/media/icon/trend-up.svg<?= $ver ?>" style="width: var(--h5);">
								</span>
								<span class="unit h6 inline"> per gram</span>
							</div>
						</div>
						<hr class="fill-light">
						<div class="22k space-50-top">
							<div class="h6 text-yellow-2">22 Karat Gold</div>
							<div class="live-rate">
								<span class="rate h2 medium text-yellow-2 inline">₹ 4,900.3</span>
								<span class="trend inline space-25-left-right">
									<img src="/media/icon/trend-down.svg<?= $ver ?>" style="width: var(--h5);">
								</span>
								<span class="unit h6 inline"> per gram</span>
							</div>
						</div>
					</div>
				</div>
				<div class="live-gold-graph columns small-12 medium-7 large-8 space-200-bottom">
					<img class="block" src="https://via.placeholder.com/800x600" alt="">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<div class="live-gold-quote columns small-12 medium-6 medium-offset-5 large-5 large-offset-4 space-200-bottom">
					<div class="form-card row fill-light">
						<form class="form form-base" onsubmit="event.preventDefault()">
							<div class="columns small-12">
								<div class="h3 strong">Quick Quotation</div>
							</div>
							<div class="columns small-12 space-50-top">
								<label class="form-label block">
									<input type="text" placeholder="Quantity (in grams)" class="form-input-field block" id="js_sell_gold_form_input_quantity">
									<span class="form-label-title medium fill-light cursor-pointer">Quantity (in grams)</span>
								</label>
							</div>
							<div class="columns small-12 space-50-top space-100-bottom">
								<label class="form-label block">
									<select class="block" id="purity">
										<option value="24">24 Karat</option>
										<option value="22">22 Karat</option>
									</select>
									<span class="form-label-title medium fill-light cursor-pointer">Purity</span>
								</label>
							</div>
							<div class="quote-output fill-yellow-1 columns small-12 radius-25" style="overflow: hidden;">
								<div class="row">
									<div class="p inline-middle columns small-5 space-50">Basic Rate</div>
									<div class="value h6 inline-middle columns small-7 space-50 text-right">₹ 5,39,000</div>
								</div>
								<div class="row space-50-left-right"><hr class="fill-neutral-4 opacity-25"></div>
								<div class="row">
									<div class="p inline-middle columns small-6 space-50">3% Service Charge</div>
									<div class="value h6 inline-middle columns small-6 space-50 text-right">- ₹ 16,170</div>
								</div>
								<div class="row fill-yellow-2">
									<div class="p inline-middle columns small-5 space-50">Final Quotation</div>
									<div class="value h4 strong inline-middle columns small-7 space-50 text-right">₹ 5,22,830</div>
								</div>
							</div>
						</form>

					</div>
				</div>
				<div class="live-gold-video columns small-12 medium-6 medium-offset-5 large-5 large-offset-4" style="margin-top: 25vw;">
					<a href="" class="watch-video block row fill-blue-1">
						<div class="columns small-6">
							<div class="thumbnail" style="background-image: url('');"></div>
						</div>
						<div class="columns small-6 space-50-left space-25-right">
							<div class="title h6 medium space-25-top-bottom">Why is the gold rate lower than I expected?</div>
							<div class="timestamp small">02:30</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="background row fill-yellow-2" style="background-image: linear-gradient(0deg, rgba(255,201,128,0.4) 40%, rgba(33,35,34,1) 98%), url('/media/background/sell-gold.png<?= $ver ?>');"></div>
	</div>
</section>
<!-- END: Live Gold Section -->





<?php require_once __ROOT__ . '/inc/footer.php'; ?>
<script type="text/javascript" src="/js/pages/live-gold/live-gold-form.js?<?= $ver ?>"></script>
<script type="text/javascript" src="/js/pages/live-gold/login-prompts.js?<?= $ver ?>"></script>
