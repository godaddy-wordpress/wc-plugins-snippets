<?php // only copy if required!

/**
 * Restrict Advanced Custom Fields values based on whether the post is restricted
 * within WooCommerce Memberships and if current user has access to the post.
 *
 * @param mixed $value the ACF field value
 * @param mixed $post_id the post ID
 * @return mixed the updated message text
 */
function wc_memberships_hide_acf_fields( $value, $post_id ) {

	if ( ! function_exists( 'wc_memberships' ) ) {
		return $value;
	}

	// check if the user has access to the post.
	if ( wc_memberships_is_post_content_restricted( $post_id ) && ! current_user_can( 'wc_memberships_view_restricted_post_content', $post_id ) ) {
		$value = '';
	}

	// return
	return $value;
}
add_filter( 'acf/format_value', 'wc_memberships_hide_acf_fields', 10, 2 );
