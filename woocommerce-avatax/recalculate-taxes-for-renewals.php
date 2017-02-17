<?php // only copy if needed

/**
 * Forces tax recalculation for Subscriptions renewal orders when created.
 *
 * NOTE THAT this snippet can ONLY be used when all Subscriptions gateways support payment total changes!
 * Without this, a change in the tax amount can cause your renewals to fail.
 */


/**
 * Forces taxes to be recalculated on renewal orders from Subscriptions.
 *
 * @param \WC_Order $renewal_order the newly-created renewal order
 * @param int|\WC_Subscription $subscription Post ID of a 'shop_subscription' post, or instance of a WC_Subscription object
 * @return \WC_Order updated renewal order
 */
function sv_wc_avatax_recalculate_renewal_taxes( $renewal_order, $subscription ) {

	if ( function_exists( 'wc_avatax' ) ) {

		wc_avatax()->get_order_handler()->calculate_order_tax( $renewal_order );
	}

	return $renewal_order;
}
add_filter( 'wcs_renewal_order_created', 'sv_wc_avatax_recalculate_renewal_taxes', 20, 2 );