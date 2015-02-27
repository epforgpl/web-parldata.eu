<?php

/*-----------------------------------------------------------------------------------*/
/* Register the admin page with the 'admin_menu' */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_admin_menu() {
	$page = add_submenu_page( 'options-general.php', __( 'PA Knowledge Base', 'pressapps' ), __( 'PA Knowledge Base', 'pressapps' ), 'manage_options', 'knowledgebase-options', 'pressapps_knowledgebase_options', 99 );
}
add_action( 'admin_menu', 'pressapps_knowledgebase_admin_menu' );


/*-----------------------------------------------------------------------------------*/
/* Load HTML that will create the outter shell of the admin page */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_options() {

	// Check that the user is able to view this page.
	if ( ! current_user_can( 'manage_options' ) )
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'pressapps' ) ); ?>

	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Knowledge Base Settings', 'pressapps' ); ?></h2>

		<form action="options.php" method="post">
			<?php settings_fields( 'knowledgebase_setup_options' ); ?>
			<?php do_settings_sections( 'knowledgebase_setup_options' ); ?>
			<?php submit_button(); ?>
		</form>

	</div>
<?php }

/*-----------------------------------------------------------------------------------*/
/* Registers all sections and fields with the Settings API */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_init_settings_registration() {
	$option_name = 'pressapps_knowledgebase_options';

	// Check if settings options exist in the database. If not, add them.
	if ( get_option( 'pressapps_knowledgebase_options' ) )
		add_option( 'pressapps_knowledgebase_options' );

	// Define settings sections.
	add_settings_section( 'knowledgebase_setup_section', __( 'Setup', 'pressapps' ), 'knowledgebase_setup_options', 'knowledgebase_setup_options' );

	add_settings_field( 'knowledgebase_page', __( 'Knowledge Base Page', 'pressapps' ), 'pressapps_knowledgebase_settings_field_pages', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'knowledgebase_page',
		'class' 			=> '',
		'value'			=> '',
		'label'			=> __( 'Select a page to display knowledge base posts.', 'pressapps' ),
	) );
	add_settings_field( 'knowledgebase_slug', __( 'Knowledge Base Slug', 'pressapps' ), 'pressapps_knowledgebase_settings_field_text', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'knowledgebase_slug',
		'class'			=> '',
		'value'			=> 'knowledgebase',
		'label'			=> __( 'Specify knowledge base url slug.', 'pressapps' ),
	) );
	add_settings_field( 'knowledgebase_cat_slug', __( 'Knowledge Base Category Slug', 'pressapps' ), 'pressapps_knowledgebase_settings_field_text', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'knowledgebase_cat_slug',
		'class'			=> '',
		'value'			=> 'kb',
		'label'			=> __( 'Specify knowledge base category url slug.', 'pressapps' ),
	) );
	add_settings_field( 'columns', __( 'Knowledge Base Columns', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'columns',
		'class' 			=> '',
		'value'			=> array(
								'2' => __( '2 Columns', 'pressapps' ),
								'3' => __( '3 Columns', 'pressapps' ),
								'4' => __( '4 Columns', 'pressapps' ),
								),
		'label'			=> __( 'Select number of columns on knowledge base page.', 'pressapps' ),
	) );
	add_settings_field( 'posts_per_cat', __( 'Posts Per Category', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'posts_per_cat',
		'class' 			=> '',
		'value'			=> array(
								'3' => __( '3', 'pressapps' ),
								'4' => __( '4', 'pressapps' ),
								'5' => __( '5', 'pressapps' ),
								'7' => __( '7', 'pressapps' ),
								'10' => __( '10', 'pressapps' ),
								'12' => __( '12', 'pressapps' ),
								'16' => __( '16', 'pressapps' ),
								'20' => __( '20', 'pressapps' ),
								'-1' => __( 'All', 'pressapps' ),
								),
		'label'			=> __( 'Select number of knowledge base posts displayed per category.', 'pressapps' ),
	) );
        add_settings_field( 'category_count', __( 'Category Count', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'category_count',
		'class' 			=> '',
		'value'			=> array(
								'0' => __( 'Disabled', 'pressapps' ),
								'1' => __( 'Enabled', 'pressapps' ),
								),
		'label'			=> __( 'Display post count in category titles.', 'pressapps' ),
	) );
	add_settings_field( 'search', __( 'Search', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'search',
		'class' 			=> '',
		'value'			=> array(
								'0' => __( 'Disabled', 'pressapps' ),
								'1' => __( 'Enabled', 'pressapps' ),
								),
		'label'			=> __( 'Enable knowledge base page search field.', 'pressapps' ),
	) );
	add_settings_field( 'reorder', __( 'Reorder', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'reorder',
		'class' 			=> '',
		'value'			=> array(
								'0' => __( 'Disabled', 'pressapps' ),
								'1' => __( 'Enabled', 'pressapps' ),
								),
		'label'			=> __( 'Enable knowledge base posts and categories drag and drop reorder feature.', 'pressapps' ),
	) );
	add_settings_field( 'voting', __( 'Voting', 'pressapps' ), 'pressapps_knowledgebase_settings_field_select', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'voting',
		'class' 			=> '',
		'value'			=> array(
								'0' => __( 'Disabled', 'pressapps' ),
								'1' => __( 'Public Voting', 'pressapps' ),
								'2' => __( 'Logged In Users Only', 'pressapps' ),
								),
		'label'			=> __( 'Enable knowledge base post vote feature.', 'pressapps' ),
	) );
	add_settings_field( 'color', __( 'Links Color', 'pressapps' ), 'pressapps_knowledgebase_settings_field_color', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'color',
		'class'			=> '',
		'value'			=> '',
		'label'			=> __( 'Set general link and icon color (leave blank for theme default).', 'pressapps' ),
	) );
	add_settings_field( 'posts_color', __( 'Post Links Color', 'pressapps' ), 'pressapps_knowledgebase_settings_field_color', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' => $option_name,
		'id'				=> 'posts_color',
		'class'			=> '',
		'value'			=> '',
		'label'			=> __( 'Set link and icon color for main page post links (leave blank for theme default).', 'pressapps' ),
	) );

	add_settings_field( 'custom_css', __( 'Custom CSS', 'pressapps' ), 'pressapps_knowledgebase_settings_field_textarea', 'knowledgebase_setup_options', 'knowledgebase_setup_section', array(
		'options-name' 	=> $option_name,
		'id'			=> 'custom-css',
		'class'			=> 'code',
		'value'			=> '',
		'label'			=> __( 'Add custom CSS code.', 'pressapps' ),
	) );

	// Register settings with WordPress so we can save to the Database
	register_setting( 'knowledgebase_setup_options', 'pressapps_knowledgebase_options', 'knowledgebase_options_sanitize' );
}
add_action( 'admin_init', 'pressapps_knowledgebase_init_settings_registration' );

