<?php // only copy this line if needed

/**
 * Adds Order Notes to the WooCommerce Order XML export 
 * All notes are nested in the <OrderNotes></OrderNotes> element
 * Each note then is enclosed by <OrderNote></OrderNote>, and includes date, author, content
 */
 

/**
 * Adds the order notes into the order data for the XML output
 *
 * @param array $elements the elements in the XML
 * @param \WC_Order $order the order object for the export
 * @return array the updated elements
 */
function sv_wc_xml_export_add_order_notes( $elements, $order ) {

	$order_notes = sv_wc_xml_export_get_order_notes( $order );

	// nest each order note inside the <OrderNotes> element
	$elements['OrderNotes'] = array( 'OrderNote' => sv_wc_xml_export_format_order_notes( $order_notes ) );
	
	return $elements;
}
add_filter( 'wc_customer_order_xml_export_suite_order_export_order_list_format', 'sv_wc_xml_export_add_order_notes', 10, 2 );


/**
 * Formats order note comment object into the array of order note data we need
 *
 * @param array $notes an array of order note comment objects
 * @return array the formatted array of order notes to output
 */
function sv_wc_xml_export_format_order_notes( $notes ) {
	
	$order_note = array();

	foreach ( $notes as $note ) {
	
		$order_note[] = array(
			'Date' 		=> $note->comment_date,
			'Author'	=> $note->comment_author,
			'Content'	=> str_replace( array( "\r", "\n" ), ' ', $note->comment_content ),
		);
	}

	return $order_note;
}


/**
 * Gets an array of order note comment objects (all note, private and customer)
 *
 * @param \WC_Order $order the order object for the export
 * @return array the array of order note comment objects
 */
function sv_wc_xml_export_get_order_notes( $order ) {
	
	$callback = array( 'WC_Comments', 'exclude_order_comments' );

	$args = array(
		'post_id' => $order->id,
		'approve' => 'approve',
		'type'    => 'order_note'
	);

	remove_filter( 'comments_clauses', $callback );

	$order_notes = get_comments( $args );

	add_filter( 'comments_clauses', $callback );

	return $order_notes;
}