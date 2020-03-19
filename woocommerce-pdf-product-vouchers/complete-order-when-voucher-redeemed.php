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

		$order = $voucher->get_order();
		
		if ( $order ) {

			$complete_order = true;

			// optional: this will check if the order contains additional unredeemed vouchers
			if ( class_exists( 'WC_PDF_Product_Vouchers_Order', false ) ) {

				foreach ( \WC_PDF_Product_Vouchers_Order::get_vouchers( $order ) as $additional_voucher ) {

					if ( $voucher->get_id() === $additional_voucher->get_id() ) {
						continue;
					}

					if ( ! $additional_voucher->has_status( 'redeemed' ) ) {

						$complete_order = false;
						break;
					}
				}
			}

			if ( $complete_order ) {

				$order_note = esc_html__( 'Voucher has been redeemed.', 'my-text-domain' );

				$order->update_status( 'completed', $order_note );
			}
		}
	}
}
add_action( 'wc_pdf_product_vouchers_voucher_status_changed', 'sv_wc_pdf_product_vouchers_complete_order_when_redeemed', 10, 3 );
