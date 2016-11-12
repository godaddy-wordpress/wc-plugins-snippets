<?php // only copy if needed

/**
 * Email members created via import with link to set password (uses WP core email)
 *
 * @param \WC_Memberships_User_Membership $user_membership User Membership object
 * @param string $action Either 'create' or 'merge' (update) a User Membership
 */
function sv_wc_memberships_import_notify_new_user( $user_membership, $action ) {

	if ( ! $user_membership->get_user_id() || 'create' !== $action ) {
		return;
	}

	wp_new_user_notification( $user_membership->get_user_id(), null, 'user' );
}
add_action( 'wc_memberships_csv_import_user_membership', 'sv_wc_memberships_import_notify_new_user', 10, 2 );