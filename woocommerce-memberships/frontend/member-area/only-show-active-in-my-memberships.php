<?php // only copy if needed!


/**
 * Filters the query for user memberships in the account to only include active memberships.
 *
 * @param \WP_Query $query query object
 */
function sv_wc_memberships_filter_my_memberships_list( $query ) {

	if ( 'wc_user_membership' === $query->get( 'post_type' ) && function_exists( 'is_account_page' ) && is_account_page() ) {
		$query->set( 'post_status', array( 'wcm-active', 'wcm-complimentary', 'wcm-pending', 'wcm-free-trial' ) );
	}
}
add_action( 'pre_get_posts', 'sv_wc_memberships_filter_my_memberships_list', 1 );