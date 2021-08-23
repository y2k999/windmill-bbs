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
 * 	add_theme_support()
 * 	add_post_type_support()
 * 	register_nav_menus()
 * 	windmill_bbpress_setup()
 * 	__bbp_manage_columns()
 * 	__bbp_manage_custom_column()
 * 	__bbpress_upload_media()
 * 	__bbpress_wp_update_nav_menu_item()
*/

/**
 * [CASE]
 * 	1. setup bbPress compatible environment.
*/


	add_action('after_setup_theme',function()
	{
		/**
		 * @since 1.0.1
		 * 	Sets up theme defaults and registers support for various bbPress features.
		 * @reference (WP)
		 * 	Note that this function is hooked into the after_setup_theme hook, which runs before the init hook.
		 * 	The init hook is too late for some features, such as indicating support for post thumbnails.
		 * 	https://developer.wordpress.org/reference/functions/add_theme_support/
		*/
		add_theme_support('bbpress');

		/**
		 * @reference (WP)
		 * 	Registers navigation menu locations for a theme.
		 * 	https://developer.wordpress.org/reference/functions/register_nav_menus/
		 * @reference
		 * 	[Child]/template/header.php
		 * 	[Child]/template-part/nav/secondary.php
		*/
		register_nav_menus(array(
			'bbpress_primary' => esc_html__('[bbPress] Primary','windmill'),
			'bbpress_secondary' => esc_html__('[bbPress] Secondary','windmill'),
		));

		/**
		 * @since 1.0.1
		 * 	Add bbpress setup action.
		*/
		do_action('windmill_bbpress_setup');

	});


	add_action('init',function()
	{
		/**
		 * @reference (WP)
		 * 	Registers support of certain features for a post type.
		 * 	https://developer.wordpress.org/reference/functions/add_post_type_support/
		*/
		add_post_type_support('forum',array('thumbnail'));
		add_post_type_support('topic',array('thumbnail'));
	});


	add_action('manage_forum_posts_columns','__bbp_manage_columns',99);
	add_action('manage_topic_posts_columns','__bbp_manage_columns',99);
	/**
	 * @reference (WP)
	 * 	Add thumbnail column on admin dashboard.
	 * 	Filters the column headers for a list table on a specific screen.
	 * 	https://developer.wordpress.org/reference/hooks/manage_screen-id_columns/
	 * @return (void)
	*/
	if(!function_exists('__bbp_manage_columns')) :
	function __bbp_manage_columns($columns)
	{
		// if(!class_exists('bbPress')){return;}
		$columns['_bbp_thumbnail'] = esc_html__('Thumbnail','windmill');
		return $columns;

	}// Method
	endif;


	add_action('manage_forum_posts_custom_column','__bbp_manage_custom_column',99,2);
	add_action('manage_topic_posts_custom_column','__bbp_manage_custom_column',99,2);
	/**
	 * @reference (WP)
	 * 	Add thumbnail column on admin dashboard.
	 * 	Fires in each custom column in the Posts list table.
	 * 	https://developer.wordpress.org/reference/hooks/manage_posts_custom_column/
	 * @return (void)
	*/
	if(!function_exists('__bbp_manage_custom_column')) :
	function __bbp_manage_custom_column($column_name,$post_id)
	{
		// if(!class_exists('bbPress')){return;}

		if($column_name == '_bbp_thumbnail'){
			/**
			 * @reference (WP)
			 * 	Retrieve post thumbnail ID.
			 * 	https://developer.wordpress.org/reference/functions/get_post_thumbnail_id/
			*/
			$thumbnail_id = get_post_thumbnail_id($post_id);
			if($thumbnail_id){
				/**
				 * @reference (WP)
				 * 	Retrieves an image to represent an attachment.
				 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
				*/
				$attachment = wp_get_attachment_image_src($thumbnail_id,'thumbnail');
				if(!empty($attachment)){
					echo '<img src="' . $attachment[0] . '" style="width: 120px; height: auto;">';
				}
			}
			else{
				echo esc_html__('No Image.','windmill');
			}
		}

	}// Method
	endif;


	/**
	 * @reference (WP)
	 * 	Allow upload media in bbPress
	 * 	This function is attached to the 'bbp_after_get_the_content_parse_args' filter hook.
	 * 	https://bavotasan.com/2014/add-media-upload-button-to-bbpress/
	*/
	add_filter('bbp_after_get_the_content_parse_args',function($args)
	{
		$args['media_buttons'] = TRUE;
		return $args;

	});


	/**
	 * @access (public)
	 * @return (void)
	 * @reference
	 * 	[Child]/template/header.php
	 * 	[Child]/template-part/nav/secondary.php
	*/
	add_action('windmill_bbpress_setup',function()
	{
		if(!class_exists('bbPress')){return;}

		foreach(array(
			'bbpress_primary' => esc_html__('bbPress Primary','windmill'),
			'bbpress_secondary' => esc_html__('bbPress Secondary','windmill'),
		) as $key => $value){

			/**
			 * @reference (WP)
			 * 	Set up a default menu if it doesn't exist.
			 * 	Returns a navigation menu object.
			 * 	https://developer.wordpress.org/reference/functions/wp_get_nav_menu_object/
			*/
			if(!wp_get_nav_menu_object($value)) :

				/**
				 * @reference (WP)
				 * 	Creates a navigation menu.
				 * 	https://developer.wordpress.org/reference/functions/wp_create_nav_menu/
				*/
				$menu_id = wp_create_nav_menu($value);

				/**
				 * @reference (WP)
				 * 	Save the properties of a menu item or create a new one.
				 * 	https://developer.wordpress.org/reference/functions/wp_update_nav_menu_item/
				 * 	Retrieves a page given its path.
				 * 	https://developer.wordpress.org/reference/functions/get_page_by_path/
				*/
				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('Front Page','windmill'),
					'menu-item-object' => get_page_by_path('front-page',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('front-page',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));

				wp_update_nav_menu_item($menu_id,0,array(
					'menu-item-title' => esc_html__('Blog','windmill'),
					'menu-item-object' => get_page_by_path('blog',OBJECT,'page')->post_type,
					'menu-item-object-id' => get_page_by_path('blog',OBJECT,'page')->ID,
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
				));
			endif;
		}

	});
