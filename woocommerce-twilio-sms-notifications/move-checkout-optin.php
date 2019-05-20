<?php // only copy if needed

/**
 * Moves Twilio input field from after the billing form to immediately before
 * the submit button
 */

function sv_wc_twilio_sms_remove_input_fields() {

	if ( ! function_exists( 'wc_twilio_sms' ) ) {
		return;
	}

	remove_action( 'woocommerce_after_checkout_billing_form', array( wc_twilio_sms(), 'add_opt_in_checkbox' ) );
	add_action( 'woocommerce_review_order_before_submit',  array( wc_twilio_sms(), 'add_opt_in_checkbox' ) );
}
add_action( 'init', 'sv_wc_twilio_sms_remove_input_fields' );
