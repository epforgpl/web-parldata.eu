<?php
/** tours Block **/

if (!class_exists('PG_Tour_Block'))
	{
	class PG_Tour_Block extends AQ_Block

		{
		function __construct()
			{
			$block_options = array(
				'name' => 'Tour',
				'size' => 'span12',
				'resizeable' => 0
			);
			parent::__construct('pg_tour_block', $block_options);
			add_action('wp_ajax_aq_block_tour_add_new', array(
				$this,
				'add_tour'
			));
			}

		function form($instance)
			{
			$defaults = array(
				'tours' => array(
					1 => array(
						'title' => 'Tour',
						'text' => '',
						'icon' => ''
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
			    <p class="description">
						<label for="<?php
				echo $this->get_field_id('subtitle') ?>">
							Sub Heading (optional)<br/>
							<?php
				echo aq_field_input('subtitle', $block_id, $subtitle) ?>
						</label>
					</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('fontset') ?>">
					Icon Set <br />
					<?php echo aq_field_select('fontset', $this->block_id, $icon_options, $fontset) ?>
				</label>
			</p>
			
			<div class="description cf">
				
				<ul id="aq-sortable-list-<?php
			echo $block_id ?>" class="aq-sortable-list" rel="<?php
			echo $block_id ?>">
					<?php
			$tours = is_array($tours) ? $tours : $defaults['tours'];
			$count = 1;
			foreach($tours as $tour)
				{
				$this->tour($tour, $count);
				$count++;
				}

?>
				</ul>
				<p></p>
				<a href="#" rel="tour" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
<?php
			}

		function tour($tour = array() , $count = 0)
			{
			$defaults = array(
				'title' => '',
				'text' => '',
				'icon' => ''
			);
			$tour = wp_parse_args($tour, $defaults);
?>
			<li id="<?php
			echo $this->get_field_id('tours') ?>-sortable-item-<?php
			echo $count ?>" class="sortable-item" rel="<?php
			echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php
			echo $tour['title'] ?></strong>
					</div>
					<div class="sortable-handle half">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-title" class="input-full" name="<?php
			echo $this->get_field_name('tours') ?>[<?php
			echo $count ?>][title]" value="<?php
			echo $tour['title'] ?>" />
						</label>
					</p>
			        <p class="description">
						<label for="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-icon">
							Icon<br/>
							
							<input type="text" id="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-icon" class="input-full" name="<?php
			echo $this->get_field_name('tours') ?>[<?php
			echo $count ?>][icon]" value="<?php
			echo $tour['icon'] ?>" />
						</label>
					</p>
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-text">
							Text<br/>
							<textarea id="<?php
			echo $this->get_field_id('tours') ?>-<?php
			echo $count ?>-text" class="textarea-full" name="<?php
			echo $this->get_field_name('tours') ?>[<?php
			echo $count ?>][text]" rows="5"><?php
			echo $tour['text'] ?></textarea>
						</label>
					</p>
	  		<p class="description">
							<label for="<?php echo $this->get_field_id('tours') ?>-<?php echo $count ?>-upload">
								Upload Image<br/>
								<input type="text" id="<?php echo $this->get_field_id('tours') ?>-<?php echo $count ?>-upload" class="input-full input-upload" value="<?php echo $tour['upload'] ?>" name="<?php echo $this->get_field_name('tours') ?>[<?php echo $count ?>][upload]">
								<a href="#" class="aq_upload_button button" rel="img">Upload</a>
						
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

		function add_tour()
			{
			$nonce = $_POST['security'];
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			// default key/value for the tab

			$tour = array(
				'title' => 'New tour',
				'link' => '',
				'icon' => '',
				'text' => ''
			);
			if ($count)
				{
				$this->tour($tour, $count);
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
?><div class="containerCentered"><h3><?php
			echo $title ?></h3>
            <p class="lead">
				<?php
							echo $subtitle ?>
            </p></div>	
            <section class="sc-tour">
                <div class="container">
			
			
				
				<?php
				
			foreach($tours as $tour)
				{
				$defaults = array(
					'title' => '',
					'icon' => '',
					'text' => ''
					
				);
				$tour = wp_parse_args($tour, $defaults);

				
				
?>
                         
   	                    <div class="row sc-tour-row">
   	                        <div class="tour-icon">
			   											<i class="fa <?php echo $fontset;?><?php
			   				echo htmlspecialchars(stripslashes($tour['icon'])) ?>"></i>
   	                        </div>
   	                        <div class="col-sm-10 col-sm-offset-2">
								<div class="col-md-7 sc-tour-text">
   	                            <h3><?php
				echo htmlspecialchars(stripslashes($tour['title'])) ?></h3>
   	                            <p>
								                               <?php
									echo stripslashes(wpautop( wptexturize($tour['text']))) ?>
   	                            </p>
								</div>
								<div class="col-md-5">
   	                            
   	                                <div class="tour-img img">
   	                                    <img src="<?php echo $tour['upload'] ?>" alt="">
	                               
   	                                </div>
   	                           
								</div>
   	                        </div>
   	                    </div>          
									 
								
													<?php 
				} ?>
						
						
						
					
						
				
				
				
				
		               
		            </div>
		        </section>
				
			
	         
				
			
			
			<?php
			}

		function update($new_instance, $old_instance)
			{
			return $new_instance;
			}
		}
	} ?>
