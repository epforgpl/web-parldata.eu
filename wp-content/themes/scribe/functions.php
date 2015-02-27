<?php
/*--------------------------*
/* A Few Directories
/*--------------------------*/

define('scribe_URL', get_template_directory() . '/');
define('scribe_ADMIN', scribe_URL . '/admin');
define('scribe_INCLUDES', scribe_URL . '/includes');

/*--------------------------*                                         
/* scribe Theme Setup                                                            
/*--------------------------*/

add_action('after_setup_theme', 'scribe_theme_setup');

function scribe_theme_setup()
{
    add_action('customize_preview_init', 'scribe_customizer_live_preview');
    add_action('init', 'register_scribe_menus');
    add_filter('nav_menu_css_class', 'scribe_add_active_class', 10, 2);
    add_filter('post_thumbnail_html', 'scribe_remove_width_attribute', 10);
    add_filter('image_send_to_editor', 'scribe_remove_width_attribute', 10);
    add_theme_support('post-thumbnails');
    add_filter( 'wp_link_pages_args', 'scribe_link_pages_args' );
	add_action('admin_head', 'scribe_custom_admin_css');
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'post', 'excerpt' );
}

/*--------------------------*                                         
/* Custom Body Class                                                                
/*--------------------------*/
function scribe_body_class($classes)
{
    $classes[] = 'scribeFadeIn';
    return $classes;
}
add_filter('body_class', 'scribe_body_class');
/*--------------------------*
/* Image Sizes
/*--------------------------*/
if (!isset($content_width))
    $content_width = 900;
add_image_size('Blog Pic', 370, 250, true);
add_image_size('Tab Pic', 70, 51, true);
add_image_size('Portfolio Pic', 370, 300, true);
add_image_size('Large Pic', 600, 400, true);

/*--------------------------*
/* Load Scripts
/*--------------------------*/

function scribe_scripts_styles()
{
    
    /*--------------------------*
    /* Enqueu Styles
    /*--------------------------*/
    
    wp_enqueue_style('bootstrap_css', get_template_directory_uri() . "/css/bootstrap.min.css", array(), '0.1', 'screen');
    wp_enqueue_style('font_awesome_css', get_template_directory_uri() . "/css/font-awesome.min.css", 'screen');
	wp_enqueue_style('pe_icon_css', get_template_directory_uri() . "/css/pe-icon-7-stroke.css", 'screen');
	wp_enqueue_style('pe_helper_css', get_template_directory_uri() . "/css/helper.css", 'screen');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('custom_css', get_template_directory_uri() . "/css/style.php", 'screen');
    
    /*--------------------------*
    /* Google Fonts
    /*--------------------------*/
    
	
    $body_font = get_theme_mod('body_font');
    
    
    
    if(!empty($body_font)){
        wp_enqueue_style('font', 'http://fonts.googleapis.com/css?family=' . $body_font);
    }

    
    /*--------------------------*
    /* Register jQuery
    /*--------------------------*/
    
    wp_enqueue_script('jquery');
    
    /*--------------------------*
    /* Enqueu Scripts
    /*--------------------------*/
    
    wp_enqueue_script('modernizr_js', 'http://modernizr.com/downloads/modernizr-latest.js', false, false, true);
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', false, false, true);
    wp_enqueue_script('counto_js', get_template_directory_uri() . '/js/jquery.countTo.js', false, false, true);
    wp_enqueue_script('flexslider_js', get_template_directory_uri() . '/js/jquery.flexslider.js', false, false, true);
	wp_enqueue_script('imagesloaded_js', get_template_directory_uri() . '/js/imagesloaded.min.js', false, false, true);
	wp_enqueue_script('fitvids_js', get_template_directory_uri() . '/js/jquery.fitvids.js', false, false, true);
	wp_enqueue_script('stellar_js', get_template_directory_uri() . '/js/stellar.js', false, false, true);
    wp_enqueue_script('plugins_js', get_template_directory_uri() . '/js/plugins.js', false, false, true);
	wp_enqueue_script('countdown_js', get_template_directory_uri() . '/js/jquery.countdown.min.js', false, false, true);
    wp_localize_script('plugins_js', 'template_url', get_template_directory_uri('template_url'));
    
}
add_action('wp_enqueue_scripts', 'scribe_scripts_styles');

/*--------------------------*
/* Customizer Script
/*--------------------------*/

function scribe_customizer_live_preview()
{
    wp_enqueue_script('scribe-themecustomizer', get_template_directory_uri() . '/admin/customizer/js/scribe-customizer.js', array(
        'jquery',
        'customize-preview'
    ), '', true);
}

