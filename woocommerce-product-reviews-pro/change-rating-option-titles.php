<?php // only copy this line if needed

/**
 * Filter the contribution form fields to change the review rating option titles
 *
 * @param array $fields Associative array of contribution form fields
 * @param string $type The contribution type
 * @return array
 */
function sv_wc_product_reviews_pro_rating_option_titles( $fields, $type ) {

	if ( 'review' === $type ) {

		$fields['rating']['options'] = array(
			'5' => __( 'Great!', 'custom-text-domain' ),
			'4' => __( 'Good', 'custom-text-domain' ),
			'3' => __( 'Average', 'custom-text-domain' ),
			'2' => __( 'Ok', 'custom-text-domain' ),
			'1' => __( 'Not satisfied', 'custom-text-domain' ),
		);
	}

	return $fields;
}
add_filter( 'wc_product_reviews_pro_contribution_type_fields', 'sv_wc_product_reviews_pro_rating_option_titles', 10, 2 );
