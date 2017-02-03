<?php // only copy if needed

/**
 * There are a couple examples in this file of how to adjust "My Content" queried posts.
 *
 * Please be aware of this if copying any of these snippets to a production site!
 */


/**
 * Sorts posts in "My Content" by date from oldest to newests instead of newest first (default).
 *
 * @param array $query_args args for retrieving membership content
 * @param string $type Type of request: 'content_restriction', 'product_restriction', 'purchasing_discount'
 */
function sv_wc_memberships_sort_my_content( $query_args, $type ) {

	// bail if we're not looking at "My Content"
	if ( 'content_restriction' !== $type ) {
		return $query_args;
	}

	$query_args['order']   = 'ASC';
	$query_args['orderby'] = 'date';

	return $query_args;
}
add_filter( 'wc_memberships_get_restricted_posts_query_args', 'sv_wc_memberships_sort_my_content', 10, 2 );


/**
 * Only includes posts and pages in "My Content" section, allowing other post types
 *  to be output in custom sections.
 *
 * @param array $query_args args for retrieving membership content
 * @param string $type Type of request: 'content_restriction', 'product_restriction', 'purchasing_discount'
 */
function sv_wc_memberships_adjust_my_content_query( $query_args, $type ) {

	// bail if we're not looking at "My Content"
	if ( 'content_restriction' !== $type ) {
		return $query_args;
	}

	$query_args['post_type'] = array( 'post', 'page' );
	return $query_args;
}
add_filter( 'wc_memberships_get_restricted_posts_query_args', 'sv_wc_memberships_adjust_my_content_query', 10, 2 );
