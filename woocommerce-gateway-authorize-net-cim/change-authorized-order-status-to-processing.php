<?php // only copy this line if needed
/**
 * When "Transaction Type" is set to "Authorization", the order status defaults to "on-hold".
 * If you want to change this to "processing" instead, add this snippet.
 *
 * Note that transactions which are held by Authorize.net for fraud review will still be marked as "on-hold".
 *
 */
function wc_auth_net_cim_change_authorized_order_status_to_processing( $order_status, $order, $response ) {
	if ( $response instanceof WC_Authorize_Net_CIM_API_Response ) {
		if ( $response->transaction_approved() && ! $response->transaction_held() ) {
			$order_status = 'processing';
		}
	}
}
add_filter( 'wc_payment_gateway_authorize_net_cim_credit_card_held_order_status', 'wc_auth_net_cim_change_authorized_order_status_to_processing', 10, 3 );
