<?php // only copy if needed

/**
 * Include specific roles in the customer export instead of all non-employees
 * REQUIRES WP 4.4+
 *
 * Please note that guest customers will continue to be included in the customer
 * export.
 *
 * @param array $query_args the arguments for the get_users query
 * @return array
 */
function sv_wc_csv_export_add_roles_to_customer_export( $query_args ) {

	// make sure our snippet is entirely controlling the included roles
	unset( $query_args['role'] );
	unset( $query_args['role__not_in'] );

	// add an array of roles to check for; users must have one to be included
	$query_args['role__in'] = array( 'customer', 'wholesale-customer', 'editor' );

	return $query_args;
}
add_filter( 'wc_customer_order_csv_export_user_query_args', 'sv_wc_csv_export_add_roles_to_customer_export' );
