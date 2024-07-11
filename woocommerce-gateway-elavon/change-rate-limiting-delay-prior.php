<?php // only copy this line if needed

/**
 * Changes the rate limit delay 
 * Prior to WC 7.2.0
 **/

add_filter('woocommerce_elavon_rate_limit_delay', function($delay) {
	return 15; // number of seconds in between requests
});