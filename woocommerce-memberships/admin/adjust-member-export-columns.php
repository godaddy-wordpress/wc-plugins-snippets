<?php // only copy if needed

/**
 * Modifies the output of the member CSV Export.
 * Can adjust column headers and include custom export columns
 */


/**
 * Modify the member CSV Export column headers.
 *
 * @param string[] $headers array of column headers as 'key' => 'output_name'
 * @return string[] updated headers
 */
function sv_wc_memberships_modify_member_export_headers( $headers ) {

	// remove any unwanted headers
	unset( $headers['membership_plan_id'], $headers['has_access'] );

	$new_headers = array();

	// add a column header for "member phone"
	foreach ( $headers as $key => $name ) {

		$new_headers[ $key ] = $name;

		// add our new header after the member email
		if ( 'member_email' == $key ) {
			$new_headers['member_phone'] = 'member_phone';
		}
	}

	return $new_headers;
}
add_filter( 'wc_memberships_csv_export_user_memberships_headers', 'sv_wc_memberships_modify_member_export_headers' );


/**
 * Adds data for our new member export column.
 *
 * Note that no column name check is needed since the filter name is scoped to the column key.
 *
 * @param string[] $data export data as 'column' => 'data'
 * @param string $_ unused, the column key
 * @param \WC_Memberships_User_Membership $user_membership User Membership object
 * @return string[] updated data
 */
function sv_wc_memberships_modify_member_export_columns( $data, $_, $user_membership ) {

	// return the data for this column
	return get_user_meta( $user_membership->get_user_id(), 'billing_phone', true );
}
add_filter( 'wc_memberships_csv_export_user_memberships_member_phone_column', 'sv_wc_memberships_modify_member_export_columns', 10, 3 );
