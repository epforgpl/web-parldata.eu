<?php

if(!class_exists('PG_Posts_Block')) {
	class PG_Posts_Block extends AQ_Block {
		
		
		function __construct() {
			$block_options = array(
				'name' => 'Recent Posts',
				'size' => 'span12',
				'resizable' => 0,
			);
			
			//create the block
			parent::__construct('pg_posts_block', $block_options);
		}
		
		function form($instance) {
			
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
	
			?>

<p>Note: You should only use this block on a full-width template</p>
<p class="description">
  <label for="<?php echo $this->get_field_id('title') ?>"> Title (optional)<br/>
    <input id="<?php echo $this->get_field_id('title') ?>" class="input-full" type="text" value="<?php echo $title ?>" name="<?php echo $this->get_field_name('title') ?>">
  </label>
</p>

<p class="description half last">
  <label for="<?php echo $this->get_field_id('catpost') ?>"> Category Slug (optional)<br/>
    <input id="<?php echo $this->get_field_id('catpost') ?>" class="input-full" type="text" value="<?php echo $catpost ?>" name="<?php echo $this->get_field_name('catpost') ?>">
  </label>
</p>
<?php
		}
		
		function block($instance) {
			extract($instance);
			
		
			
		    ?>
<div class="row-fluid">
<div class="post-row blog-row">
  <div id="postsCarousel" class="carousel postCarousel slide">
    <?php

$args = array('post_type'=> '',
            'ignore_sticky_posts'   => 1,
						'posts_per_page' => '12',
						'category_name' => $catpost
						);
query_posts($args);
if ( have_posts() ) : $d = 1; 
?>
    <!-- Carousel items -->
    <div class="carousel-inner">
      <div class="<?php if($d=="1"){ echo 'active' ; } ?> item row-fluid">
        <?php  
        $is_div = false;
        $rposts = new WP_Query( $args );
		$count_post = $rposts->post_count;
	while ( $rposts->have_posts() ) : $rposts->the_post();  ?>
        <div class="col-md-4 post blogitem">
          <div class="post-carousel">
			  <a href="<?php echo get_permalink() ?>">
            <?php the_post_thumbnail('Blog Pic'); ?>
		</a>
          </div>
          
              <h4><a href="<?php echo get_permalink() ?>">
                <?php the_title(); ?>
                </a></h4>
              <?php the_excerpt() ?>
            
          <?php
                
                		if( $d % 3 == 0 ){
							echo '</div></div><div class="item row-fluid">' ;  
						} elseif ( $d == 12) {
							echo '</div>';
						
						} else {
							echo '</div>';
						
				
				} 
			?>
          <?php $d++; endwhile; ?>
        </div>
      </div>
      <?php endif; 
  
						wp_reset_query();?>
    </div>
  </div>
</div>
<?php
			
$content = ob_get_contents();

	return $content;

			
			
		}
		
		function update($new_instance, $old_instance) {
			$new_instance['title'] = htmlspecialchars(stripslashes($new_instance['title']));
			return $new_instance;
		}
		
	}
}
