<?php // only copy this line if needed

/**
 * Resolves a compatibility issue between Memberships and Facet WP.
 *
 * @param bool $is_main_query
 * @param \WP_Query $query
 * @return bool
 */
function sv_memberships_facetwp_compatibility( $is_main_query, $query ) {

	if ( 'wc_user_membership' == $query->get( 'post_type' ) ) {
		$is_main_query = false;
	}

	return $is_main_query;
}
add_filter( 'facetwp_is_main_query', 'sv_memberships_facetwp_compatibility' , 10, 2 );
