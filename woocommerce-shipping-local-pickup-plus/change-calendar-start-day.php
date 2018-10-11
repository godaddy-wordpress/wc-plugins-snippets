<?php // only copy if needed

/**
 * Modify Start Day for Local Pickup Plus Calendar
 *
 */
function sv_local_pickup_cal_start() {
	
	$day = '0'; // int starting day of the week as numerical entity (0 = Sunday, 6 = Saturday, default 1 = Monday)
		
	return $day;
}
add_filter( 'pre_option_start_of_week', 'sv_local_pickup_cal_start' );
