<?php $dynamic_sidebar = get_post_meta( $post->ID, 'dynamic_sidebar', true ); ?>
<div class="sidebar">
<div class="col-md-3">

<?php if(!empty($dynamic_sidebar)):
                  dynamic_sidebar($dynamic_sidebar) ;
					else : dynamic_sidebar('main');
					 ?>
<?php endif;?>
</div>
</div>