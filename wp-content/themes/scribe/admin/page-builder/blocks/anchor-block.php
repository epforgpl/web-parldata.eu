<?php

if(!class_exists('PG_Anchor_Block')) {
	class PG_Anchor_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Anchor Link',
				'size' => 'span12',
			);
			
			parent::__construct('pg_anchor_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'anchor' => ''
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>


			<p class="description">
				<label for="<?php echo $this->get_field_id('anchor') ?>">
					Anchor Text (no spaces)
					<?php echo aq_field_input('anchor', $block_id, $anchor, $size = 'full') ?>
				</label>
			</p>
<?php
		}
		
		function block($instance) {
			extract($instance);
			
 ?>
 <a name="<?php echo $anchor;?>"></a> 
 
  <?php
 
}} }