<?php
/**
 * Force all notices to open links in a new tab
 */
function sv_wc_cart_notices_set_target_blank( $notice_html ) {
	$notice_html = str_replace( '<a', '<a target="blank"', $notice_html );
	return $notice_html;
}
add_filter( 'woocommerce_cart_notice_minimum_amount_notice', 'sv_wc_cart_notices_set_target_blank' );
add_filter( 'woocommerce_cart_notice_deadline_notice', 'sv_wc_cart_notices_set_target_blank' );
add_filter( 'woocommerce_cart_notice_referer_notice', 'sv_wc_cart_notices_set_target_blank' );
add_filter( 'woocommerce_cart_notice_products_notice', 'sv_wc_cart_notices_set_target_blank' );
add_filter( 'woocommerce_cart_notice_categories_notice', 'sv_wc_cart_notices_set_target_blank' );