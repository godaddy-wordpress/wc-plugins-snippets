<?php
/**
 * Grants membership access with subscription purchase BUT 
 * decouples membership changes from subscription changes
 *
 * Requires Memberships v1.5+
 *
 * @param bool $joined true if membership is coupled to a subscription
 * @param int $plan_id the user membership's membership plan ID
 * @returm bool $joined
 */
function sv_wc_memberships_decouple_membership_from_sub( $joined, $plan_id ) {

	// Use membership plan ID to decouple from access-granting subscriptions
	if ( 922 === $plan_id ) {
		$joined = false;
	}
	
	return $joined;
}
add_filter( 'wc_memberships_plan_grants_access_while_subscription_active', 'sv_wc_memberships_decouple_membership_from_sub', 10, 2 );