<?php // only copy if needed

/**
 * Adds a link to view a subscription from the "My Memberships" table if a membership is tied to a subscription.
 *
 * @param array $actions the user membership table actions for the membership
 * @param \WC_Memberships_User_Membership $user_membership user membership object
 * @return array updated actions
 */
function sv_wc_memberships_add_view_subscription_action( $actions, $user_membership ) {

	$integration = wc_memberships()->get_integrations_instance()->get_subscriptions_instance();

	if ( $integration->is_membership_linked_to_subscription( $user_membership ) ) {

		$subscription = $integration->get_subscription_from_membership( $user_membership->get_id() );
		
		$actions['view-subscription'] = array(
			'url'  => $subscription->get_view_order_url(),
			'name' => __( 'View Billing', 'my-textdomain' ),
		);
		
		// uncomment this to change the text of the "View" action as well
		// $actions['view']['name'] = __( 'View Perks', 'my-textdomain' );
	}

	return $actions;
}
add_filter( 'wc_memberships_my_account_my_memberships_actions', 'sv_wc_memberships_add_view_subscription_action', 10, 2 );