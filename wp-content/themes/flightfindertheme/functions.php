<?php
/**
 * Flight-Finder-Theme functions and definitions
 */
 
//require('db_query.php');
//require('qpx_query.php'); 
 
/* Scripts should be inserted in <head> */
function add_theme_scripts() {
	//Scripts
	wp_enqueue_script('jquery-js', get_template_directory_uri() . '/js/jquery-2.4.1.min.js');
	wp_enqueue_script('jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js');
	wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('moment-js', get_template_directory_uri() . '/js/moment.min.js');
	wp_enqueue_script('moment-with-locales-js', get_template_directory_uri() . '/js/moment-with-locales.js');
	wp_enqueue_script('datetimepicker-js', get_template_directory_uri() . '/js/datetimepicker.js');
	wp_enqueue_script('autocomplete-js', get_template_directory_uri() . '/js/autocomplete.js');
	wp_enqueue_script('result-filter-js', get_template_directory_uri() . '/js/resultFilter.js');
	wp_enqueue_script('picker-and-slider-js', get_template_directory_uri() . '/js/pickerAndSlider.js');
	
	//Footer Scripts
	wp_enqueue_script('map-js', get_template_directory_uri() . '/js/map.js', '', '', 'in_footer');
	wp_enqueue_script('flight-request-js', get_template_directory_uri() . '/js/flight-request.js', '', '', 'in_footer');
	
	//Styles
	wp_enqueue_style('jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.css');
	wp_enqueue_style('font-css', get_template_directory_uri() . '/css/font.css');
	wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/css/font-awesome.css');
	wp_enqueue_style('datetimepicker-css', get_template_directory_uri() . '/css/datetimepicker.css');
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');