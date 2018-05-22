<?php // only copy this line if needed

/**
 * Don't allow customers to view invoices. This will remove the "View Invoice"
 * link from emails, the View Order screen, and My Orders screen.
 */
add_filter( 'wc_pip_customers_can_view_invoices', '__return_false' );
