<?php

function get_age_func( $atts ){
	$params = shortcode_atts( array(
        'birth_year' => -1
    ), $atts );
	return (date("Y") - $params['birth_year']);
}

add_shortcode( 'getage', 'get_age_func' );
?>
