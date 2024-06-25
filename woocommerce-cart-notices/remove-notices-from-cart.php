<?php // only copy this line if needed!


/**
 * Removes any Cart Notices from the cart page, leaving them only at checkout.
 */
function sv_wc_cart_notices_remove_on_cart() {
    if ( is_cart() ) {
        remove_action( 'wp', array( wc_cart_notices(), 'add_cart_notices' ) );
    }
}
add_action( 'wp', 'sv_wc_cart_notices_remove_on_cart', 5 );
