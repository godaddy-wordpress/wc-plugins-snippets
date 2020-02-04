<?php // only copy this line if needed

/**
 * Change the status of the associated order when a PDF Product Vouchers voucher is redeemed
 *
 * @param \WC_Voucher $voucher the voucher object
 * @param string $old_status old status, without the wcpdf- prefix
 * @param string $new_status new status, without the wcpdf- prefix
 */
function sv_wc_pdf_product_vouchers_complete_order_when_redeemed( $voucher, $old_status, $new_status ) {

	if ( 'redeemed' === $new_status ) {

		$order_note = esc_html__( 'Voucher has been redeemed.', 'my-text-domain' );

		if ( $order = $voucher->get_order() ) {
			$order->update_status( 'completed', $order_note );
		}
	}
}
add_action( 'wc_pdf_product_vouchers_voucher_status_changed', 'sv_wc_pdf_product_vouchers_complete_order_when_redeemed', 10, 3 );
