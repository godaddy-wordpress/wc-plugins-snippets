<?php // only copy if needed

// Removes "thank you for purchasing a membership" messages from both thank you page + emails
add_filter( 'woocommerce_memberships_thank_you_message', '__return_empty_string' );


// OR


// Removes Memberships "thank you" message from emails
function sv_wc_memberships_remove_email_thankyou() {

	if ( function_exists( 'wc_memberships' ) ) {
		remove_action( 'woocommerce_email_order_meta', array( wc_memberships()->get_emails_instance(), 'maybe_render_thank_you_content' ), 5, 2 );
	}
}
add_action( 'init', 'sv_wc_memberships_remove_email_thankyou' );


// OR


// Removes Memberships "thank you" message from thank you page
function sv_wc_memberships_remove_email_thankyou() {

	if ( function_exists( 'wc_memberships' ) ) {
		remove_action( 'woocommerce_thankyou', array( wc_memberships()->get_frontend_instance(), 'maybe_render_thank_you_content' ), 9 );
	}
}
add_action( 'init', 'sv_wc_memberships_remove_email_thankyou' );