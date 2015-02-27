<?php
/**
 * Plugin Name: PA Knowledge Base
 * Plugin URI: http://pressapps.co/
 * Description: Knowledge base WordPress plugin
 * Author: PressApps Team
 * Version: 1.3.0
 */

/*-----------------------------------------------------------------------------------*/
/* Return option page data */
/*-----------------------------------------------------------------------------------*/

$pakb_settings = get_option( 'pressapps_knowledgebase_options' );

define('PAKB_PLUGIN_DIR',dirname(__FILE__));

class PAKB{
    
    function __construct() {

        global $pakb_settings;

        include_once 'includes/functions.php';
        include_once 'includes/loop.php';
        include_once 'includes/template.php';
        include_once 'includes/actions.php';
        include_once 'includes/filters.php';
        include_once 'includes/admin-reorder.php';
        include_once 'includes/admin-page.php';
        include_once 'includes/widget/knowledgebase-search.php';
        include_once 'includes/widget/knowledgebase-latest.php';
        
        include_once 'includes/deprecated.php';
        
        add_action('init'               ,array($this,'init'));
        add_action('admin_init'         ,array($this,'admin_init'));
        //add_action('template_redirect'  ,array($this,'template_redirect'));
        add_filter('template_include'     ,array($this,'template_include'));
        add_action('wp_head'            ,'pakb_print_css' );
        
        // Add the users custom CSS if they wish to add any.
        if ( $pakb_settings['custom-css'] ) {
            add_action( 'wp_head'       ,'pakb_print_custom_css' );
        }
        add_action('widgets_init' ,'widgets_init');

        function widgets_init(){
            register_widget('PAKB_LATEST_KNOWLEDGEBASE');
            register_widget('PAKB_SEARCH_KNOWLEDGEBASE');
        }

    }
    
