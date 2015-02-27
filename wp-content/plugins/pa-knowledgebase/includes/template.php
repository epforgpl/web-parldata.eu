<?php
/**
 * 
 * @package PressApps::Knowledge Base
 * @subpackage Template
 */


/**
 * 
 * get the proper File based on the $case 
 * 
 * @param string $case
 * @return string correct file path
 */
function pakb_get_template_files($case = 'single'){
    
    $default_path = PAKB_PLUGIN_DIR             . '/template/';
    $theme_path   = get_stylesheet_directory()  . '/pakb/'; 
    
    switch($case){
        case 'search':
            $filename       = 'knowledgebase-search.php';
            break;
        case 'archive':
            $filename       = 'knowledgebase-archive.php';
            break;
        case 'single':
        default :
            $filename       = 'knowledgebase-single.php';
            break;
        case 'category':
            $filename       = 'knowledgebase-category.php';
            break;
        case 'knowledgebase':
            $filename       = 'knowledgebase.php';
            break;
    }
    
    $default_file = $default_path . $filename;
    $theme_file   = $theme_path   . $filename;
    
    return ((file_exists($theme_file))?$theme_file:$default_file);
}


function pakb_load_file($filename){
    ob_start();
    include $filename;
    return ob_get_clean();
}
