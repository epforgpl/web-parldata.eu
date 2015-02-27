<?php if ( ! defined('ABSPATH') ) die();
if ( ! class_exists( 'Dynamic_Sidebars' ) ) :

class Dynamic_Sidebars {

	private $sidebars = null;

	public function __construct() {
		
		add_filter( 'ds_sidebar_description', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_before_widget', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_after_widget', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_before_title', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_after_title', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_link_before', array( &$this, 'filter_field' ), 1 );
		add_filter( 'ds_link_after', array( &$this, 'filter_field' ), 1 );
		
		add_action( 'init', array( &$this, 'get_sidebars_data' ), 10 );
		add_action( 'init', array( &$this, 'register_sidebars' ), 11 );

		
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( &$this, 'add_metabox' ), 10 );
			add_action( 'save_post', array( &$this, 'save_postdata' ), 10 );
		}
	}

	 public function get_sidebars() {
	 	return $this->sidebars;
	}

	

	public function add_metabox() {
		add_meta_box( 'dynamic-sidebar-metabox', __( 'Dynamic Sidebar', 'scribe' ), array( &$this, 'display_metabox' ), 'page', 'side', 'default' );
		add_meta_box( 'dynamic-sidebar-metabox', __( 'Dynamic Sidebar', 'scribe' ), array( &$this, 'display_metabox' ), 'post', 'side', 'default' );
		add_meta_box( 'dynamic-sidebar-metabox', __( 'Dynamic Sidebar', 'scribe' ), array( &$this, 'display_metabox' ), 'gallery', 'side', 'default' );
		add_meta_box( 'dynamic-sidebar-metabox', __( 'Dynamic Sidebar', 'scribe' ), array( &$this, 'display_metabox' ), 'product', 'side', 'default' );
	}
	

	
	public function display_metabox() {
		global $post_id;
		
		wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_sidebars_nonce' );

		$dynamic_sidebar = get_post_meta( $post_id, 'dynamic_sidebar', true );

		
		?>

<label for="dynamic_sidebar" style="display: block; margin-bottom: 6px;">
  <?php _e( 'Dynamic Sidebar Name', 'scribe' ); ?>
</label>
<input type="text" id="dynamic_sidebar" name="dynamic_sidebar" value="<?php echo ($dynamic_sidebar) ==''? '':$dynamic_sidebar; ?>" size="33" />
<?php
	}

	
	public function save_postdata( $post_id ) {
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return;
		
		
		$dynamic_sidebars_nonce = ( isset( $_POST[ 'dynamic_sidebars_nonce' ] ) ) ? $_POST[ 'dynamic_sidebars_nonce' ] : false;

		if ( ! wp_verify_nonce( $dynamic_sidebars_nonce, plugin_basename( __FILE__ ) ) )
			return;

		
		if ( 'page' == $_POST['post_type'] )  {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return;
		}

		
		$old_data = get_post_meta( $post_id, 'dynamic_sidebar', true );

		
		$new_data = $_POST[ 'dynamic_sidebar' ];

		if ( $new_data && $new_data != $old_data ) {
			
			update_post_meta( $post_id, 'dynamic_sidebar', $new_data );
		} elseif ('' == $new_data && $old_data) {
			
			delete_post_meta( $post_id, 'dynamic_sidebar', $old_data );
		}
	}

	public function get_sidebars_data() {
		global $wpdb;

		$query = "SELECT * FROM $wpdb->postmeta WHERE meta_key = 'dynamic_sidebar' GROUP BY meta_value";
		$sidebars = $wpdb->get_results( $query, OBJECT );

		$this->sidebars = $sidebars;

		return $sidebars;
	}

	
	public function register_sidebars() {
		foreach( (array) $this->sidebars as $sidebar ) {
			$meta_value = $sidebar->meta_value;
			
			register_sidebar(
				array(
					'name' => $meta_value, 
					'id' => sanitize_title( $meta_value ), 
					'description' => apply_filters( 'ds_sidebar_description', ( $meta_value . ' Widget Area') ),
					'before_title' => apply_filters( 'ds_before_title', '<div class="widget-heading"><h5 class="widget-title">' ),
					'after_title' => apply_filters( 'ds_after_title', '</h5></div>' ),
					'link_before'  => apply_filters( 'ds_link_before','<span>'),
	                'link_after'  => apply_filters( 'ds_link_after','</span>'),
				)
			);
		}
	}

	
	public function filter_field( $data ) {
		return $data;
	}

} 
$ds = new Dynamic_Sidebars;

endif;