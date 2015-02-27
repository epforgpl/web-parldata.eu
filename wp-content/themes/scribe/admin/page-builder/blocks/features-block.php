<?php

if(!class_exists('PG_Features_Block')) {
	class PG_Features_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Features',
				'size' => 'span4'
			);
			
			parent::__construct('pg_features_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title' => '',
				'icon' => '',
				'text' => '',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$icon_options = array(
				'pe-7s-' => 'theme icons',
				'' => 'fontawesome icons',
			);
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('fontset') ?>">
					Icon Set <br />
					<?php echo aq_field_select('fontset', $this->block_id, $icon_options, $fontset) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('icon') ?>">
					Icon Class - <a href="http://pixelgrapes.com/docs/scribe/icons" target="_blank">refer here</a><br/>
					<?php echo aq_field_input('icon', $block_id, $icon) ?>
					Add 'pe-2x' to increase size
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('text') ?>">
					Feature text
					<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('button') ?>">
					Button text
					<?php echo aq_field_input('button', $block_id, $button, $size = 'full') ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('link') ?>">
					Button link
					<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
				</label>
			</p>
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			
			echo '<div class="sc-feature-box text-center">';
			if($button) echo '<a href="'.$link.'" >';
			if($icon) echo  '<div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a"><span class="hi-icon hi-icon-mobile sc-icon fa '.$fontset.$icon.' img-center margin-top-20"></span></div>';
			if($button) echo '</a>';
		
			echo '<h4>'.$title.'</h4>';
			echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
			
			 echo '<p class="margin-top-20">';
			 
			if($button) echo '<a  class="btn btn-large hollow margin-top-20" href="'.$link.'" >'.$button.'</a>';
			 echo '</div>';
		}
		
	}
}


