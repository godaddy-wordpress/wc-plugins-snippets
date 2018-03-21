<?php // only copy this line if needed
/**
 * Forces tokenization and hides the "securely save to account" checkbox
 *   for First Data Payeezy Gateway credit card transactions when user is logged in
 */
add_filter( 'wc_first_data_payeezy_gateway_credit_card_payment_form_tokenization_forced', '__return_true' );
