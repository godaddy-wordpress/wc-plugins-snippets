<?php
/**
 * Force the "securely save to account" checkbox to default to checked
 *
 * @param string $html the checkbox field html
 * @param object $form the payment form object
 * @return string $html the updated checkbox field html
 */
function sv_wc_authnet_cim_save_payment_method_checkbox_default( $html, $form ) {

	if ( empty( $html ) || $form->tokenization_forced() ) {
		return $html;
	}
	
	return str_replace( 'type="checkbox"', 'type="checkbox" checked="checked"', $html );
}
add_filter( 'wc_authorize_net_cim_credit_card_payment_form_save_payment_method_checkbox_html', 'sv_wc_authnet_cim_save_payment_method_checkbox_default', 10, 2 );
