<?php // only copy this line if needed

/** 
 * Allows admin custom order fields to be accessed by the WooCommerce REST API
 * Modifies fields to stop them from being protected post meta when accessed via the API
 */


/**
 * Helper function to change the protected value if the meta belongs to Admin Custom Order Fields
 *
 * @param bool $protected true if the meta is protected
 * @param string $meta_key the key for the order meta
 * @return bool the updated $protected value
 */
function sv_wc_acof_is_protected_meta( $protected, $meta_key ) {

	if ( 0 === strpos( $meta_key, '_wc_acof_' ) ) {
		$protected = false;
	}

	return $protected;
}


/** 
 * Add our helper method to modify the protected meta when API is loaded
 */
function sv_wc_acof_api_allow_protected_meta() {
	add_filter( 'is_protected_meta', 'sv_wc_acof_is_protected_meta', 10, 2 );
}
add_action( 'woocommerce_api_loaded', 'sv_wc_acof_api_allow_protected_meta' );