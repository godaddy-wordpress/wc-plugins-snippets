<?php // only copy if needed

/**
 * Email members created via import with link to set password (uses WP core email)
 *
 * @param \WC_Memberships_User_Membership $user_membership User Membership object
 * @param string $action Either 'create' or 'merge' (update) a User Membership
 */
function sv_wc_memberships_import_notify_new_user( $user_membership, $action ) {
	global $wp_version;

	if ( ! $user_membership->get_user_id() || 'create' !== $action ) {
		return;
	}

	// the second param here was deprecated in WP 4.3.1
	if ( version_compare( $wp_version, '4.3.1', '>=' ) {
		wp_new_user_notification( $user_membership->get_user_id(), null, 'user' );
	} else {
		wp_new_user_notification( $user_membership->get_user_id() );
	}
}
add_action( 'wc_memberships_csv_import_user_membership', 'sv_wc_memberships_import_notify_new_user', 10, 2 );
