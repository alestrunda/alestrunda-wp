<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--[if lt IE 9]> 
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="description" content="<?php echo get_theme_mod( 'site_description_text' ); ?>">
    <meta name="keywords" content="">
    <meta name="author" content="Aleš Trunda alestrunda.cz">
    <meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
    
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="image/png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/ico/favicon_152.png">
    
	<?php wp_head(); ?>
    
	<title><?php bloginfo( 'name' ); wp_title( '|', true, 'left' ); ?></title>
</head>

<body>
	<script><?php //echo get_theme_mod( 'google_analytics_code' ); ?></script>
    
    <div id="loader-page" class="loader-page">
		<div class="loader-page__hide"><i class="loader-page__icon fa fa-close"></i> <?php _e( 'hide loading', 'alestrunda' ); ?></div>
	</div>
	<div id="cover-screen" class="cover-screen"></div>
	<div class="content-all">
