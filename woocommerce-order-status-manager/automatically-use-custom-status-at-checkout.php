<?php // only copy this line if needed

/**
 * Order status will automatically change to the custom status upon checkout.
 *
 * @param string $status_slug the slug for the order status
 * @return string a paid status of order completed
 */

function sv_wc_order_status_manager_payment_complete_order_status( $status_slug ) {
	return 'custom-status-slug'; // Change to the slug for your custom status
}
add_action( 'woocommerce_payment_complete_order_status', 'sv_wc_order_status_manager_payment_complete_order_status' );