/*--------------------------*
/* Style the link pages
/*--------------------------*/

function scribe_link_pages_args( $args ){
    $args = array(
        'before'           => '<ul class="pagination">',
        'after'            => '</ul>',
        'link_before'      => '<span class="current">',
        'link_after'       => '',
        'next_or_number'   => 'number',
        'separator'        => '<li>',
        'nextpagelink'     => 'Next Page',
        'previouspagelink' => 'Previous Page',
        'pagelink'         => '%',
        'echo'             => 1
    );
    return $args;
}

/*--------------------------*
/* Localization
/*--------------------------*/

load_theme_textdomain('scribe', get_template_directory() . '/languages');

/*--------------------------*
/* Register Menus
/*--------------------------*/

function register_scribe_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'scribe')
    ));
}

/*--------------------------*
/* Custom Walker Class
/*--------------------------*/

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' dropdown';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['data-hover']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><i class="fa ' . esc_attr( $item->attr_title ) . '"></i> &nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

/*--------------------------*
/* Bootstrap Active Class
/*--------------------------*/


function scribe_add_active_class($classes, $object)
{
    if ($object->menu_object_parent == 0 && in_array('current-menu-item', $classes)) {
        $classes[] = "active";
    }
    return $classes;
}

/*--------------------------*
/* Register Widget Areas
/*--------------------------*/


if (function_exists('register_sidebars'))
register_sidebar(array(
    'name' => 'Sidebar',
	'id' => 'main',
    'description' => 'Widgets in this area will be shown in the sidebar.',
    'before_widget' => '<div class="widget %2$s" id="%1$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-heading"><h4 class="widget-title">',
    'after_title' => '</h4></div>'
));
$f_columns = get_theme_mod('footer_columns');

if ($f_columns == '4') {
    $footer_widget_columns = '3';
}

elseif ($f_columns == '3') {
    $footer_widget_columns = '4';
}
elseif ($f_columns == '2') {
    $footer_widget_columns = '6';
}
 else {
    $footer_widget_columns = '12';
}

register_sidebar(array(
    'name' => 'Footer',
    'description' => 'Widgets in this area will be shown in the footer.',
    'before_widget' => '<div class="col-md-'.$footer_widget_columns.' widget %2$s" id="%1$s"><div class="widget">',
    'after_widget' => '</div></div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>'
));


/*--------------------------*
/* Dynamic Sidebars
/*--------------------------*/

require_once(scribe_ADMIN . '/sidebars/sbars.php');

/*--------------------------*
/* Plugins
/*--------------------------*/

require_once(scribe_INCLUDES . '/plugins/plugin.php');

/*--------------------------*
/* Image Size Filter
/*--------------------------*/



function scribe_remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

if ( ! class_exists( 'Gravity_Portfolio_Post_Type' ) ) :

class Gravity_Portfolio_Post_Type {

	public function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// Run when the plugin is activated
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Add the portfolio post type and taxonomies
		add_action( 'init', array( $this, 'portfolio_init' ) );

		// Thumbnail support for portfolio posts
		add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

		// Add thumbnails to column view
		add_filter( 'manage_edit-portfolio_columns', array( $this, 'add_thumbnail_column'), 10, 1 );
		add_action( 'manage_posts_custom_column', array( $this, 'display_thumbnail' ), 10, 1 );

		// Allow filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

		// Show portfolio post counts in the dashboard
		add_action( 'right_now_content_table_end', array( $this, 'add_portfolio_counts' ) );

		// Give the portfolio menu item a unique icon
		add_action( 'admin_head', array( $this, 'portfolio_icon' ) );

		// Add taxonomy terms as body classes
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_textdomain() {

		$domain = 'gravity_portfolio_post_type';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/lang' );
	}

