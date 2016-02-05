<?php
/**
 * Triggering custom code based on user membership status changes
 * Example: Change user roles based on member status
 */


/**
 * Replaces the Site Member role with the Customer role when a membership becomes inactive
 *
 * @param \WC_User_Membership $user_membership the user's membership
 * @param string $old_status the previous membership status
 * @param string $new_status the new membership status
 */
function sv_wc_memberships_update_user_role_with_membership( $user_membership, $old_status, $new_status ) {

	$user_id = $user_membership->user_id;
	$wp_user = get_userdata( $user_id );
	$roles = $wp_user->roles;
      
	// Bail if the member doesn't currently have the Site Member role or is an active member
	if ( ! in_array( 'site_member', $roles ) || wc_memberships_is_user_active_member( $user_id, $user_membership->plan_id ) ) {
		return;
	}
	
	$wp_user->remove_role( 'site_member' );
	$wp_user->add_role( 'customer' );
}
add_action( 'wc_memberships_user_membership_status_changed', 'sv_wc_memberships_update_user_role_with_membership', 10, 3 );


/**
 * Replaces the Customer role with the Site Member role when a membership is reactivated
 *
 * @param \WC_User_Membership $user_membership the user's membership
 * @param string $old_status the previous membership status
 * @param string $new_status the new membership status
 */
function sv_reactivate_member_role( $user_membership, $old_status, $new_status ) {

	$user_id = $user_membership->user_id;
	$wp_user = get_userdata( $user_id );
	$roles = $wp_user->roles;
      
	// Bail if the member currently has the Site Member role, doesn't have the customer role, or is inactive
	if ( in_array( 'site_member', $roles ) || ! in_array( 'customer', $roles ) || ! wc_memberships_is_user_active_member( $user_id, $user_membership->plan_id ) ) {
		return;
	}
	
	$wp_user->remove_role( 'customer' );
	$wp_user->add_role( 'site_member' );
}
add_action( 'wc_memberships_user_membership_status_changed', 'sv_reactivate_member_role', 10, 3 );