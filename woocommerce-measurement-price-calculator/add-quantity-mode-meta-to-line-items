<?php // only copy if needed!

/**
 * Adds quantity mode measurement data to the cart items.
 *
 * @param array $cart_item_data the cart item data
 * @param int $product_id the product being added to the cart
 * @return array updated cart item data
 */
add_filter( 'woocommerce_add_cart_item_data', function( $cart_item_data, $product_id ) {

    $product = wc_get_product( $product_id );

    if ( $product && class_exists( 'WC_Price_Calculator_Settings' ) ) {

        $settings = new \WC_Price_Calculator_Settings( $product );

        foreach ( $settings->get_calculator_measurements() as $measurement ) {

			$name = $measurement->get_name();

            if ( isset( $_POST[ "{$name}_needed" ] ) ) {
                $cart_item_data['_quantity_item_meta_data'][ "{$name}_needed" ] = $_POST[ "{$name}_needed" ];
            }
        }
    }

    return $cart_item_data;

}, 10, 2 );


/**
 * Adds quantity mode cart item data to the order line item
 *
 * @param \WC_Order_Item $item the order item
 * @param string $cart_item_key the cart item key
 * @param array $values the cart item data
 */
add_action( 'woocommerce_checkout_create_order_line_item', function( $item, $cart_item_key, $values ) {

	if ( isset( $values['_quantity_item_meta_data'] ) ) {

        foreach ( $values['_quantity_item_meta_data'] as $name => $value ) {
        	$item->add_meta_data( "_{$name}", $value );
        }
    }

}, 10, 3 );
