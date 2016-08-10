<?php // only copy this line if needed

/**
 * Adds columns for username and role to the Default customer export format
 */


/**
 * Filters the column headers for the customer export
 *
 * @param array $column_headers {
 *     column headers in key => name format
 * }
 * @return array column headers in column_key => column_name format
 */
function sv_wc_customer_csv_export_column_headers( $column_headers ) {

	$new_headers = array();

	foreach( $column_headers as $key => $value ) {

		$new_headers[ $key ] = $value;

		// Adds new columns after 'customer_id' column
		if ( 'customer_id' === $key ) {

			// Add columns for each piece of data
			$new_headers['username'] = 'username';
		}

		// Adds new column after 'last_name' column
		if ( 'last_name' === $key ) {
			$new_headers['role'] = 'role';

		}
	}

	return $new_headers;
}
add_filter( 'wc_customer_order_csv_export_customer_headers', 'sv_wc_customer_csv_export_column_headers' );


/**
 * Filters the individual row data for the customer export
 *
 * @param array $customer_data {
 *     order data in key => value format
 *     to modify the row data, ensure the key matches any of the header keys and set your own value
 * }
 * @param \WP_User $user WP User object
 * @return array customer data in the format key => content
 */
function sv_wc_customer_csv_export_customer_row( $customer_data, $user ) {

	$username = '';
	$role     = '';

	// Only add data for non-guests
	if ( 0 !== $user->ID ) {

		$username = $user->user_login;
		$_roles   = $user->roles;
		$role     = implode( ",", $_roles );
	}

	return array_merge( array( 'role' => $role, 'username' => $username ), $customer_data );
}
add_filter( 'wc_customer_order_csv_export_customer_row', 'sv_wc_customer_csv_export_customer_row', 10, 2 );
