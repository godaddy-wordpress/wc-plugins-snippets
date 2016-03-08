<?php // only copy this line if needed
/**
 * Forces tokenization and hides the "securely save to account" checkbox
 *   for Authorize.net CIM credit card transactions when user is logged in
 */
add_filter( 'wc_authorize_net_cim_credit_card_payment_form_tokenization_forced', '__return_true' );
