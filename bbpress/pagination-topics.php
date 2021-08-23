<?php
/**
 * Pagination for pages of topics (when viewing a forum)
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
$index = basename(__FILE__,'.php');

/**
 * @reference (WP)
 * 	Retrieves name of the current stylesheet.
 * 	https://developer.wordpress.org/reference/functions/get_stylesheet/
*/
$theme = get_stylesheet();


/* Exec
______________________________
*/
?>
<?php
/**
 * [CASE]
 * In this sample child theme, you can know how to 
 * 	2. apply customization via bbPress hooks.
 * 	3. apply customization via bbPress template override.
 * 
 * @reference (bbp)
 * 	https://codex.bbpress.org/themes/
 * 	https://codex.bbpress.org/themes/theme-compatibility/getting-started-in-modifying-the-main-bbpress-template/
 * 	https://codex.bbpress.org/themes/theme-compatibility/template-hierarchy-in-detail/
*/
?>
<?php
do_action('bbp_template_before_pagination_loop');

/**
 * @reference (Beans)
 * 	HTML markup.
 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
*/
beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array('class' => 'bbp-pagination'));

	beans_open_markup_e("_wrapper[{$theme}][{$index}][count]",'div',array('class' => 'bbp-pagination-count'));
		/**
		 * @reference (bbp)
		 * 	Output the pagination count.
		 * 	http://hookr.io/functions/bbp_forum_pagination_count/
		*/
		bbp_forum_pagination_count();
	beans_close_markup_e("_wrapper[{$theme}][{$index}][count]",'div');

	beans_open_markup_e("_wrapper[{$theme}][{$index}][links]",'div',array('class' => 'bbp-pagination-links'));
		/**
		 * @reference (bbp)
		 * 	Output pagination links.
		 * 	http://hookr.io/functions/bbp_forum_pagination_links/
		*/
		bbp_forum_pagination_links();
	beans_close_markup_e("_wrapper[{$theme}][{$index}][links]",'div');

beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');

do_action('bbp_template_after_pagination_loop');
