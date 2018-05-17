<?php // only copy if needed

/**
 * Mark the "take a seat" checkbox as checked by default when purchasing a team.
 * REQUIRES Teams 1.0.2
 *
 * @param array $fields the product page fields
 * @param \WC_Product $product current product, unused
 * @return array updated fields
 */
add_filter( 'wc_memberships_for_teams_product_team_user_input_fields', function( $fields, $product ) {

	if ( isset( $fields['team_owner_takes_seat'] ) ) {
		$fields['team_owner_takes_seat']['default'] = 1;
	}

	return $fields;
}, 10, 2 );
