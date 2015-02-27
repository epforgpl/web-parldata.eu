<?php

class PG_Countdown_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Countdown',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('pg_countdown_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'wp_autop' => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('countdown') ?>">
				Date (format: 2014/09/24)
				<?php echo aq_field_input('countdown', $block_id, $countdown, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		?>
		<section class="countdown">
		<div class="col-sm-12 col-md-12 col-lg-12 text-center">
			<h3><?php echo strip_tags($title) ?></h3>
			<h4 class="subtitle"></h4>
			<h1 id="countdown">42 weeks 01 days <br> 01:57:04</h1>
</section>

	<script>
	//The Final Countdown for jQuery v2.0.2 (http://hilios.github.io/jQuery.countdown/)
// * Copyright (c) 2013 Edson Hilios
// just change year and date
jQuery(document).ready(function () {
		jQuery('#countdown').countdown('<?php echo do_shortcode(htmlspecialchars_decode($countdown)) ?>', function(event) {
		jQuery(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
	});
});
	</script>	
	<?php	
	}
	
}
