<?php get_header();?>
    
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			
	$format = get_post_format(); 
	if( false === $format ) 
		$format = 'standard'; ?>
     
	    <section class="sc-header-sub">
	       
	        <div class="containerCentered">
	            <div class="row">
	<h1 id="changingtext"><?php the_title(); ?></h1>
	        </div></div>
	    </section>
	


	 <div class="container box">
	 
   <div class="row col-md-9">

	  <section class="sc-blog-section">
		  
 
			 
                     <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" >  
                            
                             <div class="row sc-blog-pow">
								 
							  <div class="col-xs-1 col-md-1 sc-date-wrap"><span class="sc-date"><?php echo get_the_date('M j'); ?></span>
							  <?php if ( has_post_format( 'standard' )) { ?><span class="sc-post-format pe-7s-albums pe-3x img-center"></span>
							  <?php }  elseif ( has_post_format( 'gallery' )) { ?><span class="sc-post-format pe-7s-camera pe-3x img-center"></span>
							  <?php } elseif ( has_post_format( 'video' )) { ?><span class="sc-post-format pe-7s-video pe-3x img-center"></span>
							  <?php } else { ?><span class="sc-post-format pe-7s-albums pe-3x img-center"> <?php } ?></div>
                                 <div class="col-md-10">
										  <?php get_template_part('postformats/format', $format); ?>
	                                      <h3><?php the_title(); ?></h3>

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
	                                           <?php the_content(); ?>
	                                      </p> <div class="sc-tags"> <?php the_tags('',''); ?></div>
	                                  </div>
	                              
               </div>
	                       
                      
                          
	              
   
      <?php endwhile;?>
 
	   </section>
     <div class="col-md-10 col-md-offset-1"> <br/>
       <?php previous_post_link(); wp_link_pages();?>
       <div class="pull-right">
         <?php next_post_link(); ?>
       </div>
       <?php endif; ?>
       <?php comments_template( '', true ); ?>
     </div>
    </div></div></div>
<?php get_sidebar(); ?>
      
      
      <?php wp_reset_query(); ?>
  </div> 

<?php if(get_post_meta($post->ID, "_sc_meta_value_key", true) ) { ?>
<script>

jQuery(document).ready(function () {
(function($) {
  var repl = $('#changingtext span').text()
  var t=[ "<?php echo get_post_meta( $post->ID, '_sc_meta_value_key', true ); ?>",repl],
      $h1 = $("#changingtext"),
      $sp = $h1.find("span"),
      i=0,
      widths=[];

  $.each(t, function(i, v){
      var el = $('<span />', {text:v}).appendTo($h1);
      widths.push(el.width());
      el.remove();
  });
  
  $sp.css({opacity:0});
  
  (function loop(){
     i = ++i%t.length;    
     $sp.text(t[i]).animate({width:widths[i]}, 500, function(){
       $(this).animate({opacity:1},500).delay(4000).animate({opacity: 0}, 500, loop); 
      });     
  })(); 

})(jQuery);
});
</script>
<?php } ?>

<?php get_footer();?>