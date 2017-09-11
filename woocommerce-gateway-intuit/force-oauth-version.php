<?php // only copy if needed!

/**
 * Depending on when your developer account was created vs when the plugin was configured,
 *  you may need to adjust the OAuth version the plugin uses.
 *
 *  - If your Intuit account uses "Consumer key", you need OAuth 1.0
 *  - If your Intuit account uses "Client ID", you need OAuth 2.0
 *
 *  You can use this filter to force a specific version if the plugin settings don't 
 *   match your account.
 */


/**
 * Adjust the OAuth version used for Intuit Payments.
 *
 * @param string $version the OAuth version number
 * @return string updated version
 */
function sv_wc_intuit_payments_set_oauth_version( $version ) {
    return '1.0';
}
add_filter( 'wc_intuit_payments_oauth_version', 'sv_wc_intuit_payments_set_oauth_version' );