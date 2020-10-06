<?php // only copy this line if needed

/**
 * Change feed file generation interval
 * ex: every 24 hours
 *
 * NOTE: to reset schedule fully, Product Sync must be
 * disabled, saved, and re-enabled to allow the new interval
 * settings to take effect
 */
 
 add_filter( 'wc_facebook_feed_generation_interval', function(){ return HOUR_IN_SECONDS * 24; } );