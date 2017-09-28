<?php // only copy if needed

/**
 * IF USING MEMBERSHIPS 1.7+
 * This snippet is likely not needed, you can set up a plan to grant access at registration
 *
 * However, this shows usage of programmatic membership creation for developers.
 */


/**
 * Programmatically create a user membership
 * Example: automatically grant membership access to a plan at WP user registration
 * Requires Memberships 1.3+
 *
 * @param int $user_id the ID of the newly created user
 */
function sv_wc_memberships_user_membership_at_registration( $user_id ) {

	// bail if Memberships isn't active
	if ( ! function_exists( 'wc_memberships' ) ) {
		return;
	}

	$args = array(
		// Enter the ID (post ID) of the plan to grant at registration
		'plan_id' => 253,
		'user_id' => $user_id,
	);

	// magic!
	wc_memberships_create_user_membership( $args );

	// Optional: get the new membership and add a note so we know how this was registered.
	$user_membership = wc_memberships_get_user_membership( $user_id, $args['plan_id'] );
	$user_membership->add_note( 'Membership access granted automatically from registration.' );
}
add_action( 'user_register', 'sv_wc_memberships_user_membership_at_registration', 15 );
