<?php
/**
 * Add attributes to Checkout Add-ons fields at checkout
 * Example: add maximum character counts, placeholders, and descriptions for add-ons
 *
 * @param array $checkout_fields the fields in the WooCommerce checkout
 * @return array $checkout_fields the updated fields array
 */
function sv_wc_checkout_add_ons_add_attributes( $checkout_fields ) {

	$add_on_id = 3; // change 3 to your add-on id

	// is our checkout add-on a field?
    if ( isset( $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ] ) ) {
    
		// Adds a maximum character length + description to this add on
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['maxlength']   = "300";
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['description']   = "Please add no more than 300 characters.";
    
    }

	// repeat for each add-on
	$add_on_id = 7; // change 7 to your add-on id

    if ( isset( $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ] ) ) {
    
		// Add a maximum length and placeholder
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['maxlength']   = "140";
        $checkout_fields['add_ons'][ 'wc_checkout_add_ons_' . $add_on_id ]['placeholder'] = "My custom placeholder";
        
    }
	return $checkout_fields;
}
add_filter( 'woocommerce_checkout_fields', 'sv_wc_checkout_add_ons_add_attributes', 20 );
