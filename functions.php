<?php
/**
 * Functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
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
?>
<?php
/**
 * [NOTE]
 * This WordPress theme is the child theme of Windmill.
 * https://github.com/y2k999/windmill
 * 
 * This theme requires the Beans Extension plugin.
 * https://github.com/y2k999/beans-extension
*/

/**
 * [CASE]
 * In this sample child theme, you can know how to 
 * 	1. setup bbPress compatible environment.
 * 	2. apply customization via bbPress hooks.
 * 	3. apply customization via bbPress template override.
*/

	/**
	 * @since 1.0.1
	 * 	Setup theme.
	*/
	require_once (trailingslashit(get_stylesheet_directory()) . 'lib/setup.php');
	require_once (trailingslashit(get_stylesheet_directory()) . 'lib/widget.php');


	/**
	 * @reference (WP)
	 * 	Fires when scripts and styles are enqueued.
	 * 	https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
	 * @reference
	 * 	[Parent]/inc/utility/general.php
	*/
	add_action('wp_enqueue_scripts',function()
	{
		// Enqueue child theme's root stylesheet.
		wp_enqueue_style(__utility_make_handle('base-child'),trailingslashit(get_stylesheet_directory_uri()) . 'style.css');

		// Enqueue scripts and styles (including inline style).
		require_once (trailingslashit(get_stylesheet_directory()) . 'lib/enqueue.php');

	},99);


	/**
	 * [NOTE]
	 * 	Set priority higher than parent theme.
	 * 
	 * @reference (WP)
	 * 	Fires after the theme is loaded.
	 * 	https://developer.wordpress.org/reference/hooks/after_setup_theme/
	 * @reference
	 * 	[Parent]/inc/utility/general.php
	 * 	[Parent]/inc/customizer/setup.php
	 * 	[Parent]/inc/customizer/color.php
	 * 	[Parent]/inc/env/enqueue.php
	*/
	add_action('after_setup_theme',function()
	{
		// Render components.
		require_once (trailingslashit(get_stylesheet_directory()) . 'lib/controller.php');

	},99);


	// Theme colors.
	if(is_admin() || is_customize_preview()){
		require_once (trailingslashit(get_stylesheet_directory()) . 'lib/color.php');
	}

	// Hooks.
	require_once (trailingslashit(get_stylesheet_directory()) . 'lib/extra.php');
