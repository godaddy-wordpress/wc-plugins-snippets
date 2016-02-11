<?php // only copy this line if needed

/**
 * Track custom events in Mixpanel
 *
 * Placeholders:
 * * `hook_to_trigger_event_on`: replace with the hook you would like this event to trigger on; eg: `woocommerce_add_to_cart`
 * * `Event Name`: replace with custom even name
 * * `array( 'Property name' => 'value' )`: replace with an array of custom property names and values
 */
if ( ! function_exists( 'sv_wc_mixpanel_track_custom_event' ) ) {

	function sv_wc_mixpanel_track_custom_event() {

		if ( function_exists( 'wc_mixpanel' ) ) {
			wc_mixpanel()->get_integration()->custom_event( 'Event name', array( 'Property name' => 'value' ) );
		}
	}

	add_action( 'hook_to_trigger_event_on', 'sv_wc_mixpanel_track_custom_event' );
}
