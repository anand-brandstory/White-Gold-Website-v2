<section class="sell-gold-form-section space-100-top space-200-bottom js_sell_gold_form_section" id="sell-gold-form-section" data-section-title="Sell Gold Form Section" data-section-slug="sell-gold-form-section">
	<div class="container">
		<div class="row sell-gold-form">
			<div class="columns small-6 medium-5 large-3 space-100-bottom">
				<div class="logo space-75-bottom">
					<img class="block" src="../media/whitegold-logo-dark.svg<?php echo $ver ?>">
				</div>
				<div class="h2 line-height-small">Turn your <span class="strong">gold into money</span></div>
			</div>
			<br class="hide-large hide-xlarge">
			<div class="columns small-9 medium-5 large-3 large-offset-1">
				<div class="form-card row fill-light">
					<form class="form form-base js_sell_gold_form" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<label class="form-label block">
								<input type="text" placeholder="Full Name" class="form-input-field block" id="js_sell_gold_form_input_name">
								<span class="form-label-title medium fill-light cursor-pointer">Full Name</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<input type="text" placeholder="Quantity (in grams)" class="form-input-field block" id="js_sell_gold_form_input_quantity">
								<span class="form-label-title medium fill-light cursor-pointer">Quantity (in grams)</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="phone-verify form-label block">
								<input type="text" class="form-input-field phone-number block" id="js_sell_gold_form_input_phone">
								<select class="form-input-field country-code js_phone_country_code">
									<?php require __ROOT__ . '/inc/phone-country-codes.php' ?>
								</select>
								<input type="text" disabled="" class="form-input-field country-code-label js_phone_country_code_label" value="+91" id="js_sell_gold_form_input_phone_country_code">
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
								<button class="button fill-blue-1" type="submit">
									<span class="button-label">Sell Gold</span>
									<img class="button-icon tall" src="../media/icon/rupee-tall-blue.svg<?php echo $ver ?>">
								</button>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<a class="inline phone-call" href="tel:<?= $contactNumbersForRegions[ REGION ] ?>">
								<img class="icon inline-middle" style="width: calc( var(--h6) * 2 );" src="../media/icon/phone-call-dark.svg<?php echo $ver ?>">
								<div class="inline-middle space-25-left">
									<span class="inline label strong text-uppercase line-height-small">Or call</span><br>
									<span class="inline h6 strong line-height-small"><?= $contactNumbersForRegions[ REGION ] ?></span>
								</div>
							</a>
						</div>
					</form>
					<form class="form form-otp js_otp_form js_otp_form_sell_gold" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<label class="form-label block">
								<input type="text" placeholder="Enter OTP" class="form-input-field block" id="js_form_input_otp_sell_gold">
								<span class="form-label-title medium fill-light cursor-pointer">Enter OTP</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-light cursor-pointer">Submit</span>
								<button class="button fill-blue-1">Submit OTP</button>
							</label>
						</div>
					</form>
					<div class="form form-thankyou">
						<div class="columns small-12">
							<div class="h4 strong space-25-bottom">Thank You</div>
							<div class="p">We'll get in touch with you soon.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="char"><img class="block" src="../media/cutout/char-5.png<?php echo $ver ?>"></div>
	</div>
</section>