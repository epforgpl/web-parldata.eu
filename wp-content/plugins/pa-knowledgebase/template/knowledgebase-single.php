
<?php global $pakb_settings; ?>
<?php pakb_search(); ?>

<?php
while(pakb_have_posts()) : pakb_the_post();
?>
	<article class="knowledgebase-single">
	    <div class="knowledgebase-meta">
	        <p>
	            <time class="updated" datetime="<?php echo get_the_modified_date('c'); ?>" pubdate><?php echo __('Last Updated:', 'pressapps') . ' '. human_time_diff(get_the_modified_date('U'), current_time('timestamp')) . ' ' . __('ago', 'pressapps'); ?></time> <?php pakb_the_category(); ?>
	            <?php pakb_the_tags(); ?>
	        </p>
	    </div>
	    <div class="knowledgebase-content">
	        <?php 
	        if ( has_post_thumbnail() ) { 
	          the_post_thumbnail();
	        } 
	        ?>
	    	<?php pakb_the_content(); ?>
	    </div>

	    <?php 
	    if ( $pakb_settings['voting'] != 0 && !pakb_post_password_required())  {
	        pakb_votes();
	    }
	    ?>
    </article>
<?php
endwhile;
?>