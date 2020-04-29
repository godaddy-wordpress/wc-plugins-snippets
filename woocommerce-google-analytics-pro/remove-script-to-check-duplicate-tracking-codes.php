<?php // only copy this line if needed

/**
 * Disable the script that checks for duplicate tracking codes in WooCommerce Google Analytics Pro.
 *
 * This is usefull if you know there are no other plugins that integrate with Google Analytics
 * or otherwise want to prevent the script used to check for duplicate tracking codes to be included
 * in your website.
 *
 * Requires at least v1.8.11 of WooCommerce Google Analytics Pro
 */
add_filter( 'wc_google_analytics_pro_should_check_for_duplicate_tracking_codes', '__return_false' );
