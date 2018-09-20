<?php // only copy if needed!


/**
 * Adds a shortcode to output content only for team owners.
 *
 * @param array $atts shortcode attributes
 * @param string|null $content the shortcode content
 */
function sv_wcm_teams_owner_message_shortcode( $atts, $content = null ) {

	$a = shortcode_atts( array(
		'display' => 'notice',
	), $atts );

	$user_id = get_current_user_id();
	$teams   = wc_memberships_for_teams_get_teams( $user_id, array( 'role' => 'owner' ) );

	// render a message if this user owns any teams
	if ( $content && $teams && ! empty( $teams ) ) {

		ob_start();
		?>
			<div class="woocommerce wcm-teams-owner-message<?php if ( 'notice' === $a['display'] ) echo ' woocommerce-info'; ?>">
				<?php printf( '%1$s%2$s%3$s', 'notice' === $a['display'] ? '' : '<p>', wp_kses_post( do_shortcode( $content ) ), 'notice' === $a['display'] ? '' : '</p>' ); ?>
			</div>
		<?php
		return ob_get_clean();
	}
}
add_shortcode( 'wcm_teams_owner_content', 'sv_wcm_teams_owner_message_shortcode' );
