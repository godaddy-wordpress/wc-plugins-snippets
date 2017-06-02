<?php // only copy if needed

/**
 * Display a FontAwesome lock icon next to the post title if a member does not have access
 *  with WooCommerce Memberships.
 *
 * REQUIRES FontAwesome to be loaded already
 *
 * @param string $post_title the post title
 * @param int $post_id the WordPress post ID
 * @return string the updated title
 */
function sv_wc_memberships_add_post_lock_icon( $title, $post_id ) {

	if ( is_admin() ) {
		return $title;
	}

	// show the lock icon if the post is restricted, or access is delayed
	if (   ! current_user_can( 'wc_memberships_view_delayed_post_content',    $post_id )
	    || ! current_user_can( 'wc_memberships_view_restricted_post_content', $post_id ) ) {

		$title = "<i class='fa fa-lock' aria-hidden='true'></i> {$title}";
	}

	return $title;
}
add_filter( 'the_title', 'sv_wc_memberships_add_post_lock_icon', 10, 2 );