<?php
/**
 * Twenty Fifteen functions and definitions
 */
 
/* Scripts should be inserted in <head> */
function head_scripts() {
	echo '<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
		  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js"></script>
	      <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
		  <script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/datetimepicker.js"></script>
		  <script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/autocomplete.js"></script>
		  <script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/form-validation.js"></script>
		  <script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/flight-request.js"></script>
		  <script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/resultFilter.js"></script>';
}
add_action('wp_head', 'head_scripts');

/* Stylesheets should be inserted in <head> */
function head_stylesheets() {
	echo '<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">
		  <link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css" media="screen" />
		  <link href="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/css/bootstrap.css" rel="stylesheet" type="text/css" />
		  <link href="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/css/font-awesome.css" rel="stylesheet" type="text/css" />
		  <link href="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/css/datetimepicker.css" rel="stylesheet" type="text/css" />';
}
add_action('wp_head', 'head_stylesheets');