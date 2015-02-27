<?php
/* Pricing Tables Block */
if(!class_exists('PG_Pricetable_Block')) {
	class PG_Pricetable_Block extends AQ_Block {
		
		function __construct() {
			$block_options = array(
				'name' => 'Pricing Table',
				'size' => 'span4'
			);
			
			parent::__construct('pg_pricetable_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array(
				'title' => 'Normal',
				'price' => 'free',
				'timeline' => '',
				'featured_price' => '',
				'features' => '',
				'button_url' => '',
				'button_text' => '',
				
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			
			?>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Package Title (required)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('price') ?>">
					Price (required)<br/>
					<?php echo aq_field_input('price', $block_id, $price) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('timeline') ?>">
					Pricing timeline (e.g. "per month")<br/>
					<?php echo aq_field_input('timeline', $block_id, $timeline) ?>
				</label>
			</p>
			<p class="description">
				<label for="<?php echo $this->get_field_id('features') ?>">
					Features (start each feature on new line)
					<?php echo aq_field_textarea('features', $block_id, $features) ?>
				</label>
			</p>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('button_text') ?>">
					Button Text (required)<br/>
					<?php echo aq_field_input('button_text', $block_id, $button_text) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('button_url') ?>">
					Button Link<br/>
					<?php echo aq_field_input('button_url', $block_id, $button_url) ?>
				</label>
			</p>
      <p>
				<input class="checkbox" type="checkbox" value="true" id="<?php echo $this->get_field_id( 'featured_price' ); ?>" name="<?php echo $this->get_field_name( 'featured_price' ); ?>"<?php checked( $instance['featured_price'], 'true' ); ?> />
				<label for="<?php echo $this->get_field_id( 'featured_price' ); ?>"><?php _e( 'Feature this column?', 'scribe' ); ?></label>
			</p>
			<?php
			
		}
		
	

		function block($instance) { extract($instance); $featured =''; if( isset( $featured_price ) && $featured_price == true) {$featured='featured';}
		$output = '<div class="p-table-table"><div class="p-table '.$featured.'">'; $output .= '<div class="p-table-header">'; $output .= '<div
		class="p-table-cost">'.htmlspecialchars_decode($price).'</div>'; $output .= !empty($timeline) ? '<div
		class="p-table-per">'.htmlspecialchars_decode($timeline).'</div>' : ''; $output .= '</div><div class="p-table-content">'; $output .=
		'<h3>'.htmlspecialchars_decode($title).'</h3>';
					
					
					$features = !empty($features) ? explode("\n", trim($features)) : array();
					
					foreach($features as $feature) {
						$output .= '<li>'.do_shortcode(htmlspecialchars_decode($feature)).'</li>';
					}
				if( $button_url ) {
				$output .= '<div class="btn"><a href="'.htmlspecialchars_decode($button_url) .'" rel="nofollow" ><span class="" >'.htmlspecialchars_decode($button_text).'</span></a></div>';
			
			
			}
		$output .= '</div></div></div>'; 
			
			
			
			echo $output;	
		}
		
	}
}

	