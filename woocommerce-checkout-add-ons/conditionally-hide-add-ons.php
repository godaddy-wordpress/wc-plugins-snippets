<?php
/**
 * Conditionally show gift add-ons only if shipping address differs from billing
 * Note: be careful not to require fields if you do this!
 *   they may be hidden and the customer can't complete checkout
 */
function sv_wc_checkout_add_ons_conditionally_show_gift_add_on() {

    wc_enqueue_js( "
        $( 'input[name=ship_to_different_address]' ).change( function () {

            if ( $( this ).is( ':checked' ) ) {

                // show the gift checkout add-on -- replace '2' with the id of your add-on
                $( '#wc_checkout_add_ons_2_field' ).show();

            } else {

                // hide the gift checkout add-on -- replace '2' with the id of your add-on
                $( '#wc_checkout_add_ons_2_field' ).hide();

            }

        } ).change();
    " );
}
add_action( 'wp_enqueue_scripts', 'sv_wc_checkout_add_ons_conditionally_show_gift_add_on' );