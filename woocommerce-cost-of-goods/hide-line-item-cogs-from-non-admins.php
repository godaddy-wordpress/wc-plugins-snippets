<?php // only copy this line if needed

/**
 * Removes the Cost of Goods column from the order line items table for non-admins.
 * This code will allow you to hide the cost of goods from employees who have
 * access to orders, but the costs will remain visible to administrators.
 */
function sv_wc_cog_hide_line_item_cogs_from_non_admins() {

	// bail if Cost of Goods is deactivated or if logged in user is an admin
	if ( ! function_exists( 'wc_cog' ) || current_user_can( 'manage_options' )  ) {
		return;
	}

	// remove the  cost of goods column header from the order items
	remove_action( 'woocommerce_admin_order_item_headers', array( wc_cog()->get_admin_instance()->get_orders_instance(), 'add_order_item_cost_column_headers' ) );

	// remove cost of goods value and input field from order items
	remove_action( 'woocommerce_admin_order_item_values', array( wc_cog()->get_admin_instance()->get_orders_instance(), 'add_order_item_cost' ) );

	// remove the order total cost of goods from the order totals section
	remove_action( 'woocommerce_admin_order_totals_after_total', array( wc_cog()->get_admin_instance()->get_orders_instance(), 'show_order_total_cost' ) );
}
add_action( 'admin_init', 'sv_wc_cog_hide_line_item_cogs_from_non_admins' );
