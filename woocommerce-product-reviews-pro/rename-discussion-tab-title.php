<?php // only copy this line if needed

/**
 * Change the Contributions tab title to "Reviews (%d)"
 *
 * @param string $tab_title The tab title
 * @param string $type The contribution type
 * @param int $count The number of contributions
 * @return string The new tab title
 */
function sv_wc_product_reviews_pro_contribution_type_tab_title( $tab_title, $type, $count ) {
	return sprintf( __( 'Reviews (%d)', 'woocommerce-product-reviews-pro' ), $count );
}
add_filter( 'wc_product_reviews_pro_contribution_type_tab_title', 'sv_wc_product_reviews_pro_contribution_type_tab_title', 10, 3 );
