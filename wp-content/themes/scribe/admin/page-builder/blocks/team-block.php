<?php
/** A simple text block **/
if(!class_exists('PG_Team_Block')) {
	class PG_Team_Block extends AQ_Block {
		
		/* PHP5 constructor */
		function __construct() {
			
			$block_options = array(
				'name' => 'Team',
				'size' => 'span6'
			);
			
			//create the widget
			parent::__construct('pg_team_block', $block_options);
			
		}
		
		function form($instance) {
			
			$defaults = array(
		'title' 	=> '', // the name of the team member
		'position'	=> '', // job position
		'avatar'	=> '', // profile picture
		'bio'		=> '', // a little info about the member
		'url'		=> '', // website URL
		'twitter' 	=> '', // twitter URL
		'facebook'	=> '', // facebook URL
		'linkedin'	=> '', // linkedin URL
		'google'	=> '', // google+ URL
	);

	// set default values (if not yet defined)
	$instance = wp_parse_args($instance, $defaults);

	// import each array key as variable with defined values
	extract($instance);
		
			?>
      
      
			<p class="description half">
	<label for="<?php echo $this->get_field_id('title') ?>">
		Name (required)<br/>
		<?php echo aq_field_input('title', $block_id, $title) ?>
	</label>
</p>

<p class="description half last">
	<label for="<?php echo $this->get_field_id('position') ?>">
		Position (required)<br/>
		<?php echo aq_field_input('position', $block_id, $position) ?>
	</label>
</p>

<div class="description">
	<label for="<?php echo $this->get_field_id('avatar') ?>">
		Upload an image<br/>
		<?php echo aq_field_upload('avatar', $block_id, $avatar) ?>
	</label>
	<?php if($avatar) { ?>
	<div class="screenshot">
		<img src="<?php echo $avatar ?>" />
	</div>
	<?php } ?>
</div>

<p class="description">
	<label for="<?php echo $this->get_field_id('bio') ?>">
		Member info
		<?php echo aq_field_textarea('bio', $block_id, $bio, $size = 'full') ?>
	</label>
</p>

<p class="description half">
	<label for="<?php echo $this->get_field_id('twitter') ?>">
		Twitter<br/>
		<?php echo aq_field_input('twitter', $block_id, $twitter) ?>
	</label>
</p>

<p class="description half last">
	<label for="<?php echo $this->get_field_id('facebook') ?>">
		Facebook<br/>
		<?php echo aq_field_input('facebook', $block_id, $facebook) ?>
	</label>
</p>

<p class="description half">
	<label for="<?php echo $this->get_field_id('linkedin') ?>">
		LinkedIn<br/>
		<?php echo aq_field_input('linkedin', $block_id, $linkedin) ?>
	</label>
</p>

<p class="description half last">
	<label for="<?php echo $this->get_field_id('google') ?>">
		Google +1<br/>
		<?php echo aq_field_input('google', $block_id, $google) ?>
	</label>
</p>
			
			
			
			<?php
		}
		
	function block($instance) {
			extract($instance); 
			echo '<div id="effect-5">';
			if($avatar) echo  '<div class="team-img animated slideUp"><figure><img src="'.$avatar.'"/>';
			echo '<figcaption>';
			if($title) echo '<div class="team-box"><h4>'.strip_tags($title). '</h4>';
			if($position) echo '<h5>'.strip_tags($position). '</h5>';
			echo wpautop(do_shortcode(htmlspecialchars_decode($bio)));
			
			echo '<div class="social">';
			
			if($twitter) echo '<a class="twittered" data-original-title="twitter" data-tip="top" target="_blank" href="'.strip_tags($twitter). '" ><i class="icon-twitter"></i></a>';
			if($facebook) echo '<a class="facebook" data-original-title="facebook" data-tip="top" target="_blank" href="'.strip_tags($facebook). '"><i class="icon-facebook"></i></a>';
			if($linkedin) echo '<a class="linkedin" data-original-title="linkedin" data-tip="top" target="_blank" href="'.strip_tags($linkedin). '"><i class="icon-linkedin"></i></a>';
			if($google) echo '<a class="googleplus" data-original-title="google +1" data-tip="top" target="_blank" href="'.strip_tags($google). '"><i class="icon-google-plus"></i></a>';
			echo ' <a href="#" class="close-caption hidden">x</a>';
			echo '</figcaption></figure></div></div>';
			
		}
		
	}
	
}


