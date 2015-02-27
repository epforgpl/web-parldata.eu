<?php 
	
		if ( get_post_meta( $post->ID, "sc_audio", true ) ) : 
	
	 	echo apply_filters('the_content', get_post_meta( $post->ID, "sc_audio", true ));

		endif;
	endwhile;