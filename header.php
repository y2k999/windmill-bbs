<?php
/**
 * The template for displaying the header.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
<!DOCTYPE html>
<?php
/**
 * @reference (WP)
 * 	Displays the language attributes for the ehtmlf tag.
 * 	https://developer.wordpress.org/reference/functions/language_attributes/
*/
?>
<html <?php language_attributes(); ?>>

<!-- ====================
	<head>
 ==================== -->
<?php
/**
 * @reference (WP)
 * 	Displays information about the current site.
 * 	https://developer.wordpress.org/reference/functions/bloginfo/
 * 	Fire the wp_head action.
 * 	https://developer.wordpress.org/reference/functions/wp_head/
 * @reference
 * 	[Parent]/inc/setup/constant.php
*/
?>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php do_action(HOOK_POINT['head']['before']); ?>
	<?php wp_head(); ?>
	<?php do_action(HOOK_POINT['head']['after']); ?>
</head>

<!-- ====================
	<body>
 ==================== -->
<?php
/**
 * @reference (WP)
 * 	Displays the class names for the body element.
 * 	https://developer.wordpress.org/reference/functions/body_class/
 * 	Fire the wp_body_open action.
 * 	https://developer.wordpress.org/reference/functions/wp_body_open/
*/
?>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php do_action(HOOK_POINT['site']['before']); ?>

<div id="page" class="<?php echo apply_filters("_class[root][site]",esc_attr('hfeed site')); ?>">

<?php if(apply_filters("_filter[root][skiplink]",TRUE)) : ?>
	<a class="screen-reader-text skip-link" href="#content"><?php echo apply_filters("_output[root][skip-link]",esc_html__('Skip to content.','windmill')); ?></a>
<?php endif; ?>

<?php
/**
 * @since 1.0.1
 * 	Load and render specific header template for the child theme.
 * @reference (WP)
 * 	Retrieves stylesheet directory path for current theme.
 * 	https://developer.wordpress.org/reference/functions/get_stylesheet_directory/
 * @reference
 * 	[Child]/template/header.php
 * 	[Parent]/inc/utility/theme.php
*/
__utility_template_header(trailingslashit(get_stylesheet_directory()) . 'template/header.php');
