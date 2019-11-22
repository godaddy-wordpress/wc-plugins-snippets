<?php // only copy this line if needed

/**
 * Convert to comparing the start and end date filters with the orderpaid date
 * when orders are exported to CSV from the bulk export page.
 *
 * @param array $query_args the original order query args
 * @return array the updated order query args
 */
function sv_wc_customer_order_csv_export_query_args_use_paid_date( $query_args ) {

	if ( isset( $_POST['export_query'] ) ) {

		$query = $_POST['export_query'];

		// remove date query
		unset( $query_args['date_query'] );

		// add meta query arg if not set
		if ( ! isset( $query_args['meta_query'] ) ) {
			$query_args['meta_query'] = array();
		}

		// add meta query comparing value of _date_paid key
		$query_args['meta_query'][] = array(
			'relation' => 'AND',
			array(
				'key'     => '_date_paid',
				'value'   => empty( $query['start_date'] ) ? 0 : strtotime( $query['start_date'] . ' 00:00 ' . get_option( 'timezone_string' ) ),
				'compare' => '>=',
				'type'    => 'NUMERIC',
			),
			array(
				'key'     => '_date_paid',
				'value'   => empty( $query['end_date'] ) ? current_time( 'timestamp' ) : strtotime( $query['end_date'] . ' 23:59:59.99 ' . get_option( 'timezone_string' ) ),
				'compare' => '<=',
				'type'    => 'NUMERIC',
			),
		);
	}

	return $query_args;
}
add_filter( 'wc_customer_order_csv_export_query_args', 'sv_wc_customer_order_csv_export_query_args_use_paid_date', 100 );
