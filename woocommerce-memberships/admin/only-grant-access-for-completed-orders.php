<?php // only copy this line if needed

/**
 * Removes membership access for processing orders
 * so access is only granted at when orders are complete
 */
function sv_wc_memberships_remove_processing_access() {

	// make sure Memberships is active first
	if ( function_exists( 'wc_memberships' ) ) {
		remove_action( 'woocommerce_order_status_processing', array( wc_memberships(), 'grant_membership_access' ), 11 );
	}
}
add_action( 'init', 'sv_wc_memberships_remove_processing_access' );