/*-----------------------------------------------------------------------------------*/
/* add_settings_section() function for the widget options */
/*-----------------------------------------------------------------------------------*/

function knowledgebase_setup_options() {
	//echo '<p>' . __( 'You can add video posts to your site using [video] shortcode.', 'pressapps' ) . '.</p>';
}

/*-----------------------------------------------------------------------------------*/
/* he callback function to display textareas */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_textarea( $args ) {
	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<label for="<?php echo $args['id']; ?>"><?php esc_attr_e( $args['label'] ); ?></label><br />
	<textarea name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" class="<?php if ( ! empty( $args['class'] ) ) echo ' ' . $args['class']; ?>" cols="60" rows="7"><?php esc_attr_e( $options[ $args['id'] ] ); ?></textarea>
<?php }


/*-----------------------------------------------------------------------------------*/
/* The callback function to display checkboxes */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_checkbox( $args ) {
	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" <?php if ( ! empty( $args['class'] ) ) echo 'class="' . $args['class'] . '" '; ?>value="<?php esc_attr_e( $args['value'] ); ?>" <?php if ( isset( $options[ $args['id'] ] ) ) checked( $args['value'], $options[ $args['id'] ], true ); ?> />
	<label for="<?php echo $args['id']; ?>"><?php esc_attr_e( $args['label'] ); ?></label>
<?php }


