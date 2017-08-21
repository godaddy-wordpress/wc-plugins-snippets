<?php // only copy if needed

/**
 * Halts automated member login from email renewal links.
 *
 * REQUIRES Memberships v1.9+
 *
 * @param int $member_user_id the member's WP user ID
 * @param \WC_Memberships_User_Membership $membership the membership object (unused)
 */
function sv_wc_memberships_disable_renewal_auto_login( $member_user_id ) {

	// halt the login process if the right user isn't logged in already
	if ( ! get_current_user_id() ) {

		throw new SV_WC_Plugin_Exception( 'Please log in to renew your membership.' );

	// also halt if the user isn't logged into the right account
	} elseif ( (int) $member_user_id !== get_current_user_id() ) {

		throw new SV_WC_Plugin_Exception( 'Please login to the correct account to renew your membership.' );
	}
}
add_action( 'wc_memberships_before_renewal_auto_login', 'sv_wc_memberships_disable_renewal_auto_login', 10, 1 );