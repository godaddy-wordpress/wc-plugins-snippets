<?php // only copy this line if needed

/**
 * Remove post types from the membership plan restriction options
 * Example: remove Sensei Messages from post types that can be restricted
 *
 * @param array $blacklist the array of post types to exclude from restriction options
 * @return array $blacklist the updated array of post types to exclude
 */
function sv_wc_memberships_add_post_type_to_blacklist( $blacklist ) {

	$blacklist[] = 'sensei_message';
	return $blacklist;
}
add_filter( 'wc_memberships_content_restriction_excluded_post_types', 'sv_wc_memberships_add_post_type_to_blacklist' );
