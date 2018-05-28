<?php // only copy if needed

/**
 * Displays checkout add-ons below terms and conditions
 *
 */

add_filter( 'wc_checkout_add_ons_position', 'sv_custom_checkout_add_on_position' );

function sv_custom_checkout_add_on_position( $position ) {
    return 'woocommerce_checkout_after_terms_and_conditions';
}
