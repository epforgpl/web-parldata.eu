<?php

function pakb_get_dummy_post_data($args){
    
    return array_merge(array(
        'ID'                    => 0,
        'post_status'           => 'publish',
        'post_author'           => 0,
        'post_parent'           => 0,
        'post_type'             => 'page',
        'post_date'             => 0,
        'post_date_gmt'         => 0,
        'post_modified'         => 0,
        'post_modified_gmt'     => 0,
        'post_content'          => '',
        'post_title'            => '',
        'post_excerpt'          => '',
        'post_content_filtered' => '',
        'post_mime_type'        => '',
        'post_password'         => '',
        'post_name'             => '',
        'guid'                  => '',
        'menu_order'            => 0,
        'pinged'                => '',
        'to_ping'               => '',
        'ping_status'           => '',
        'comment_status'        => 'closed',
        'comment_count'         => 0,
        'filter'                => 'raw',

        

    ),$args);
}

function pakb_override_is_var(){
    global $wp_query;
    
    $wp_query->is_tax                   = FALSE;
    $wp_query->is_archive               = FALSE;
    $wp_query->is_search                = FALSE;
    $wp_query->is_single                = FALSE;
    $wp_query->is_post_type_archive     = FALSE;
    
    $wp_query->is_404                   = FALSE;
    
    $wp_query->is_singular              = TRUE;
    $wp_query->is_page                  = TRUE;
}

// add post-formats support
add_post_type_support( 'knowledgebase', 'post-formats' );


function pakb_search() {
    global $pakb_settings;
    if ( $pakb_settings['search'] == 1) { ?>
        <form role="search" method="get" id="kbsearchform" action="<?php echo home_url('/'); ?>" >
            <div class="knowledgebase-search">
                <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" /><span><input type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search'); ?>" /></span>
                <input type="hidden" name="post_type" value="knowledgebase" />
            </div>
        </form>
    <?php
    }
}


function pakb_print_css() {

    global $pakb_settings;

    echo '<style text="text/css"id="knowledgebase-style-css">' . "\n";

    if ( $pakb_settings['color'] ) {
        echo '.knowledgebase-main h2 a, .knowledgebase-main h2 a:hover, .knowledgebase-main h2 a:visited, .knowledgebase-main h2 i, .knowledgebase-archive a h3, knowledgebase-archive a:hover h3, knowledgebase-archive h3 i,.knowledgebase-single a, .knowledgebase-single a:hover { color: ' . sanitize_text_field( $pakb_settings['color'] ) . "}\n" ;
    }
    if ( $pakb_settings['posts_color'] ) {
        echo '.knowledgebase-main li a, .knowledgebase-main li a:hover, .knowledgebase-main li a:visited, .knowledgebase-main li i { color: ' . sanitize_text_field( $pakb_settings['posts_color'] ) . "}\n" ;
    }
       
    echo "</style>\n";
}

function pakb_print_custom_css() {

    global $pakb_settings;

    echo '<style text="text/css" id="knowledgebase-custom-css">' . "\n" . sanitize_text_field( $pakb_settings['custom-css'] ) . "\n</style>\n";
}

/*-----------------------------------------------------------------------------------*/
/* Post format icons */
/*-----------------------------------------------------------------------------------*/

function pakb_icon() {
    if (get_post_format() == 'video') {
        return 'pakb-icon-video';
    } elseif (get_post_format() == 'image') {
        return 'pakb-icon-picture';
    } else {
        return 'pakb-icon-doc-text';
    }
}

/*-----------------------------------------------------------------------------------*/
/* Voting */
/*-----------------------------------------------------------------------------------*/

function pakb_votes($is_ajax = FALSE) {

        global $pakb_settings;        
        global $post;
        $votes_like = (int) get_post_meta($post->ID, '_votes_likes', true);
        $votes_dislike = (int) get_post_meta($post->ID, '_votes_dislikes', true);
        $voted_like             = sprintf(_n('%s person found this helpful', '%s people found this helpful', $votes_like, 'pressapps'), $votes_like);
        $voted_dislike  = sprintf(_n('%s person did not find this helpful', '%s people did not find this helpful', $votes_dislike, 'pressapps'), $votes_dislike);
        $vote_like_link                 = __("I found this helpful", 'pressapps');
        $vote_dislike_link      = __("I did not find this helpful", 'pressapps');
        $cookie_vote_count      = '';
        
        if(isset($_COOKIE['vote_count'])){
            $cookie_vote_count = @unserialize(base64_decode($_COOKIE['vote_count']));
        }
        
        if(!is_array($cookie_vote_count) && isset($cookie_vote_count)){
            $cookie_vote_count = array();
        }
       
        echo (($is_ajax)?'':'<div class="votes">');
                                
        if (is_user_logged_in() || $pakb_settings['voting'] == 1) :
            
                if(is_user_logged_in())
                    $vote_count = (array) get_user_meta(get_current_user_id(), 'vote_count', true);
                else
                    $vote_count = $cookie_vote_count;
                
                if (!in_array( $post->ID, $vote_count )) :

                        echo '<p data-toggle="tooltip" title="' . $vote_like_link . '" class="likes"><a class="pakb-like-btn" href="javascript:" post_id="'  . $post->ID . '"><i class="pakb-icon-thumbs-up"></i><span class="count">' . $votes_like . '</span></a></p>';
                        echo '<p data-toggle="tooltip" title="' . $vote_dislike_link . '" class="dislikes"><a class="pakb-dislike-btn" href="javascript:" post_id="' . $post->ID . '"><i class="pakb-icon-thumbs-down"></i><span class="count">' . $votes_dislike . '</span></a></p>';

                else :
                        // already voted
                        echo '<p data-toggle="tooltip" title="' . $voted_like . '" class="likes"><i class="pakb-icon-thumbs-up"></i><span class="count">' . $votes_like . '</span></p>';
                        echo '<p data-toggle="tooltip" title="' . $voted_dislike . '" class="dislikes"><i class="pakb-icon-thumbs-down"></i><span class="count">' . $votes_dislike . '</span></p>';
                endif;
        
        else :
                // not logged in
                echo '<p data-toggle="tooltip" title="' . $voted_like . '" class="likes"><i class="pakb-icon-thumbs-up"></i><span class="count">' . $votes_like . '</span></p>';
                echo '<p data-toggle="tooltip" title="' . $voted_dislike . '" class="dislikes"><i class="pakb-icon-thumbs-down"></i><span class="count">' . $votes_dislike . '</span></p>';
        endif;
        
        echo (($is_ajax)?'':'</div>');

}

