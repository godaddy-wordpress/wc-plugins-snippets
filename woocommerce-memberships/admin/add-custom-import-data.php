<?php // only copy if needed

/**
 * Import a custom column with member imports, then use it to add user or membership data.
 */


/**
 * Add a custom column to the membership import data.
 *
 * @param array $import_data import data
 * @param string $action either 'create' or 'merge' (update) a user membership
 * @param array $columns CSV columns raw data
 * @param array $row CSV row raw data
 * @return array updated import data
 */
function sv_wc_memberships_modify_import_data( $import_data, $action, $columns, $row ) {

	if ( is_array( $row_data ) ) {
		$import_data['company'] = isset( $columns['company'] ) && ! empty( $row[ $columns['company'] ] ) ? $row[ $columns['company'] ] : '';
	}
	
	return $import_data;
}
add_filter( 'wc_memberships_csv_import_user_memberships_data', 'sv_wc_memberships_modify_import_data', 10, 4 );


/**
 * Use import data to take action on member import.
 *
 * @param \WC_Memberships_User_Membership $user_membership user membership object
 * @param string $action either 'create' or 'merge' (update) a user membership
 * @param array $import_data import data
 */
function sv_wc_memberships_use_import_data( $user_membership, $action, $import_data ) {

	if ( ! $user_membership instanceof \WC_Memberships_User_Membership ) {
		return;
	}

	
	if ( isset( $import_data['company'] ) ) {
		
		if ( ! empty( $import_data['company'] ) && is_string( $import_data['company'] ) {
			
			// imports the data passed from wc_memberships_csv_import_user_memberships_data filter as a membership note, in this example...
			$user_membership->add_note( sprintf( __( 'Member imported for company %s.', 'my-textdomain' ), $import_data['company'] ) );
		
			// ...but you can also set a custom meta data on the membership itself, perhaps if you intend to use it in further customizations
			update_post_meta( $user_membership->get_id(), '_member_company', $import_data['company'] );
			
		} elseif ( 'merge' === $action ) {
			
			// you can also use the current callback to delete existing data on the membership, if necessary
			delete_post_meta( $user_membership->get_id(), '_member_company' );
		}		
	}
	
	// optional: delete existing data if received import is empty
	if ( 'merge' === $action 
	
	// optional: migrate data stored elsewhere into the membership (a user meta associated to the user of this membership, for example)
	if ( $user_phone = get_user_meta( $user_membership->get_id(), '_user_phone', true ) ) {
		update_post_meta( $user_membership->get_id(), '_member_phone', $user_phone );
	}
	
	// optional: set data on the membership conditionally (a unique member number, for example)
	if ( 'create' === $action ) {
		update_post_meta( $user_membership->get_id(), '_member_number', uniqid( '', false ) );
	}
	
}
add_action( 'wc_memberships_csv_import_user_membership', 'sv_wc_memberships_use_import_data', 10, 3 );
