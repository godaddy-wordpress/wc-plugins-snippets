<?php // only copy this line if needed

/**
 * Change the "View" link to the Member area from "My Memberships"
 * Use the "My Products" section instead of "My Content"
 *
 * @param array $default_actions the default actions for the member area
 * @param \WC_Memberships_User_Membership the current user's membership
 * @param obj $object the post or product object (if relevant)
 * @return array $default_actions the updated array of actions
 */
function sv_wc_memberships_change_members_area_view_link( $default_actions, $user_membership, $object ) {

	$members_area = $user_membership->get_plan()->get_members_area_sections();

	// let's make our keys = values so we don't need to know array position & can use section id below
	$members_area = array_combine( $members_area, $members_area );

	// link to the "My Products" section from the "My Memberships" table instead of "My Content"
	$default_actions['view']['url'] = wc_memberships_get_members_area_url( $user_membership->get_plan_id(), $members_area['my-membership-products'] );

	return $default_actions;

}
add_filter( 'wc_memberships_members_area_my-memberships_actions', 'sv_wc_memberships_change_members_area_view_link', 10, 3 );
