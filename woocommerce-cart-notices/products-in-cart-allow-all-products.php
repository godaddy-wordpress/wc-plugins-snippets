<?php // only copy this line if needed

/**
 * Allow "Products in Cart" notice to apply to all prouducts in the store.
 * This allows you to configure a cart notice when there are *any* products
 * in the cart
 */
add_filter( 'wc_cart_notices_products_notice_all_products', '__return_true' );
