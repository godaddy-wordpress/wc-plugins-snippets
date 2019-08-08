<?php // only copy this line if needed

// Adds support in Elavon for WooCommerce Subscriptions Importer/Exporter plugin
// https://github.com/Prospress/woocommerce-subscriptions-importer-exporter

add_filter( 'woocommerce_subscription_payment_meta', static function( $payment_methods, $subscription = null ) {

	if ( $subscription instanceof \WC_Subscription ) {

		$payment_methods['elavon_converge_credit_card'] = [
			'post_meta' => [
				'_wc_elavon_converge_credit_card_customer_id'   => [
					'value' => get_post_meta( $subscription->get_id(), '_wc_elavon_converge_credit_card_customer_id' , true ),
				],
				'_wc_elavon_converge_credit_card_payment_token' => [
					'value' => get_post_meta( $subscription->get_id(), '_wc_elavon_converge_credit_card_payment_token', true ),
				],
			], 
		];
	}


	return $payment_methods;
	
}, 10, 2 );
