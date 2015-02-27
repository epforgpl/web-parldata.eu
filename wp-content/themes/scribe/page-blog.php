<?php
/*
Template Name: Blog / Sidebar
*/
?>
<?php get_header();?>
    
        
  		<?php if ( has_post_thumbnail() ) { ?>
				<section class="sc-parallax" style="background-image:url(<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true); echo $thumb_url[0]; ?>
			);font-size:;" data-stellar-background-ratio="0.5" >
					           <div class="row"><div class="containerCentered">
							<h3></h3></div> <div class="sc-mask"></div>
					            <div class="container">
			<section class="sc-header-sub">
	       
			   	        <div class="containerCentered">
			   	            <div class="row">
			   	<h1 id="changingtext"><?php the_title(); ?></h1>
			   	        </div>
			   	    </section>
					                </div> 
					            </div>
					        </section>
     <?php } else { ?>  
	   
	    <section class="sc-header-sub">
	       
   	        <div class="containerCentered">
   	            <div class="row">
   	<h1 id="changingtext"><?php the_title(); ?></h1>
   	        </div>
   	    </section>
		<?php } ?>
	


	 <div class="container box">
	 <div class="">
   <div class="row col-md-9">

	  <section class="sc-blog-section">
		  
      <?php  
	  
	  
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $the_query = query_posts(
        array(
            
            
            'orderby'=>'date',
			 'paged'=>$paged
			
        )
    );
    
 if (have_posts()) :
   $i=1;
			
   while (have_posts()) :
       the_post(); ?>
	   <?php $author_link = get_the_author_link(); ?>
	   <?php $comments_count = wp_count_comments($post->ID); 
	  	$format = get_post_format(); 
	  	if( false === $format ) 
	  		$format = 'standard';     ?>
                        
                             <div <?php post_class(); ?> id="post-<?php the_ID(); ?>" >
	                              <div class="row sc-blog-pow">
									  <div class="col-xs-1 col-md-1 sc-date-wrap"><span class="sc-date"><?php echo get_the_date('M j'); ?></span>
									  <?php if ( has_post_format( 'standard' )) { ?><span class="sc-post-format pe-7s-albums pe-3x img-center"></span>
									  <?php }  elseif ( has_post_format( 'gallery' )) { ?><span class="sc-post-format pe-7s-camera pe-3x img-center"></span>
									  <?php } elseif ( has_post_format( 'video' )) { ?><span class="sc-post-format pe-7s-video pe-3x img-center"></span>
									  <?php } else { ?><span class="sc-post-format pe-7s-albums pe-3x img-center"> <?php } ?></div>
	                                  <div class="col-md-10">
										   <a href="<?php the_permalink(); ?>">
										  <?php get_template_part('postformats/format', $format); ?>
	                                      <h3><?php the_title(); ?></h3></a>

	                                      <div class="article-info">
	                                          <span><?php echo $author_link; ?></span>
	                                          
											  	                                          <span class="sc-cat"> / <?php global $post; $categories = get_the_category($post->ID);
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
	                                  
									  <hr class="wside"> 
	                              </div>
               </div>
	                       
                       
                          
	              </div>
   
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
