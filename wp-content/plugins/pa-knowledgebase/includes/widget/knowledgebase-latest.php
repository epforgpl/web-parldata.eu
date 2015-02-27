<?php

class PAKB_LATEST_KNOWLEDGEBASE extends WP_Widget {

    function __construct() {
	$widget_ops = array( 'description' => __('Latest Knowledge Base', 'pressapps') );
    $control_ops = array( 'title' => __('Latest Knowledge Base', 'pressapps'), 'numberposts' => '10' );

	parent::WP_Widget( 'knowledgebase_latest', __('Knowledge Base Latest', 'pressapps'), $widget_ops, $control_ops );
    }

    function widget($args, $instance) {
	global $wpdb, $current_site, $post;

	extract($args);

	$options = $instance;

	$title = apply_filters('widget_title', empty($instance['title']) ? __('Latest Knowledge Base', 'pressapps') : $instance['title'], $instance, $this->id_base);
	$numberposts = $instance['numberposts'];

	global $pakb_settings;

	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
	<?php
    $args = array(
			'post_type' => 'knowledgebase',
			'orderby' => 'post_date',
			'order' => 'DESC',
			'numberposts' => $numberposts,
		    );
	?>
	    <ul>
		<?php
		$postslist = get_posts( $args );
		foreach ( $postslist as $post ) :
		  setup_postdata( $post );
				?>
				    <li><a href="<?php the_permalink(); ?>"><i class="<?php echo pakb_icon(); ?>"></i> <?php the_title(); ?></a></li>
		<?php
		endforeach; 
		wp_reset_postdata();
		?>
	    </ul>
        <?php echo $after_widget; ?>
	<?php
    }


    function update($new_instance, $old_instance) {
	$instance                   = $old_instance;
        $new_instance               = wp_parse_args( (array) $new_instance, array( 'title' => __('Latest Knowledge Base', 'pressapps'), 'numberposts' => '10') );
        $instance['title']          = strip_tags($new_instance['title']);
	$instance['numberposts']    = $new_instance['numberposts'];

        return $instance;
    }

    function form($instance) {
	$instance   = wp_parse_args( (array) $instance, array( 'title' => __('Latest Knowledge Base', 'pressapps'), 'numberposts' => '10'));
        $options    = array('title' => strip_tags($instance['title']), 'numberposts' => $instance['numberposts']);

	?>
	<div style="text-align:left">
            <label for="<?php echo $this->get_field_id('title'); ?>" style="line-height:35px;display:block;"><?php _e('Title', 'pressapps'); ?>:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $options['title']; ?>" type="text" style="width:95%;" />
            </label>
            <label for="<?php echo $this->get_field_id('numberposts'); ?>" style="line-height:35px;display:block;"><?php _e('Number of Posts', 'pressapps'); ?>:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" value="<?php echo $options['numberposts']; ?>" type="text" style="width:25%;" />
            </label>
	    <input type="hidden" name="knowledgebase-submit" id="knowledgebase-submit" value="1" />
	</div>
	<?php
    }
}
