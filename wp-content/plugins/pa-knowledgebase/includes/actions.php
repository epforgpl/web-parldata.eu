<?php

/**
 * 
 * Add the Additional column Values for the knowledgebase Post Type
 * 
 * @global type $post
 * @param string $column
 */

function pakb_manage_custom_column($column){
    global $post;
    switch($column){
        case 'category':
            $terms = wp_get_object_terms($post->ID  ,'knowledgebase_category');
            foreach($terms as $term){
                $temp  = " <a href=\"" . admin_url('edit-tags.php?action=edit&taxonomy=knowledgebase_category&tag_ID=' . $term->term_id . '&post_type=knowledgebase') . "\" ";
                $temp .= " class=\"row-title\">{$term->name}</a><br/>";
                echo $temp;
            }
            break;
    }
}

add_action( 'manage_knowledgebase_posts_custom_column' , 'pakb_manage_custom_column'); 

/**
 * Category Based Filtering options
 * 
 * @global string $typenow
 */

function pakb_restrict_manage_posts(){
    global $typenow;
    
    if($typenow=='knowledgebase'){
        ?>
        <select name="knowledgebase_category">
            <option value="0"><?php _e( 'View all categories' ); ?></option>
        <?php
        $categories = get_terms('knowledgebase_category');
        if(count($categories)>0){
            foreach($categories as $cat){
                if($_GET['knowledgebase_category']==$cat->slug){
                    echo "<option value={$cat->slug} selected=\"selected\">{$cat->name}</option>";
                }else{
                    echo "<option value={$cat->slug} >{$cat->name}</option>";
                }
            }
        }
        ?>
        </select>
        <?php
    }
    
}

add_action('restrict_manage_posts','pakb_restrict_manage_posts');

add_action( 'pre_get_posts', 'pakb_pre_get_posts' );

function pakb_pre_get_posts($query){
    global $pakb_settings;
    if(($pakb_settings['reorder'] != 1))
        return ;
    
    if(
             (  $query->is_post_type_archive('knowledgebase') 
             || $query->is_tax('knowledgebase_category')      || $query->is_tax('knowledgebase_tags') 
             || (isset($query->query_vars['page_id'])?($query->query_vars['page_id'] == ($pakb_settings['knowledgebase_page'])):FALSE)
             || ($query->is_search() && (isset($_REQUEST['post_type'])?($_REQUEST['post_type']=='knowledgebase'):FALSE)   )
             ) && $query->is_main_query()
      ){
        $query->set('orderby'   ,'menu_order');
        $query->set('order'     ,'ASC');
    }
    
}

