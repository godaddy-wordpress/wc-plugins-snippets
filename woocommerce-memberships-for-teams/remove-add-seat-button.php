<?php // only copy if needed!


/**
 * Remove the Add Seat button from the team owners `Team Settings` page.
 * REQUIRES Teams 1.1.0
 */
add_filter( 'wc_memberships_for_teams_team_can_add_seats', '__return_false', 20 );
