<?php // only copy if needed

// REQUIRES version 2.0 or newer

/**
 * Change definitions for custom XML export formats
 * Lets you adjust XML version or other document settings
 *
 * @param array $definition the settings and custom fields for the custom export format
 * @param string $export_type the export type, either 'orders' or 'customers'
 * @param string $format the enabled export format, ie 'default', 'legacy', or 'custom'
 * @return array - the updated definition settings and fields
 */
function sv_wc_xml_export_custom_format_settings( $definition, $export_type, $format ) {
  
	// could also check $export_type for 'orders' or 'customers'
	if ( 'custom' === $format ) {
		$definition['xml_version'] = '1.1';
		$definition['xml_encoding'] = 'UTF-16';
		// $definition['xml_standalone'] = 'yes';
	}
  
	return $definition;
}
add_filter( 'wc_customer_order_xml_export_suite_format_definition', 'sv_wc_xml_export_custom_format_settings', 10, 3 );