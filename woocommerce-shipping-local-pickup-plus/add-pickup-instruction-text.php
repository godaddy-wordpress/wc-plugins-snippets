<?php // only copy if needed

/**
 * Adds a line of instructions before the pickup location selector
 */
function sv_wc_local_pickup_plus_add_instructions() {

	echo '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do...</p>';
}
add_action( 'woocommerce_review_order_before_local_pickup_location', 'sv_wc_local_pickup_plus_add_instructions' );
