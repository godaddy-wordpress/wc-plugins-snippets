<?php // only copy if needed

/**
 * Round stock quantities to one decimal place when:
 *  1. reduced for an order via checkout, or
 *  2. using the order "reduce stock" action.
 *
 * @param float $qty the item quantity
 * @return float the rounded quantity
 */
function sv_wc_mpc_round_reduced_stock( $qty ) {

	// round all quantities to 1 decimal place
	return round( $qty, 1 );
}
add_filter( 'woocommerce_reduce_order_stock_quantity', 'sv_wc_mpc_round_reduced_stock' );
add_filter( 'woocommerce_order_item_quantity',         'sv_wc_mpc_round_reduced_stock' );
