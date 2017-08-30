<?php // only copy if needed

/**
 * Translates Checkout Add-ons Labels and options when using Polylang.
 *
 * Requires strings to be translated under Languages > String Translation before use.
 */


/**
 * Registers Add-on names and options in Polylang for translation.
 *  Will use the add-on name if a label is not set.
 */
function sv_wc_coa_register_polylang_strings() {

	if ( function_exists( 'wc_checkout_add_ons' ) && function_exists( 'pll_register_string' ) ) {

		$add_ons = wc_checkout_add_ons()->get_add_ons();

		foreach ( $add_ons as $id => $add_on ) {

			$add_on_label = ! empty( $add_on->label ) ? $add_on->label : $add_on->name;
			pll_register_string( $add_on->name, $add_on_label, 'woocommerce-checkout-add-ons' );

			// if the add-on has options, register these option labels, too
			if ( $add_on->has_options() ) {

				$options = $add_on->get_options( false );

				foreach ( $options as $option ) {
					pll_register_string( $option['value'], $option['label'], 'woocommerce-checkout-add-ons' );
				}
			}
		}
	}
}
add_action( 'init', 'sv_wc_coa_register_polylang_strings' );


/**
 * Use the translated the add-on label.
 *
 * @param string $label the add-on label or name if not set
 * @return string translated label
 */
function sv_wc_coa_polylang_translate_labels( $label ) {

	if ( function_exists( 'pll__' ) ) {
		$label = pll__( $label );
	}

	return $label;
}
add_filter( 'wc_checkout_add_ons_add_on_label', 'sv_wc_coa_polylang_translate_labels' );
add_filter( 'wc_checkout_add_ons_add_on_name',  'sv_wc_coa_polylang_translate_labels' );


/**
 * Uses translated options labels for add-ons with options.
 *
 * @param string[] $options the option data
 * @return string[] translated options
 */
function sv_wc_coa_polylang_translate_options( $options ) {

	$translated_options = array();

	if ( function_exists( 'pll__' ) ) {

		foreach ( $options as $option ) {
			$option['label']      = pll__( $option['label'] );
			$translated_options[] = $option;
		}
	}

	return ! empty( $translated_options ) ? $translated_options : $options;
}
add_filter( 'wc_checkout_add_ons_options', 'sv_wc_coa_polylang_translate_options' );