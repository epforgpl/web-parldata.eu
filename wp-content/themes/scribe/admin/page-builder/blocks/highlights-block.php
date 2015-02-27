<?php
/** Highlights Block **/

if (!class_exists('PG_Highlights_Block'))
	{
	class PG_Highlights_Block extends AQ_Block

		{
		function __construct()
			{
			$block_options = array(
				'name' => 'Highlights',
				'size' => 'span12',
				'resizeable' => 0
			);
			parent::__construct('pg_highlights_block', $block_options);
			add_action('wp_ajax_aq_block_highlight_add_new', array(
				$this,
				'add_highlight'
			));
			}

		function form($instance)
			{
			$defaults = array(
				'highlights' => array(
					1 => array(
						'title' => 'Highlight',
						'text' => '',
						'icon' => '',
						'type' => 'left'
					)
				) ,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			$icon_options = array(
				'pe-7s-' => 'theme icons',
				'' => 'fontawesome icons',
			);
?>
		    <p class="description">
					<label for="<?php
			echo $this->get_field_id('title') ?>">
						Title (optional)<br/>
						<?php
			echo aq_field_input('title', $block_id, $title) ?>
					</label>
				</p>
			    <p class="description half">
						<label for="<?php
				echo $this->get_field_id('subtitle') ?>">
							Sub Heading (optional)<br/>
							<?php
				echo aq_field_input('subtitle', $block_id, $subtitle) ?>
						</label>
					</p>
					<p class="description half last">
						<label for="<?php echo $this->get_field_id('fontset') ?>">
							Icon Set <br />
							<?php echo aq_field_select('fontset', $this->block_id, $icon_options, $fontset) ?>
						</label>
					</p>
			<p class="description">
	        <label for="<?php
			echo $this->get_field_id('img') ?>"> Upload an image<br/>
			    <?php
			echo aq_field_upload('img', $block_id, $img) ?> </label>
			  <?php
			if ($img)
				{ ?>
			<div class="screenshot"> <img src="<?php
				echo $img ?>" /> </div>
			<?php
				} ?>
			</p>
			
			<div class="description cf">
				
				<ul id="aq-sortable-list-<?php
			echo $block_id ?>" class="aq-sortable-list" rel="<?php
			echo $block_id ?>">
					<?php
			$highlights = is_array($highlights) ? $highlights : $defaults['highlights'];
			$count = 1;
			foreach($highlights as $highlight)
				{
				$this->highlight($highlight, $count);
				$count++;
				}

?>
				</ul>
				<p></p>
				<a href="#" rel="highlight" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
<?php
			}

		function highlight($highlight = array() , $count = 0)
			{
			$defaults = array(
				'title' => '',
				'text' => '',
				'icon' => ''
			);
			$highlight = wp_parse_args($highlight, $defaults);
?>
			<li id="<?php
			echo $this->get_field_id('highlights') ?>-sortable-item-<?php
			echo $count ?>" class="sortable-item" rel="<?php
			echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php
			echo $highlight['title'] ?></strong>
					</div>
					<div class="sortable-handle half">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-title" class="input-full" name="<?php
			echo $this->get_field_name('highlights') ?>[<?php
			echo $count ?>][title]" value="<?php
			echo $highlight['title'] ?>" />
						</label>
					</p>
			        <p class="description">
						<label for="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-icon">
							Icon<br/>
							Icon Class - <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">refer here</a><br/>
							<input type="text" id="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-icon" class="input-full" name="<?php
			echo $this->get_field_name('highlights') ?>[<?php
			echo $count ?>][icon]" value="<?php
			echo $highlight['icon'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-text">
							Text<br/>
							<textarea id="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-text" class="textarea-full" name="<?php
			echo $this->get_field_name('highlights') ?>[<?php
			echo $count ?>][text]" rows="5"><?php
			echo $highlight['text'] ?></textarea>
						</label>
					</p>
				<p class="description">
					<label for="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-side">
						Which side of image? (type 'left' or 'right')<br/>
						<input type="text" id="<?php
			echo $this->get_field_id('highlights') ?>-<?php
			echo $count ?>-side" class="input-half" name="<?php
			echo $this->get_field_name('highlights') ?>[<?php
			echo $count ?>][side]" value="<?php
			echo $highlight['side'] ?>" />
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

		function add_highlight()
			{
			$nonce = $_POST['security'];
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			// default key/value for the tab

			$highlight = array(
				'title' => 'New Highlight',
				'link' => '',
				'icon' => '',
				'text' => ''
			);
			if ($count)
				{
				$this->highlight($highlight, $count);
				}
			  else
				{
				die(-1);
				}

			die();
			}

		function block($instance)
			{
			extract($instance);
?>
	        <section class="container">
	           
	                <div class="containerCentered">
			<h3><?php
			echo $title ?></h3>
            <p class="lead">
				<?php
							echo $subtitle ?>
            </p></div>	
			<div id="highlights_<?php
			echo rand(1, 100) ?>" class="highlights cf">
				<div class="col-md-3 col-sm-12 sc-highlightleft">
				
				<?php
			foreach($highlights as $highlight)
				{
				$defaults = array(
					'title' => '',
					'link' => '',
					'text' => ''
				);
				$highlight = wp_parse_args($highlight, $defaults);

				// $position =''; if( isset( $type ) && $type == true) {$position='highlight_hide';

?>
                        
                            <div class="feature-box <?php
				echo htmlspecialchars(stripslashes($highlight['side'])) ?>">
								<div class="col-md-10 col-sm-12">
                                <h4><?php
				echo htmlspecialchars(stripslashes($highlight['title'])) ?></h4>
                               <?php
				echo wpautop(htmlspecialchars(stripslashes($highlight['text']))) ?>
                            </div>
							<div class="col-md-2 col-sm-12 sc-highlight-icon">
								<i class="fa <?php echo $fontset;?><?php
				echo htmlspecialchars(stripslashes($highlight['icon'])) ?>"></i>
								</div></div>
										<?php
				} ?>
                            </div>
                        <div class="col-md-6 col-sm-12 sc_up highlight-img">
							
								<a href="">
                            <img src="<?php
			echo $img; ?>" alt="">
		</a>
		</div>
                       
                        <div class="col-md-3 col-sm-12 sc-highlightright">
							<?php
			foreach($highlights as $highlight)
				{
				$defaults = array(
					'title' => '',
					'link' => '',
					'text' => ''
				);
				$highlight = wp_parse_args($highlight, $defaults);
?>
                        
			                            <div class="feature-box <?php
				echo htmlspecialchars(stripslashes($highlight['side'])) ?>">
											<div class="col-md-2 col-sm-12 sc-highlight-icon">
											<i class="fa <?php echo $fontset;?><?php
				echo htmlspecialchars(stripslashes($highlight['icon'])) ?>"></i>
											</div>
											<div class="col-md-10 col-sm-12 ">
			                                <h4><?php
				echo htmlspecialchars(stripslashes($highlight['title'])) ?></h4>
			                               <?php
				echo wpautop(htmlspecialchars(stripslashes($highlight['text']))) ?>
			                            </div>
										</div>
													<?php
				} ?>
						
						
						
					
						
				
				
				
				
		                </div>
		            </div>
				</div>
		        </section>
			</div>
			
				
				
			
			
			<?php
			}

		function update($new_instance, $old_instance)
			{
			return $new_instance;
			}
		}
	} ?>
