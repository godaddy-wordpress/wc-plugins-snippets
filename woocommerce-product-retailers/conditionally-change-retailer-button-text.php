<?php
/**
 * Change the retailer button text based on product category
 * Works with > 1 buttons per product
 *
 * @param string $label the button text
 * @param object $retailer the retailer post object
 * @param obj $product the currently viewed product
 * @return string retailer button label
 */
function skyverge_change_retailer_buttons( $label, $retailer, $product ) {

	$name = $retailer->get_name();

	// Use the retailer name whose buttons you'd like to change
	if ( 'Amazon' === $name ) {

		// Use your product category slugs to set new labels
		if ( has_term( 'Books', 'product_cat' ) ) {

			$label = 'Buy Paperback at Amazon';

		} elseif ( has_term( 'Shoes', 'product_cat' ) ) {

			$label = 'Shop Amazon Shoes';

		} elseif ( has_term( 'Jewelry', 'product_cat' ) ) {

			$label = 'Shop Amazon Jewelry';

		} else {

			// give back the original Amazon label
			return $label;
		}

		// Spit out our new text + price if we're changing the label
		// Use your currency symbol instead of &#36; if different from US dollars
		return $label . ' - &#36;' . $retailer->get_price();
	}

	// if not Amazon, just return the original label
	return $label;
}
add_filter( 'wc_product_retailers_button_label', 'skyverge_change_retailer_buttons', 10, 3 );
