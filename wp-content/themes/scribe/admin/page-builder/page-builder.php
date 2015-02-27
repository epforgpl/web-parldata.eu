<?php
 /**
 * Copyright (c) 2013 Syamil MJ. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

//definitions

if(!defined('AQPB_PATH')) define( 'AQPB_PATH', get_template_directory() . '/admin/page-builder/' );
if(!defined('AQPB_DIR')) define( 'AQPB_DIR', get_template_directory_uri() . '/admin/page-builder/' );

//required functions & classes
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');

require_once(AQPB_PATH . 'functions/aqpb_functions.php');

//some default blocks
require_once(AQPB_PATH . 'blocks/aq-alert-block.php');
require_once(AQPB_PATH . 'blocks/aq-clear-block.php');
require_once(AQPB_PATH . 'blocks/aq-column-block.php');
require_once(AQPB_PATH . 'blocks/aq-text-block.php');
require_once(AQPB_PATH . 'blocks/testimonial-block.php');
require_once(AQPB_PATH . 'blocks/pricetable-block.php');
require_once(AQPB_PATH . 'blocks/video-block.php');
require_once(AQPB_PATH . 'blocks/googlemap-block.php');
require_once(AQPB_PATH . 'blocks/contact-block.php');
require_once(AQPB_PATH . 'blocks/stats-block.php');
require_once(AQPB_PATH . 'blocks/heading-block.php');
require_once(AQPB_PATH . 'blocks/image-block.php');
require_once(AQPB_PATH . 'blocks/team-block.php');
require_once(AQPB_PATH . 'blocks/twitter-block.php');
require_once(AQPB_PATH . 'blocks/features-block.php');
require_once(AQPB_PATH . 'blocks/button-block.php');
require_once(AQPB_PATH . 'blocks/tabs-block.php');
require_once(AQPB_PATH . 'blocks/progressbar-block.php');
require_once(AQPB_PATH . 'blocks/gallery-block.php');
require_once(AQPB_PATH . 'blocks/highlights-block.php');
require_once(AQPB_PATH . 'blocks/parallax-block.php');
require_once(AQPB_PATH . 'blocks/slider-block.php');
require_once(AQPB_PATH . 'blocks/stretchbanner-block.php');
require_once(AQPB_PATH . 'blocks/tour-block.php');
require_once(AQPB_PATH . 'blocks/carousel-block.php');
require_once(AQPB_PATH . 'blocks/infobanner-block.php');
require_once(AQPB_PATH . 'blocks/showcase-block.php');
require_once(AQPB_PATH . 'blocks/countdown-block.php');
require_once(AQPB_PATH . 'blocks/icon-block.php');
require_once(AQPB_PATH . 'blocks/anchor-block.php');
require_once(AQPB_PATH . 'blocks/posts-block.php');

//register blocks

aq_register_block('AQ_Alert_Block');
aq_register_block('PG_Anchor_Block');
aq_register_block('PG_Button_Block');
aq_register_block('PG_Carousel_Block');
aq_register_block('AQ_Clear_Block');
aq_register_block('AQ_Column_Block');
aq_register_block('PG_Contact_Block');
aq_register_block('PG_Countdown_Block');
aq_register_block('PG_Features_Block');
aq_register_block('PG_Gallery_Block');
aq_register_block('PG_Googlemap_Block');
aq_register_block('PG_Heading_Block');
aq_register_block('PG_Highlights_Block');
aq_register_block('PG_Icon_Block');
aq_register_block('PG_Image_Block');
aq_register_block('PG_Infobanner_Block');
aq_register_block('PG_Parallax_Block');
aq_register_block('PG_Pricetable_Block');
aq_register_block('PG_Progressbar_Block');
aq_register_block('PG_Posts_Block');
aq_register_block('PG_Slider_Block');
aq_register_block('PG_Showcase_Block');
aq_register_block('PG_Stats_Block');
aq_register_block('PG_Stretchbanner_Block');
aq_register_block('PG_Tabs_Block');
aq_register_block('PG_Team_Block');
aq_register_block('PG_Testimonial_Block');
aq_register_block('AQ_Text_Block');
aq_register_block('PG_Tour_Block');
aq_register_block('PG_Twitter_Block');
aq_register_block('PG_Video_Block');

//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder = new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
