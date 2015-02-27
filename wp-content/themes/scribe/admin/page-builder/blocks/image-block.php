<?php

if(!class_exists('PG_Image_Block')) {
	class PG_Image_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Image',
				'size' => 'span12',
			);
			
			parent::__construct('pg_image_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'img' => ''
				
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

<p class="description ">
  <label for="<?php echo $this->get_field_id('title') ?>"> Title (optional)<br/>
    <?php echo aq_field_input('title', $block_id, $title) ?> </label>
</p>
<p class="description">
  <label for="<?php echo $this->get_field_id('img') ?>"> Upload an image<br/>
    <?php echo aq_field_upload('img', $block_id, $img) ?> </label>
  <?php if($img) { ?>
<div class="screenshot"> <img src="<?php echo $img ?>" /> </div>
<?php } ?>
</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('link') ?>">
					Link (optional)
					<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
				</label>
			</p>
<?php
		}
		
		function block($instance) {
			extract($instance);
			


 if($link) echo '<a href="'.$link.'">'; ?>
 <img src="<?php echo $img;?>" />  <?php
  if($link) echo '</a>';
}} }