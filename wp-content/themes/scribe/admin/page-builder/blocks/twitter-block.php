<?php

if(!class_exists('PG_Twitter_Block')) {
	class PG_Twitter_Block extends AQ_Block {
		
		
		function __construct() {
			$block_options = array(
				'name' => 'Twitter Banner',
				'size' => 'span12',
				
			);
			
			//create the block
			parent::__construct('pg_twitter_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				
				  'twitname' =>'',
					'key' => '',
					'secret' =>'',
					'token' => '',
					'secret_token' => '',
					'pin_footer' => ''
					
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
	
			?>


<p class="description half">
  <label for="<?php echo $this->get_field_id('twitname') ?>"> Twitter Name<br/>
    <input id="<?php echo $this->get_field_id('twitname') ?>" class="input-full" type="text" value="<?php echo $twitname ?>" name="<?php echo $this->get_field_name('twitname') ?>">
  </label>
</p>

<p class="description half">
  <label for="<?php echo $this->get_field_id('key') ?>"> Consumer Key<br/>
    <input id="<?php echo $this->get_field_id('key') ?>" class="input-full" type="text" value="<?php echo $key ?>" name="<?php echo $this->get_field_name('key') ?>">
  </label>
</p>
<p class="description half last">
  <label for="<?php echo $this->get_field_id('secret') ?>"> Consumer Secret<br/>
    <input id="<?php echo $this->get_field_id('secret') ?>" class="input-full" type="text" value="<?php echo $secret ?>" name="<?php echo $this->get_field_name('secret') ?>">
  </label>
</p>
<p class="description half">
  <label for="<?php echo $this->get_field_id('token') ?>"> Access Token<br/>
    <input id="<?php echo $this->get_field_id('token') ?>" class="input-full" type="text" value="<?php echo $token ?>" name="<?php echo $this->get_field_name('token') ?>">
  </label>
</p>
<p class="description half last">
  <label for="<?php echo $this->get_field_id('secret_token') ?>"> Access Token Secret<br/>
    <input id="<?php echo $this->get_field_id('secret_token') ?>" class="input-full" type="text" value="<?php echo $secret_token ?>" name="<?php echo $this->get_field_name('secret_token') ?>">
  </label>
</p>
<?php
		}
		
		function block($instance) {
			extract($instance);
			
		

 
// Now display the tweets.


echo '</div></div></div></div></div>';
?>
<div class="twit-banner">
  <div class="container">
    <div id="tweets" class="twitter">
		<span><a href="http://twitter.com/<?php echo $twitname; ?>" target="_blank" class="social-btn"><i class="fa fa-twitter"> </i></a></span>
   <?php  
echo do_shortcode('[really_simple_twitter username="'.$twitname.'" consumer_key="'.$key.'" consumer_secret="'.$secret.'" access_token="'.$token.'" access_token_secret="'.$secret_token.'" num="1"]')?>
    </div>
  </div>
  
</div>


<?php
echo '<div class="container"><div class="row"><div class="col-md-12">';			
$content = ob_get_contents();

	return $content;

?>

<?php
			
			
		}
		
	}
}
?>
