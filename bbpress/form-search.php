<?php
/**
 * Search
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
/**
 * @reference (bbp)
 * 	Is forum-wide searching allowed.
 * 	http://hookr.io/plugins/bbpress/2.5.9/filters/bbp_allow_search/
*/
if(bbp_allow_search()){
	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e("_form[{$theme}][{$index}]",'form',array(
		'id' => 'bbp-search-form',
		'class' => 'uk-search uk-search-default uk-padding-small uk-width-1-1',
		'method' => 'get',
		'action' => esc_url(home_url('/')),
		'role' => 'search',
	));
		beans_open_markup_e("_icon[{$theme}][{$index}]",'span',array(
			'class' => 'uk-padding-small',
			'uk-search-icon' => '',
		));
		beans_close_markup_e("_icon[{$theme}][{$index}]",'span');

		beans_open_markup_e("_input[{$theme}][{$index}]",'input',array(
			'type' => 'search',
			'id' => 'bbp_search',
			'name' => 'bbp_search',
			'class' => 'uk-search-input',
			/**
			 * @reference (bbp)
			 * 	The WordPress Core bbp get search terms hook.
			 * 	http://hookr.io/filters/bbp_get_search_terms/
			*/
			'value' => esc_attr(bbp_get_search_terms()),
			'placeholder' => esc_attr__('bbPress Search','windmill'),
		));

	beans_close_markup_e("_form[{$theme}][{$index}]",'form');
}
