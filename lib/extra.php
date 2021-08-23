<?php
/**
 * Customize bbPress components.
 * @package Windmill BBS
 * @license GPL-3.0+
 * @since 1.0.1
*/

/**
 * Inspired by Beans Framework WordPress Theme
 * @link https://www.getbeans.io
 * @author Thierry Muller
 * 
 * Inspired by bbPress WordPress Plugin
 * @link https://bbpress.org
 * @author The bbPress Contributors
*/


/* Prepare
______________________________
*/

// If this file is called directly,abort.
if(!defined('WPINC')){die;}

// Set identifiers for this template.
// $index = basename(__FILE__,'.php');

/**
 * @reference (WP)
 * 	Retrieves name of the current stylesheet.
 * 	https://developer.wordpress.org/reference/functions/get_stylesheet/
*/
// $theme = get_stylesheet();


/* Exec
______________________________
*/
/**
 * [CASE]
 * 	2. apply customization via bbPress hooks.
 * 	3. apply customization via bbPress template override.
 * 
 * [TOC]
 * 	init()
 * 	template_redirect()
*/

	/**
	 * @reference (Beans)
	 * 	Remove parent theme's profile widget from sidebar.
	 * 	https://www.getbeans.io/code-reference/functions/beans_remove_action/
	 * @reference
	 * 	[Parent]/controller/structure/sidebar.php
	 * 	[Parent]/model/widget/profile.php
	*/
	beans_remove_action('_structure_sidebar__the_profile');

	/**
	 * @reference (Beans)
	 * 	Remove parent theme's related posts widget from single post.
	 * 	https://www.getbeans.io/code-reference/functions/beans_remove_action/
	 * @reference
	 * 	[Parent]/controller/structure/single.php
	 * 	[Parent]/template-part/content/content-single.php
	*/
	beans_remove_action('_structure_single__the_relation');
