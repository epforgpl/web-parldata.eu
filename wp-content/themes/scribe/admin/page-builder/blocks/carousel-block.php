<?php
/** Carousel Block **/

if (!class_exists('PG_Carousel_Block'))
	{
	class PG_Carousel_Block extends AQ_Block

		{
		function __construct()
			{
			$block_options = array(
				'name' => 'Clients',
				'size' => 'span12',
				'resizeable' => 0
			);
			parent::__construct('pg_carousel_block', $block_options);
			add_action('wp_ajax_aq_block_carousel_add_new', array(
				$this,
				'add_carousel'
			));
			}

		function form($instance)
			{
			$defaults = array(
				'carousels' => array(
					1 => array(
						'title' => 'Clients',
						'link' => '',
						
					)
				) ,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
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
			
			
			<div class="description cf">
				
				<ul id="aq-sortable-list-<?php
			echo $block_id ?>" class="aq-sortable-list" rel="<?php
			echo $block_id ?>">
					<?php
			$carousels = is_array($carousels) ? $carousels : $defaults['carousels'];
			$count = 1;
			foreach($carousels as $carousel)
				{
				$this->carousel($carousel, $count);
				$count++;
				}

?>
				</ul>
				<p></p>
				<a href="#" rel="carousel" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
<?php
			}

		function carousel($carousel = array() , $count = 0)
			{
			$defaults = array(
				'title' => '',
				'text' => '',
				'icon' => ''
			);
			$carousel = wp_parse_args($carousel, $defaults);
?>
			<li id="<?php
			echo $this->get_field_id('carousels') ?>-sortable-item-<?php
			echo $count ?>" class="sortable-item" rel="<?php
			echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php
			echo $carousel['title'] ?></strong>
					</div>
					<div class="sortable-handle half">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="description">
						<label for="<?php
			echo $this->get_field_id('carousels') ?>-<?php
			echo $count ?>-title">
							Client<br/>
							<input type="text" id="<?php
			echo $this->get_field_id('carousels') ?>-<?php
			echo $count ?>-title" class="input-full" name="<?php
			echo $this->get_field_name('carousels') ?>[<?php
			echo $count ?>][title]" value="<?php
			echo $carousel['title'] ?>" />
						</label>
					</p>
			       
					
	  		<p class="description">
							<label for="<?php echo $this->get_field_id('carousels') ?>-<?php echo $count ?>-upload">
								Upload Image<br/>
								<input type="text" id="<?php echo $this->get_field_id('carousels') ?>-<?php echo $count ?>-upload" class="input-full input-upload" value="<?php echo $carousel['upload'] ?>" name="<?php echo $this->get_field_name('carousels') ?>[<?php echo $count ?>][upload]">
								<a href="#" class="aq_upload_button button" rel="img">Upload</a>
						
							</label>
						</p>
	
		<p class="description">
									<label for="<?php
						echo $this->get_field_id('carousels') ?>-<?php
						echo $count ?>-link">
										Link (optional)<br/>
										<input type="text" id="<?php
						echo $this->get_field_id('carousels') ?>-<?php
						echo $count ?>-link" class="input-full" name="<?php
						echo $this->get_field_name('carousels') ?>[<?php
						echo $count ?>][link]" value="<?php
						echo $carousel['link'] ?>" />
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

		function add_carousel()
			{
			$nonce = $_POST['security'];
			if (!wp_verify_nonce($nonce, 'aqpb-settings-page-nonce')) die('-1');
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			// default key/value for the tab

			$carousel = array(
				'title' => 'New Item',
				'link' => '',
				
			);
			if ($count)
				{
				$this->carousel($carousel, $count);
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
	<div class="containerCentered"><h3><?php
				echo $title ?></h3>
	            <p class="lead">
					<?php
								echo $subtitle ?>
	            </p></div>
										<section id="sc-Carousel">


			
			   
							
			   				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			   					<div id="carousel-sc" class="carousel slide controls-slider">
			   					 
			    
                        
			   						<div class="carousel-inner1">
			   							
				<?php
				$count2= 0;
			foreach($carousels as &$carousel)
				{
					$count2++; 
					
				$defaults = array(
					'title' => '',
					'icon' => '',
					'text' => ''
				);
				$carousel = wp_parse_args($carousel, $defaults);

				
				
?>
				   <?php if($count2=="1") {echo '<div class= "active item"><div class="row">';}?>
				   		
				   									<div class="col-xs-6 col-sm-2 col-md-2 col-lg-2 text-center sc-carousel-cell">
														
																	<a href="<?php
				echo htmlspecialchars(stripslashes($carousel['link'])) ?>" target="_blank">
				   										<img class="img-center img-responsive" src="<?php
																		echo htmlspecialchars(stripslashes($carousel['upload'])) ?>"  alt="thumb"> </a>
				   										
				   									
				   									</div>
				   								
				   							<?php if( $count2 == 6 ) { echo '</div></div><div class="item"><div class="row">'; }; ?>
				   							
							  
							  
				   							
				   					 
									 
								
													<?php
				} ?>
						
						</div>
				   						</div></div></div>
										
			   					</div><!-- /.carousel -->
			   			</div>
			   		</div>
		
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
