<?php // only copy if needed


/**
 * Redirects a member to the shop when logging in rather than the account.
 *
 * @param string $redirect link to direct user to
 * @param \WP_User $user the user logging in
 * @return string updated redirect link
 */
function sv_wc_memberships_redirect_member_login( $redirect, $user ) {

	// the current_user_can() check prevents us from redirecting shop employees
	if ( wc_memberships_is_user_active_member( $user->ID, 'silver' ) && ! current_user_can( 'manage_woocommerce' ) ) {

		// you could use a different page instead by using the page ID:
		// $new_redirect = get_permalink( 99 );
		// or a product category using get_term_link:
		// $new_redirect = get_term_link( 'clothing', 'product_cat' );

		$new_redirect = wc_get_page_permalink( 'shop' );
	}

	return ! is_wp_error( $new_redirect ) ? $new_redirect : $redirect;
}
add_filter( 'woocommerce_login_redirect', 'sv_wc_memberships_redirect_member_login', 99, 2 );
