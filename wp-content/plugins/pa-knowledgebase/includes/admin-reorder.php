<?php
/**
 * Admi post order
 */




function pakb_order_reorder_taxonomies_list($orderby, $args) {
    $orderby = "t.term_group";
    return $orderby;
}


function pakb_order_reorder_list($query) {
    $query->set('orderby', 'menu_order');
    $query->set('order', 'ASC');
    return $query;
}




function pakb_order_save_order() {
    
    global $wpdb;
    
    $action             = $_POST['action']; 
    $posts_array        = $_POST['post'];
    $listing_counter    = 1;
    
    foreach ($posts_array as $post_id) {
        
        $wpdb->update( 
                    $wpdb->posts, 
                        array('menu_order'  => $listing_counter), 
                        array('ID'          => $post_id) 
                    );

        $listing_counter++;
    }
    
    die();
}

function pakb_order_save_taxonomies_order() {
    global $wpdb;
    
    $action             = $_POST['action']; 
    $tags_array         = $_POST['tag'];
    $listing_counter    = 1;
    
    foreach ($tags_array as $tag_id) {
        
        $wpdb->update( 
                    $wpdb->terms, 
                        array('term_group'          => $listing_counter), 
                        array('term_id'     => $tag_id) 
                    );

        $listing_counter++;
    }
    
    die();
}

add_action('wp_ajax_pakb_order_update_posts'        , 'pakb_order_save_order');
add_action('wp_ajax_pakb_order_update_taxonomies'   , 'pakb_order_save_taxonomies_order');
