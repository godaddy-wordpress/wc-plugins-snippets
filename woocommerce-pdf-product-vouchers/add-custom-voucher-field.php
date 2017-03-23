<?php // only copy if needed

/**
 * Requires version 3.0+!
 *
 * Custom voucher fields can have a data_type = "property" or "user_input". A property is
 *  static for each voucher, while a user input allows for customer input on the product page.
 *
 * A "property" type field muse be filtered to set its value and formatted value for pdf generation.
 */


/**
 * Add a custom voucher field.
 *
 * @param string[] $fields associative array of voucher fields
 * @return string[] updated fields
 */
function sv_wc_pdf_vouchers_voucher_fields( $fields ) {

	$fields['product_weight'] = array(
		'data_type' => 'property',
		'label'     => __( 'Product Weight', 'my-plugin' ),
	);

	$fields['inc_children'] = array(
		'data_type' => 'user_input',
		'type'      => 'number',
		'label'     => __( 'Children Included', 'my-plugin' ),
	);

	$fields['pickup_name'] = array(
		'data_type' => 'user_input',
		'type'      => 'text',
		'label'     => __( 'People authorized for pickup', 'my-plugin' ),
	);

	return $fields;
}
add_filter( 'wc_pdf_product_vouchers_voucher_fields', 'sv_wc_pdf_vouchers_voucher_fields' );


/**
 * Return a custom value for a property field. By default, the value will be loaded
 *  from voucher post meta ( get_post_meta( $voucher_id, '_' . $field_id, true ) )
 *
 * @param mixed $value the field value
 * @return mixed the updated field value
 */
function sv_wc_pdf_vouchers_product_weight_value( $value, $voucher ) {

	$order   = $voucher->get_order();
	$item    = $voucher->get_order_item();
	$product = $order->get_product_from_item( $item );

	return $product->get_weight();
}
add_filter( 'wc_pdf_product_vouchers_get_product_weight', 'sv_wc_pdf_vouchers_product_weight_value', 10, 2 );


/**
 * Format a custom voucher field value for output.
 *
 * @param mixed $value_formatted the formatted field value
 * @return mixed the updated formatted value
 */
function sv_wc_pdf_vouchers_product_weight_value_formatted( $value_formatted ) {
	return wc_format_decimal( $value_formatted, 2 );
}
add_filter( 'wc_pdf_product_vouchers_get_product_weight_formatted', 'sv_wc_pdf_vouchers_product_weight_value_formatted' );
