<?php // only copy this line if needed!


/**
 * Update cancelled membership start date to now.
 *
 * @param \WC_Memberships_Membership_Plan $membership_plan the plan that user was granted access to
 * @param array $args array of User Membership arguments {
 *     @type int $user_id the user ID the membership is assigned to
 *     @type int $user_membership_id the user membership ID being saved
 *     @type bool $is_update whether this is a post update or a newly created membership
 * }
 */
add_action( 'wc_memberships_user_membership_created', function( $plan, $details ) {

	$membership = wc_memberships_get_user_membership( $details['user_membership_id'] );

	// if we're updating something that was cancelled before...
	if ( $details['is_update'] && $membership->get_cancelled_date() ) {

		// set start date to now
		$membership->set_start_date();
	}

}, 10, 2 );
