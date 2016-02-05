<?php
/**
 * Export each order individually when paid
 *
 * @param int $order_id the ID of the order being exported
 */
function sv_wc_csv_export_export_order_on_payment( $order_id ) {

	$export = new WC_Customer_Order_CSV_Export_Handler( $order_id );

	// for FTP
	$export->upload();

	// uncomment for HTTP POST
	// $export->http_post();
	
}
add_action( 'woocommerce_payment_complete', 'sv_wc_csv_export_export_order_on_payment' );