    function admin_init(){
        global $pagenow,$pakb_settings;
        
        if(isset($_GET['page']) && isset($_GET['settings-updated'])){
            if($_GET['page'] == 'knowledgebase-options' && $_GET['settings-updated'] == 'true'){
                flush_rewrite_rules(TRUE);
            }
         }
         
        if($pakb_settings['reorder'] != 1)
            return ;
        
        if( $pagenow == 'edit.php') {
            if ( isset($_GET['post_type']) && 'knowledgebase' == $_GET['post_type'] ) {
                wp_register_style('pakb_order-admin-styles'       , plugin_dir_url(__FILE__) . 'assets/css/admin.css');
    
                wp_register_script('pakb_order-update-order'       , plugin_dir_url(__FILE__) . 'assets/js/order-posts.js');


                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script('pakb_order-update-order');
                wp_enqueue_style('pakb_order-admin-styles');
                
                add_filter( 'pre_get_posts', 'pakb_order_reorder_list' );
                
            }
        } elseif( $pagenow == 'edit-tags.php' ) {
            if ( isset($_GET['post_type']) && 'knowledgebase' == $_GET['post_type'] ) {
                wp_register_style('pakb_order-admin-styles'       , plugin_dir_url(__FILE__) . 'assets/css/admin.css');
    
                wp_register_script('pakb_order-update-order'       , plugin_dir_url(__FILE__) . 'assets/js/order-taxonomies.js');
    
                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script('pakb_order-update-order');
                wp_enqueue_style('pakb_order-admin-styles');
                
                add_filter( 'get_terms_orderby', 'pakb_order_reorder_taxonomies_list', 10, 2 );
            }
        } 
        /**
         * 
         * @note this section is only executed if the condition on line 62 is true
         * so better place to write logic will be above that condition
         */
    }
    function init(){
        
        global $pakb_settings;

        load_plugin_textdomain('pressapps', false, basename(dirname(__FILE__)).'/lang' );

        register_post_type( 'knowledgebase',array(
            'description'           => __('Knowledge Base','pressapps'),
            'labels'                => array(
                'name'                  => __('Knowledge Base'                     ,'pressapps'),
                'singular_name'         => __('Knowledge Base'                      ,'pressapps'),
                'add_new'               => __('Add Knowledge Base'                  ,'pressapps'),  
                'add_new_item'          => __('Add New Knowledge Base'              ,'pressapps'),  
                'edit_item'             => __('Edit Knowledge Base'                 ,'pressapps'),  
                'new_item'              => __('New Knowledge Base'                  ,'pressapps'),  
                'view_item'             => __('View Knowledge Base'                ,'pressapps'),  
                'search_items'          => __('Search Knowledge Base'              ,'pressapps'),  
                'not_found'             => __('No Knowledge Base found'            ,'pressapps'),  
                'not_found_in_trash'    => __('No Knowledge Base found in Trash'   ,'pressapps'),
                'all_items'             => __('All Knowledge Base'                 ,'pressapps'),
            ),
            'public'                => true,
            'menu_position'         => 5,
            'rewrite'               => array(
                'slug'       => $pakb_settings['knowledgebase_slug'],
                'with_front' => false,
            ),
            'supports'              => array('title','editor','author','comments','page-attributes','thumbnail'),
            'public'                => true,
            'show_ui'               => true,
            'publicly_queryable'    => true,
            'has_archive'           => true,
            'exclude_from_search'   => false
        ));

        register_taxonomy( 'knowledgebase_category',array( 'knowledgebase' ),array( 
            'hierarchical'  => false,
            'labels'        => array(
                'name'              => __( 'Categories'             ,'pressapps'),
                'singular_name'     => __( 'Category'               ,'pressapps'),
                'search_items'      => __( 'Search Categories'      ,'pressapps'),
                'all_items'         => __( 'All Categories'         ,'pressapps'),
                'parent_item'       => __( 'Parent Category'        ,'pressapps'),
                'parent_item_colon' => __( 'Parent Category:'       ,'pressapps'),
                'edit_item'         => __( 'Edit Category'          ,'pressapps'),
                'update_item'       => __( 'Update Category'        ,'pressapps'),
                'add_new_item'      => __( 'Add New Category'       ,'pressapps'),
                'new_item_name'     => __( 'New Category Name'      ,'pressapps'),
                'popular_items'     => NULL,
                'menu_name'         => __( 'Categories'             ,'pressapps') 
            ),
            'show_ui'       => true,
            'public'        => true,
            'query_var'     => true,
            'hierarchical'  => true,
            'rewrite'       => array( 'slug' => $pakb_settings['knowledgebase_cat_slug'] )
        ));
        
        register_taxonomy( 'knowledgebase_tags',array( 'knowledgebase' ),array( 
            'hierarchical'  => false,
            'labels'        => array(
                'name'              => __( 'Tags'              ,'pressapps'),
                'singular_name'     => __( 'Tag'               ,'pressapps'),
                'search_items'      => __( 'Search Tags'       ,'pressapps'),
                'all_items'         => __( 'All Tags'          ,'pressapps'),
                'parent_item'       => __( 'Parent Tag'        ,'pressapps'),
                'parent_item_colon' => __( 'Parent Tag:'       ,'pressapps'),
                'edit_item'         => __( 'Edit Tag'          ,'pressapps'),
                'update_item'       => __( 'Update Tag'        ,'pressapps'),
                'add_new_item'      => __( 'Add New Tag'       ,'pressapps'),
                'new_item_name'     => __( 'New Tag Name'      ,'pressapps'),
                'popular_items'     => NULL,
                'menu_name'         => __( 'Tags'              ,'pressapps') 
            ),
            'show_ui'       => true,
            'public'        => true,
            'query_var'     => true,
            'hierarchical'  => false,
            'rewrite'       => array( 'slug' => 'knowledgebase_tags' )
        ));
        
        wp_register_style('pakb_default'   , plugins_url('/assets/css/default.css'     , __FILE__));
        wp_register_script('pakb_tooltip'  , plugins_url('/assets/js/tooltip.min.js'   , __FILE__)      ,array('jquery'));
        wp_register_script('pakb_custom'   , plugins_url('/assets/js/custom.js'        , __FILE__)      ,array('jquery'));

        wp_enqueue_style('pakb_default');
        wp_enqueue_script('pakb_tooltip');
        wp_enqueue_script('pakb_custom');
        
        if(!is_admin()){
            add_filter('pre_get_posts',array($this,'pre_get_posts'));
        }
       
    }

    function pre_get_posts($query){
        global $pakb_settings;
            if ( 
                 (   $query->is_post_type_archive('knowledgebase') 
                 || $query->is_tax('knowledgebase_tags') || $query->is_tax('knowledgebase_category')
                 || ( $query->is_search() && 
                         ((isset($query->query_vars['post_type']))?($query->query_vars['post_type'] == 'knowledgebase'):FALSE)
                    )
                 || (isset($query->query_vars['page_id'])?($query->query_vars['page_id'] == ($pakb_settings['knowledgebase_page'])):FALSE)
                ) && $query->is_main_query()
            ){            
                $query->set('posts_per_page'            , -1);
                $query->set('posts_per_archive_page'    , -1);
            }
         return $query;
    }
    
