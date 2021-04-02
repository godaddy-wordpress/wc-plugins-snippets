<?php // only copy this line if needed


/**
 * Swap the credentials used by Elavon Converge plugin based on the order currency
 *
 * @param array $data the request data
 * @param \WC_Elavon_Converge_API_Request $request the request object
 * @return array the updated request data
 */
function sv_wc_elavon_swap_auth_data( $request_data, $request ) {

	$auth_data = [];
	
	if ( is_callable( [ $request, 'get_order' ] ) && $request->get_order() instanceof WC_Order && $request->get_order()->get_currency() ) {

		switch ( $request->get_order()->get_currency() ) {

			case 'USD':
				$auth_data = [
					'ssl_merchant_id' => 'USD Merchant ID here',
					'ssl_user_id'     => 'USD User ID here',
					'ssl_pin'         => 'USD SSL Pin',
				];
			break;

			case 'CAD':
				$auth_data = [
					'ssl_merchant_id' => 'CAD Merchant ID here',
					'ssl_user_id'     => 'CAD User ID here',
					'ssl_pin'         => 'CAD SSL Pin',
				];
			break;
		}
	}

	return array_merge( $request_data, $auth_data );
}
add_filter( 'wc_elavon_converge_credit_card_request_data', 'sv_wc_elavon_swap_auth_data', 10, 2 );
