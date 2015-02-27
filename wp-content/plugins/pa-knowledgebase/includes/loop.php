<?php

/**
 * 
 * @package PressApps::Knowledge Base
 * @subpackage Loop
 */

/**
 * 
 * @global WP_Query $pakb_query
 * @return bool
 */
function pakb_have_posts() {
    
    global $pakb_query;

    return $pakb_query->have_posts();
}

function pakb_in_the_loop() {
    global $pakb_query;

    return $pakb_query->in_the_loop;
}

function pakb_the_post() {
    global $pakb_query;

    $pakb_query->the_post();
}


function pakb_the_ID(){
    echo pakb_get_the_ID();
}

function pakb_get_the_ID( $post_id = 0 ) {
        global $wp_query,$pakb_query;


        if ( !empty( $post_id ) && is_numeric( $post_id ) ) {
                $knowledgebase_id = $post_id;
        } elseif ( !empty( $pakb_query->in_the_loop ) && isset( $pakb_query->post->ID ) ) {
                $knowledgebase_id = $pakb_query->post->ID;
        } 

        return $knowledgebase_id;
        
}

function pakb_the_permalink(){
    echo pakb_get_the_permalink();
}

function pakb_get_the_permalink($post_id = 0){
    
    if($post_id == 0)
        $post_id = get_post(pakb_get_the_ID());
    
    return apply_filters('pakb_the_permalink',  get_permalink($post_id));
}

function pakb_the_title(){
    echo pakb_get_the_title();
}

function pakb_get_the_title(){
    
    $post = get_post(pakb_get_the_ID());
    
    return apply_filters('pakb_the_title',$post->post_title);
    
}

function pakb_the_content(){
    echo pakb_get_the_content();
}

function pakb_get_the_content(){
    
    $post = get_post(pakb_get_the_ID());
    
    if ( pakb_post_password_required( $post ) )
        return get_the_password_form( $post );
    
    return apply_filters('pakb_the_content',$post->post_content);
    
}

function pakb_post_password_required($post = NULL ){
    
    if(empty($post))
        $post = get_post(pakb_get_the_ID());
    
    return post_password_required( $post );   
        
}

function pakb_the_category($args = array()){
    echo  pakb_get_the_category(pakb_get_the_ID(),$args);
}

function pakb_get_the_category($knowledgebase_id = 0,$args = array()){
    
    $default = array(
        'output'        => 'string',
        'hyperlink'     => TRUE,
        'before_cat'    => '&nbsp;',
        'after_cat'     => '',
        'separator'     => ',',
    );
    
    $args = array_merge($default,$args);
    
    if($knowledgebase_id == 0)
        $knowledgebase_id = pakb_get_the_ID ();
    
    $categories = wp_get_post_terms($knowledgebase_id,'knowledgebase_category');
    
    switch($args['output']){
        case 'string':
            $temp = __('in', 'pressapps');
            
            if(!is_array($categories))
                return $temp;
            
            for($i=0;$i<count($categories);$i++){
                
                $cat = $categories[$i];
                
                $temp  .= $args['before_cat'];
                if($args['hyperlink'])
                    $temp .= "<a href=\"" . get_term_link($cat,'knowledgebase_category') . "\">";
                $temp  .= $cat->name;
                if($args['hyperlink'])
                    $temp .= "</a>";
                $temp  .= $args['after_cat'];
                
                if(count($categories) != ($i+1) )
                    $temp .= $args['separator'];
            }
            
            return $temp;
            
            break;
        case 'array':
            return $categories;
            break;
    }
}



function pakb_the_tags($args = array()){
    echo pakb_get_the_tags(pakb_get_the_ID(),$args);
}

