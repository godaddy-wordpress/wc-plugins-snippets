<?php // only copy this line if needed

/**
 * Remove the "Cancel" action for members from the "Membership Details" table
 * Memberships will have to be cancelled manually by a shop admin
 *
 * @param array $actions the array of membership action links
 * @return array $actions the updated array of actions
 */

function sv_wc_memberships_remove_cancel_button( $actions ) {
    
	unset( $actions['cancel'] );
    
	return $actions;
}
add_filter( 'wc_memberships_members_area_my-membership-details_actions', 'sv_wc_memberships_remove_cancel_button' );


/**
 * Remove the "Cancel" action for members from the "My Memberships" table
 * Memberships will have to be cancelled manually by a shop admin
 *
 * @param array $actions the array of membership action links
 * @return array $actions the updated array of actions
 */

function sv_wc_edit_my_memberships_actions( $actions ) {
    
	unset( $actions['cancel'] );
    
	return $actions;
}
add_filter( 'wc_memberships_members_area_my-memberships_actions', 'sv_wc_edit_my_memberships_actions' );