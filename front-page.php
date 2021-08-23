<?php
/**
 * The template for displaying the landing page.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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
 * @reference (WP)
 * 	Load header template.
 * 	https://developer.wordpress.org/reference/functions/get_header/
*/
?>
<?php get_header(); ?>

<?php
/**
 * @since 1.0.1
 * 	Load and render specific front page template for the child theme.
 * @param (string) $template_name
 * 	Specified template file to be loaded.
 * 	Default is [Parent]/template/content/archive.php.
 * @reference
 * 	[Child]/template/front-page.php
 * 	[Parent]/inc/utility/theme.php
*/
__utility_template_content(trailingslashit(get_stylesheet_directory()) . 'template/front-page.php');
?>

<?php
/**
 * @reference (WP)
 * 	Load footer template.
 * 	https://developer.wordpress.org/reference/functions/get_footer/
*/
?>
<?php get_footer(); ?>
