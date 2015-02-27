<?php

if(!class_exists('PG_InfoBanner_Block')) {
	class PG_Infobanner_Block extends AQ_Block {
		
		
		function __construct() {
			$block_options = array(
				'name' => 'Info Banner',
				
				'resizable' => 0,
			);
			
			//create the block
			parent::__construct('pg_infobanner_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				
				  'title' =>'',
					'textbig' => '',
					'text' =>''	,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
	
			?>

<p>Note: You should only use this block on a full-width template</p>
<p class="description">
  <label for="<?php echo $this->get_field_id('title') ?>"> Banner Title<br/>
    <?php echo aq_field_input('title', $block_id, $title) ?> </label>
</p>
<p class="description">
				<label for="<?php echo $this->get_field_id('textbig') ?>">Big Text<br/>
					<?php echo aq_field_textarea('textbig', $block_id, $textbig, $size = 'full') ?>
				</label>
			</p>
			
<p class="description">
				<label for="<?php echo $this->get_field_id('text') ?>"> Text<br/>
					<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				</label>
			</p>
 
			
<?php
		}
		
		function block($instance) {
			extract($instance);
				
	

echo '</div></div></div></div></div>';
 echo '<section class="sc-stretch-banner sc-info">
		<div class="container">';

echo '';
  echo  '<div class="col-md-6"><h2>'.$title.'</h2><h4>'.wpautop(do_shortcode(htmlspecialchars_decode($textbig))).'</h4></div>'; 
   echo '<div class="col-md-5 col-md-offset-1">'.wpautop(do_shortcode(htmlspecialchars_decode($text))).'</div>';
			echo '</div></section>';
  echo '<div class="container"><div class="row"><div class="col-md-12">';
			
$content = ob_get_contents();

	return $content;

?>

<?php
			
			
		}
		
	}
}
?>
