<?php // only copy if needed
/**
 * Adds the ability to export only orders that have at least one refund associated with them.
 * Will respect other filters, such as products / categories by simply adding a post__in query param
 *  for the order IDs that have refunds.
 */


/**
 * Add option to export orders with refunds only.
 *
 * @param string[] $options Associative array of options.
 * @return string[] updated options
 */
function sv_wc_csv_export_add_refund_options( $options ) {

	$new_options = array();
	$refunds = array(
		'name'     => __( 'Refunds', 'textdomain' ),
		'id'       => 'refunds',
		'type'     => 'select',
		'class'    => 'wc-enhanced-select js-export-type-field show_if_orders',
		'desc_tip' => __( 'Determine whether to export all orders or those with at least 1 refund.', 'textdomain' ),
		'options'  => array(
			'all'          => __( 'Include all orders', 'textdomain' ),
			'only_refunds' => __( 'Only include orders with refunds', 'textdomain' ),
		),
		'default'  => 'all',
	);

	// add our new refunds option *before* order statuses
	foreach ( $options as $key => $option) {

		if ( 'statuses' === $key ) {
			$new_options['refunds'] = $refunds;
		}

		$new_options[$key] = $option;
	}

	return $new_options;
}
add_filter( 'wc_customer_order_export_options', 'sv_wc_csv_export_add_refund_options' );


/**
 * Export orders with at least 1 associated refund.
 *
 * @param string[] $query_args Array of arguments for WP_Query.
 * @param string $export_type Either 'orders' or 'customers.
 * @param string $output_type Either 'csv' or 'xml.
 * @return string[] updated WP_Query args
 */
function sv_wc_csv_export_only_orders_with_refunds( $query_args, $export_type, $output_type ) {

	// Optionally filter only XML or CSV outputs with $output_type
	if ( 'orders' === $export_type && 'only_refunds' === $_POST['export_query']['refunds'] ) {

		// we don't need the refund's ID, just order ID
		$refund_order_ids = array_values( sv_get_wc_orders_with_refunds() );

		if ( ! empty( $refund_order_ids ) ) {
			$query_args['post__in'] = isset( $query_args['post__in'] ) ? array_merge( (array) $query_args['post__in'], $refund_order_ids ) : $refund_order_ids;
		} else {
			$query_args['post__in'] = array(0);
		}
	}

	return $query_args;
}
add_filter( 'wc_customer_order_export_query_args', 'sv_wc_csv_export_only_orders_with_refunds', 5, 3 );


if ( ! function_exists( 'sv_get_wc_orders_with_refunds' ) ) :

	/**
	 * Returns an array of order IDs that have a refund associated with the order
	 *
	 * @return array $refunded_order_ids formatted 'refund_id' => 'order_id'
	 */
	function sv_get_wc_orders_with_refunds() {

		$query_args = array(
			'fields'         => 'id=>parent',
			'post_type'      => 'shop_order_refund',
			'post_status'    => 'any',
			'posts_per_page' => 999999999999,
		);

		return array_unique( get_posts( $query_args ) );
	}

endif;
