<?php // only copy this line if needed

/**
 * Removes Memberships default Members Area used since v1.9 onwards.
 */
function sv_memberships_unhook_members_area() {

	if ( ! is_admin() && function_exists( 'wc_memberships' ) ) {

		$frontend     = wc_memberships()->get_frontend_instance();
		$members_area = $frontend ? $frontend->get_members_area_instance() : null;

		if ( $members_area ) {
			remove_filter( 'woocommerce_account_menu_items', array( $members_area, 'add_account_members_area_menu_item' ), 999 );
		}
	}
}
add_action( 'init', 'sv_memberships_unhook_members_area' );


/**
 * Outputs the Members Area below the My Account Dashboard as in versions before v1.9.
 *
 * @param string $template the current template being displayed by WooCommerce
 */
function sv_memberships_output_my_account_dashboard_my_memberships( $template = '' ) {

	if ( 'myaccount/dashboard.php' === $template ) {

		ob_start();
		?>
		<div class="woocommerce">
			<h2><?php esc_html_e( 'My Memberships', 'woocommerce-memberships' ); ?></h2>
			<?php wc_get_template( 'myaccount/my-memberships.php', array(
				'customer_memberships' => wc_memberships_get_user_memberships(),
				'user_id'              => get_current_user_id(),
			) ); ?>
		</div>
		<?php

		echo ob_get_clean();
	}
}
add_action( 'woocommerce_after_template_part', 'sv_memberships_output_my_account_dashboard_my_memberships' );
