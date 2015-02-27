<?php

if(!class_exists('PG_Stretchbanner_Block')) {
	class PG_Stretchbanner_Block extends AQ_Block {
		
		
		function __construct() {
			$block_options = array(
				'name' => 'Stretch Banner',
				
				'resizable' => 0,
			);
			
			//create the block
			parent::__construct('pg_stretchbanner_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				
				  'title' =>'',
					'img' => '',
					'text' =>''	,
					'parallax_background' =>''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
	
			?>

<p>Note: You should only use this block on a full-width template</p>
<p class="description half">
  <label for="<?php echo $this->get_field_id('title') ?>"> Banner Title<br/>
    <?php echo aq_field_input('title', $block_id, $title) ?> </label>
</p>
<p class="description half">
  <label for="<?php echo $this->get_field_id('img') ?>"> Upload an image<br/>
    <?php echo aq_field_upload('img', $block_id, $img) ?> </label>
  <?php if($img) { ?>
<div class="screenshot"> <img src="<?php echo $img ?>" /> </div>
<?php } ?>
</p>
			<p class="description half last">
			  <label for="<?php echo $this->get_field_id('bgimg') ?>"> Upload a second image (optional)<br/>
			    <?php echo aq_field_upload('bgimg', $block_id, $bgimg) ?> </label>
			  <?php if($bgimg) { ?>
			<div class="screenshot"> <img src="<?php echo $bgimg ?>" /> </div>
			<?php } ?>
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
				
	

echo '</div></div></div>';
 echo '<section class="sc-stretch-banner">
		<div class="container">';

echo '';
  echo  '<div class="col-md-6 sc-pow stretch-banner-img"><a href="http://parldata.eu/wp-content/uploads/report-pdf-print.pdf" target="_blank"><img src="'.$img.'" class="overlay1"/><img src="'.$bgimg.'" class="overlay2"/></a></div>'; 
   echo '<div class="col-md-6 sc-text"><h2>'.$title.'</h2><i>This publication surveys and evaluates availability and openness of a large number of key parliamentary data types in 12 parliamentary chambers in the Visegrad and Western Balkan countries (Albania, Bosnia and Hercegovina, Czech Republic, Hungary, Kosovo, Montenegro, Poland, Serbia, Slovakia). 
<br/>
<br/>
Its aim is to help increase availability, quality and re-usability of parliamentary information by comparing the surveyed parliamentary chambers, identifying strengths and weaknesses and recommending specific strategies to mitigate them. Download the publication <a href="http://parldata.eu/wp-content/uploads/report-pdf-print.pdf">here</a> or check the executive summary in your language at page <a href="http://parldata.eu/report/">"Report"</a>.
<br/><br/>
<a href="http://parldata.eu/wp-content/uploads/2015/02/report-text.txt">download text</a>, <a href="http://parldata.eu/wp-content/uploads/2015/02/report-data.tsv">download data</a></i></div>';
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
