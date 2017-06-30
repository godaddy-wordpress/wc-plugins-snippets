<?php // only copy if needed

/**
 * Import a custom column with member imports, then use it to add user or membership data.
 */


/**
 * Add a custom column to the membership import data.
 *
 * @param array $import_data import data
 * @param string $action Either 'create' or 'merge' (update) a user membership; unused
 * @param array $columns CSV columns raw data
 * @param array $row CSV row raw data
 */
function sv_wc_memberships_modify_import_data( $import_data, $_, $columns, $row ) {

	$import_data['company'] = isset( $columns['company'] ) && ! empty( $row[ $columns['company'] ] ) ? $row[ $columns['company'] ] : null;
	return $import_data;
}
add_filter( 'wc_memberships_csv_import_user_memberships_data', 'sv_wc_memberships_modify_import_data', 10, 4 );


/**
 * Use import data to take action on member import.
 *
 * @param \WC_Memberships_User_Membership $user_membership User Membership object
 * @param string $action Either 'create' or 'merge' (update) a user membership; unused
 * @param array $import_data import data
 */
function sv_wc_memberships_use_import_data( $user_membership, $_, $import_data ) {

	if ( isset( $import_data['company'] ) && $import_data['company'] ) {
		$user_membership->add_note( sprintf( __( 'Member imported for company %s.', 'my-textdomain' ), $import_data['company'] ) );
	}
}
add_action( 'wc_memberships_csv_import_user_membership', 'sv_wc_memberships_use_import_data', 10, 3 );