function pakb_vote() {
    global $post;
    global $pakb_settings;    

    if (is_user_logged_in()) {
        
        $vote_count = (array) get_user_meta(get_current_user_id(), 'vote_count', true);
        
        if (isset( $_GET['pakb_vote_like'] ) && $_GET['pakb_vote_like']>0) :
                
                $post_id = (int) $_GET['pakb_vote_like'];
                $the_post = get_post($post_id);
                
                if ($the_post && !in_array( $post_id, $vote_count )) :
                        $vote_count[] = $post_id;
                        update_user_meta(get_current_user_id(), 'vote_count', $vote_count);
                        $post_votes = (int) get_post_meta($post_id, '_votes_likes', true);
                        $post_votes++;
                        update_post_meta($post_id, '_votes_likes', $post_votes);
                        $post = get_post($post_id);
                        pakb_votes(true);
                        die('');
                endif;
                
        elseif (isset( $_GET['pakb_vote_dislike'] ) && $_GET['pakb_vote_dislike']>0) :
                
                $post_id = (int) $_GET['pakb_vote_dislike'];
                $the_post = get_post($post_id);
                
                if ($the_post && !in_array( $post_id, $vote_count )) :
                        $vote_count[] = $post_id;
                        update_user_meta(get_current_user_id(), 'vote_count', $vote_count);
                        $post_votes = (int) get_post_meta($post_id, '_votes_dislikes', true);
                        $post_votes++;
                        update_post_meta($post_id, '_votes_dislikes', $post_votes);
                        $post = get_post($post_id);
                        pakb_votes(true);
                        die('');
                        
                endif;
                
        endif;

    } elseif (!is_user_logged_in() && $pakb_settings['voting'] == 1) {

        // ADD VOTING FOR NON LOGGED IN USERS USING COOKIE TO STOP REPEAT VOTING ON AN ARTICLE
        $vote_count = '';
        
        if(isset($_COOKIE['vote_count'])){
            $vote_count = @unserialize(base64_decode($_COOKIE['vote_count']));
        }
        
        if(!is_array($vote_count) && isset($vote_count)){
            $vote_count = array();
        }
        
        if (isset( $_GET['pakb_vote_like'] ) && $_GET['pakb_vote_like']>0) :
                
                $post_id = (int) $_GET['pakb_vote_like'];
                $the_post = get_post($post_id);
                
                if ($the_post && !in_array( $post_id, $vote_count )) :
                        $vote_count[] = $post_id;
                        $_COOKIE['vote_count']  = base64_encode(serialize($vote_count));
                        setcookie('vote_count', $_COOKIE['vote_count'] , time()+(10*365*24*60*60),'/');
                        $post_votes = (int) get_post_meta($post_id, '_votes_likes', true);
                        $post_votes++;
                        update_post_meta($post_id, '_votes_likes', $post_votes);
                        $post = get_post($post_id);
                        pakb_votes(true);
                        die('');
                endif;
                
        elseif (isset( $_GET['pakb_vote_dislike'] ) && $_GET['pakb_vote_dislike']>0) :
                
                $post_id = (int) $_GET['pakb_vote_dislike'];
                $the_post = get_post($post_id);
                
                if ($the_post && !in_array( $post_id, $vote_count )) :
                        $vote_count[] = $post_id;
                        $_COOKIE['vote_count']  = base64_encode(serialize($vote_count));
                        setcookie('vote_count', $_COOKIE['vote_count'] , time()+(10*365*24*60*60),'/');
                        $post_votes = (int) get_post_meta($post_id, '_votes_dislikes', true);
                        $post_votes++;
                        update_post_meta($post_id, '_votes_dislikes', $post_votes);
                        $post = get_post($post_id);
                        pakb_votes(true);
                        die('');
                        
                endif;
                
        endif;

    } elseif (!is_user_logged_in() && $pakb_settings['voting'] == 2) {

        return;
        
    }
        
}

add_action('init', 'pakb_vote');

add_action('wp_head','pakb_common_js');

function pakb_common_js(){
    $pakb = array(
        'base_url'  => esc_url(home_url()),
    );
    ?>
<script type="text/javascript">
    PAKB = <?php echo json_encode($pakb); ?>;
</script>
    <?php
}

function pakb_is_catCount_enable(){
    global $pakb_settings;
    
    if(!isset($pakb_settings['category_count']))
        return FALSE;
    else
        return (bool)$pakb_settings['category_count'];
    
}

