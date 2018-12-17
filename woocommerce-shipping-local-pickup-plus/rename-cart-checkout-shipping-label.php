<?php // only copy this line if needed

/**
 * Rename "Shipping" label on Cart and Checkout pages to read "Pickup".
 * This should only be used if your store *does not* provide shipping
 *
 * @param string $locations the package name (unused)
 * @return int $package_index the package index
 */
function sv_wc_local_pickup_plus_change_shipping_package_name( $package_name, $package_index ) {

	return ( ( $package_index + 1 ) > 1 ) ? sprintf( _x( 'Pickup package %d', 'pickup packages', 'your-text-domain' ), ( $package_index + 1 ) ) : _x( 'Pickup', 'pickup packages', 'your-text-domain' );
}
add_filter( 'woocommerce_shipping_package_name', 'sv_wc_local_pickup_plus_change_shipping_package_name', 10, 2 );
