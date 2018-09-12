<?php // only copy this line if needed

/**
 * Disables completed purchase tracking for renewal orders when the renewed
 * subscription event is disabled.
 *
 * @param bool $do_not_track whether to track a completed purchase
 * @param int $order_id the related order ID
 * @return bool whether to track a completed purchase
 */
function sv_wc_google_analytics_pro_maybe_do_not_track_completed_purchase_renewal_order( $do_not_track, $order_id ) {

	if ( '' === wc_google_analytics_pro()->get_integration()->settings['renewed_subscription_event_name'] && ( wcs_order_contains_resubscribe( $order_id ) || wcs_order_contains_renewal( $order_id ) ) ) {
		$do_not_track = true;
	}

	return $do_not_track;
}
add_filter( 'wc_google_analytics_pro_do_not_track_completed_purchase', 'sv_wc_google_analytics_pro_maybe_do_not_track_completed_purchase_renewal_order', 10, 2 );
