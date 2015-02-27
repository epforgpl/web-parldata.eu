<?php
class PG_Video_Block extends AQ_Block {
	
	
	function __construct() {
		$block_options = array(
			'name' => 'Video',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('pg_video_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
	
	
	<p>To embed video in page enter embed code<br/>
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Embed Code
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		
		echo '<div class="video">';
			echo htmlspecialchars_decode($text);
		echo '</div>';
	}
	
}
?>
