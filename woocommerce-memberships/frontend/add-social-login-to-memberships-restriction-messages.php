<?php // only copy this line if needed

/**
 * We're working on adding this to Social Login soon!
 * {BR 2017-09-28}
 */

/**
 * Add social login buttons to the WC Memberships "restricted content" messages
 * Loops all "content restricted" filters to add login buttons to all message types
 */
function sv_wc_memberships_social_login_buttons_restriction_notices() {

	if ( function_exists( 'woocommerce_social_login_buttons' ) && function_exists( 'wc_memberships' ) ) {

		foreach ( sv_wc_memberships_get_restriction_messages() as $code ) {
			add_filter( "wc_memberships_{$code}", 'sv_wc_memberships_add_social_login_buttons', 10, 2 );
		}
	}
}
add_action( 'wp', 'sv_wc_memberships_social_login_buttons_restriction_notices' );


/**
 * Renders Social Login buttons in restriction message HTML
 *
 * @param string $message the message content
 * @param string[] $args {
 *	@type string $context whether the message appears in the context of a notice or elsewhere
 *	@type \WP_Post $post the post object
 *	@type int $post_id the ID of the restricted post
 *	@type int $access_time the user access timestamp
 *	@type int[] $products the product IDs that grant access
 *	@type string $rule_type the related rule type
 *	@type string|string[] $classes optional message CSS classes
 * }
 * @return string updated message html
 */
function sv_wc_memberships_add_social_login_buttons( $message, $args ) {

	add_filter( 'pre_option_wc_social_login_text_non_checkout', '__return_empty_string' );

	// you could limit login buttons to certain posts or post types using the post ID
	// e.g., if ( 'projects' === get_post_type( $args['post_id'] ) ) { // only output buttons for project restriction messages }
	// or by choosing which filters you hook this function into

	ob_start();
	woocommerce_social_login_buttons();
	return $message . ob_get_clean();
}


if ( ! function_exists( 'sv_wc_memberships_get_restriction_messages' ) ) :

	/**
	 * Returns a list of all Memberships "content restricted" message types.
	 *
	 * @return string[] restriction message codes
	 */
	function sv_wc_memberships_get_restriction_messages() {

		return array(
			'post_content_restricted_message',
			'post_content_restricted_message_no_products',
			'page_content_restricted_message',
			'page_content_restricted_message_no_products',
			'content_restricted_message',
			'content_restricted_message_no_products',
			'product_viewing_restricted_message',
			'product_viewing_restricted_message_no_products',
			'product_purchasing_restricted_message',
			'product_purchasing_restricted_message_no_products',
			'product_category_viewing_restricted_message',
			'product_category_viewing_restricted_message_no_products',
		);
	}

endif;
