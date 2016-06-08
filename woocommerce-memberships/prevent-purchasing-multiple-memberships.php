<?php // only copy this line if needed

/**
 * There are two ways we could prevent purchasing more than one membership:
 *  1. prevent access if the customer already has an active membership
 *  2. prevent access if the customer already has any membership
 *
 * This snippet shows the second scenario.
 */


/**
 * Do not grant membership access to purchasers if they already hold any membership, regardless of status
 *
 * @param bool $grant_access true if the purchaser should get memberships access from this order
 * @param array $args {
 *	@type int $user_id purchaser's WordPress user ID
 *	@type int $product_id the ID of the access-granting product
 *	@type int $order_id the ID of order for this purchase
 * }
 * @return bool $grant_access
 */
function sv_wc_memberships_limit_to_one_membership( $grant_access, $args ) {

	// get all active memberships for the purchaser, regardless of status
	$memberships = wc_memberships_get_user_memberships( $args['user_id'] );

	// if there are any memberships returned, do not grant access from purchase
	if ( ! empty( $memberships ) ) {
		return false;
	}

	return $grant_access;
}
add_filter( 'wc_memberships_grant_access_from_new_purchase', 'sv_wc_memberships_limit_to_one_membership', 1, 2 );
