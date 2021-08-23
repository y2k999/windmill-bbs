<?php
/**
 * Enqueue styles and scripts for this child theme.
 * @link https://codex.wordpress.org/Template_Hierarchy
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
$theme = get_stylesheet();


/* Exec
______________________________
*/
?>
<?php

	/**
	 * @since 1.0.1
	 * 	Only front-end scripts for this child theme.
	 * @reference (WP)
	 * 	Determines whether the current request is for an administrative interface page.
	 * 	https://developer.wordpress.org/reference/functions/is_admin/
	*/
	if(is_admin()){return;}


	// Invoke PHP_CSS plugin.
	if(class_exists('PHP_CSS') === FALSE) :
		get_template_part(SLUG['plugin'] . 'php-css/php-css');
	endif;
	$php_css = new PHP_CSS;


	/**
	 * @since 1.0.1
	 * 	bbPress plugin styles.
	 * @reference
	 * 	[Parent]/inc/setup/constant.php
	*/

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums li.bbp-header, #bbpress-forums li.bbp-footer');
	$php_css->add_properties(array(
		'background' => '#AAD6EC',
		'border-top' => '1px solid #eee',
	));

	// Add a single property.
	$php_css->set_selector('#bbpress-forums li.bbp-header');
	$php_css->add_property('background','#AAD6EC');

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums');
	$php_css->add_properties(array(
		'font-size' => FONT['small'],
		'line-height' => '1.5',
	));

	// Add a single property.
	$php_css->set_selector('#bbpress-forums ul.bbp-lead-topic, #bbpress-forums ul.bbp-topics, #bbpress-forums ul.bbp-forums, #bbpress-forums ul.bbp-replies, #bbpress-forums ul.bbp-search-results');
	$php_css->add_property('font-size',FONT['small']);

	// Add a single property.
	$php_css->set_selector('#bbpress-forums .bbp-forums-list .bbp-forum');
	$php_css->add_property('font-size',FONT['small']);

	// Add a single property.
	$php_css->set_selector('#bbpress-forums div.bbp-forum-title h3, #bbpress-forums div.bbp-topic-title h3, #bbpress-forums div.bbp-reply-title h3');
	$php_css->add_property('font-size',FONT['large']);

	// Add a single property.
	$php_css->set_selector('#bbpress-forums div.bbp-forum-author .bbp-author-role, #bbpress-forums div.bbp-topic-author .bbp-author-role, #bbpress-forums div.bbp-reply-author .bbp-author-role');
	$php_css->add_property('font-size',FONT['small']);

	// Add multiple properties at once.
	$php_css->set_selector('span.bbp-author-ip');
	$php_css->add_properties(array(
		'font-size' => FONT['small'],
		'color' => '#747474',
	));

	// Add a single property.
	$php_css->set_selector('div.bbp-breadcrumb, div.bbp-topic-tags');
	$php_css->add_property('font-size',FONT['small']);

	// Add multiple properties at once.
	$php_css->set_selector('span.bbp-admin-links a');
	$php_css->add_properties(array(
		'font-size' => FONT['xsmall'],
		'color' => '#707070',
	));

	// Add multiple properties at once.
	$php_css->set_selector('.bbp-row-actions #favorite-toggle a');
	$php_css->add_properties(array(
		'color' => '#7c7',
		'border' => '1px solid #aca',
		'background' => '#dfd',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('.bbp-row-actions #subscription-toggle a');
	$php_css->add_properties(array(
		'color' => '#7c7',
		'border' => '1px solid #aca',
		'background' => '#dfd',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums .bbp-forum-info .bbp-forum-content, #bbpress-forums p.bbp-topic-meta');
	$php_css->add_property('font-size',FONT['xsmall']);

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums .bbp-pagination-links a, #bbpress-forums .bbp-pagination-links span.current');
	$php_css->add_properties(array(
		'border' => '1px solid #efefef',
		'line-height' => '1.5',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums .bbp-topic-pagination a');
	$php_css->add_properties(array(
		'color' => 'inherit',
		'border' => '1px solid #ddd',
		'line-height' => '1',
		'font-size' => FONT['xsmall'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('body.page .bbp-reply-form code, body.page .bbp-topic-form code, body.single-topic .bbp-reply-form code, body.single-forum .bbp-topic-form code, body.topic-edit .bbp-topic-form code, body.reply-edit .bbp-reply-form code');
	$php_css->add_properties(array(
		'border' => '1px solid #ceefe1',
		'background' => '#f0fff8',
		'font-size' => FONT['xsmall'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums #bbp-your-profile fieldset p.description');
	$php_css->add_properties(array(
		'border' => '1px solid #cee1ef',
		'background' => '#f0f8ff',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('div.bbp-template-notice p, div.bbp-template-notice li');
	$php_css->add_properties(array(
		'line-height' => '1.5',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums div.bbp-template-notice code');
	$php_css->add_properties(array(
		'background' => 'rgba(200, 200, 200, 0.3)',
		'font-size' => FONT['xsmall'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('.bbp-topics-front ul.super-sticky, bbp-topics ul.super-sticky, bbp-topics ul.sticky, bbp-forum-content ul.sticky');
	$php_css->add_properties(array(
		'background' => 'ffffe0 !important',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums .bbp-topic-content ul.bbp-topic-revision-log, #bbpress-forums .bbp-reply-content ul.bbp-topic-revision-log, #bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log');
	$php_css->add_properties(array(
		'border-top' => '1px dotted #ddd',
		'color' => '#aaa',
		'font-size' => FONT['xsmall'],
	));

	// Add a single property.
	$php_css->set_selector('.bbp-logged-in h4');
	$php_css->add_property('font-size',FONT['large']);

	// Add multiple properties at once.
	$php_css->set_selector('#bbpress-forums h1');
	$php_css->add_properties(array(
		'line-height' => '1',
		'font-size' => FONT['xlarge'],
	));

	// Add a single property.
	$php_css->set_selector('#bbpress-forums #bbp-user-wrapper h2.entry-title');
	$php_css->add_property('font-size',FONT['xlarge']);

	// Add a single property.
	$php_css->set_selector('.bbp-login-form .bbp-form');
	$php_css->add_property('border','none');

	// Add a single property.
	$php_css->set_selector('.bbp-login-form .bbp-form .bbp-remember-me label');
	$php_css->add_property('width','90% !important');

	// Add multiple properties at once.
	$php_css->set_selector('.site-main .' . $theme . ' .caption-title');
	$php_css->add_properties(array(
		'padding' => '0.25rem',
		'font-size' => FONT['small'],
	));

	// Add multiple properties at once.
	$php_css->set_selector('.site-main .' . $theme . ' .caption-meta');
	$php_css->add_properties(array(
		'padding' => '0.25rem',
		'font-size' => FONT['xsmall'],
	));


	/**
	 * @since 1.0.1
	 * 	Register the handle of inline css.
	 * @reference
	 * 	[Parent]/inc/utility/general.php
	*/
	wp_register_style(__utility_make_handle('inline'),trailingslashit(get_stylesheet_directory_uri()) . 'asset/style/dummy.min.css');
	wp_enqueue_style(__utility_make_handle('inline'));


	/**
	 * @reference (WP)
	 * 	Add extra CSS styles to a registered stylesheet.
	 * 	https://developer.wordpress.org/reference/functions/wp_add_inline_style/
	 * @param (string) $handle
	 * 	Name of the stylesheet to add the extra styles to.
	 * @param (string) $data
	 * 	String containing the CSS styles to be added.
	 * @reference
	 * 	[Parent]/inc/utility/general.php
	*/
	wp_add_inline_style(__utility_make_handle('inline'),$php_css->css_output());
