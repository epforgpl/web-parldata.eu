<?php
/*----------------------------------------*/
/*	Flickr Widget
/*----------------------------------------*/

add_action( 'widgets_init', 'reg_scribe_flickr' );

function reg_scribe_flickr() {
	register_widget( 'scribe_Flickr_Widget' );
}

class scribe_Flickr_Widget extends WP_Widget {

public function __construct() {
	parent::__construct(
 		'scribe_flickr', 
		'Flickr Photos', 
		array( 'description' => __( 'A widget that displays Flickr photos', 'scribe' ), )
	);
}

function widget( $args, $instance ) {
	extract( $args );


	$title = apply_filters('widget_title', $instance['title'] );
	$flickrID = $instance['flickrID'];
	

	$desc = $instance['desc'];


	echo $before_widget;

	if ( $title ) echo $before_title . $title . $after_title;

	?>
<?php if($desc != '') : ?>

<p><?php echo $desc; ?></p>
<?php endif; ?>
<div class="flickr-image-wrapper"> 
  <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=latest&amp;size=t&amp;layout=x&amp;source=user&amp;user=<?php echo $flickrID ?>"></script> 
  <script type="text/javascript">
		    jQuery(document).ready(function($){
		        $('.scribe_flickr_widget').imagesLoaded(function(){	
		    	});
		    });
		</script> 
</div>
<?php

	
	echo $after_widget;
}

function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
	$instance['desc'] = $new_instance['desc'];

	return $instance;
}

function form( $instance ) {


	$defaults = array(
		'title' => 'Flikr',
		'flickrID' => '',
		'display' => 'latest',
		'desc' => 'custom flickr widget',
		
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('Title:', 'scribe') ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'desc' ); ?>">
    <?php _e('Description:', 'scribe') ?>
  </label>
  <textarea class="widefat" rows="3" cols="15" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>"><?php echo $instance['desc']; ?></textarea>
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'flickrID' ); ?>">
    <?php _e('Flickr ID:', 'scribe') ?>
    (<a href="http://idgettr.com/">idGettr</a>)</label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
</p>
<?php
	} 
	
} 
?>
