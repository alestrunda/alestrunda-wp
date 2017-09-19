<?php

function mytheme_customize_register( $wp_customize ) {
	
	//Codes
	$wp_customize->add_section( 'codes' , array(
		'title'      => __( 'Codes', 'alestrunda' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'google_analytics_code' , array(
	) );
	
	//when adding control to setting, the setting must be already added
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_analytics_code', array(
		'label'      => __( 'Google Analytics code', 'alestrunda' ),
		'section'    => 'codes',
		'settings'   => 'google_analytics_code',
		'type'		 => 'textarea'
	) ) );
	
	
	
	//Site description
	$wp_customize->add_section( 'site_description' , array(
		'title'      => __( 'Site description', 'alestrunda' ),
		'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'site_description_text' , array(
	) );
	
	//when adding control to a setting, this setting has to be already added
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'site_description_text', array(
		'label'      => __( 'Site description', 'alestrunda' ),
		'section'    => 'site_description',
		'settings'   => 'site_description_text',
		'type'		 => 'textarea'
	) ) );
}

add_action( 'customize_register', 'mytheme_customize_register' );
?>
