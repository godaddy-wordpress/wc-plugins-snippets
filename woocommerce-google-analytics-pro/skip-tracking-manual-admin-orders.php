<?php // only copy if needed

/**
 * REQUIRES WOOCOMMERCE 3.0+
 */

/**
 * Do not track orders created via the WooCommerce admin in Google Analytics.
 *
 * @param bool $do_not_track true if orders should not be tracked; default: false
 * @param int $order_id
 * @return bool
 */
function sv_wc_google_analytics_skip_manual_order_tracking( $do_not_track, $order_id ) {

	$order = wc_get_order( $order_id );

	if ( 'admin' === $order->get_created_via() ) {
		$do_not_track = true;
	}

	return $do_not_track;
}
add_filter( 'wc_google_analytics_pro_do_not_track_completed_purchase', 'sv_wc_google_analytics_skip_manual_order_tracking', 10, 2 );
