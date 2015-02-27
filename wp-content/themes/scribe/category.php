<?php get_header();?>
    
        
    
	    <section class="sc-header-sub">
	       
	        <div class="containerCentered">
	            <div class="row">
	<h1 id="changingtext"><?php wp_title("", true); ?></h1>
	        </div>
	    </section>
	


	 <div class="container box">
	 
   <div class="row col-md-9">

	  <section class="sc-blog-section">
		  
      <?php  
	  
	  
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	  $author_link = get_the_author_link(); ?>
	   <?php $comments_count = wp_count_comments($post->ID); 
	  	$format = get_post_format(); 
	  	if( false === $format ) 
	  		$format = 'standard';     ?>
                        
                            
	                              <div class="row sc-blog-pow">
									  <div class="col-xs-1 col-md-1 sc-date-wrap"><span class="sc-date"><?php echo get_the_date('M j'); ?></span>
									  <?php if ( has_post_format( 'standard' )) { ?><span class="sc-post-format pe-7s-albums pe-2x img-center"></span>
									  <?php }  elseif ( has_post_format( 'gallery' )) { ?><span class="sc-post-format pe-7s-camera pe-2x img-center"></span>
									  <?php } elseif ( has_post_format( 'video' )) { ?><span class="sc-post-format pe-7s-video pe-2x img-center"></span>
									  <?php } else { ?><span class="sc-post-format pe-7s-albums pe-2x img-center"> <?php } ?></div>
	                                  <div class="col-md-10">
										   <a href="<?php the_permalink(); ?>">
										  <?php get_template_part('postformats/format', $format); ?>
	                                      <h3><?php the_title(); ?></h3></a>

	                                      <div class="article-info">
	                                          <span><?php echo $author_link; ?></span>
	                                          
											  	                                          <span class="sc-cat"> Posted In: <?php global $post; $categories = get_the_category($post->ID);
											  $separator = ', ';
											  $output = '';

											  if($categories){
											  	foreach($categories as $category) {
											  		$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", "scribe" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
											  	}
											  echo '  '.trim($output, $separator).'';
											  } ?></span>
	                                      </div>
	                                 
	                                      <p>
	                                           <?php the_excerpt(); ?>
	                                      </p> <div class="sc-tags"> <?php the_tags('',''); ?></div>
	                                  </div>
	                              
               </div>
	                       <hr class="wside"> 
                       
                          
	              
   
      <?php endwhile; endif;?>
 
	   </section>
   	  <div class="col-md-9 col-md-offset-2">
           <div class="centered">
             <?php
   global $wp_query;

   echo scribe_pagination(); 
   ?></div>
           </div>
    </div>
<?php get_sidebar(); ?>
      
      
      <?php wp_reset_query(); ?>
  </div> 

<?php if(get_post_meta($post->ID, "_sc_meta_value_key", true) ) { ?>

<?php } ?>

<?php get_footer();?>
