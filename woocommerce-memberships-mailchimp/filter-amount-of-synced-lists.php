<?php // only copy if needed!

/**
 * Adds the "count" parameter to the mailchimp API request.
 *
 * @param array $params associative array of request parameters
 * @return array updated params
 */
function sv_wc_memberships_mailchimp_api_request_params( $params ) {

	$params['count'] = 50;

	return $params;
}
add_filter( 'wc_memberships_mailchimp_api_request_params', 'sv_wc_memberships_mailchimp_api_request_params', 10 );
