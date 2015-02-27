<?php

if(!class_exists('PG_Progressbar_Block')) {
	class PG_Progressbar_Block extends AQ_Block {
		
	
		function __construct() {
			
			$block_options = array(
				'name' => 'Progress Bar',
				'size' => 'span12',
				
			);
			

			parent::__construct('pg_progressbar_block', $block_options);
			
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => '',
				'style' => '',
				'width' => ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
		
			
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)
					<input id="<?php echo $this->get_field_id('title') ?>" class="input-full" type="text" value="<?php echo $title ?>" name="<?php echo $this->get_field_name('title') ?>">
				</label>
			</p>
			
      <p class="description half last">
				<label for="<?php echo $this->get_field_id('width') ?>">
					Enter the percentage as number
					<?php echo aq_field_input('width', $block_id, $width) ?>
				</label>
			</p>
			<?php
		}
		
	function block($instance) {
			extract($instance);
			
			
	echo '<h4>'.$title.'</h4>';
			
			echo '<div class="progress progress-striped"><div class="bar" style= "float:left; width:0%;" data-percentage="'.$width .'"></div></div>';
			
			

			
		}
		
	}
}