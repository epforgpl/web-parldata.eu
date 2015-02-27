<?php

class PAKB_SEARCH_KNOWLEDGEBASE extends WP_Widget {

    function __construct() {
	$widget_ops = array( 'description' => __('Search Knowledge Base', 'pressapps') );
        $control_ops = array( 'title' => __('Search Knowledge Base', 'pressapps') );

	parent::WP_Widget( 'knowledgebase_search_posts', __('Knowledge Base Search', 'pressapps'), $widget_ops, $control_ops );
    }

    function widget($args, $instance) {
	global $wpdb, $current_site, $post;

	extract($args);

	$options = $instance;

	global $pakb_settings;
	if( isset($pakb_settings['knowledgebase_page']) && $pakb_settings['knowledgebase_page'] != 0 ){
		$page_link = get_permalink( $pakb_settings['knowledgebase_page'] );
	} else {
		echo '<p>Knowledge Base page not set under Settings > Knowledge Base</p>';
	}

	$title = apply_filters('widget_title', empty($instance['title']) ? __('Search Knowledge Base', 'pressapps') : $instance['title'], $instance, $this->id_base);
	?>
	<?php echo $before_widget; ?>
	<?php echo $before_title . $title . $after_title; ?>
        <form role="search" method="get" id="kbsearchform" action="<?php echo home_url('/'); ?>" >
            <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" />
            <input type="hidden" name="post_type" value="knowledgebase" />
        </form>
    <?php echo $after_widget; ?>
	<?php
    }

    function update($new_instance, $old_instance) {
	$instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title' => __('Search Knowledge Base', 'pressapps')) );
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form($instance) {
	$instance = wp_parse_args( (array) $instance, array( 'title' => __('Search Knowledge Base', 'pressapps')));
        $options = array('title' => strip_tags($instance['title']));

	?>
	<div style="text-align:left">
            <label for="<?php echo $this->get_field_id('title'); ?>" style="line-height:35px;display:block;"><?php _e('Title', 'pressapps'); ?>:<br />
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $options['title']; ?>" type="text" style="width:95%;" />
            </label>
	    <input type="hidden" name="knowledgebase-submit" id="knowledgebase-submit" value="1" />
	</div>
	<?php
    }
}
