<?php // only copy this line if needed

/**
 * Check if product purchasing is retricted
 * Example: Add a restricted product notice
 * Display a top notice to non-members for members-only products
 */
function sv_wc_memberships_members_only_product_notice() {

	// bail if Memberships isn't active
    if ( ! function_exists( 'wc_memberships' ) ) {
        return;
    }

    $user_id = get_current_user_id();

    // Bail if the user is already a silver or gold member
    if ( wc_memberships_is_user_active_member( $user_id, 'silver' ) || wc_memberships_is_user_active_member( $user_id, 'gold' ) ) {
        return;
    }

    // Add our top notice if purchasing is restricted
    if ( wc_memberships_is_product_purchasing_restricted() ) {
        wc_print_notice( 'This is a preview! Only silver or gold members can purchase this product.', 'notice' );
    }
}
add_action( 'woocommerce_before_single_product', 'sv_wc_memberships_members_only_product_notice' );