    function template_include($template){
        global $wp_query,$pakb_query,$pakb_settings,$post,$pakb_cat,$pakb_tag;
        $pakb_query = $wp_query;
       
        if(
                is_post_type_archive('knowledgebase') || is_singular('knowledgebase') 
             || is_tax('knowledgebase_category')      || is_tax('knowledgebase_tags') 
             || is_page($pakb_settings['knowledgebase_page'])
             || (is_search() && (isset($_REQUEST['post_type'])?($_REQUEST['post_type']=='knowledgebase'):FALSE)   )
                
          ){
            
            $overridekb = FALSE;
            $kb_page    = get_post($pakb_settings['knowledgebase_page']);
            
            if(!empty($kb_page)){
                if($pakb_settings['knowledgebase_slug'] == $kb_page->post_name){
                    $overridekb = TRUE;
                }
            }
            
            if((is_post_type_archive('knowledgebase') && !$overridekb) || is_search()){
                
                if(is_search()){
                    $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                        'ID'                    => $wp_query->post->ID,
                        'post_content'          => pakb_load_file(pakb_get_template_files('search')),
                        'post_title'            => sprintf(__('Search Result for "%s"','pressapps'),$_REQUEST['s']),
                    )));
                    
                    pakb_override_is_var();
                }else{
                    
                    $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                        'ID'                    => $wp_query->post->ID,
                        'post_content'          => pakb_load_file(pakb_get_template_files('archive')),
                        'post_title'            => __('KB Archive'     ,'pressapps'),
                    )));
                }
                
                /**
                 * @todo this is redundant Code we need to get this updated with 1 function call like pakb_override_is_var
                 */
                $wp_query->posts                = array($post);
                $wp_query->post                 = $post;
                $wp_query->post_count           = 1;
      
            }elseif(is_tax('knowledgebase_category')){
                
                pakb_process_cat();
                
                if(pakb_has_sub_cat()){
                    
                    $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                        'ID'                    => $pakb_settings['knowledgebase_page'],
                        'post_content'          => pakb_load_file(pakb_get_template_files('knowledgebase')),
                        'post_title'            => $pakb_cat['main']->name,
                    )));
                    
                }else{
                    $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                        'ID'                    => $wp_query->post->ID,
                        'post_content'          => pakb_load_file(pakb_get_template_files('archive')),
                        'post_title'            => $pakb_cat['main']->name,
                    )));
                }
                
                $wp_query->posts                = array($post);
                $wp_query->post                 = $post;
                $wp_query->post_count           = 1;                
                
               
            }elseif(is_tax('knowledgebase_tags')){
                
                pakb_process_tag();
                
                $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                    'ID'                    => $wp_query->post->ID,
                    'post_content'          => pakb_load_file(pakb_get_template_files('archive')),
                    'post_title'            => $pakb_tag['main']->name,
                )));
               
                
                $wp_query->posts                = array($post);
                $wp_query->post                 = $post;
                $wp_query->post_count           = 1;
                
               
            }elseif(
                is_page($pakb_settings['knowledgebase_page']) 
                    || 
                (is_post_type_archive('knowledgebase') && $overridekb)
             ){
                
                pakb_process_kbpage();
                
                $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                    'ID'                    => $wp_query->post->ID,
                    'post_content'          => pakb_load_file(pakb_get_template_files('knowledgebase')),
                    'post_title'            => $wp_query->post->post_title,
                )));
                
                
                $wp_query->posts                = array($post);
                $wp_query->post                 = $post;
                $wp_query->post_count           = 1;
                
            }elseif(is_singular('knowledgebase')){
                
                $post   = new WP_Post((object)pakb_get_dummy_post_data(array(
                    'ID'                    => $wp_query->post->ID,
                    'post_content'          => pakb_load_file(pakb_get_template_files('single')),
                    'post_title'            => $wp_query->post->post_title,
                )));
                
                $wp_query->posts        = array($post);
                $wp_query->post         = $post;
                $wp_query->post_count   = 1;    
                
                
            }
                        
            return $this->page_template($template);
        }
        
        return $template;
                
    }

    function page_template($template){
        
        global $pakb_settings;
        $kb_page    = get_post($pakb_settings['knowledgebase_page']);

        $id         = $kb_page->ID;
        $template   = get_page_template_slug($kb_page->ID);
        $pagename   = $kb_page->post_name;

        $templates = array();
        if ( $template && 0 === validate_file( $template ) )
                $templates[] = $template;
        if ( $pagename )
                $templates[] = "page-$pagename.php";
        if ( $id )
                $templates[] = "page-$id.php";
        $templates[] = 'page.php';

        return get_query_template( 'page', $templates );
    }
}

$pakb = new PAKB();

