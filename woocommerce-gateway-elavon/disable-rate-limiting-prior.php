<?php // only copy this line if needed

/**
 * Disables rate limiting
 * Prior to WC 7.2.0
 **/

add_filter('woocommerce_elavon_rate_limit_delay', function($delay) {
	return 0;
});