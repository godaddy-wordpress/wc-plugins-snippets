<?php
/**
 * Move social login buttons on account page from the "login"
 * to the bottom of the "register" form
 */
function sv_wc_social_login_move_register_buttons() {
    if ( function_exists( 'wc_social_login' ) && ! is_admin() ) {
        remove_action( 'woocommerce_login_form_end', array( wc_social_login()->frontend, 'render_social_login_buttons' ) );
        add_action( 'woocommerce_register_form_end', array( wc_social_login()->frontend, 'render_social_login_buttons' ) );
    }
}
add_action( 'init', 'sv_wc_social_login_move_register_buttons' );