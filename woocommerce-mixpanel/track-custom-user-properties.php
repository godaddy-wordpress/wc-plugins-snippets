<?php // only copy this line if needed

if ( ! function_exists( 'sv_wc_mixpanel_track_custom_user_property' ) ) {

	/**
	 * Track custom user properties via the Mixpanel API (pseudo code)
	 *
	 * * Placeholders:
	 * * `hook_to_trigger_event_on`: replace with the hook you would like this event to trigger on; eg: `woocommerce_add_to_cart`
	 * * $properties array: replace with an array of custom property names and values in the `'Property Name' => 'Property Value'` format
	 *
	 * @param string $html the checkbox field html
	 * @param object $form the payment form object
	 * @return string $html the updated checkbox field html
	 */
	function sv_wc_mixpanel_track_custom_user_property() {

		if ( ! function_exists( 'wc_mixpanel' ) ) {
			return;
		}

		$properties = array(
			'Property Name' => 'Property Value',
		);

		wc_mixpanel()->get_integration()->custom_user_properties_api( $properties );
	}

	add_action( 'hook_to_trigger_event_on', 'sv_wc_mixpanel_track_custom_user_property', 10, 4 );
}


if ( ! function_exists( 'sv_wc_mixpanel_renewed_subscription' ) ) {

	/**
	 * Track custom user properties via the Mixpanel API
	 *
	 * This example illustrates how to add/update the "Last Subscription Billing Amount"
	 * user property when a subscription is renewed.
	 *
	 * @param \WC_Order  $renewal_order the checkbox field html
	 * @param \WC_Order  $original_order the payment form object
	 * @param int        $product_id the payment form object
	 * @param \WC_Order  $new_order_role the payment form object
	 */
	function sv_wc_mixpanel_renewed_subscription( $renewal_order, $original_order, $product_id, $new_order_role ) {

		if ( ! function_exists( 'wc_mixpanel' ) ) {
			return;
		}

		$properties = array(
			'Last Subscription Billing Amount' => $renewal_order->get_total(),
		);

		wc_mixpanel()->get_integration()->custom_user_properties_api( $properties, $renewal_order->user_id );
	}

	add_action( 'woocommerce_subscriptions_renewal_order_created', 'sv_wc_mixpanel_renewed_subscription', 10, 4 );
}
