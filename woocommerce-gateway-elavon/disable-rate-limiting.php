<?php // only copy this line if needed

/**
 * Disables rate limiting
 * REQUIRES WooCommerce 7.2.0+ 
 **/

add_filter('woocommerce_elavon_rate_limit_options', function($options) {
	$options['enabled'] = false;
	
	return $options;
});