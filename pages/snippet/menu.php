<?php

function navigationMenuComponent ( $whatsappId, $contactNumbersForRegions ) {
?>

<!-- Main Menu -->
<div class="main-menu columns small-12 medium-6 medium-offset-3 large-12 large-offset-0 fill-dark radius-50 js_whatsapp_form_section js_main_menu">
	<div class="row">
		<!-- Menu Switcher Checkbox -->
		<input id="toggle-menu-open-<?= $whatsappId ?>" type="checkbox" name="toggle-menu-open" class="toggle-menu-open visuallyhidden js_primary_toggle_menu">
		<!-- Whatsapp Switcher Checkbox -->
		<input id="toggle-whatsapp-open-<?= $whatsappId ?>" type="checkbox" name="toggle-whatsapp-open" class="toggle-whatsapp-open visuallyhidden js_wa_toggle_menu">
		<!-- Menu Content -->
		<div class="menu-content columns small-12 large-9">
			<div class="row space-25">
				<div class="columns small-6 large-4 space-25">
					<a class="menu-button menu-button-large block fill-blue-4" href="/<?= REGION ?>/branches">
						<span class="menu-button-bg" style="background-image: url('/media/background/find-branch.png<?php echo $ver ?>'); filter: brightness(0.9);" alt=""></span>
						<span class="menu-button-icon">
							<img class="block" src="/media/icon/location-white.svg<?php echo $ver ?>">
						</span>
						<span class="menu-button-label">Find Nearest <br class="hide-large hide-xlarge">Branch</span>
					</a>
				</div>
				<div class="columns small-6 large-4 space-25">
					<a class="menu-button menu-button-large block fill-yellow-2 text-light disabled" href="/<?= REGION ?>/live-gold">
						<span class="menu-button-bg fill-dark" style="background-image: url('/media/background/sell-gold.png<?php echo $ver ?>'); filter: brightness(0.5);" alt=""></span>
						<span class="menu-button-icon">
							<img class="block" src="/media/icon/rupee-white.svg<?php echo $ver ?>">
						</span>
						<span class="menu-button-label">Live Gold <br class="hide-large hide-xlarge">Rate</span>
					</a>
				</div>
				<div class="columns small-6 large-2 space-25">
					<a class="menu-button block fill-blue-5" href="/<?= REGION ?>#sell-gold-section">Sell Gold</a>
				</div>
				<div class="columns small-6 large-2 space-25">
					<a class="menu-button block fill-light" href="/<?= REGION ?>#release-gold-section">Release Gold</a>
				</div>
			</div>
		</div>
		<!-- Menu Controls -->
		<div class="menu-head columns small-12 large-3">
			<div class="row space-25">
				<div class="toggle-whatsapp columns small-2 large-3 space-25">
					<label class="menu-button block fill-neutral-5" style="--bg-image: url( '/media/icon/vertical-dots.white.svg<?= $ver ?>' ); background-color: #32AF74;" for="toggle-whatsapp-open-<?= $whatsappId ?>">
						<span class="l1"></span>
						<span class="l2"></span>
						<img class="block" src="/media/icon/whatsapp-outline.svg<?= $ver ?>">
					</label>
				</div>
				<div class="phone-number columns small-6 small-offset-1 large-9 large-offset-0 space-25">
					<a class="menu-button block fill-neutral-5 text-center" href="tel:<?= $contactNumbersForRegions[ REGION ] ?>"><?= $contactNumbersForRegions[ REGION ] ?></a>
				</div>
				<div class="toggle-menu columns small-2 small-offset-1 large-3 large-offset-0 space-25 hide-large hide-xlarge">
					<label class="menu-button block fill-neutral-5" style="--bg-image: url( '/media/icon/vertical-dots.white.svg<?= $ver ?>' )" for="toggle-menu-open-<?= $whatsappId ?>">
						<span class="l1"></span>
						<span class="l2"></span>
						<span class="l3"></span>
					</label>
				</div>
			</div>
		</div>
		<!-- Whatsapp Form -->
		<div class="whatsapp-form fill-dark columns small-12 large-4">
			<div class="">
				<form class="form-card form-dark row space-25 js_whatsapp_form" onsubmit="event.preventDefault()" data-number="<?= WHATSAPP_NUMBER ?>">
					<div class="columns small-12 space-25">
						<label class="form-label block">
							<textarea class="form-input-field block js_form_input_message" placeholder="Your Message"></textarea>
							<span class="form-label-title medium fill-dark cursor-pointer">Your Message</span>
						</label>
					</div>
					<div class="columns small-10 space-25">
						<label class="phone-verify form-label block">
							<input type="text" class="form-input-field phone-number block js_form_input_phone_number" _id="js_home_visit_form_input_phone_<?= $whatsappId ?>">
							<select class="form-input-field country-code js_phone_country_code">
								<?php require __ROOT__ . '/pages/snippet/phone-country-codes.php' ?>
							</select>
							<span class="country-code-divider material-icons" data-icon="unfold_more"></span>
							<input type="text" disabled="" class="form-input-field country-code-label js_phone_country_code_label" value="+91" _id="js_home_visit_form_input_phone_country_code_<?= $whatsappId ?>">
							<span class="form-label-title medium fill-dark cursor-pointer">Mobile Number</span>
						</label>
					</div>
					<div class="columns small-2 space-25">
						<button class="send-to-whatsapp block fill-neutral-5" type="submit"><img class="block" src="/media/icon/whatsapp-outline.svg<?= $ver ?>"></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END: Main Menu -->

<?php
}
