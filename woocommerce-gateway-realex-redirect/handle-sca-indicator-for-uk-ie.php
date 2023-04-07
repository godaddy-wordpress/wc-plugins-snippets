<?php //only copy this line if needed

/**
 * Add the appropriate SCA indicator to the HPP parameters for UK/IE merchants whose banks do not handle these automatically
 *
 * @param array $params payment form request parameters
 * @return array
 */
add_filter( 'wc_realex_redirect_hpp_params', function( $params ){

    // Require SCA for UK/IE customers
    if( $params[ 'BILLING_CO' ] === 'GB' || $params[ 'BILLING_CO' ] === 'IE' )
    {
        $params[ 'HPP_CHALLENGE_REQUEST_INDICATOR' ] = 'CHALLENGE_MANDATED';
    }

    // Allow issuer to determine preference for all others
    else
    {
        $params[ 'HPP_CHALLENGE_REQUEST_INDICATOR' ] = 'NO_PREFERENCE';
    }

    return $params;
});
