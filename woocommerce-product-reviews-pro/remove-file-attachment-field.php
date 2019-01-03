<?php // only copy this line if needed

/**
 * Removes the file attachment field from the default contribution fields.
 * Customers will still be able to post photos using the URL option.
 *
 * @param array $fields The default contribution fields.
 * @return array The updated contribution fields.
 */
function sv_wc_product_reviews_pro_remove_attachment_file_field( $fields ) {

	unset( $fields['attachment_file'] );

	return $fields;
}
add_filter( 'wc_product_reviews_pro_default_fields', 'sv_wc_product_reviews_pro_remove_attachment_file_field' );
