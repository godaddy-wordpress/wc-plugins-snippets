<?php // only copy if needed

/**
 * Add additional roles to the customer export
 *
 * @param array $query_args the arguments for the get_users query
 * @return array
 */
function sv_wc_csv_export_add_roles_to_customer_export( $query_args ) {

	// we have to use "role__in" instead so a user isn't required to have *all* roles
	unset( $query_args['role'] );

	// add an array of roles to check for; users must have one to be included
	$query_args['role__in'] = array( 'customer', 'wholesale-customer', 'editor' );

	return $query_args;
}
add_filter( 'wc_customer_order_csv_export_user_query_args', 'sv_wc_csv_export_add_roles_to_customer_export' );