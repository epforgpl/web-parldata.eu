<?php

if(!class_exists('PG_Gallery_Block')) {
	class PG_Gallery_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array (
				'name' => 'Gallery',
				'size' => 'span12',
			);
			
			parent::__construct('pg_gallery_block', $block_options);
		}
		
		function form($instance) {
			$defaults = array (
				'captions' => 'no',
				'spacing' => '4',
				'columns' => '4'
			
						);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			
			$column_options = array(
				'1' => 'One',
				'2' => 'Two',
				'3' => 'Three',
				'4' => 'Four',
				'5' => 'Five',
				'6' => 'Six',
				'7' => 'Seven',
				'8' => 'Eight'
			);
			
			$spacing_options = array(
				'1' => 'One',
				'2' => 'Two',
				'3' => 'Three',
				'4' => 'Four',
				'5' => 'Five',
				'6' => 'Six',
				'7' => 'Seven',
				'8' => 'Eight'
			);
			
			$captions_options = array(
				'yes' => 'Yes',
				'no' => 'No'
			);
			
			$sorting_options = array(
				'yes' => 'Yes',
				'no' => 'No'
			);
			
			
		
			
			?>
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</p>
			
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('column') ?>">
					Number of Columns <br />
					<?php echo aq_field_select('column', $this->block_id, $column_options, $column) ?>
				</label>
			</p>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('spacing') ?>">
					Spacing (optional)<br/>
					<?php echo aq_field_select('spacing', $this->block_id, $spacing_options, $spacing) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('captions') ?>">
					Captions?<br/>
					<?php echo aq_field_select('captions', $this->block_id, $captions_options, $captions) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('sorting') ?>">
					Dynamic Sorting?<br/>
					<?php echo aq_field_select('sorting', $this->block_id, $sorting_options, $sorting) ?>
				</label>
			</p>
			<?php
		}
		
		
		 
		
		function block($instance) {
			extract($instance);
			
			$terms = get_terms('portfolio_category');
			$count = count($terms);
			if ( $count > 0 ) {
			    foreach ( $terms as $term ) {
			        $output .= $term->term_id . ", ";
			    }
			}
			
			if($title) echo '<h4 class="aq-block-title">'.strip_tags($title).'</h4>';
			echo do_shortcode('[ajax_portfolio categories="'.$output.'" columns="'.$column.'" animation="2" thumb_size="full" padding="'.$spacing.'" items="-1" sort="'.$sorting.'" prevnext="no" paginate="infinite" caption="'.$captions.'" orderby="none" order="DESC" ]');
			
		}
	}
}


