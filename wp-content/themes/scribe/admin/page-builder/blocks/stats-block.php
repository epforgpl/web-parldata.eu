<?php
/* Pricing Tables Block */
if(!class_exists('PG_Stats_Block')) {
	class PG_Stats_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Statistics Counter',
				'size' => 'span4'
			);
			
			parent::__construct('pg_stats_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title' => 'Normal',
				'icon' => 'free',
				'stats' => '',
				'text' => '',
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			
			?>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('stat') ?>">
					Number<br/>
					<?php echo aq_field_input('stat', $block_id, $stat) ?>
				</label>
			</p>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('stat_text') ?>">
					Text<br/>
					<?php echo aq_field_input('stat_text', $block_id, $stat_text) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('stat_icon') ?>">
					Icon Class - <a href="http://pixelgrapes.com/docs/scribe/icons" target="_blank">refer here</a><br/>
					<?php echo aq_field_input('stat_icon', $block_id, $stat_icon) ?>
					Add 'pe-2x' to increase size
				</label>
			</p>
			
      
			<?php
			
		}
		
		function block($instance) {
			extract($instance);
			
			echo '<div class="sc_stats">';
			if($stat_icon) echo  '<span class="icon fa pe-7s-'.$stat_icon.'"></span>';
			
			if($stat) echo '<div class="stat-counter"><span class="timer highlight" data-from="0" data-refresh-interval="50" data-to="'.strip_tags($stat). '" data-speed="5000">0</span> <div class="milestone-details">';
			
			echo wpautop(do_shortcode(htmlspecialchars_decode($stat_text).'</div>'));
			echo '</div></div>';
		}
		
	}
}
