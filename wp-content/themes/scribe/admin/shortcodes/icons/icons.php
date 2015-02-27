<?php

	function wp_bt_icon($atts, $content = null, $code) 
	{
		extract(shortcode_atts( array(
			'style' => '',
			'size'  => '',
			'background' => ''
		), $atts));
			
			if($size == 'large') {
		$size_class = 'icon-2x';}
		else {
		$size_class = ''; 
	}
	
	if($background == 'yes') {
		$bg_class = 'ibackbg';}
		else {
		$bg_class = ''; 
	}
	
		$html = '';
		
		
			$html = '<i class="'.$style.' '.$size_class.' '.$bg_class.'"></i>';
		
		
		return $html;
	}

	add_shortcode('icon','wp_bt_icon');
	
?>