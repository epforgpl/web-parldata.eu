<?php 
header("Content-type: text/css;");
$current_url = dirname(__FILE__);
$wp_content_pos = strpos($current_url, 'wp-content');
$wp_content = substr($current_url, 0, $wp_content_pos);
require_once($wp_content . 'wp-load.php');


$highlight_color  = get_theme_mod('highlight_color');
$body_font  = get_theme_mod('body_font');
?>

h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{font-family:"<?php echo $body_font;?>",Helvetica Neue,Helvetica,Arial,sans-serif;}
body{font-family:"<?php echo $body_font;?>",Helvetica Neue,Helvetica,Arial,sans-serif;}
a {color:<?php echo $highlight_color;?>;}
#container #menu-wrap .menu-item span {color:<?php echo $highlight_color;?>;}
#back-to-top:hover{background:<?php echo $highlight_color;?>;}
.btn, #searchsubmit, #submit, .wpcf7-submit, #content input.button, button, html input[type="button"], input[type="reset"], input[type="submit"]{background:<?php echo $highlight_color;?>;}
.sc-parallax .btn.hollow {background:none;}
.featurebox-icon{background-color:<?php echo $highlight_color;?>;}
.p-table-table .featured .p-table-header{background-color:<?php echo $highlight_color;?>;}
.aq_block_tabs ul.aq-nav li.ui-tabs-active a{background-color:<?php echo $highlight_color;?>;}
.tabs-left > .nav-tabs .active > a,.tabs-left > .nav-tabs .active > a:hover{background-color:<?php echo $highlight_color;?>;}
.aq_block_tabs ul.aq-nav li a{color:<?php echo $highlight_color;?>;}
.pagination ul > li > a,.pagination ul > li > span{color:<?php echo $highlight_color;?>;}
.progress-striped .bar{background:<?php echo $highlight_color;?>;}
.right .col-md-3 li a:hover{color:<?php echo $highlight_color;?>;}
.sidebar .tagcloud a:hover{border:1px solid <?php echo $highlight_color;?>;}
.tabs-left > .nav-tabs > li a:hover{color:<?php echo $highlight_color;?>;}
.footer .tagcloud a:hover{border:1px solid <?php echo $highlight_color;?>;}
.dropdown-menu a:hover{background:<?php echo $highlight_color;?>;}
.dropdown-menu>li>a:hover{background-color:<?php echo $highlight_color;?>!important;background-image:none;color:#fff!important;}
textarea:focus,input[type="text"]:focus,input[type="password"]:focus,input[type="datetime"]:focus,input[type="datetime-local"]:focus,input[type="date"]:focus,input[type="month"]:focus,input[type="time"]:focus,input[type="week"]:focus,input[type="number"]:focus,input[type="email"]:focus,input[type="url"]:focus,input[type="search"]:focus,input[type="tel"]:focus,input[type="color"]:focus,.uneditable-input:focus{border-color:<?php echo $highlight_color;?>!important;box-shadow:none!important;transition:all linear 0.15s;-ms-transition:all linear 0.15s;-moz-transition:all linear 0.15s;-webkit-transition:all linear 0.15s;-o-transition:all linear 0.15s;}
.label,.badge{background:<?php echo $highlight_color;?>;}
.pagination > li > a:hover,ul.pagination .current:hover,ul.pagination > .active > span{background-color:<?php echo $highlight_color;?>;}
.sidebar .tagcloud a:hover{border-color:<?php echo $highlight_color;?>;color:#555;}
.twit-banner:after {border-color:<?php echo $highlight_color;?> rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);}
.twit-banner {background:<?php echo $highlight_color;?>;}
.hi-icon-effect-1 .hi-icon {background:<?php echo $highlight_color;?>;}
div.wpcf7-validation-errors {border-color:<?php echo $highlight_color;?>;border-radius:3px;}
span.wpcf7-not-valid-tip {color:<?php echo $highlight_color;?>;}
.scr-icon, .sc-info h2, .feature-box .sc-highlight-icon {color:<?php echo $highlight_color;?>;}
.sc-date-wrap, .sc-tour .container .tour-icon {background:<?php echo $highlight_color;?>;}
#changingtext span {color:<?php echo $highlight_color;?>;}
.sc_stats .fa {color:<?php echo $highlight_color;?>;}
ul.social li a {color:<?php echo $highlight_color;?>;}
ul.social li:hover {background:<?php echo $highlight_color;?>;}
.sc-tags a:hover {background:<?php echo $highlight_color;?>;}
.sidebar a:hover {color:<?php echo $highlight_color;?>;}
.aq-block-pg_slider_block .hollow.btn:hover {border-color:<?php echo $highlight_color;?>!important;}
.no-touch .hi-icon-effect-1a .hi-icon:hover{color:<?php echo $highlight_color;?>;}
.aq-block-pg_slider_block .hollow.btn:hover, .sc-parallax .hollow.btn:hover, .sc-parallax .btn:hover {border:2px solid <?php echo $highlight_color;?> !important}
.sc_select a {background:<?php echo $highlight_color;?>;}
.sticky h3 {color:<?php echo $highlight_color;?>;}

.pagination li > span.current {color:<?php echo $highlight_color;?>;}
.ui-widget-header {background:<?php echo $highlight_color;?>!important;border-color:<?php echo $highlight_color;?>}
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {background:<?php echo $highlight_color;?>!important;border-color:<?php echo $highlight_color;?>;color:#fff!important;}