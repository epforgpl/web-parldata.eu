<?php

add_action( 'customize_register', 'scribe_theme_customizer_register' );

function scribe_theme_customizer_register($wp_customize) {
	
require_once(scribe_ADMIN . '/customizer/google-fonts.php');
	
     //scribe Options
  $wp_customize->add_section( 'scribe_theme_customizer_basic', array(
		'title' => __( 'Logo & Favicon', 'scribe' ),
		'priority' => 100
	) );
	
	//Logo Image
	$wp_customize->add_setting( 'logo_image', array( 
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
		'label' => __( 'Logo Upload', 'scribe' ),
		'section' => 'scribe_theme_customizer_basic',
		'settings' => 'logo_image'
		
	) ) );
		
		//Logo Image Small
		$wp_customize->add_setting( 'logo_image_small', array( 
		) );
	
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image_small', array(
			'label' => __( 'Scroll Logo Upload (optional)', 'scribe' ),
			'section' => 'scribe_theme_customizer_basic',
			'settings' => 'logo_image_small'
		
		) ) );
		
		//Footer Logo Image
		$wp_customize->add_setting( 'footer_logo_image', array( 
		) );
	
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo_image', array(
			'label' => __( 'Footer Logo Upload', 'scribe' ),
			'section' => 'scribe_theme_customizer_basic',
			'settings' => 'footer_logo_image'
		
		) ) );
	
	//Favicon Image
	$wp_customize->add_setting( 'favicon_image', array( 
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon_image', array(
		'label' => __( 'Favicon Upload', 'scribe' ),
		'section' => 'scribe_theme_customizer_basic',
		'settings' => 'favicon_image',
		
	) ) );
	

	
	//Highlight Color
  $wp_customize->add_setting( 'highlight_color', array(
	'default' => '#34D298',
	'sanitize_callback' => 'sanitize_hex_color',
	 'transport' => 'postMessage'
	) );
	

	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color', array(
		'label'   => __( 'Highlight Color', 'scribe' ),
		'section' => 'colors',
		'settings'   => 'highlight_color'
		
	) ) );
	
	//Typography
	$wp_customize->add_section( 'scribe_theme_customizer_typography', array(
		'title' => __( 'Typography', 'scribe' ),
		'priority' => 500
	) );
	
	$wp_customize->add_setting( 'body_font', array(
		'default' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
		'transport'=>'postMessage'
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'body_font', array(
		'label'   => __( 'Select a Font', 'scribe' ),
		'section' => 'scribe_theme_customizer_typography',
		'type' => 'select',
		'settings'   => 'body_font',
	  'choices'   =>  
            $googlefonts
            ,
	) ) );
	
	//Footer
	$wp_customize->add_section( 'scribe_theme_customizer_footer', array(
		'title' => __( 'Footer', 'scribe' ),
		'priority' => 600
	) );
	
	
	$wp_customize->add_setting( 'footer_columns', array( 'default' => '1', ) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_columns', array(
		'label'   => __( 'Footer Widget Columns', 'scribe' ),
		'section' => 'scribe_theme_customizer_footer',
		'type' => 'select',
		'settings'   => 'footer_columns',
	  'choices'   =>  array("1" =>"1", "2" => "2", "3" => "3", "4" => "4"), 
            
            
	) ) );
	
	//Social Settings
	$wp_customize->add_section( 'scribe_theme_customizer_social', array(
		'title' => __( 'Social Settings', 'scribe' ),
		'priority' => 700
	) );
	
	$wp_customize->add_setting( 'twitter_text', array(
		'default' => '',
		 'priority' => 1
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_text', array(
		'label'   => __( 'Twitter username', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'twitter_text',
		
	) ) );
	
	
	$wp_customize->add_setting( 'facebook_text', array(
		'default' => '',
		 'priority' => 2
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_text', array(
		'label'   => __( 'Facebook username', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'facebook_text',
		
	) ) );
	
	$wp_customize->add_setting( 'pinterest_text', array(
		'default' => '',
		 'priority' => 3
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'pinterest_text', array(
		'label'   => __( 'Pinterest url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'pinterest_text',
		
	) ) );
	
	$wp_customize->add_setting( 'google1_text', array(
		'default' => '',
		 'priority' => 4
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google1_text', array(
		'label'   => __( 'Google1 url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'google1_text',
		
	) ) );
	
	
	$wp_customize->add_setting( 'dribbble_text', array(
		'default' => '',
		 'priority' => 5
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'dribbble_text', array(
		'label'   => __( 'Dribbble url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'dribbble_text',
		
	) ) );
	
	$wp_customize->add_setting( 'tumblr_text', array(
		'default' => '',
		 'priority' => 6
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'tumblr_text', array(
		'label'   => __( 'Tumblr url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'tumblr_text',
		
	) ) );
	
	$wp_customize->add_setting( 'youtube_text', array(
		'default' => '',
		 'priority' => 7
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_text', array(
		'label'   => __( 'YouTube url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'youtube_text',
		
	) ) );
	
	$wp_customize->add_setting( 'instagram_text', array(
		'default' => '',
		 'priority' => 8
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'instagram_text', array(
		'label'   => __( 'Instagram url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'instagram_text',
		
	) ) );
	
	$wp_customize->add_setting( 'vimeo_text', array(
		'default' => '',
		 'priority' => 9
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vimeo_text', array(
		'label'   => __( 'Vimeo url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'vimeo_text',
		
	) ) );
	
	$wp_customize->add_setting( 'stackof_text', array(
		'default' => '',
		 'priority' => 10
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'stackof_text', array(
		'label'   => __( 'Stack Overflow url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'stackof_text',
		
	) ) );
	
	$wp_customize->add_setting( 'linkedin_text', array(
		'default' => '',
		 'priority' => 1
	) );
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'linkedin_text', array(
		'label'   => __( 'LinkedIn url', 'scribe' ),
		'section' => 'scribe_theme_customizer_social',
		'settings'   => 'linkedin_text',
		
	) ) );
	

	
	//Real Time Settings Preview
	
	$wp_customize->get_setting('blogname')->transport='postMessage';	
	$wp_customize->remove_control( 'header_textcolor');
  $wp_customize->remove_control( 'display_header_text');
	$wp_customize->remove_control( 'background_color');
	 $wp_customize->remove_section( 'background_image');
}
