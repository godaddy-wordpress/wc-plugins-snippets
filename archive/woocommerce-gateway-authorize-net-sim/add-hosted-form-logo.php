<?php // only copy if needed!

/**
 * Shows a logo you've provided to AuthNet on your hosted payment form.
 *
 * YOU MUST FOLLOW THE STEPS + FORMAT HERE FOR YOUR LOGO:
 *  https://support.authorize.net/authkb/index?page=content&id=A824&actp=search&viewlocale=en_US&searchid=1511368547237
 */

/**
 * Adds a logo to the hosted SIM payment page.
 *
 * @param string[] $params form parameters in name => value format
 * @param \WC_Order $order order object
 * @param \WC_Gateway_Authorize_Net_SIM $gateway class instance
 * @return string[] updated params
 */
function sv_wc_authnet_sim_add_logo( $params, $order, $gateway ) {

	// change this file type to match the logo you uploaded to AuthNet!
	$image_type = 'png';

	// change this to your AuthNet account gateway ID!
	// see http://cloud.skyver.ge/062b0H0A2y0e
	$gateway_id = '123456';

	$params['x_logo_URL'] = "https://secure.authorize.net/mgraphics/logo_{$gateway_id}.{$image_type}";

	return $params;
}
add_filter( 'wc_authorize_net_sim_hosted_payment_form_params', 'sv_wc_authnet_sim_add_logo', 10, 3 );