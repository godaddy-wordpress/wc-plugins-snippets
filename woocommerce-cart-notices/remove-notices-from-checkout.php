<?php
/**
 * Removes any Cart Notices from the checkout page
 */
function sv_wc_cart_notices_remove_on_checkout() {

    if ( is_checkout() ) {
        remove_action( 'wp', array( wc_cart_notices(), 'add_cart_notices' ) );
    }
}
add_action( 'wp', 'sv_wc_cart_notices_remove_on_checkout', 5 );
