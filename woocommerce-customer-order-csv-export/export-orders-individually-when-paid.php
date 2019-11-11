<?php // only copy this line if needed

/**
 * Export each order individually when paid
 *
 * DO NOT USE with WooCommerce Customer/Order/Coupon Export 4.0 or newer.
 *
 * In version 5.0.0 or newer, orders can be exported immediately when paid
 * using an Automated Export.
 *
 * In versions 4.0.0 to 4.8.1, you can configure the plugin to export orders
 * immediately when paid from the WooCommerce > CSV Export > Settings screen.
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
