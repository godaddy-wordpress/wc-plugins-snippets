<?php // only copy if needed!

/**
 * Add a product short description voucher field.
 *
 * @param array $fields associative array of voucher fields
 * @return array updated fields
 */
function sv_wc_pdf_vouchers_add_voucher_fields( $fields ) {

	$new_fields = [];

	foreach ( $fields as $key => $field ) {

		$new_fields[ $key ] = $field;

		if ( 'product_name' === $key ) {
			$new_fields['product_excerpt'] = [
				'data_type' => 'property',
				'label'     => __( 'Product Short Description', 'my-plugin' ),
			];
		}
	}

	return $new_fields;
}
add_filter( 'wc_pdf_product_vouchers_voucher_fields', 'sv_wc_pdf_vouchers_add_voucher_fields' );


/**
 * Return a custom value for the short description field.
 *
 * @param mixed $value the field value
 * @return mixed the updated field value
 */
function sv_wc_pdf_vouchers_product_excerpt( $value, $voucher ) {

	if ( $product = $voucher->get_product() ) {
		$value = $product->get_short_description();
	}

	return $value;
}
add_filter( 'wc_pdf_product_vouchers_get_product_excerpt', 'sv_wc_pdf_vouchers_product_excerpt', 10, 2 );


/**
 * Format a custom voucher field value for output.
 *
 * @param mixed $value_formatted the formatted field value
 * @return mixed the updated formatted value
 */
function sv_wc_pdf_vouchers_product_excerpt_formatted( $value_formatted ) {
	return wp_strip_all_tags( $value_formatted );
}
add_filter( 'wc_pdf_product_vouchers_get_product_excerpt_formatted', 'sv_wc_pdf_vouchers_product_excerpt_formatted' );

