<?php // only copy if needed

/**
 * Adjusts the date format for export files from MySQL format to a custom format.
 *
 * REQUIRES v4.3.4+
 *
 * @param string $date the current formatted date
 * @param \WC_Customer_Order_CSV_Export_Generator $generator the generator instance
 * @return string the updated formatted date
 */
function sv_wc_csv_export_format_dates( $date, $generator ) {

	// in WC 3.0+ this date could be null, so leave it alone if not set
	if ( $date ) {

		switch( $generator->export_type ) {

			case 'orders':
				$date = date( 'M j, Y', strtotime( $date ) );
			break;

			case 'customers':
				$date = date( 'Y.m.d', strtotime( $date ) );
			break;
		}
	}

	return $date;
}
add_filter( 'wc_customer_order_csv_export_format_date', 'sv_wc_csv_export_format_dates', 10, 2 );