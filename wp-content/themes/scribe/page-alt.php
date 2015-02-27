<?php
/*
Template Name: Large Slider
*/
?>

<?php get_header(); 
global $post;
$slider = get_post_meta( $post->ID, 'sc_slider', true ) ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();  ?>
	
	<div id="slider">
	<?php putRevSlider($slider) ?>
	<?php
	if ( is_front_page() ) { ?>
	         <div class="control-bar">
	           
<div class="sc-scroll">
                   <span class="scroll-btn"><a href="#content"> <span class="mouse"><span> </span></span>
                   </a></span>
				   </div>
	            </div>
	        
				<?php } else {} ?>
	  </div>
	
   
    

	<div class="row">
	  <div class="container" name="content">
        
		
       
	    <?php the_content(); ?>
	  </div>
	  <?php endwhile; ?>
	  <?php endif; ?>
	</div></div>
	<?php get_footer();?>