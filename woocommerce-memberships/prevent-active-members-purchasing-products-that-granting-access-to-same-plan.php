<?php // only copy this line if needed


/**
 * Sets whether a product/variation is purchasable based on whether the current
 * user is an existing member of the plan that this product grants access to.
 *
 * @param bool $purchasable whether the product is purchasable
 * @param \WC_Product|\WC_Product_Variation $product the product
 * @return bool
 */
function sv_wc_memberships_user_is_product_purchasable_existing_member( $purchasable, $product ) {

	if ( function_exists( 'wc_memberships' ) && sv_wc_memberships_user_is_active_member_of_product( $product->get_id() ) ) {
		$purchasable = false;
	}

	return $purchasable;
}
add_filter( 'woocommerce_is_purchasable',            'sv_wc_memberships_user_is_product_purchasable_existing_member', 100, 2 );
add_filter( 'woocommerce_variation_is_purchasable',  'sv_wc_memberships_user_is_product_purchasable_existing_member', 100, 2 );


function sv_wc_memberships_product_summary_display_nonpurchasable_notice(  ) {
	global $product;

	if ( function_exists( 'wc_memberships' ) && $product instanceof \WC_Product && sv_wc_memberships_user_is_active_member_of_product( $product->get_id() ) ) {
		?>
		<div class="woocommerce">
			<div class="woocommerce-info">
				<?php _e( 'You are already an active member of the membership plan this product grants access to. ', 'my-text-domain' ) ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'woocommerce_single_product_summary', 'sv_wc_memberships_product_summary_display_nonpurchasable_notice' );


/**
 * Helper function that determines if the user is an active member of a membership
 * plan that the specified product grants access to.
 *
 * @param int $product_id        The product ID
 * @param int $user_id Optional. The user ID
 * @return bool
 */
function sv_wc_memberships_user_is_active_member_of_product( $product_id, $user_id = 0 ) {

	if ( ! function_exists( 'wc_memberships' ) ) {
		return false;
	}

	$user_id               = $user_id ? $user_id : get_current_user_id();
	$is_user_active_member = false;

	foreach ( wc_memberships_get_membership_plans() as $plan ) {

		// check if prouduct grants access to this plan
		if ( $plan->has_product( $product_id ) ) {

			// check if user is active member of this plan
			if ( wc_memberships_is_user_active_member( $user_id, $plan->get_id() ) ) {
				$is_user_active_member = true;
				break;
			}
		}
	}

	return $is_user_active_member;
}
