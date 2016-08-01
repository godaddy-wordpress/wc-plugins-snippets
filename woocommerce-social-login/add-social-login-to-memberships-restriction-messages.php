<?php // only copy this line if needed

/**
 * Add social login buttons to the WC Memberships "restricted content" messages
 * Hooks into several filters to add login buttons to all message types
 *
 * @param string $message the message content
 * @param int $post_id the post or product ID for the restricted post object
 * @return string - the updated message content
 */
function sv_wc_memberships_social_login_buttons_notice( $message, $post_id ) {

	// you could limit login buttons to certain posts or post types using the post ID
	// e.g., if ( 'projects' === get_post_type( $post_id ) ) { // only output buttons for project restriction messages }
	// or by choosing which filters you hook this function into

	if ( function_exists( 'woocommerce_social_login_buttons' ) ) {

		add_filter( 'pre_option_wc_social_login_text', '__return_empty_string' );

		ob_start();
		woocommerce_social_login_buttons();
		return $message . ob_get_clean();
	}

	return $message;
}
add_filter( 'wc_memberships_product_viewing_restricted_message', 'sv_wc_memberships_social_login_buttons_notice', 10, 2 );
add_filter( 'wc_memberships_product_purchasing_restricted_message', 'sv_wc_memberships_social_login_buttons_notice', 10, 2 );
add_filter( 'wc_memberships_content_restricted_message', 'sv_wc_memberships_social_login_buttons_notice', 10, 2 );
add_filter( 'wc_memberships_product_taxonomy_viewing_restricted_message', 'sv_wc_memberships_social_login_buttons_notice', 10, 2 );