<section class="sell-gold-home-visit-form-section space-200-top-bottom fill-blue-5 js_home_visit_form_section" id="sell-gold-home-visit-form-section" data-section-title="Sell Gold Home Visit Form Section" data-section-slug="sell-gold-home-visit-form-section">
	<div class="container">
		<div class="row sell-gold-home-visit-form">
			<div class="columns small-12 large-4 space-100-bottom">
				<div class="h2 strong text-yellow-2">Sell your Gold</div>
				<div class="h2 strong text-blue-3">from home</div>
			</div>
			<br class="hide-large hide-xlarge">
			<div class="columns small-6 medium-3 large-2 space-100-bottom">
				<div class="p strong inline fill-blue-4 space-50 opacity-75 radius-25" style="margin: 0 var(--space-50) var(--space-50) 0;">Minimum quantity <br><span class="no-wrap">50 grams</span></div>
				<div class="p strong inline fill-blue-4 space-50 opacity-75 radius-25">Only 916 Hallmark <br>Jewellery</div>
			</div>
			<div class="columns small-9 medium-5 large-3">
				<div class="form-card form-dark row fill-blue-4">
					<form class="form form-base js_home_visit_form" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<label class="form-label block">
								<input type="text" placeholder="Pincode" class="form-input-field block" id="js_home_visit_form_input_pincode">
								<span class="form-label-title medium fill-blue-4 cursor-pointer">Pincode</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="phone-verify form-label block">
								<input type="text" class="form-input-field phone-number block" id="js_home_visit_form_input_phone">
								<select class="form-input-field country-code js_phone_country_code">
									<?php require __ROOT__ . '/inc/phone-country-codes.php' ?>
								</select>
								<span class="country-code-divider material-icons" data-icon="unfold_more"></span>
								<input type="text" disabled="" class="form-input-field country-code-label js_phone_country_code_label" value="+91" id="js_home_visit_form_input_phone_country_code">
								<span class="form-label-title medium fill-blue-4 cursor-pointer">Mobile Number</span>
							</label>
						</div>
						<div class="row space-25-top space-50-left-right">
							<div class="small text-light">I hereby authorise, WHITE GOLD to call me on this number.</div>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-blue-2 cursor-pointer">Submit</span>
								<button class="button fill-light" type="submit">
									<span class="button-label">Book Home Visit&ensp;</span>
									<img class="button-icon tall" src="../media/icon/submit-tall-blue.svg<?php echo $ver ?>">
								</button>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<a class="inline phone-call" href="tel:<?= $contactNumbersForRegions[ REGION ] ?>">
								<img class="icon inline-middle" style="width: calc( var(--h6) * 2 );" src="../media/icon/phone-call-light.svg<?php echo $ver ?>">
								<div class="inline-middle space-25-left">
									<span class="inline label strong text-uppercase line-height-small">Or call</span><br>
									<span class="inline h6 strong line-height-small"><?= $contactNumbersForRegions[ REGION ] ?></span>
								</div>
							</a>
						</div>
					</form>
					<form class="form form-otp js_otp_form js_otp_form_home_visit" onsubmit="event.preventDefault()">
						<div class="columns small-12">
							<label class="form-label block">
								<input type="text" placeholder="Enter OTP" class="form-input-field block" id="js_form_input_otp_home_visit">
								<span class="form-label-title medium fill-blue-4 cursor-pointer">Enter OTP</span>
							</label>
						</div>
						<div class="columns small-12 space-50-top">
							<label class="form-label block">
								<span class="form-label-title hidden medium fill-light cursor-pointer">Submit</span>
								<button class="button fill-light">Submit OTP</button>
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
		<div class="char"><img class="block" src="../media/cutout/char-7364.png<?php echo $ver ?>"></div>
	</div>
</section>