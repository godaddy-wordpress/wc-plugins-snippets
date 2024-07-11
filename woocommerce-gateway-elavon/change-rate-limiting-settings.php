<?php // only copy this line if needed

/**
 * Updates rate limiting settings 
 * Default limit = 3; Default seconds = 45
 * REQUIRES WooCommerce 7.2.0+ 
 **/

add_filter('woocommerce_elavon_rate_limit_options', function($options) {
	$options['limit'] = 3; // max amount of requests allowed in the timeframe (below)
	$options['seconds'] = 45; // number of seconds before rate limits are reset
	
	return $options;
});