<?php
/**
 * Pre-set widgets for bbPress plugin.
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
 * [CASE]
 * In this sample child theme, you can know how to 
 * 	1. setup bbPress compatible environment.
*/

	/**
		@access (public)
			Pre-set default widgets on each sidebars.
		@return (void)
		@reference (WP)
			Fires on the first WP load after a theme switch if the old theme still exists.
			https://developer.wordpress.org/reference/hooks/after_switch_theme/
	*/
	beans_add_smart_action('after_switch_theme',function()
	{
		if(!class_exists('bbPress')){return;}

		$default = array(
			// Unshown
			'widget_meta' => array(1 => array('_multiwidget' => 1)),
			'widget_search' => array(1 => array('_multiwidget' => 1)),
			'widget_recent-posts' => array(1 => array('_multiwidget' => 1)),
			'widget_categories' => array(1 => array('_multiwidget' => 1)),

			// Show
			'bbp_widget_login' => array(2 => array('title' => esc_html__('(bbPress) Login Widget','windmill'),'register' => '','lostpass' => '',),'_multiwidget' => 1),
			'widget_display_search' => array(2 => array('title' => esc_html__('(bbPress) Forum Search Form','windmill')),'_multiwidget' => 1),
			'widget_display_views' => array(2 => array('title' => esc_html__('(bbPress) Topic Views List','windmill')),'_multiwidget' => 1),
			'widget_display_forums' => array(2 => array('title' => esc_html__('(bbPress) Forums List','windmill'),'post_parent' => 'any'),'_multiwidget' => 1),
			'widget_display_topics' => array(2 => array('title' => esc_html__('(bbPress) Recent Topics','windmill'),'order_by' => FALSE,'parent_forum' => 'any','max_shown' => 5,'show_date' => FALSE,'show_user' => FALSE),'_multiwidget' => 1),
			'widget_display_replies' => array(2 => array('title' => esc_html__('(bbPress) Recent Replies','windmill'),'max_shown' => 5,'show_date' => FALSE,'show_user' => FALSE),'_multiwidget' => 1),

			// Order
			'sidebars_widgets' => array(
				'wp_inactive_widgets' => array(),
				'sidebar_primary' => array(
					0 => 'bbp_login_widget-2',
					1 => 'bbp_search_widget-2',
					2 => 'bbp_views_widget-2',
				),
				'sidebar_secondary' => array(
					0 => 'bbp_forums_widget-2',
					1 => 'bbp_topics_widget-2',
					2 => 'bbp_replies_widget-2',
				),
				'footer_primary' => array(),
				'footer_secondary' => array(),
				'header_primary' => array(),
				'header_secondary' => array(),
				'content_primary' => array(
					// 0 => 'bbp_topics_widget-2',
				),
				'content_secondary' => array(
					// 0 => 'bbp_forums_widget-2',
				),
				'array_version' => 3
			),
		);
		foreach($default as $key => $value){
			update_option($key,$value);
		}

	},99);
