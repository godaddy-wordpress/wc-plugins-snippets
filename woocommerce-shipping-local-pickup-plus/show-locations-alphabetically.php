<?php
/**
 * Sort pickup locations alphabetically when shown to customers
 */
 

/**
 * Helper sorting function
 * Returns an alphabetized list of what's passed in.
 */
function wc_lpp_sort_locations( $a, $b ) {
	return strcmp( $a['company'], $b['company'] );
}


/**
 * Sorts Local Pickup Plus locations alphabetically
 *
 * @param array $locations the array of available pickup locations
 * @return array $locations the sorted location array
 */
function sv_wc_local_pickup_plus_alphabetize_locations( $locations ) {

	usort( $locations, 'wc_lpp_sort_locations' );
	return $locations;

}
add_filter( 'option_woocommerce_pickup_locations', 'sv_wc_local_pickup_plus_alphabetize_locations' );