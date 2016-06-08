<?php // only copy this line if needed

/**
 * There are two ways we could prevent purchasing more than one membership:
 *  1. prevent access if the customer already has an active membership
 *  2. prevent access if the customer already has any membership
 *
 * This snippet shows the first scenario.
 */


/**
 * Do not grant membership access to purchasers if they already hold an active membership
 *
 * @param bool $grant_access true if the purchaser should get memberships access from this order
 * @param array $args {
 *	@type int $user_id purchaser's WordPress user ID
 *	@type int $product_id the ID of the access-granting product
 *	@type int $order_id the ID of order for this purchase
 * }
 * @return bool $grant_access
 */
function sv_wc_memberships_limit_membership_count( $grant_access, $args ) {

	// get all active memberships for the purchaser
	// you can remove any of these if you don't want to allow multiples
	// ie you may not want to count complimentary memberships
	$statuses = array(
    		'status' => array( 'active', 'complimentary', 'pending', 'free_trial' ),
	);

	$active_memberships = wc_memberships_get_user_memberships( $args['user_id'], $statuses );

	// if there are any active memberships returned, do not grant access from purchase
	if ( ! empty( $active_memberships ) ) {
		return false;
	}

	return $grant_access;
}
add_filter( 'wc_memberships_grant_access_from_new_purchase', 'sv_wc_memberships_limit_membership_count', 1, 2 );
