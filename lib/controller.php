<?php
/**
 * bbPress functions and definitions.
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
 * [TOC]
 * 	related
*/

/**
 * [CASE]
 * 	2. apply customization via bbPress hooks.
*/

	/**
		@since 2.0.0 bbPress (r2464)
			The main function responsible for returning the one true bbPress Instance to functions everywhere.
			Use this function like you would a global variable, except without needing to declare the global.
			Example: <?php $bbp = bbpress(); ?>
		@return (bbPress)
			The one true bbPress Instance
		@reference
			[Plugin]/bbpress/bbpress.php
	*/
	if(class_exists('bbPress')){
		$bbp = bbpress();
		/**
			@reference (bbp)
				The bbPress bbp before main content hook.
				http://hookr.io/plugins/bbpress/2.5.6/actions/bbp_before_main_content/
				The bbPress bbp after main content hook.
				http://hookr.io/plugins/bbpress/2.5.6/actions/bbp_after_main_content/
		*/
		remove_action('bbp_before_main_content',[$bbp,'before_main_content']);
		remove_action('bbp_after_main_content',[$bbp,'after_main_content']);
	}


	/**
	 * @since 1.0.1
	 * 	Display related posts.
	 * @reference (Beans)
	 * 	Set beans_add_action() using the callback argument as the action ID.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_smart_action/
	 * @reference
	 * 	[Parent]/controller/structure/single.php
	 * 	[Parent]/inc/setup/constant.php
	 * 	[Parent]/template-part/content/content-single.php
	*/
	beans_add_smart_action(HOOK_POINT['single']['body']['append'],function()
	{
		get_template_part('lib/model/related');
	});


	/**
	 * @since 1.0.1
	 * 	Adjust class properties of list item called by front-page.php.
	 * @reference (Beans)
	 * 	Hooks a function or method to a specific filter action.
	 * 	https://www.getbeans.io/code-reference/functions/beans_add_filter/
	 * @reference (Uikit)
	 * 	https://getuikit.com/docs/card
	 * 	https://getuikit.com/docs/padding
	 * @reference (WP)
	 * 	Removes a callback function from a filter hook.
	 * 	https://developer.wordpress.org/reference/functions/remove_filter/
	 * @reference
	 * 	[Child]/template/front-page.php
	 * 	[Parent]/template-part/item/list.php
	*/
	remove_filter('_class[list][item][image]',['_render_item','__the_image_list'],PRIORITY['mid-low']);
	beans_add_filter('_class[list][item][image]',function()
	{
		echo 'uk-card-media-left uk-width-small@m uk-width-1-3@s uk-padding-remove-vertical uk-padding-remove-horizonal';
	});

	remove_filter('_class[list][item][header]',['_render_item','__the_header'],PRIORITY['mid-low']);
	beans_add_filter('_class[list][item][header]',function()
	{
		echo 'uk-card-header uk-width-auto uk-padding-small';
	});

	beans_add_filter('_class[list][item][unit]',function()
	{
		echo 'uk-card uk-flex';
	});
