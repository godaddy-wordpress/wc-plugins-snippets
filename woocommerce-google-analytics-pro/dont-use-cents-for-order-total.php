<?php // only copy this line if needed

/**
 * Don't track order totals in cents when tracking purchases.
 *
 * It's important to note that this value will be rounded down to the nearest
 * whole dollar value because Google Analytics doesn't accept decimal values here.
 */
add_filter( 'wc_google_analytics_pro_purchase_event_use_cents' , '__return_false' );
