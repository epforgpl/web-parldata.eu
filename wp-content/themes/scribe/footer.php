</div></div>
		
<footer id="fill">
	
  <div class="container"><div id="footer" class="footer-content">
  <div class="logo">Check other applications created or supported by this project:</div>
	<?php /*?><div class="logo"><a href="<?php echo home_url(); ?>">
        <?php $foot_logo  = get_theme_mod('footer_logo_image'); 
        if(!empty($foot_logo)) { ?>
		<img src="<?php echo $foot_logo;?>" alt="logo" />
        <?php }
         else { ?>
        
          <?php bloginfo('name'); ?>
          
		  <?php }?>
	</a></div><?php */?>
    <?php $twitter  = get_theme_mod('twitter_text');  ?>
    <?php $facebook  = get_theme_mod('facebook_text');  ?>
    <?php $googleplus  = get_theme_mod('google1_text');  ?>
    <?php $dribbble  = get_theme_mod('dribbble_text');  ?>
    <?php $pinterest  = get_theme_mod('pinterest_text');  ?>
	<?php $vimeo  = get_theme_mod('vimeo_text');  ?>
    <?php $tumblr  = get_theme_mod('tumblr_text');  ?>
    <?php $youtube  = get_theme_mod('youtube_text');  ?>
	 <?php $stackof  = get_theme_mod('stackof_text');  ?>
	  <?php $instagram  = get_theme_mod('instagram_text');  ?>
	   <?php $linkedin  = get_theme_mod('linkedin_text');  ?>
	<section id="container">
	<!-- Style 2 -->
	<div id="menu-wrap">
 <?php if(!empty($facebook)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-facebook"></span>
				<a id="hover" class="text" href="http://www.facebook.com/<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a>
			</div><!-- Menu Item -->
			 <?php } ?>
        <?php if(!empty($twitter)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-twitter"></span>
				<a id="hover" class="text" href="http://www.twitter.com/<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a>
			</div><!-- Menu Item -->
        <?php } ?>
		<?php if(!empty($youtube)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-youtube"></span>
				<a id="hover" class="text" href="<?php echo $youtube ?>"><i class="fa fa-youtube"></i></a>
			</div><!-- Menu Item -->
			<?php } ?>
         <?php if(!empty($linkedin)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-linkedin"></span>
				<a id="hover" class="text" href="<?php echo $linkedin ?>"><i class="fa fa-linkedin"></i></a>
			</div><!-- Menu Item -->
         <?php } ?>
		 <?php if(!empty($googleplus)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-google-plus"></span>
				<a id="hover" class="text" href="<?php echo $googleplus ?>"><i class="fa fa-google-plus"></i></a>
			</div><!-- Menu Item -->
         <?php } ?>
		  <?php if(!empty($dribbble)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa fa-dribbble"></span>
				<a id="hover" class="text" href="<?php echo $dribbble ?>"><i class="fa fa fa-dribbble"></i></a>
			</div><!-- Menu Item -->
			 <?php } ?>
         <?php if(!empty($pinterest)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-pinterest-square"></span>
				<a id="hover" class="text" href="<?php echo $pinterest ?>"><i class="fa fa-pinterest-square"></i></a>
			</div><!-- Menu Item -->
       <?php } ?>
	   <?php if(!empty($stackof)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-stack-overflow"></span>
				<a id="hover" class="text" href="<?php echo $stackof ?>"><i class="fa fa-stack-overflow"></i></a>
			</div><!-- Menu Item -->
			 <?php } ?>
        <?php if(!empty($tumblr)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-tumblr"></span>
				<a id="hover" class="text" href="<?php echo $tumblr ?>"><i class="fa fa-tumblr"></i></a>
			</div><!-- Menu Item -->
         <?php } ?>
		  <?php if(!empty($instagram)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-instagram"></span>
				<a id="hover" class="text" href="<?php echo $instagram ?>"><i class="fa fa-instagram"></i></a>
			</div><!-- Menu Item -->
			 <?php } ?>
        <?php if(!empty($vimeo)){?>
			<div class="menu-item">
				<span id="active" class="icon fa fa-vimeo-square"></span>
				<a id="hover" class="text" href="<?php echo $vimeo ?>"><i class="fa fa-vimeo-square"></i></a>
			</div><!-- Menu Item -->
 <?php } ?>
	</div><!-- Menu Wrap -->
	</section><!-- Container -->
	<?php
	$f_columns = get_theme_mod('footer_columns');

	if ($f_columns == '4') {
	    $footer_widget_wrapper = 'sc_foot4';
	}

	elseif ($f_columns == '3') {
	    $footer_widget_wrapper = 'sc_foot3';
	}
	elseif ($f_columns == '2') {
	    $footer_widget_wrapper = 'sc_foot2';
	}
	 else {
	    $footer_widget_wrapper = 'sc_foot1';
	}
	
	?>
	
	  <div class="foot-sidebar <?php echo $footer_widget_wrapper; ?>">
	  <?php get_sidebar('footer')?>
	  
  </div>
  </div>
  

</div> <span class="scroll-wrapper"><a id="back-to-top" class="back-to-top" href="#main"> <i class="icon-arrow-up"></i></a></span>

</footer>
		
<?php wp_footer(); ?>

</body></html>

