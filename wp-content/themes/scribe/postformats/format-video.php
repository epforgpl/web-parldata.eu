	<?php 
		if ( get_post_meta( $post->ID, "sc_video", true ) ) : 
			echo '<div class="video">';
	 	echo apply_filters('the_content', get_post_meta( $post->ID, "sc_video", true ));
		echo '</div>';
		endif;
		?>