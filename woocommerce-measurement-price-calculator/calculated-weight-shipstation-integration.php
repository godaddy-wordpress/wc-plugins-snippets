<?php // only copy this line if needed

/**
 * Ensures Measurement Price Calulator products are sent to ShipStation with
 * the correct weight via the WooCommerce ShipStation Integration
 */

/**
 * Filter the product's weight only when the WooCommerce ShipStation API is loaded.
 * This ensures that the `WC_Order::woocommerce_get_product_from_item()` method
 * is not filtered when not needed.
 */
function sv_wc_mpc_shipstation_product_weight() {
	add_filter( 'woocommerce_get_product_from_item', 'sv_wc_mpc_shipstation_get_product_from_item_weight', 10, 3 );
}
add_action( 'woocommerce_api_wc_shipstation',  'sv_wc_mpc_shipstation_product_weight', 9 );

/**
 * Filter the product retruned by `WC_Order::woocommerce_get_product_from_item()`
 * to re-calculate a Measurement Price Calculator product's weight based on the
 * selected measurements. This function ensures that the "Weight" calculator
 * type is handled appropriately as well.
 *
 * @param \WC_Product $product The product.
 * @param array $item The order item.
 * @param \WC_Order $order The order.
 * @return \WC_Product The filtered product
 */
function sv_wc_mpc_shipstation_get_product_from_item_weight( $product, $item, $order ) {

	if ( WC_Price_Calculator_Product::pricing_calculated_weight_enabled( $product ) ) {

		$settings = new WC_Price_Calculator_Settings( $product );

		if ( 'weight' == $settings->get_calculator_type() ) {
			// Now, the weight calculator products have to be handled specially
			// since the customer is actually supplying the weight, but it will
			// be in pricing units which may not be the same as the globally
			// configured WooCommerce Weight Unit expected by other plugins and code

			if ( isset( $item['item_meta']['_measurement_data'][0] ) ) {

				$measurement_data = maybe_unserialize( $item['item_meta']['_measurement_data'][0] );

				if ( isset( $measurement_data['_measurement_needed_unit'] ) && isset( $measurement_data['_measurement_needed'] ) ) {

					$supplied_weight = new WC_Price_Calculator_Measurement(
						$measurement_data['_measurement_needed_unit'],
						$measurement_data['_measurement_needed']
					);

					// set the product weight as supplied by the customer, in WC Weight Units
					$product->weight = $supplied_weight->get_value( get_option( 'woocommerce_weight_unit' ) );
				}
			}

		} elseif ( $product->get_weight() ) {

			if ( isset( $item['item_meta']['_measurement_data'][0] ) ) {

				$measurement_data = maybe_unserialize( $item['item_meta']['_measurement_data'][0] );

				// record the configured weight per unit for future reference
				if ( ! isset( $measurement_data['_weight'] ) ) {
					$measurement_data['_weight'] = $product->get_weight();
				}

				// calculate the product weight = unit weight * total measurement (both will be in the same pricing units so we have say lbs/sq. ft. * sq. ft. = lbs)
				$product->weight = $measurement_data['_weight'] * $measurement_data['_measurement_needed'];
			}
		}
	}

	return $product;
}
