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
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a id="home-link" href="<?php echo home_url(); ?>"><img id="logo" src="<?php echo home_url() . '/wp-content/themes/flightfindertheme/img/flightfinder-logo.png' ?>"></a>