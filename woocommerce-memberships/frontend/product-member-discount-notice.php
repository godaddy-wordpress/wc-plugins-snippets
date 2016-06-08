<?php // only copy this line if needed

/**
 * Check if a product has a member discount
 * Example: Display a member discount notice
 */
function sv_wc_memberships_member_discount_product_notice() {

	// bail if Memberships isn't active
    if ( ! function_exists( 'wc_memberships' ) ) {
        return;
    }

    // Set a discount end date
    $discount_ends = date_i18n( wc_date_format(), strtotime( '2015-12-31' ) );

    // Add our top notice if the member has a discount
    if ( wc_memberships_user_has_member_discount() ) {
        wc_print_notice( sprintf( 'Act fast! Your member discount ends on %s.', $discount_ends ), 'notice' );
    }
}
add_action( 'woocommerce_before_single_product', 'sv_wc_memberships_member_discount_product_notice' );
