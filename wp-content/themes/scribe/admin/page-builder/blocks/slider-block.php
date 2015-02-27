<?php

if(!class_exists('PG_Slider_Block')) {
	class PG_Slider_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array (
				'name' => 'Slider',
				'size' => 'span12',
			);
			
			parent::__construct('pg_slider_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array (
				'slider_id' => 0,
				'load' => 6
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			global $wpdb;
			$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
			$revsliders[0] = 'Select a slider';
			if($get_sliders) {
			foreach($get_sliders as $slider) {
			$revsliders[$slider->alias] = $slider->title;
			}
			}
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('sliders') ?>">
					Choose Slider<br/>
					<?php echo aq_field_select('sliders', $block_id, $revsliders, $sliders); ?>
				</label>
			</p>
			
			<?php
		}
		
		function block($instance) {
			extract($instance);
			putRevSlider($sliders);
			
		}
	}
}


