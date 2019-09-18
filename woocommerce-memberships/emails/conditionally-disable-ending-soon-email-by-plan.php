<?php // only copy this line if needed


/**
 * Conditionally disable the Memberships Ending Soon email for a specific plan
 *
 * @param bool $enabled true if the Memberships Ending Soon email is enabled, false otherwise
 * @param mixed/\WC_Memberships_User_Membership $user_membership the user membership
 * @return bool the updated boolean value
 */
function sv_wc_memberships_conditionally_disable_ending_soon_email( $enabled, $user_membership ) {

	if ( $user_membership instanceof WC_Memberships_User_Membership ) {

		$plan = $user_membership->get_plan();

		// disable the email for one specific plan
		if ( 'one-year-membership' === $plan->get_slug() ) {
			$enabled = false;
		}
	}

	return $enabled;
}
add_filter( 'woocommerce_email_enabled_WC_Memberships_User_Membership_Ending_Soon_Email', 'sv_wc_memberships_conditionally_disable_ending_soon_email', 10, 2 );
