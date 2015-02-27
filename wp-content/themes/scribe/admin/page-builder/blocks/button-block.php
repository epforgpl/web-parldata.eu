<?php

if(!class_exists('PG_Button_Block')) {
	class PG_BUtton_Block extends AQ_Block {
		
	
		function __construct() {
			
			$block_options = array(
				'name' => 'Button',
				'size' => 'span2',
				
			);
			

			parent::__construct('pg_button_block', $block_options);
			
		}
		
		function form($instance) {
			
			$defaults = array(
				'button_url' => '',
				'new_window' => 'no',
				'button_text' => '',
				'center' => 'no',
				'hollow' => 'no',
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$options = array("no" => "no", "yes" => "yes");
			$sizes = array("default" => "default", "xs" => "mini", "sm" => "small", "lg" => "large");
			?>
			
      <p class="description half">
				<label for="<?php echo $this->get_field_id('button_text') ?>">
					Button Text
					<input id="<?php echo $this->get_field_id('button_text') ?>" class="input-full" type="text" value="<?php echo $button_text ?>" name="<?php echo $this->get_field_name('button_text') ?>">
				</label>
			</p>
      <p class="description half">
				<label for="<?php echo $this->get_field_id('button_url') ?>">
					Button Link<br/>
					<?php echo aq_field_input('button_url', $block_id, $button_url) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('new_window') ?>">
					Should the link open in a new window?
					<?php echo aq_field_select('new_window', $block_id, $options, $new_window) ?>
				</label>
			</p>
			
			
			<?php
		}
		
	function block($instance) {
			extract($instance);
			
			if($new_window == 'yes')
				$target = '_blank';
			else
				$target = '';
			
			
		echo '<a href="'.$button_url.'" target="'.$target.'"><button class="btn btn-large hollow">'.$button_text.'</button></a>'; 
  
			

			
		}
		
	}
}