function pakb_get_the_tags($knowledgebase_id = 0,$args = array()){
    $default = array(
        'output'        => 'string',
        'hyperlink'     => TRUE,
        'before_tag'    => '&nbsp;',
        'after_tag'     => '',
        'separator'     => ',',
    );
    
    $args = array_merge($default,$args);
    
    if($knowledgebase_id == 0)
        $knowledgebase_id = pakb_get_the_ID ();
    
    $tags = wp_get_post_terms($knowledgebase_id,'knowledgebase_tags');

    if (count($tags) > 0) {

        switch($args['output']){
            case 'string':
                $temp = __('Tags:', 'pressapps');
                
                if(!is_array($tags))
                    return $temp;
                
                for($i=0;$i<count($tags);$i++){
                    
                    $tag = $tags[$i];
                    
                    $temp  .= $args['before_tag'];
                    if($args['hyperlink'])
                        $temp .= "<a href=\"" . get_term_link($tag,'knowledgebase_tags') . "\" >";
                    $temp  .= $tag->name;
                    if($args['hyperlink'])
                        $temp .= "</a>";
                    $temp  .= $args['after_tag'];
                    
                    if(count($tags)!=($i+1))
                        $temp .= $args['separator'];
                    
                }
                
                return $temp;
                break;
            case 'array':
                return $tags;
                break;
        }

    }
}




function pakb_the_created_time(){
    echo pakb_get_the_created_time();
}

function pakb_get_the_created_time(){
    $post = get_post(pakb_get_the_ID());
    
    return apply_filters('pakb_the_created_time',$post->post_date_gmt);
}

function pakb_the_modified_time(){
    echo pakb_get_the_modified_time();
}

function pakb_get_the_modified_time(){
    $post = get_post(pakb_get_the_ID());
    
    return apply_filters('pakb_the_created_time',$post->post_modified_gmt);
}


function pakb_is_archive(){
    
    if(is_admin())
        return FALSE;
    
    global $pakb_query;
    
    return $pakb_query->is_archive();
}

function pakb_is_single(){
    
    if(is_admin())
        return FALSE;
    
    global $pakb_query;
    
    return $pakb_query->is_single();
}

function pakb_get_the_update_ID(){
    global $pakb_comment;
    
    return (!empty($pakb_comment))?$pakb_comment->ID:'0';
}

function pakb_setup_comment($comment){
    
    global $pakb_comment;
   
    $pakb_comment = $comment;
   
}

function pakb_the_update(){
    echo pakb_load_file(pakb_get_template_files('update-list'));
}

function pakb_the_update_content(){
    
    echo pakb_get_the_update_content();
}

function pakb_get_the_update_content(){
    
    global $pakb_comment;
    
    return ((isset($pakb_comment->comment_content))?$pakb_comment->comment_content:'');
}

function pakb_the_avtar($size = NULL){
    $size  = ((is_null($size))?64:$size);
    echo pakb_get_the_avtar($size);
}

function pakb_get_the_avtar($size = 64){
    global $pakb_comment;
    
    if(empty($pakb_comment))
        return '';
    
    return get_avatar($pakb_comment->user_id,$size);
}

function pakb_process_cat(){
    global $pakb_cat;
    global $pakb_settings;

    $pakb_cat['main']        = get_term_by('slug', get_query_var( 'knowledgebase_category' ),'knowledgebase_category'); 

    if ( $pakb_settings['reorder'] == 1 ) {
        $pakb_cat['child']       =  get_terms('knowledgebase_category', array(
            'parent'        => $pakb_cat['main']->term_id, 
            'orderby'       => 'term_group',
            'order'         => 'ASC',
            'hide_empty'    => 0
        )); 
    } else {
        $pakb_cat['child']       =  get_terms('knowledgebase_category', array(
            'parent'        => $pakb_cat['main']->term_id, 
            'hide_empty'    => 0
        )); 
    }

}

function pakb_process_tag(){
    global $pakb_tag;
    global $pakb_settings;

    $pakb_tag['main']        = get_term_by('slug', get_query_var( 'knowledgebase_tags' ),'knowledgebase_tags');

}

function pakb_process_kbpage(){
    global $pakb_cat;
    global $pakb_settings;

    $pakb_cat['main']        = ''; 

    if ( $pakb_settings['reorder'] == 1 ) {
        $pakb_cat['child']       = get_terms('knowledgebase_category', array('parent' => 0, 'hide_empty' => 0, 'orderby' => 'term_group', 'order' => 'ASC')); 
    } else {
        $pakb_cat['child']       = get_terms('knowledgebase_category', array('parent' => 0, 'hide_empty' => 0)); 
    }
}

function pakb_get_cats(){
    global $pakb_cat;
    
    return $pakb_cat['child'];
}

