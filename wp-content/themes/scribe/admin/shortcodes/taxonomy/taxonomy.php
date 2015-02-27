<?php


function list_terms_custom_taxonomy( $atts ) {



	extract( shortcode_atts( array(
		'custom_taxonomy' => '',
	), $atts ) );


$args = array( 
taxonomy => $custom_taxonomy,
title_li => ''
);


echo '<ul>'; 
echo wp_list_categories($args);
echo '</ul>';
}


add_shortcode( 'sc_terms', 'list_terms_custom_taxonomy' );



add_filter('widget_text', 'do_shortcode');
	
?>