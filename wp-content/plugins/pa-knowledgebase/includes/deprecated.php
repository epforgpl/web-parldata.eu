<?php

global $knowledgebase_settings,$pakb_settings;

/**
 * Old Variable reference for some of the templates files
 * @deprecated since version 1.1.2
 */
$knowledgebase_settings = $pakb_settings;

/**
 * 
 * @deprecated since version 1.1.2
 */
function knowledgebase_icon(){
    return pakb_icon(); 
}

/**
 * 
 * @deprecated since version 1.1.3
 */
function pakb_kb_page_the_content(){
    pakb_process_kbpage();
    
    return pakb_load_file(pakb_get_template_files('knowledgebase'));;   
}