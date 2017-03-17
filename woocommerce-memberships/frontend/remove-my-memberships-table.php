<?php // Only copy this line if needed

/**
 * Removes the "My Memberships" table from my account area
 */
function sv_remove_my_memberships_table() {

	if ( function_exists( 'wc_memberships' ) && ! is_admin() ) {
		remove_action( 'woocommerce_before_my_account', array( wc_memberships()->get_frontend_instance()->get_member_area_instance(), 'my_account_memberships' ) );
	}
}
add_action( 'init', 'sv_remove_my_memberships_table', 50 );
