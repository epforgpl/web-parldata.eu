<?php
/*--------------------------*
/* Tag Cloud Function
/*--------------------------*/

add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 12;
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}

add_filter( 'woocommerce_product_tag_cloud_widget_args', 'mys_widget_tag_cloud_args' );

function mys_widget_tag_cloud_args( $args ) {
	$args['number'] = 12;
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}

/*--------------------------*
/*  Comments
/*--------------------------*/

if ( ! function_exists( 'cl_comment' ) ) :
function cl_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li>
  <div class="comment">
    <div class="avatar-box"> <?php echo get_avatar( $comment, 32 ); ?> </div>
    <div class="meta"> <strong class="author"><a href="#"><?php echo get_comment_author_link(); ?></a></strong>
      <div class="box-row">
        <ul class="links-list">
          <li><a class="edit">
            <?php edit_comment_link( __( '(Edit)', 'scribe' ), ' ' ); ?>
            </a></li>
          <li>
            <?php comment_reply_link( array_merge( $args, array( 'class'=>'text-reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </li>
        </ul>
        <em class="date">
         <?php comment_date('F jS'); ?>
        </em> </div>
    </div>
    <div class="comment-box">
     
         
            
              <?php comment_text(); ?>
           
    </div>
  </div>
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'scribe'); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'scribe' ), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;


add_filter('comment_form_defaults', 'remove_comment_styling_prompt');

function remove_comment_styling_prompt($defaults) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}
?>