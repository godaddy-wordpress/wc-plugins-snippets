<?php // only copy this line if needed

/**
 * This snippet will change the pricing label of products with quantity-mode measurement calculators.
 *
 * In the example only "weight" measurement types of simple products are considered. 
 * You can adapt the logic provided by the example to include other measurement types or conditions.
 */

/**
 * Changes the pricing label of quantity-mode Measurement Price Calculator products.
 *
 * @param string $price_html the price HTML computed by Measurement Price Calculator
 * @param \WC_Product $product the WooCommerce product object
 * @param string $pricing_label any custom pricing label as defined in the product data
 */
function sv_wc_measurement_price_calculator_quantity_pricing_label( $price_html, $product, $pricing_label ) {
	
	if ( ! $product || $product->is_type( 'variable' ) || ! class_exists( 'WC_Price_Calculator_Settings', false ) || ! class_exists( 'WC_Price_Calculator_Product', false ) ) {
		return $price_html;
	}
  
	$settings = new \WC_Price_Calculator_Settings( $product );
	
	if ( $settings->is_quantity_calculator_enabled() ) {
		
		$measurement = \WC_Price_Calculator_Product::get_product_measurement( $product, $settings );
		
		if ( 'weight' === $measurement->get_type() ) {
			
			$price  = wc_price( $product->get_price() );
			$weight = $product->get_weight();
			$unit   = $measurement->get_unit();
			
			// e.g. "$1.00 per 100g"
			$price_html = "{$price} per {$weight}{$unit}";
		}
	}
	
	return $price_html;
}

add_filter( 'wc_measurement_price_calculator_get_price_html', 'sv_wc_measurement_price_calculator_quantity_pricing_label', 10, 3 );
