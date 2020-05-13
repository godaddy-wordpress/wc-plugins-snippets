<?php // only copy this line if needed!


/**
 * Adds an expiry message shortcode, show content N days before or after expiry. Only "end" is optional!
 * [wcm_expiry_message plan="plan-slug" start="+10 days" end="+15 days"] (start 10 days after expiry)
 * [wcm_expiry_message plan="plan-slug" start="-10 days" end="+2 days"] (start 10 days before expiry)
 *
 * @param array $atts shortcode arguments
 * @param null|string $content the shortcode content
 * @return string formatted discount HTML
 */
add_shortcode( 'wcm_expiry_message', function( $atts, $content = null ) {

	$a = shortcode_atts( [
		'plan'  => null,
		'start' => null,
		'end'   => null,
	], $atts );

	// doesn't matter if we don't have one of these, bail out
	if ( empty( $content ) || ! a['plan'] || ! $a['start'] ) {
		return '';
	}

	// final check: start must be before end, if there's an end
	if ( $a['end'] && ( (float) $a['start'] > (float) $a['end'] ) ) {
		return '';
	}

	$plan       = trim( $a['plan'] );
	$has_plan   = wc_memberships_is_user_member( get_current_user_id(), $plan );
	$membership = wc_memberships_get_user_membership( get_current_user_id(), $plan );

	if ( $has_plan && $membership ) {

		$end_date  = $membership->get_end_date( 'timestamp' );
		$msg_start = strtotime( date( 'Y-m-d H:i:s', $end_date ) . $a['start'] );
		$msg_end   = $a['end'] ? strtotime( date( 'Y-m-d H:i:s', $end_date ) . $a['end'] ) : null;

		// show if we've passed the start, but are before end (if there is an end)
		if ( time() > $msg_start && ( empty( $msg_end ) || time() < $msg_end ) ) {

			ob_start();

			echo '<p>' . wp_kses_post( do_shortcode( $content ) ) . '</p>';

			return ob_get_clean();
		}
	}

	return '';

}, 10, 2 );