	/**
	 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 *
	 * @uses Portfolio_Post_Type::portfolio_init()
	 */
	public function plugin_activation() {
		$this->load_textdomain();
		$this->portfolio_init();
		flush_rewrite_rules();
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Portfolio_Post_Type::register_post_type()
	 * @uses Portfolio_Post_Type::register_taxonomy_category()
	 */
	public function portfolio_init() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Get an array of all taxonomies this plugin handles.
	 *
	 * @return array Taxonomy slugs.
	 */
	protected function get_taxonomies() {
		return array( 'portfolio_category' );
	}

	/**
	 * Enable the Portfolio custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Portfolio', 'gravity_portfolio_post_type' ),
			'singular_name'      => __( 'Portfolio Item', 'gravity_portfolio_post_type' ),
			'add_new'            => __( 'Add New Item', 'gravity_portfolio_post_type' ),
			'add_new_item'       => __( 'Add New Portfolio Item', 'gravity_portfolio_post_type' ),
			'edit_item'          => __( 'Edit Portfolio Item', 'gravity_portfolio_post_type' ),
			'new_item'           => __( 'Add New Portfolio Item', 'gravity_portfolio_post_type' ),
			'view_item'          => __( 'View Item', 'gravity_portfolio_post_type' ),
			'search_items'       => __( 'Search Portfolio', 'gravity_portfolio_post_type' ),
			'not_found'          => __( 'No portfolio items found', 'gravity_portfolio_post_type' ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', 'gravity_portfolio_post_type' ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => true,
			'supports'        => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'revisions',
			),
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'portfolio', ), // Permalinks format
			'menu_position'   => 5,
			'has_archive'     => true,
			'menu_icon'       => 'dashicons-screenoptions',
		);

		$args = apply_filters( 'portfolioposttype_args', $args );

		register_post_type( 'portfolio', $args );
	}

	
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Portfolio Categories', 'gravity_portfolio_post_type' ),
			'singular_name'              => __( 'Portfolio Category', 'gravity_portfolio_post_type' ),
			'menu_name'                  => __( 'Portfolio Categories', 'gravity_portfolio_post_type' ),
			'edit_item'                  => __( 'Edit Portfolio Category', 'gravity_portfolio_post_type' ),
			'update_item'                => __( 'Update Portfolio Category', 'gravity_portfolio_post_type' ),
			'add_new_item'               => __( 'Add New Portfolio Category', 'gravity_portfolio_post_type' ),
			'new_item_name'              => __( 'New Portfolio Category Name', 'gravity_portfolio_post_type' ),
			'parent_item'                => __( 'Parent Portfolio Category', 'gravity_portfolio_post_type' ),
			'parent_item_colon'          => __( 'Parent Portfolio Category:', 'gravity_portfolio_post_type' ),
			'all_items'                  => __( 'All Portfolio Categories', 'gravity_portfolio_post_type' ),
			'search_items'               => __( 'Search Portfolio Categories', 'gravity_portfolio_post_type' ),
			'popular_items'              => __( 'Popular Portfolio Categories', 'gravity_portfolio_post_type' ),
			'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'gravity_portfolio_post_type' ),
			'add_or_remove_items'        => __( 'Add or remove portfolio categories', 'gravity_portfolio_post_type' ),
			'choose_from_most_used'      => __( 'Choose from the most used portfolio categories', 'gravity_portfolio_post_type' ),
			'not_found'                  => __( 'No portfolio categories found.', 'gravity_portfolio_post_type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'portfolio_category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'portfolioposttype_category_args', $args );

		register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
	}

	
	public function add_body_classes( $classes ) {

		// Only single posts should have the taxonomy body classes
		if ( is_single() ) {
			$taxonomies = $this->get_taxonomies();
			foreach( $taxonomies as $taxonomy ) {
				$terms = get_the_terms( get_the_ID(), $taxonomy );
				if ( $terms && ! is_wp_error( $terms ) ) {
					foreach( $terms as $term ) {
						$classes[] = sanitize_html_class( str_replace( '_', '-', $taxonomy ) . '-' . $term->slug );
					}
				}
			}
		}

		return $classes;
	}

	
	public function add_thumbnail_column( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'portfolioposttype' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	}

	/**
	 * Custom column callback
	 *
	 * @global stdClass $post Post object.
	 *
	 * @param string $column Column ID.
	 */
	public function display_thumbnail( $column ) {
		global $post;
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post->ID, array(35, 35) );
				break;
		}
	}

	
	public function add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomies you want to display. Use the taxonomy name or slug
		$taxonomies = $this->get_taxonomies();

		// Must set this to the post type you want the filter(s) displayed on
		if ( 'portfolio' != $typenow ) {
			return;
		}

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj          = get_taxonomy( $tax_slug );
			$tax_name         = $tax_obj->labels->name;
			$terms            = get_terms( $tax_slug );
			if ( 0 == count( $terms ) ) {
				return;
			}
			echo '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
			echo '<option>' . esc_html( $tax_name ) .'</option>';
			foreach ( $terms as $term ) {
				printf(
					'<option value="%s"%s />%s</option>',
					esc_attr( $term->slug ),
					selected( $current_tax_slug, $term->slug ),
					esc_html( $term->name . '(' . $term->count . ')' )
				);
			}
			echo '</select>';
		}
	}

	
	public function add_portfolio_counts() {
		if ( ! post_type_exists( 'portfolio' ) ) {
			return;
		}

		$num_posts = wp_count_posts( 'portfolio' );

		// Published items
		$href = 'edit.php?post_type=portfolio';
		$num  = number_format_i18n( $num_posts->publish );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Portfolio Item', 'Portfolio Items', intval( $num_posts->publish ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );

		if ( 0 == $num_posts->pending ) {
			return;
		}

		// Pending items
		$href = 'edit.php?post_status=pending&amp;post_type=portfolio';
		$num  = number_format_i18n( $num_posts->pending );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval( $num_posts->pending ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );
	}

	
	protected function link_if_can_edit_posts( $value, $href ) {
		if ( current_user_can( 'edit_posts' ) ) {
			return '<a href="' . esc_url( $href ) . '">' . $value . '</a>';
		}
		return $value;
	}

	
	protected function display_dashboard_count( $number, $label ) {
		?>
		<tr>
			<td class="first b b-portfolio"><?php echo $number; ?></td>
			<td class="t portfolio"><?php echo $label; ?></td>
		</tr>
		<?php
	}

	
	public function portfolio_icon() {
	}

}

