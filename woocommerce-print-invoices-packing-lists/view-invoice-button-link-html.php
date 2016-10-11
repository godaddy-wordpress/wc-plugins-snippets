<?php // only copy this line if needed

/**
 * Remove "View Invoice" link from customer emails 
 * or change HTML of the original link button in "View Order" page from "My Account"
 *
 * @param string $button The button HTML
 * @param string $action The current context where the link button is produced ('send_email' or 'print')
 * @return string HTML
 */
function sv_pip_view_invoice_button_html( $button, $action ) {
    
    if ( 'send_email' === $action ) {
        $button = '';
    } elseif ( 'print' === $action ) {
		$button = '<span class="my-css-class">' . $button . '</span>';
	}
    
    return $button;
}

add_filter( 'wc_pip_view_invoice_button_html', 'sv_pip_view_invoice_button_html', 10, 2 );
	
