<?php // only copy this line if needed
/**
 * Forces tokenization and hides the "securely save to account" checkbox
 *   for Braintree credit card transactions when user is logged in
 */
add_filter( 'wc_braintree_credit_card_payment_form_tokenization_forced', '__return_true' );


/**
 * Forces tokenization and hides the "securely save to account" checkbox
 *   for Braintree PayPal transactions when user is logged in
 */
add_filter( 'wc_braintree_paypal_payment_form_tokenization_forced', '__return_true' );
