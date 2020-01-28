<?php // only copy if needed

// Adds a "profit per order" column to the orders list.

/**
 * Adds 'Profit' column header to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $columns
 * @return string[] $new_columns
 */
function sv_wc_cogs_add_order_profit_column_header( $columns ) {

	$new_columns = array();

	foreach ( $columns as $column_name => $column_info ) {

		$new_columns[ $column_name ] = $column_info;

		if ( 'order_total' === $column_name ) {
			$new_columns['order_profit'] = __( 'Profit', 'my-textdomain' );
		}
	}

	return $new_columns;
}
add_filter( 'manage_edit-shop_order_columns', 'sv_wc_cogs_add_order_profit_column_header', 20 );


/**
 * Adds 'Profit' column content to 'Orders' page immediately after 'Total' column.
 *
 * @param string[] $column name of column being displayed
 */
function sv_wc_cogs_add_order_profit_column_content( $column ) {
	global $post;

	if ( 'order_profit' === $column ) {

		$order    = wc_get_order( $post->ID );
		$currency = is_callable( array( $order, 'get_currency' ) ) ? $order->get_currency() : $order->order_currency;
		$profit   = '';
		$cost     = sv_helper_get_order_meta( $order, '_wc_cog_order_total_cost' );
		$total    = (float) $order->get_total();

		// don't check for empty() since cost can be '0'
		if ( '' !== $cost || false !== $cost ) {

			// now we can cast cost since we've ensured it was calculated for the order
			$cost   = (float) $cost;
			$profit = $total - $cost;

			if ( 'yes' === get_option( 'wc_cog_profit_report_exclude_gateway_fees' ) ) {

				foreach ( $order->get_fees() as $item_id => $fee ) {
					$profit -= (float) $fee->get_total();
				}

			}

			if ( 'yes' === get_option( 'wc_cog_profit_report_exclude_taxes' ) ) {
				$profit -= (float) $order->get_total_tax();
			}

			if ( 'yes' === get_option( 'wc_cog_profit_report_exclude_shipping_costs' ) ) {
				$profit -= (float) $order->get_shipping_total();
			}
		}

		echo wc_price( $profit, array( 'currency' => $currency ) );
	}
}
add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );


/**
 * Adjusts the styles for the new 'Profit' column.
 */
function sv_wc_cogs_add_order_profit_column_style() {

	$css = '.widefat .column-order_date, .widefat .column-order_profit { width: 9%; }';
	wp_add_inline_style( 'woocommerce_admin_styles', $css );
}
add_action( 'admin_print_styles', 'sv_wc_cogs_add_order_profit_column_style' );


if ( ! function_exists( 'sv_helper_get_order_meta' ) ) :

	/**
	 * Helper function to get meta for an order.
	 *
	 * @param \WC_Order $order the order object
	 * @param string $key the meta key
	 * @param bool $single whether to get the meta as a single item. Defaults to `true`
	 * @param string $context if 'view' then the value will be filtered
	 * @return mixed the order property
	 */
	function sv_helper_get_order_meta( $order, $key = '', $single = true, $context = 'edit' ) {

		// WooCommerce > 3.0
		if ( defined( 'WC_VERSION' ) && WC_VERSION && version_compare( WC_VERSION, '3.0', '>=' ) ) {

			$value = $order->get_meta( $key, $single, $context );

		} else {

			// have the $order->get_id() check here just in case the WC_VERSION isn't defined correctly
			$order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;
			$value    = get_post_meta( $order_id, $key, $single );
		}

		return $value;
	}

endif;
