<?php // only copy this line if needed
/**
 * Force the "securely save to account" checkbox to default to checked when using Braintree Credit Cards
 * (still allows customers to uncheck this)
 */
add_filter( 'wc_braintree_credit_card_default_tokenize_payment_method_checkbox_to_checked', '__return_true' );


/**
 * Force the "securely save to account" checkbox to default to checked when using Braintree PayPal
 * (still allows customers to uncheck this)
 */
add_filter( 'wc_braintree_paypal_default_tokenize_payment_method_checkbox_to_checked', '__return_true' );
