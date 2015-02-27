<?php
/** Showcase Block **/

if (!class_exists('PG_Showcase_Block'))
	{
	class PG_Showcase_Block extends AQ_Block

		{
		function __construct()
			{
			$block_options = array(
				'name' => 'App Showcase',
				'size' => 'span12',
				'resizeable' => 0
			);
			parent::__construct('pg_Showcase_block', $block_options);
			add_action('wp_ajax_aq_block_showcase_add_new', array(
				$this,
				'add_showcase'
			));
			}

		function form($instance)
			{
			$defaults = array(
				'showcases' => array(
					1 => array(
						'title' => 'Title',
						'text' => '',
						'icon' => '',
						'type' => 'left'
					)
				) ,
			);
			$device_options = array(
				'iphone' => 'iPhone',
				'ipad' => 'iPad',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
?>
		    <p class="description">
					<label for="<?php
			echo $this->get_field_id('title') ?>">
						Main Heading (optional)<br/>
						<?php
			echo aq_field_input('title', $block_id, $title) ?>
					</label>
				</p>
			    <p class="description">
						<label for="<?php
				echo $this->get_field_id('subtitle') ?>">
							Sub Heading (optional)<br/>
							<?php
				echo aq_field_input('subtitle', $block_id, $subtitle) ?>
						</label>
					</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('device') ?>">
					Select device<br/>
					<?php echo aq_field_select('device', $block_id, $device_options, $device); ?>
				</label>
			</p>
			<br/>
			<div class="description cf">
				
				<ul id="aq-sortable-list-<?php
			echo $block_id ?>" class="aq-sortable-list" rel="<?php
			echo $block_id ?>">
					<?php
			$showcases = is_array($showcases) ? $showcases : $defaults['showcases'];
			$count = 1;
			foreach($showcases as $showcase)
				{
				$this->showcase($showcase, $count);
				$count++;
				}

?>
				</ul>
				<p></p>
				<a href="#" rel="showcase" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
<?php
			}

		function showcase($showcase = array() , $count = 0)
			{
			$defaults = array(
				'title' => '',
				'text' => '',
				'icon' => ''
			);
			$showcase = wp_parse_args($showcase, $defaults);
?>
			<li id="<?php
			echo $this->get_field_id('showcases') ?>-sortable-item-<?php
			echo $count ?>" class="sortable-item" rel="<?php
			echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php
			echo $showcase['title'] ?></strong>
					</div>
					<div class="sortable-handle half">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('showcases') ?>-<?php
			echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php
			echo $this->get_field_id('showcases') ?>-<?php
			echo $count ?>-title" class="input-full" name="<?php
			echo $this->get_field_name('showcases') ?>[<?php
			echo $count ?>][title]" value="<?php
			echo $showcase['title'] ?>" />
						</label>
					</p>
					
							
			  		<p class="description">
									<label for="<?php echo $this->get_field_id('showcases') ?>-<?php echo $count ?>-upload">
										Upload Screenshot (iPhone - 249px by 440px) or (iPad - 377px by 502px)<br/>
										
										<input type="text" id="<?php echo $this->get_field_id('showcases') ?>-<?php echo $count ?>-upload" class="input-full input-upload" value="<?php echo $showcase['upload'] ?>" name="<?php echo $this->get_field_name('showcases') ?>[<?php echo $count ?>][upload]">
										<a href="#" class="aq_upload_button button" rel="img">Upload</a>
						
									</label>
								</p>
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('showcases') ?>-<?php
			echo $count ?>-text">
							Text<br/>
							<textarea id="<?php
			echo $this->get_field_id('showcases') ?>-<?php
			echo $count ?>-text" class="textarea-full" name="<?php
			echo $this->get_field_name('showcases') ?>[<?php
			echo $count ?>][text]" rows="5"><?php
			echo $showcase['text'] ?></textarea>
						</label>
					</p>
					
							
			       
				<label>
					<p class="description half"></p>
		</label>
					<p class="description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			
			
			<?php
			}

		function add_showcase()
			{
			$nonce = $_POST['security'];
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			// default key/value for the tab

			$showcase = array(
				'title' => 'New screenshot',
				'link' => '',
				'icon' => '',
				'text' => ''
			);
			if ($count)
				{
				$this->showcase($showcase, $count);
				}
			  else
				{
				die(-1);
				}

			die();
			}

		function block($instance)
			{
				$i=1;
			extract($instance);
?>
	        <section class="container Showcase">
				
	          
				   <div class="containerCentered">
			<h3><?php
			echo $title ?></h3>
            <p class="lead">
				<?php
							echo $subtitle ?>
            </p>	
		</div> <div class="main <?php echo $device; ?>">
				<div id="sc-wrapper" class="sc-wrapper">
					<?php foreach($showcases as $showcase) {
					echo '<h2 class="sc-title"><span>'.wpautop($showcase['title']).'</span></h2>';
					
					if($i == 1) break;
				} ?>
					<div class="sc-<?php echo $device; ?> sc-device">
					   <?php 
					   foreach($showcases as $showcase) {
						echo '<a href="#"><img src="'.htmlspecialchars(stripslashes($showcase['upload'])).'"/></a>';
						
					  echo '<span class="sc-text sc-sub">'.stripslashes(wpautop( wptexturize($showcase['text']))).'</span>';
					    
						 if($i == 1) break;
					} ?>
						<nav>
							<span><i class="pe-7s-angle-left-circle"></i></span>
							<span><i class="pe-7s-angle-right-circle"></i></span>
						</nav>
					</div>
					<div class="sc-grid">
					<?php	foreach($showcases as $showcase) { ?>
						
					<a href="#"><img src="<?php echo htmlspecialchars(stripslashes($showcase['upload'])) ?>"/><span><?php echo stripslashes(wpautop( wptexturize($showcase['title']))) ?></span><span3><?php echo stripslashes(wpautop( wptexturize($showcase['text']))) ?></span3></a>
						
					       
					 <?php  } 
						
					  ?>
					</div>
				</div>	
							
			</div>
		         
		        </section>
				
			<script>
			jQuery(document).ready(function( $ ) {
				$(function() {
					AppShowcase.init();
				});
			});
			</script>
				
			
			<?php
			}

		function update($new_instance, $old_instance)
			{
			return $new_instance;
			
			
			}
		}
	} ?>
	
