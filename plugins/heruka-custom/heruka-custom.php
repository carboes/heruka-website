<?php
/*
Plugin Name: Heruka KMC Customisations
Plugin URI: http://www.meditateinlondon.org.uk/
Description: A simple plugin for the weekly classes section.
Version: 1.0
Author: Carl Peterken
Author URI: http://www.meditateinlondon.org.uk/
License: GPL2
*/


include 'weekly-class-widget.php';
include 'paypal-widget.php';
include 'social-widget.php';
include 'newsletter-widget.php';
include 'homeitem-widget.php';

function register_widgets() {
    register_widget( 'PaypalAnalytics_Widget' );
    register_widget( 'Social_Widget' );
    register_widget( 'WeeklyClass_Widget' );
    register_widget( 'Newsletter_Widget' );
    register_widget( 'HomeItem_Widget' );
}
add_action( 'widgets_init', 'register_widgets' );

function get_single_branch_template($single_template) {
	global $wp_query, $post;
	if ($post->post_type == "meditation-class") {
	    return dirname( __FILE__ ) . '/single-branch.php';
	}
    if ($post->post_type == "event") {
        return dirname( __FILE__ ) . '/single-event.php';
    }
	return $single;
}
add_filter('single_template', 'get_single_branch_template');


wp_enqueue_style( 'heruka-style', plugins_url('style.css', __FILE__) );
wp_enqueue_script( 'heruka-scripts', plugins_url('scripts.js', __FILE__), array( 'jquery' ), '', true );
wp_enqueue_style( 'fontawesome-style', "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");

wp_enqueue_style( 'fullcalendar-style', plugins_url('fullcalendar-2.1.1/fullcalendar.css', __FILE__) );
wp_enqueue_script( 'fullcalendar-script1', plugins_url('fullcalendar-2.1.1/lib/moment.min.js', __FILE__), array( 'jquery'), '', true );
wp_enqueue_script( 'fullcalendar-script2', plugins_url('fullcalendar-2.1.1/fullcalendar.min.js', __FILE__), array( 'jquery'), '', true );
wp_enqueue_script( 'fullcalendar-script3', plugins_url('fullcalendar-2.1.1/gcal.js', __FILE__), array( 'jquery'), '', true );
wp_enqueue_script( 'fullcalendar-script4', plugins_url('calendar.js', __FILE__), array( 'jquery'), '', true );
wp_enqueue_script( 'cookie', "//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js", array( 'jquery'));

wp_enqueue_style( 'fontawesome-style', "//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");


/**
* add some conditional output conditions for Events Manager
* @param string $replacement
* @param string $condition
* @param string $match
* @param object $EM_Event
* @return string
*/
function filterEventOutputCondition($replacement, $condition, $match, $EM_Event){
    if (is_object($EM_Event)) {
 
        switch ($condition) {
 
            // replace LF with HTML line breaks
            case 'nl2br':
                // remove conditional
                $replacement = preg_replace('/\{\/?nl2br\}/', '', $match);
                // process any placeholders and replace LF
                $replacement = nl2br($EM_Event->output($replacement));
                break;

          	// #_ATT{DateReplaceText}
            case 'keep_date':
                if (is_array($EM_Event->event_attributes) && empty($EM_Event->event_attributes['DateReplaceText']))
                    $replacement = preg_replace('/\{\/?keep_date\}/', '', $match);
                else
                    $replacement = '';
                break;
        }
 
    }
 
    return $replacement;
} 
add_filter('em_event_output_condition', 'filterEventOutputCondition', 10, 4);


?>
