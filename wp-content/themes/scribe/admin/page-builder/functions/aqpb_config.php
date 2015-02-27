<?php
/**
 * Aqua Page Builder Config
 *
 * This file handles various configurations
 * of the page builder page
 *
 */
function aq_page_builder_config() {

	$config = array(); //initialise array
	
	/* Page Config */
	$config['menu_title'] = __('Page Builder', 'scribe');
	$config['page_title'] = __('Page Builder', 'scribe');
	$config['page_slug'] = __('aq-page-builder', 'scribe');
	
	/* This holds the contextual help text - the more info, the better.
	 * HTML is of course allowed in all of its glory! */
	$config['contextual_help'] = 
		'<p>' . __('The page builder allows you to create custom page templates which you can later use for your pages.', 'scribe') . '<p>' .
		'<p>' . __('To use the page builder, start by adding a new template. You can drag and drop the blocks on the left into the building area on the right of the screen. Each block has its own unique configuration which you can manually configure to suit your needs', 'scribe') . '<p>' .
		'<p>' . __('Please refer to the', 'scribe') . '<a href="http://pixelgrapes.com/docs/scribe/icons" target="_blank" alt="Scribe Builder Documentation">'. __(' icon documentation ', 'scribe') . '</a>'. __('for a list of icons which can be used.', 'scribe') . '<p>';
	
	/* Debugging */
	$config['debug'] = false;
	
	return $config;
	
}