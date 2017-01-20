<?php // only copy if needed


/**
 * Complete snippet will allow for replacing a {plan_names} merge tag in product restricted
 *  messages with a human-readable list of plans names that restrict the product
 *
 * See: http://skyver.ge/5U
 */


/**
 * Allows for replacing {plan_names} merge tag in product restriction messages
 *
 * @param string $message the restriction message
 * @param int $product_id the ID of the product currently being viewed
 * @return string the message with the merge tag replaced
 */
function edit_purchasing_restricted_message( $message, $product_id ) {

	$plans = sv_wc_memberships_get_plans_for_product( $product_id );

	// NOTE: wc_memberships_list_items( $plans ) can replace this function entirely
	// ...if you're barbaric enough to dislike Oxford commas -.-
	$plans_list = sv_get_readable_list( $plans );

	return str_replace( '{plan_names}', $plans_list, $message );
}
add_filter( 'wc_memberships_product_purchasing_restricted_message', 'edit_purchasing_restricted_message', 10, 2 );
add_filter( 'wc_memberships_product_viewing_restricted_message',    'edit_purchasing_restricted_message', 10, 2 );


/**
 * Creates a human-readable (Oxford comma) list from an array
 *
 * @param array $items the array of items to turn into a list
 * @param string $glue the string that should separate items in the list
 * @param string $last the string that should appear between final list items
 * @return string a human-readable list of the items
 */
function sv_get_readable_list( $items, $glue = ', ', $last = ' or ' ) {

	// optional: bold the text for each value
	// foreach ( $items as $key => $value ) {
	//	$items[ $key ] = '<strong>' . $value . '</strong>';
	// }

	if ( count( $items ) > 1 ) {
		$last_element = array_pop( $items );
		array_push( $items, $last . $last_element );
	}

	// don't add the glue unless we have > 2 items
	return 2 === count( $items ) ? implode( ' ', $items ) : implode( $glue, $items );
}


/**
 * Helper function to get membership plans that restrict access to a product
 *
 * @param int $product_id the product ID being viewed
 * @return array $product_plans plans that restrict access to the product
 */
function sv_wc_memberships_get_plans_for_product( $product_id ) {

	$all_plans     = wc_memberships_get_membership_plans();
	$product_plans = array();

	foreach ( $all_plans as $plan ) {

		$restriction_rules = $plan->get_product_restriction_rules();
		$product_cats      = get_the_terms( $product_id, 'product_cat' );

		// Just in case :)
		if ( is_wp_error( $product_cats ) || ! $product_cats ) {
			$product_cats = array();
		}

		// give us just an array of IDs for the product categories, thx
		$categories = wp_list_pluck( $product_cats, 'term_id' );

		foreach ( $restriction_rules as $rule ) {

			// rule can be either a product or term restriction, let's see which type
			// then use that to compare against our current product
			switch ( $rule->get_content_type_name() ) {

				case 'product_cat':

					// check for at least one match
					// if we find one, break out of the rules foreach, we're done
					if ( count( array_intersect( $rule->get_object_ids(), $categories ) ) > 0 ) {
						$product_plans[ $plan->get_slug() ] = $plan->get_name();
						break 2;
					}

				break;

				case 'product':

					// check to see if the product is restricted directly
					// break completely out if so (this is intentionally not strict)
					if ( in_array( $product_id, $rule->get_object_ids() ) ) {
						$product_plans[ $plan->get_slug() ] = $plan->get_name();
						break 2;
					}

				break;
			}
		}
	}

	return $product_plans;
}
