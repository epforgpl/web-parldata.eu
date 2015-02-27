<?php
/**
 * Comments Template
 */

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>

<p class="nocomments">
  <?php _e('This post is password protected. Enter the password to view comments.', 'hv'); ?>
</p>
<?php
		return;
	}
?>
<div id="comments-template">
<div class="comments-section">
  <div id="comments">
    <?php if ( have_comments() ) : ?>
    <ol class="comments">
      <?php wp_list_comments( array( 'callback' => 'cl_comment' ) ); ?>
    </ol>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav id="comment-nav">
    <div class="nav-previous">
      <?php previous_comments_link( __( 'Older Comments', 'hv' ) ); ?>
    </div>
    <div class="nav-next">
      <?php next_comments_link( __( 'Newer Comments', 'hv' ) ); ?>
    </div>
  </div>
  <!-- .navigation -->
  <?php endif;  ?>
  <?php else : 

	
	if ( ! comments_open() ) :
?>
  <?php endif;  ?>
  <?php endif;  ?>
  
</div>
<!-- #comments --> 
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=>'<h5>'. __( 'Post A Comment','scribe' ) .'</h5>',
	'title_reply_to' => __( 'Post A Reply to %s','scribe' ),
	'cancel_reply_link' => __( 'Cancel Reply','scribe' ),
	'label_submit' => __( 'Submit','scribe' ),
	'comment_field' => '<textarea id="comment" placeholder="'.__( 'Write your message here...','scribe' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="col-md-3 clearfix"><div class="row1"><div class="column_inner"><input id="author" name="author" placeholder="'. __( 'Your Full Name','scribe' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="row2"><div class="column_inner"><input id="email" name="email" placeholder="'. __( 'E-mail Address','scribe' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'email' => '<div class="row3"><div class="column_inner"><input id="url" name="url" type="text" placeholder="'. __( 'Website','scribe' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div>'
		 ) ) );
 ?>
 <div class="comment_pager">
	<p><?php paginate_comments_links(); ?></p>
 </div>
 <div class="comment_form">
	<?php comment_form($args); ?>
</div>
