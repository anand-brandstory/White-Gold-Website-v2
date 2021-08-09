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
<section class="live-gold-section fill-blue-7 space-200-top-bottom js_live_gold_form_section" style="min-height: 70vh;">
	<div class="container">
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
									<span class="button-label js_submit_label">Get OTP&ensp;</span>
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
								<button class="button fill-blue-1 js_submit_label" type="submit">Submit OTP</button>
							</label>
						</div>
					</form>
					<div class="form form-thankyou">
						<div class="columns small-12">
							<div class="h4 strong space-50-bottom">Launching on <br>31st August, 2021.</div>
							<div class="p">The Live Gold Rate Feature will ensure that you get the same gold rate across all our branches.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container hidden">
		<div class="row">
			<div class="inline-modal columns small-12">
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
			<div class="live-gold columns small-12">
				<div class="row">
					<div class="live-gold-graph columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-data columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-quote columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-alert-form columns small-12">
						<!-- insert text -->
					</div>
					<div class="live-gold-video columns small-12">
						<!-- insert text -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Live Gold Section -->





<?php require_once __ROOT__ . '/inc/footer.php'; ?>
<script type="text/javascript" src="/js/pages/live-gold/live-gold-form.js?<?= $ver ?>"></script>
<script type="text/javascript" src="/js/pages/live-gold/login-prompts.js?<?= $ver ?>"></script>
