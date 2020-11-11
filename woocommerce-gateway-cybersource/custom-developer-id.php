<?php // only copy this line if needed

/**
 * Add a custom developer ID for API requests.
 *
 * Requires Cybersource v2.3.0+
 */
add_filter( 'wc_cybersource_api_developer_id', function() {

	return 'your-developer-id'; // replace with the ID given to you by Cybersource
	
} );
