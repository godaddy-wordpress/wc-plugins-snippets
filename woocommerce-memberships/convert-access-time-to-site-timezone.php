<?php // only copy if needed!

/**
 * Change membership dripping so it starts at midnight in the site timezone instead of UTC.
 *
 * @param int|null $access_time access start timestamp or null if no access should be granted
 * @param array $args array of arguments {
 *   @type string $content_type content type: one of 'post_type' or 'taxonomy'
 *   @type string $content_type_name content type name: a valid post type or taxonomy name
 *   @type string|int $object_id optional post or taxonomy term ID or slug
 *   @type string $access_type the access type (for products: view or purchase)
 * }
 * @return int new access time
 */
function sv_wc_memberships_start_dripping_in_site_timezone( $access_time, $args ) {

	$offset = get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;
	return $access_time - $offset;
}
add_filter( 'wc_memberships_user_object_access_start_time', 'sv_wc_memberships_start_dripping_in_site_timezone', 10, 2 );