<?php // only copy this line if needed

/**
 * Change feed file generation interval
 * ex: every 24 hours
 */
 
 add_filter( 'wc_facebook_feed_generation_interval', function(){ return HOUR_IN_SECONDS * 24; } );