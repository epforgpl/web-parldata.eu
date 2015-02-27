<?php

function wp_hv_button($atts, $content = null, $code) 
{
	extract(shortcode_atts(array(
		'id' => 'false',
		'class' => 'false',
		'link' => '',
		'linktarget' => '',
		'size' => '',
		), $atts));
	
	if($id != 'false') { $id = ' id="'.$id.'" '; } else { $id = ''; }
	if($class != 'false') { $class = ''.$class.'" '; } else { $class = ''; }
	
	if($link != '') { $link = ' href="'.$link.'" '; }
	
	if($linktarget != '') { $linktarget = ' target="'.$linktarget.'" '; }
	
	
		
	$content = '<a'.$link.$linktarget.' class="btn btn-'.$size.'"><span>' . trim($content) . '</span></a>';
	
		return $content;
	
}

add_shortcode('event-button','event_button');

function event_button($atts, $content = null, $code) 
{
	extract(shortcode_atts(array(
		'text' => ''
		), $atts));
	
	
	
	
		
	$content = '<button class="ex-trigger btn animated pulse" data-modal="modal-12">'.$text.'</button>';
	
		return $content;
	
}

add_shortcode('event-button','event_button');

?>