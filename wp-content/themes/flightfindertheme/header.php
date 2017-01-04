<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta charset="<?php bloginfo('charset'); ?>" />	
	<link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet" type="text/css" media="screen" />
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css"> 
	<link href="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/css/datetimepicker.css" rel="stylesheet" type="text/css" />
	<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/datetimepicker.js"></script>
	<script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/autocomplete.js"></script>
	<script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/form-validation.js"></script>
	<script src="http://localhost:8080/flight-finder/wp-content/themes/flightfindertheme/js/flight-request.js"></script>
	<script type="text/javascript">
        $(function () {
			$('#datetimepicker').datetimepicker({
				format: 'YYYY-MM-DD', //'DD.MM.YYYY - HH:mm'
				showTodayButton: true,
				showClear: true
			});
			$('#datetimepicker1').datetimepicker({
				format: 'YYYY-MM-DD', //'DD.MM.YYYY - HH:mm'
				showTodayButton: true,
				showClear: true
			});
        });
    </script>
</head>
<body <?php body_class(); ?>>
	<div id="nav-menu" class="collapse navbar-collapse ">	
		<?php wp_nav_menu(); ?>			
	</div>