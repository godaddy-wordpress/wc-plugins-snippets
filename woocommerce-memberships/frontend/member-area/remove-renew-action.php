<?php // only copy this line if needed

/**
 * Remove the "Renew" action for members from the "My Memberships" table
 *
 * @param array $actions the array of membership action links
 * @param \WC_Memberships_User_Membership $user_membership User Membership object
 * @return array $actions the updated array of actions
 */

function sv_wc_memberships_edit_my_memberships_actions( $actions, $user_membership ) {

	// we could check the plan slug if you only want to unset this for certain memberships
	// if ( 'silver' !== $user_membership->get_plan()->get_slug() ) {
	//	return $actions;
	// }

	unset( $actions['renew'] );
	return $actions;
}
add_filter( 'wc_memberships_members_area_my-memberships_actions', 'sv_wc_memberships_edit_my_memberships_actions', 10, 2 );
