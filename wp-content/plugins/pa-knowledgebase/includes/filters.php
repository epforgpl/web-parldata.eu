<?php

/**
 * 
 * Rename the Columns for the knowledgebase post type and adding new Columns
 * 
 * @param array $columns
 * @return array
 */

function pakb_manage_edit_knowledgebase_columns($columns){
    
    $new_columns['cb']          = $columns['cb'];
    $new_columns['title']       = __('Title','pressapps');
    $new_columns['category']    = __('Category','pressapps');
    $new_columns['date']        = $columns['date'];

    return $new_columns;
}

add_filter('manage_edit-knowledgebase_columns','pakb_manage_edit_knowledgebase_columns');



