<?php // only copy this line if needed

/**
 * Registers Memberships messages for translation with WPML under the
 * `woocommerce-memberships-messages` domain
 *
 * Requires v1.10.1+ of Memberships
 */
function sv_memberships_wpml_translate_restricted_message( $message ) {

	return apply_filters( 'translate_string', $message, 'woocommerce-memberships-messages', $message );
}
add_filter( 'wc_memberships_restricted_message', 'sv_memberships_wpml_translate_restricted_message' );
