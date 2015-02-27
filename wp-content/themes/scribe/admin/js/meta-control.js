jQuery(document).ready(function($) {

function show_boxes(){

	//POST FORMAT GALLERY METABOXES
	if ( $('input#post-format-gallery').is(':checked') || $('input#post-format-image').is(':checked') ) {
		$('#gallery_metabox').show();
	}
	else {
		$('#gallery_metabox').hide();
	}
	
	
	//POST FORMAT VIDEO METABOXES
	if ( $('input#post-format-video').is(':checked') || $('input#post-format-audio').is(':checked') ) {
		$('#video_metabox').show();
	}
	else {
		$('#video_metabox').hide();
	}
	
};

//CALL SHOW_BOXES
show_boxes();

//CALL SHOW_BOXES AGAIN ON INPUT CLICK
$('input').click(function(){
	show_boxes();
});

$('select#page_template').change(function(){
	show_boxes();
});
	
});