new Gravity_Portfolio_Post_Type;

endif;

	
	
/*--------------------------*
/* Tags/Comments
/*--------------------------*/

require_once(scribe_INCLUDES . '/tags-comments/tags.php');


function new_excerpt_more($more)
{
    
    global $post;
    
    return '<span class="more-arrow"> <a href="' . get_permalink($post->ID) . '">' . '&rarr;' . '</a></span>';
    
}
add_filter('excerpt_more', 'new_excerpt_more');
/*--------------------------*
/* Shortcodes
/*--------------------------*/

require_once(scribe_ADMIN . '/shortcodes/buttons/buttons.php');
require_once(scribe_ADMIN . '/shortcodes/icons/icons.php');
require_once(scribe_ADMIN . '/shortcodes/taxonomy/taxonomy.php');
add_filter('widget_text', 'do_shortcode');
/*--------------------------*
/* Metabox
/*--------------------------*/

require_once(scribe_ADMIN . '/meta/metabox.php');
require_once(scribe_ADMIN . '/metabox-functions.php');
/*--------------------------*
/* Widgets
/*--------------------------*/

require_once(scribe_ADMIN . '/widgets/flickr/flickr.php');

/*--------------------------------------*/
/*    Customizer Support
/*--------------------------------------*/

require_once(scribe_ADMIN . '/customizer/customizer.php');

/*--------------------------------------*/
/*    Page Builder
/*--------------------------------------*/

require_once(scribe_ADMIN . '/page-builder/page-builder.php');

/*--------------------------*
/* Editor Style
/*--------------------------

add_editor_style('style.css');*/

/*--------------------------*
/* Default RSS link
/*--------------------------*/
add_theme_support('automatic-feed-links');


/*--------------------------*
/* Blank Search Function
/*--------------------------*/

function scribe_blank_search($query)
{
    global $wp_query;
    if (isset($_GET['s']) && $_GET['s'] == '') {
        $wp_query->set('s', ' ');
        $wp_query->is_search = true;
    }
    return $query;
}
add_action('pre_get_posts', 'scribe_blank_search');

/*--------------------------*
/* Search Form Fixes
/*--------------------------*/

function scribe_search_form($form)
{
    
    $form = '<form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:', 'scribe') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" class="btn" value="' . esc_attr__('Search', 'scribe') . '" />
    </div>
    </form>';
    
    return $form;
}


/*--------------------------*
/* Pagination
/*--------------------------*/

function scribe_pagination($pages = '', $range = 2)
{
    $showitems       = ($range * 2) + 1;
    $additional_loop = '';
    global $paged;
    if (empty($paged))
        $paged = 1;
    
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    
    if (1 != $pages)
        echo "<ul class='pagination'>"; {
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link(1) . "'></a>";
        if ($paged > 1 && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($paged - 1) . "'></a>";
        
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<li><span class=\"current\">" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a></li>";
            }
        }
        
        if ($paged < $pages && $showitems < $pages)
            echo "<a href=\"" . get_pagenum_link($paged + 1) . "\"></a>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<a href='" . get_pagenum_link($pages) . "'></a>";
    }
    echo "</ul>";
}

/*--------------------------*
/* Custom Admin
/*--------------------------*/

function scribe_custom_admin_css()
{
    echo '<style type="text/css">
	.screenshot {float:none;} #dynamic_sidebar {max-width:100%;}
             </style>';
}

/*--------------------------*
/* Post Formats
/*--------------------------*/

add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio' ) );

add_post_type_support( 'page', 'post-formats' );
add_post_type_support( 'post', 'post-formats' );


