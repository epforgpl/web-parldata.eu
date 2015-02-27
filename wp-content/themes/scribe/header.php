<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php wp_title( '|', true, 'right' ); ?>
<?php echo bloginfo( 'name' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_theme_mod('favicon_image'); ?>">

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<?php wp_head(); ?>
<script type="text/javascript" src="https://epforgpl.github.io/ParlData-Widgets/js/widget-visegrad.js"></script>

</head>

<body <?php body_class(); ?>>
	
	 <div class="loader"></div>
	 <div id="main">
	<div class="">
	
	<div class="navbar navbar-default navbar-fixed-top sc-nav" role="navigation">
		<!-- BEGIN: NAV-CONTAINER -->
		<?php 
		  if ( is_admin_bar_showing() ) echo '<div style="min-height: 28px;"></div>'; 
		?>
		<div class="nav-container container">
	    	<div class="navbar-header">
	        	<!-- BEGIN: TOGGLE BUTTON (RESPONSIVE)-->
	        	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		        	<span class="sr-only">Toggle navigation</span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        </button>
		        
	        	<!-- BEGIN: LOGO -->
			   <?php $logo  = get_theme_mod('logo_image'); 
			         $logo_small  = get_theme_mod('logo_image_small');
					 if(!empty($logo_small)) { ?>
						               <a class="brand sc-logo-large" href="<?php echo home_url(); ?>"> <img class="a" src="<?php echo $logo;?>" alt=""> </a>
					 			       <a class="brand sc-logo-small" href="<?php echo home_url(); ?>"> <img class="a" src="<?php echo $logo_small;?>" alt=""> </a>
					 			       <?php }
			   		 elseif(!empty($logo)) { ?>
			       <a class="brand" href="<?php echo home_url(); ?>"> <img class="a" src="<?php echo $logo;?>" alt=""> </a>
			       <?php }
			   		 else { ?> <div class="logo-text">
			       <a class="brand" href="<?php echo home_url(); ?>">
			       <?php bloginfo('name'); ?>
			       </a> </div><?php }?>
	        </div>
	       	<?php do_action('icl_language_selector'); ?>
	       	<!-- BEGIN: MENU -->       
	        
			
	        <?php
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'primary',
	                'depth'             => 3,
	                'container'         => 'div',
	                'container_class'   => 'collapse navbar-collapse',
	        'container_id'      => 'sc-navbar-collapse-main',
	                'menu_class'        => 'nav navbar-nav',
	                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                'walker'            => new wp_bootstrap_navwalker())
	            );
	        ?>
			<!-- END: MENU -->
		</div>
		<!--END: NAV-CONTAINER -->               
	
			
		 </div></div>
	        
			
