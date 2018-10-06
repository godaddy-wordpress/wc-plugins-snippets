<?php // only copy this line if needed

/**
 * Replaces the tracking ID based on the current language in WPML
 */
function sv_wc_google_analytics_pro_tracking_id_wpml_current_language( $tracking_id ) {

	if ( function_exists( 'wpml_get_current_language' ) ) {

		switch ( wpml_get_current_language() ) {

			case 'en':
				$tracking_id = 'UA-00000000-1';
			break;

			case 'fr':
				$tracking_id = 'UA-00000000-2';
			break;
		}
	}

	return $tracking_id;
}
add_filter( 'wc_google_analytics_pro_tracking_id', 'sv_wc_google_analytics_pro_tracking_id_wpml_current_language' );
