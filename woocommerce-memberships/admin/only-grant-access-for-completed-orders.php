<?php // only copy this line if needed

/**
 * Removes membership access for processing orders
 * so access is only granted at when orders are complete
 */
function sv_wc_memberships_remove_processing_access() {

	// make sure Memberships is active first
	if ( function_exists( 'wc_memberships' ) ) {

		remove_action( 'woocommerce_order_status_processing', array( wc_memberships()->get_plans_instance(), 'grant_access_to_membership_from_order' ), 9 );
	}

	// Add support for Teams for Memberships but make sure it is active first
	if ( function_exists( 'wc_memberships_for_teams' ) ) {

		remove_action( 'woocommerce_order_status_processing', array( wc_memberships_for_teams()->get_orders_instance(), 'process_team_actions_for_order' ), 10 );
	}
}
add_action( 'init', 'sv_wc_memberships_remove_processing_access' );