/*-----------------------------------------------------------------------------------*/
/* The callback function to display selection dropdown */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_select( $args ) {
	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<select name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" <?php if ( ! empty( $args['class'] ) ) echo 'class="' . $args['class'] . '" '; ?>>
		<?php foreach ( $args['value'] as $key => $value ) : ?>
			<option value="<?php esc_attr_e( $key ); ?>"<?php if ( isset( $options[ $args['id'] ] ) ) selected( $key, $options[ $args['id'] ], true ); ?>><?php esc_attr_e( $value ); ?></option>
		<?php endforeach; ?>
	</select>
	<label for="<?php echo $args['id']; ?>" style="display:block;"><?php esc_attr_e( $args['label'] ); ?></label>
<?php }


/*-----------------------------------------------------------------------------------*/
/* The callback function to display pages dropdown */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_pages( $args ) {
	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<select name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" <?php if ( ! empty( $args['class'] ) ) echo 'class="' . $args['class'] . '" '; ?>>
	    <option value="0"><?php _e('Select Knowledge Base Page','pressapps'); ?></option>
	    <?php 
	    $pages = get_posts(array(
	        'post_type'         => 'page',
	        'posts_per_page'    => -1,
	        'orderby'			=> 'title',
	        'order'				=> 'ASC',
	    ));
	    foreach($pages as $page){
	       if($page->ID ==  $options[ $args['id']] ){
	           echo "<option selected=\"selected\" value=\"{$page->ID}\">{$page->post_title}</option>";
	       }else{
	           echo "<option value=\"{$page->ID}\">{$page->post_title}</option>";
	       }
	    }
	    ?>
	</select>
	<label for="<?php echo $args['id']; ?>" style="display:block;"><?php esc_attr_e( $args['label'] ); ?></label>
<?php }


/*-----------------------------------------------------------------------------------*/
/* The callback function to display text field */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_text( $args ) {

	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<input name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" type="text" class="regular-text<?php if ( ! empty( $args['class'] ) ) echo ' ' . $args['class']; ?>" value="<?php if ( isset ( $options[ $args['id'] ] )) { esc_attr_e( $options[ $args['id'] ] ) ;} else { echo ''; } ?>"></input>

	<label for="<?php echo $args['id']; ?>" style="display:block;"><?php esc_attr_e( $args['label'] ); ?></label>
<?php }


/*-----------------------------------------------------------------------------------*/
/* Color picker */
/*-----------------------------------------------------------------------------------*/

function wp_enqueue_knowledgebase_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-script', plugins_url('assets/js/admin.js' , dirname(__FILE__) ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'wp_enqueue_knowledgebase_color_picker' );

/*-----------------------------------------------------------------------------------*/
/* The callback function to display color picker */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_color( $args ) {

	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<input name="<?php echo $name; ?>" id="<?php echo $args['id']; ?>" class="wp-color-picker-field<?php if ( ! empty( $args['class'] ) ) echo ' ' . $args['class']; ?>" value="<?php if ( isset ( $options[ $args['id'] ] )) { esc_attr_e( $options[ $args['id'] ] ) ;} else { echo ''; } ?>"></input>

	<label for="<?php echo $args['id']; ?>" style="display:block;"><?php esc_attr_e( $args['label'] ); ?></label>
<?php }


/*-----------------------------------------------------------------------------------*/
/* The callback function to display info */
/*-----------------------------------------------------------------------------------*/

function pressapps_knowledgebase_settings_field_info( $args ) {
	// Set the options-name value to a variable
	$name = $args['options-name'] . '[' . $args['id'] . ']';

	// Get the options from the database
	$options = get_option( $args['options-name'] ); ?>

	<p><?php esc_attr_e( $args['value'] ); ?></p>

<?php }


/*-----------------------------------------------------------------------------------*/
/* Sanitization function */
/*-----------------------------------------------------------------------------------*/

function knowledgebase_options_sanitize( $input ) {

	// Set array for the sanitized options
	$output = array();

	// Loop through each of $input options and sanitize them.
	foreach ( $input as $key => $value ) {
		if ( isset( $input[ $key ] ) )
			$output[ $key ] = strip_tags( stripslashes( $input[ $key ] ) );
	}

	return apply_filters( 'knowledgebase_options_sanitize', $output, $input );
}