function pakb_has_sub_cat(){
    
    global $pakb_cat;
    
    return (count((array)$pakb_cat['child'])!=0)?TRUE:FALSE;
}

function pakb_setup_cat($cat){
    
    global $pakb_cat_obj;
    global $pakb_settings;
    
    $pakb_cat_obj['cat'] = $cat;

    if ( $pakb_settings['reorder'] == 1 ) {
        $args = array(
            'post_type'     => 'knowledgebase',
            'orderby'       => 'menu_order', 
            'order'         => 'ASC', 
            'tax_query'     => array(
                array(
                    'taxonomy'          => 'knowledgebase_category',
                    'field'             => 'id',
                    'terms'             => $cat->term_id,
                    'include_children'  => true
                )
            ),
        );
    } else {
        $args = array(
            'post_type'     => 'knowledgebase',
            'numberposts'   => -1,
            'tax_query'     => array(
                array(
                    'taxonomy'          => 'knowledgebase_category',
                    'field'             => 'id',
                    'terms'             => $cat->term_id,
                    'include_children'  => true
                )
            ),
        );
    }
    
    if(is_search()){
        $args['posts_per_page']     = -1;
    }else{
        $args['posts_per_page']     = $pakb_settings['posts_per_cat'];
    }
    
    $pakb_cat_obj['posts']          = new WP_Query($args);
    $pakb_cat_obj['actual_count']   = $pakb_cat_obj['posts']->found_posts;
    
    
}

function pakb_print_the_cat(){
    
    echo pakb_load_file(pakb_get_template_files('category'));
    
}

function pakb_the_catLink(){
    global $pakb_cat_obj;
    
    echo get_term_link($pakb_cat_obj['cat']);
}

function pakb_the_catName(){
    
    global $pakb_cat_obj;
    
    echo $pakb_cat_obj['cat']->name;
}

function pakb_the_catCount(){
    
    global $pakb_cat_obj;
    
    echo $pakb_cat_obj['actual_count'];
}

function pakb_subcat_have_posts() {
    
    global $pakb_cat_obj;

    return $pakb_cat_obj['posts']->have_posts();
}

function pakb_subcat_in_the_loop() {
    global $pakb_cat_obj;

    return $pakb_cat_obj['posts']->in_the_loop;
}

function pakb_subcat_the_post() {
    global $pakb_cat_obj;

    $pakb_cat_obj['posts']->the_post();
}


function pakb_subcat_the_ID(){
    echo pakb_subcat_get_the_ID();
}

function pakb_subcat_get_the_ID( $post_id = 0 ) {
        global $wp_query,$pakb_cat_obj;


        if ( !empty( $post_id ) && is_numeric( $post_id ) ) {
                $knowledgebase_id = $post_id;
        } elseif ( !empty( $pakb_cat_obj['posts']->in_the_loop ) && isset( $pakb_cat_obj['posts']->post->ID ) ) {
                $knowledgebase_id = $pakb_cat_obj['posts']->post->ID;
        } 

        return $knowledgebase_id;
        
}

function pakb_subcat_the_permalink(){
    echo pakb_subcat_get_the_permalink();
}

function pakb_subcat_get_the_permalink($post_id = 0){
    
    if($post_id == 0)
        $post_id = get_post(pakb_subcat_get_the_ID());
    
    return apply_filters('pakb_the_permalink',  get_permalink($post_id));
}

function pakb_subcat_the_title(){
    echo pakb_subcat_get_the_title();
}

function pakb_subcat_get_the_title(){
    
    $post = get_post(pakb_subcat_get_the_ID());
    
    return apply_filters('pakb_the_title',$post->post_title);
    
}

add_filter('pakb_the_content', 'wptexturize');
add_filter('pakb_the_content', 'convert_smilies');
add_filter('pakb_the_content', 'convert_chars');
add_filter('pakb_the_content', 'wpautop');
add_filter('pakb_the_content', 'shortcode_unautop');
add_filter('pakb_the_content', 'prepend_attachment');

add_filter('pakb_the_title', 'wptexturize');
add_filter('pakb_the_title', 'convert_chars');
add_filter('pakb_the_title', 'trim');
