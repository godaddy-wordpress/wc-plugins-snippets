<?php // only copy if needed

// Adds Memberships restrictions support to Sensei


/**
 * Required: Restrict lesson videos & quiz links until the member has access to the lesson.
 * Used to ensure content dripping from Memberships is compatible with Sensei.
 *
 * This will also remove the "complete lesson" button until the lesson is available.
 */
function sv_wc_memberships_sensei_restrict_lesson_details() {
	global $post;
	
	// sanity checks
	if ( ! function_exists( 'wc_memberships_get_user_access_start_time' ) || ! function_exists( 'Sensei' ) || 'lesson' !== get_post_type( $post ) ) {
		return;
	}
	
	// if access start time isn't set, or is after the current date, remove the video
	if (   ! wc_memberships_get_user_access_start_time( get_current_user_id(), 'view', array( 'lesson' => $post->ID ) )
	    || current_time( 'timestamp' ) < wc_memberships_get_user_access_start_time( get_current_user_id(), 'view', array( 'lesson' => $post->ID ) ) ) {
	
		remove_action( 'sensei_single_lesson_content_inside_after',  array( 'Sensei_Lesson', 'footer_quiz_call_to_action' ) );
		remove_action( 'sensei_single_lesson_content_inside_before', array( 'Sensei_Lesson', 'user_lesson_quiz_status_message' ), 20 );
	
		remove_action( 'sensei_lesson_video',           array( Sensei()->frontend, 'sensei_lesson_video' ), 10, 1 );
		remove_action( 'sensei_lesson_meta',            array( Sensei()->frontend, 'sensei_lesson_meta' ), 10 );
		remove_action( 'sensei_complete_lesson_button', array( Sensei()->frontend, 'sensei_complete_lesson_button' ) );
	}
}
add_action( 'wp', 'sv_wc_memberships_sensei_restrict_lesson_details' );


/**
 * Optional: Restrict course videos unless the member has access.
 * Used if you don't want to show course previews to non-members.
 */
function sv_wc_memberships_sensei_restrict_course_videos() {
	global $post;

	// sanity checks
	if ( ! function_exists( 'wc_memberships_get_user_access_start_time' ) || ! function_exists( 'Sensei' ) || 'course' !== get_post_type( $post ) ) {
		return;
	}

	// if access start time isn't set, or is after the current date, remove the video
	if (   ! wc_memberships_get_user_access_start_time( get_current_user_id(), 'view', array( 'course' => $post->ID ) )
	    || current_time( 'timestamp' ) < wc_memberships_get_user_access_start_time( get_current_user_id(), 'view', array( 'course' => $post->ID ) ) ) {
	
		remove_action( 'sensei_single_course_content_inside_before',  array( 'Sensei_Course' , 'the_course_video' ), 40 );
		remove_action( 'sensei_no_permissions_inside_before_content', array( 'Sensei_Course' , 'the_course_video' ), 40 );
	}
}
add_action( 'wp', 'sv_wc_memberships_sensei_restrict_course_videos' );