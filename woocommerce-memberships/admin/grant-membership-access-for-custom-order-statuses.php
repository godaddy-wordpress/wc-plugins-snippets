<?php // only copy this line if needed

/**
 * Membership access is already granted when orders are processing or completed
 * Add membership access for custom order statuses as well
 *
 * Example: grant membership access for "Shipped" and "Invoice Paid" orders during purchase cycle as well
 * Use the appropriate action for your custom order status
 */
function sv_wc_memberships_grant_access_for_custom_order_statuses() {

	// bail if Memberships is not active
	if ( function_exists( 'wc_memberships' ) ) {
		add_action( 'woocommerce_order_status_shipped', array( wc_memberships(), 'grant_membership_access' ), 11 );
		add_action( 'woocommerce_order_status_invoice-paid', array( wc_memberships(), 'grant_membership_access' ), 11 );
	}

}
add_action( 'init', 'sv_wc_memberships_grant_access_for_custom_order_statuses', 15 );


/**
 * Include custom order statuses in the plan "Grant Access" action to
 * create new memberships as well
 *
 * Example: include "Shipped" and "Invoice Paid Orders" in "Grant Access" action for memberships
 * @param array $statuses orders statuses to create memberships for in "Grant access" action
 * @param object $plan the associated membership plan object
 * @return array $statuses the updated array of statuses for which to grant access
 */
function sv_wc_memberships_add_grant_access_order_statuses( $statuses, $plan ) {

	// Grant membership access to "Shipped" and "Invoice Paid" orders as well
	// when "Grant Access" action is used
	$statuses = array_merge( $statuses, array( 'shipped', 'invoice-paid' ) );
	return $statuses;

}
add_filter( 'wc_memberships_grant_access_from_existing_purchase_order_statuses', 'sv_wc_memberships_add_grant_access_order_statuses', 10, 2 );
