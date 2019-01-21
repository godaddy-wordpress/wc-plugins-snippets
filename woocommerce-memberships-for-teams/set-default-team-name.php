<?php // only copy if needed!

/**
 * Set a default team name when created if not available.
 *
 * @param \SkyVerge\WooCommerce\Memberships\Teams\Team $team the team that was just created
 */
add_action( 'wc_memberships_for_teams_team_created', function( $team ) {

	$name = $team->get_name();

	// don't make changes if the team already has a name!
	if ( empty( $name ) ) {

		$order   = $team->get_order();
		$company = false;

		// check if this team was purchased
		if ( $order instanceof WC_Order ) {

			// addresses are null if not available
			$billing_company  = $order->get_billing_company();
			$shipping_company = $order->get_shipping_company();
			$company          = $billing_company ?: $shipping_company;
		} 

		// use the company name if possible, and fallback to team ID if not
		wp_update_post( array(
			'ID'         => $team->get_id(),
			'post_title' => $company ?: sprintf( __( 'Team %s', 'woocommerce-memberships-for-teams' ), $team->get_id() ),
		) );
	}
} );