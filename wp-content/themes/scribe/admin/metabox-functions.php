<?php

function sc_custom_metaboxes_jquery() {
        wp_enqueue_script('custom_script', get_template_directory_uri().'/admin/js/meta-control.js', array('jquery'), false, true);
}
add_action('admin_enqueue_scripts', 'sc_custom_metaboxes_jquery', 9999); 

add_filter( 'cmb_render_imag_select_taxonomy_id', 'imag_render_imag_select_taxonomy_id', 10, 2 );
function imag_render_imag_select_taxonomy_id( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => '&#8212; Select &#8212;',
            'hierarchical' => 1,
            'taxonomy' => $field['taxonomy'],
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field['id'],
            'selected' => $meta  

        ));
    if ( !empty($field['desc']) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
  
function new_custom_metaboxes( $meta_boxes ) {
	$prefix = 'sc_'; // Prefix for all fields
	
$meta_boxes[] = array(
		'id' => 'gallery_metabox',
		'title' => __('Add a Gallery', 'scribe'),
		'pages' => array('post', 'page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Attach gallery images',
				'desc' => 'Add your images here to create a sliding gallery.',
				'id' => $prefix . 'gallery_list',
				'type' => 'file_list',
			),
		)
	);

	
	$meta_boxes[] = array(
		'id' => 'video_metabox',
		'title' => __('Add Main Video', 'scribe'),
		'pages' => array('post', 'page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'OEmbed',
				'desc' => 'Enter your video embed link.',
				'id'   => $prefix . 'video',
				'type' => 'textarea_code',
			),
		
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'slider_metabox',
		'title' => __('Add Slider Alias', 'scribe'),
		'pages' => array('page'), // post type
		'context' => 'side',
		'priority' => 'low',
		'show_names' => true, 
		'fields' => array(
			array(
				'name' => 'Slider',
				'desc' => 'Enter Slider Alias.',
				'id'   => $prefix . 'slider',
				'type' => 'text',
			),
		
		)
	);


	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'new_custom_metaboxes' );

// Initialize the metabox class
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}
?>