<?php // only copy this line if needed!


/**
 * Re-format order numbers when orders are paid or completed.
 *
 * @param $order int|\WC_Order $order WC_Order id or object
 */
function sv_reformat_order_number( $order ) {

	if ( function_exists( 'wc_seq_order_number_pro' ) ) {

		$order        = is_numeric( $order ) ? wc_get_order( (int) $order ) : $order;
		$order_number = $order->get_meta( '_order_number' );
		$reformatted  = (bool) $order->get_meta( '_order_number_reformatted' );

		if ( ! $reformatted ) {

			$formatted_number = wc_seq_order_number_pro()->format_order_number( $order_number, get_option( 'woocommerce_order_number_prefix', "" ), get_option( 'woocommerce_order_number_suffix', "" ), get_option( 'woocommerce_order_number_length', 1 ), $order->get_id() );

			$order->update_meta_data( '_order_number_formatted', $formatted_number );
			$order->update_meta_data( '_order_number_reformatted', true );
			$order->save_meta_data();
		}
	}
}
add_action( 'woocommerce_payment_complete', 'sv_reformat_order_number' );
add_action( 'woocommerce_order_status_on-hold', 'sv_reformat_order_number' );
add_action( 'woocommerce_order_status_completed', 'sv_reformat_order_number' );
