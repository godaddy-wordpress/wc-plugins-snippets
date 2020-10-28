<?php // only copy this line if needed

namespace SkyVerge\WooCommerce\Checkout_Add_Ons\Add_Ons;

/**
 * Helper function to return the Checkout Add-ons associated with the given order.
 *
 * @param int $order_id the order id
 * @return array an associated array of checkout add-ons
 */
function sv_wc_checkout_add_ons_get_order_add_ons_formatted( $order_id ) {

	// bail if Checkout Add-ons isn't activated
	if ( ! function_exists( 'wc_checkout_add_ons' ) ) {
		return [];
	}

	// bail if id is not for a valid order
	if ( ! wc_get_order( $order_id ) instanceof \WC_Order ) {
		return [];
	}

	$add_ons       = [];
	$order_add_ons = wc_checkout_add_ons()->get_order_add_ons( $order_id );

	foreach( Add_On_Factory::get_add_ons() as $id => $add_on ) {

		$add_on_data = [];

		if ( isset( $order_add_ons[ $add_on->get_id() ] ) ) {

			switch( $add_on->get_type() ) {

				case 'file':
					$add_on_value = wp_get_attachment_url( $order_add_ons[ $add_on->get_id() ]['value'] );
				break;

				case 'checkbox':
					$add_on_value = '1' === $order_add_ons[ $add_on->get_id() ]['value'] ? 'yes' : 'no';
				break;

				default:
					$add_on_value = is_array( $order_add_ons[ $add_on->get_id() ]['normalized_value'] ) ? implode( ', ', $order_add_ons[ $add_on->get_id() ]['normalized_value'] ) : $order_add_ons[ $add_on->get_id() ]['normalized_value'];
				break;
			}

			$add_on_data['id']    = $add_on->get_id();
			$add_on_data['name']  = $order_add_ons[ $add_on->get_id() ]['name'];
			$add_on_data['value'] = $add_on_value;
			$add_on_data['cost']  = wc_format_decimal( $order_add_ons[ $add_on->get_id() ]['total'], 2 );
		}

		$add_ons[] = $add_on_data;
	}

	return $add_ons;
}
