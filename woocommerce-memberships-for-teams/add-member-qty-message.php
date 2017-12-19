<?php // only copy if needed!


/**
 * Adds a message to select team quantity to Team products with per-member pricing.
 *
 * @param string $template_name template name
 * @param string $template_path template path, unused
 * @param string $located template location, unused
 * @param string[] $args template arguments
 */
function sv_wc_memberships_for_teams_add_quantity_message( $template_name, $template_path, $located, $args ) {

	// only add the message to team products
	if ( 'single-product/product-team.php' === $template_name && isset( $args['product'] ) ) {
	
		// TODO: change this to your own message
		$message = esc_html__( 'Choose the number of members on your team', 'textdomain' );
		$product = $args['product'];

		// don't add a note about quantity if it's not there, or if we're not using a per-member price
		if ( ! $product->get_sold_individually() && \SkyVerge\WooCommerce\Memberships\Teams\Product::has_per_member_pricing( $product ) ) {
			echo "<p><strong>{$message}</strong></p>";
		}
	}
}
add_action( 'woocommerce_after_template_part', 'sv_wc_memberships_for_teams_add_quantity_message', 10, 4 );