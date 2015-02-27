<?php 
	global $post;
	
	$attachments = get_post_meta( $post->ID, 'sc_gallery_list', true );
	
	if ( $attachments ) : 
?>

	<div class="flexslider">
	    <ul class="slides">
	  		
	  		<?php 
	  			foreach ( $attachments as $attachment ){
	  				echo '<li><img src="'.$attachment.'" alt="'.get_the_title().'"/></li>';
	  			}
	  		?>
	    
	     </ul>
	 </div><!--end flexslider-->

<?php 
	endif;
?>
 

