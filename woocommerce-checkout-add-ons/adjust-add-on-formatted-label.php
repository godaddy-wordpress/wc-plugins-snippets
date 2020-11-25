<?php // only copy if needed


/**
 * Adjust the formatted add-on label shown to customers.
 *
 * Requires v1.10.5+
 *
 * @param string $formatted the formatted label
 * @param string $name field name
 * @param string $label optional descriptive field label
 * @param string $cost optional field cost
 * @return string the updated label
 */
function sv_wc_checkout_addons_formatted_label( $formatted, $name, $label, $cost ) {

	// you could do something different, such as build a new label with the cost
	// $label     = $label ? esc_html( $label ) : esc_html( $name );
	// $formatted = $cost ? "{$label} ... {$cost}" : $label;

	// or just remove the cost completely
	return ! empty( $label ) ? esc_html( $label ) : esc_html( $name );
}
add_filter( 'wc_checkout_add_ons_formatted_add_on_label', 'sv_wc_checkout_addons_formatted_label', 10, 4 );
