<?php // only copy if needed!

/**
 * Allows Checkout Add-ons to be shown in the Member Details area when viewing a membership.
 *
 * REQUIRES Checkout Add-ons v2.0 or newer!
 */


/**
 * Allow attributes to be shown on the edit member screen.
 *
 * @param array $attributes the accepted attributes
 * @return updated array
 */
function add_membership_add_on_attribute( $attributes ) {

	if ( function_exists( 'wc_memberships' ) ) {

		$attributes['membership_view'] = __( 'Display in Edit Member screen', 'woocommerce-memberships-member-fields' );
	}

	return $attributes;
}
add_filter( 'wc_checkout_add_ons_add_on_attributes', 'add_membership_add_on_attribute' );


/**
 * Show member add-on fields in the Edit Member screen.
 *
 * @param int $user_id the WP_User id
 * @param int $membership_id the user membership post ID
 */
function show_member_fields( $user_id, $membership_id ) {

	// bail if checkout add-ons isn't active
	if ( ! function_exists( 'wc_checkout_add_ons' ) ) {
		return;
	}

	$membership = wc_memberships_get_user_membership( $membership_id );
	$add_ons    = $membership->get_order_id() ? wc_checkout_add_ons()->get_order_add_ons( $membership->get_order_id() ) : array();
	$to_show    = array();

	// bail if we have no add-ons
	if ( empty( $add_ons ) ) {
		return;
	}

	foreach ( $add_ons as $key => $add_on ) {

		$add_on_master = \SkyVerge\WooCommerce\Checkout_Add_Ons\Add_Ons\Add_On_Factory::get_add_on( $key );

		if ( $add_on_master->has_attribute( 'membership_view' ) ) {
			$to_show[] = $add_on;
		}
	}

	ob_start();
	?>

	<h2 class="member-name"><?php esc_html_e( 'Additional fields', 'woocommerce-memberships-member-fields' ); ?></h2>

	<?php if ( ! empty( $to_show ) ) : ?>

		<ul>
		<?php foreach( $to_show as $item ) : ?>
			<li><?php printf( "%s: %s", $item['name'], is_array( $item['value'] ) ? implode( ', ', $item['value'] ) : $item['value']); ?></li>
		<?php endforeach; ?>
		</ul>

	<?php else : ?>
		<p><em><?php esc_html_e( 'No member fields.', 'woocommerce-memberships-member-fields' ); ?></em></p>
	<?php endif; ?>

	<?php
	echo ob_get_clean();
}
add_action( 'wc_memberships_after_user_membership_member_details', 'show_member_fields', 10, 2 );
