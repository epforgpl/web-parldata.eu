<?php
/*
Template Name: Parallax Full Page
*/
?>
<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   	    
	
 
	<section class="sc-parallax sc-full" style="background-image:url(<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true); echo $thumb_url[0]; ?>
);font-size:;" data-stellar-background-ratio="0.5" >
		           <div class="row"></div> <div class="sc-mask"></div>
		            <div class="container">
<?php the_content(); ?>
		                </div> 
		            </div>
		        </section> 

	  
    
  </div>
  <?php endwhile; ?>
  <?php endif; ?>
  </div></div>

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
       $(this).animate({opacity:1},500).delay(3000).animate({opacity: 0}, 500, loop); 
      });     
  })(); 

})(jQuery);
});
</script>
<?php } ?>
<?php get_footer();?>
