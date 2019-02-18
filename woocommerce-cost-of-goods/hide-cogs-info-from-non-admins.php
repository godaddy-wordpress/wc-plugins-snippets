<?php // only copy this line if needed

/**
 * Removes all Cost of Goods information for non-admins.
 * This code will allow you to hide the cost of goods from employees who have
 * access to orders, but the costs will remain visible to administrators.
 */
function sv_wc_cog_hide_costs_from_non_admins() {

	// bail if Cost of Goods is deactivated or if logged in user is an admin
	if ( ! function_exists( 'wc_cog' ) || current_user_can( 'manage_options' )  ) {
		return;
	}

	$admin_instance         = wc_cog()->get_admin_instance();
	$orders_instance        = $admin_instance->get_orders_instance();
	$products_instance      = $admin_instance->get_products_instance();
	$admin_reports_instance = wc_cog()->get_admin_reports_instance();

	// remove COGs settings
	remove_action( 'woocommerce_inventory_settings', array( $admin_instance, 'add_global_settings' ) );

	// remove the  cost of goods column header from the order items
	remove_action( 'woocommerce_admin_order_item_headers', array( $orders_instance, 'add_order_item_cost_column_headers' ) );

	// remove cost of goods value and input field from order items
	remove_action( 'woocommerce_admin_order_item_values', array( $orders_instance, 'add_order_item_cost' ) );

	// remove the order total cost of goods from the order totals section
	remove_action( 'woocommerce_admin_order_totals_after_total', array( $orders_instance, 'show_order_total_cost' ) );

	// don't save cost of goods value when edited
	remove_action( 'woocommerce_saved_order_items', array( $orders_instance, 'maybe_save_order_item_cost' ) );

	// remove cost field from simple products under the 'General' tab
	remove_action( 'woocommerce_product_options_pricing', array( $products_instance, 'add_cost_field_to_simple_product' ) );

	// remove cost field from variable products under the 'General' tab
	remove_action( 'woocommerce_product_options_sku', array( $products_instance, 'add_cost_field_to_variable_product' ) );

	// don't save the cost field for simple products
	remove_action( 'woocommerce_process_product_meta', array( $products_instance, 'save_simple_product_cost' ) );

	// removes the product variation 'Cost' bulk edit action
	remove_action( 'woocommerce_variable_product_bulk_edit_actions', array( $products_instance, 'add_variable_product_bulk_edit_cost_action' ) );

	// don't save variation cost for bulk edit action
	remove_action( 'woocommerce_bulk_edit_variations_default', array( $products_instance, 'variation_bulk_action_variable_cost' ) );

	// remove cost field from variable products under the 'Variations' tab after the shipping class select
	remove_action( 'woocommerce_product_after_variable_attributes', array( $products_instance, 'add_cost_field_to_product_variation' ), 15 );

	// don't save the cost field for variable products
	remove_action( 'woocommerce_save_product_variation', array( $products_instance, 'save_variation_product_cost' ) );

	// don't save the default cost, cost/min/max costs for variable products
	remove_action( 'woocommerce_process_product_meta_variable', array( $products_instance, 'save_variable_product_cost' ), 15 );
	remove_action( 'woocommerce_ajax_save_product_variations',  array( $products_instance, 'save_variable_product_cost' ), 15 );

	// remove Products list cost bulk edit field
	remove_action( 'woocommerce_product_bulk_edit_end', array( $products_instance, 'add_cost_field_bulk_edit' ) );

	// don't save Products List cost bulk edit field
	remove_action( 'woocommerce_product_bulk_edit_save', array( $products_instance, 'save_cost_field_bulk_edit' ) );

	// remove Products list quick edit cost field
	remove_action( 'woocommerce_product_quick_edit_end',  array( $products_instance, 'render_quick_edit_cost_field' ) );
	remove_action( 'manage_product_posts_custom_column',  array( $products_instance, 'add_quick_edit_inline_values' ) );

	// don't save Products list quick edit cost field
	remove_action( 'woocommerce_product_quick_edit_save', array( $products_instance, 'save_quick_edit_cost_field' ) );

	// remove cost field from Bookings products
	remove_action( 'woocommerce_product_options_general_product_data', array( $products_instance, 'add_cost_field_to_booking_product' ) );

	// don't save the cost field for booking products
	remove_action( 'woocommerce_process_product_meta', array( $products_instance, 'save_booking_product_cost' ) );

	// remove the "Cost" column header next to "Price"
	remove_filter( 'manage_edit-product_columns', array( $products_instance, 'product_list_table_cost_column_header' ), 11 );

	// removes the product cost in the product list table
	remove_action( 'manage_product_posts_custom_column', array( $products_instance, 'product_list_table_cost_column' ), 11 );

	// remove reports
	remove_filter( 'woocommerce_admin_reports', array( $admin_reports_instance, 'add_reports' ) );
}
add_action( 'admin_init', 'sv_wc_cog_hide_costs_from_non_admins' );
