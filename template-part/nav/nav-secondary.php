<?php
/**
 * The template for displaying global navigation without sub-menu.
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
 * [NOTE]
 * 	This template part file overrides the corresponding template part file in the parent theme.
 * @since 1.0.1
 * 	Display secondary navigation.
 * @reference (Uikit)
 * 	https://getuikit.com/docs/navbar
 * @reference
 * 	[Parent]/model/app/nav.php
 * 	[Parent]/template-part/nav/nav-offcanvas.php
*/

beans_open_markup_e("_nav[{$theme}][{$index}]",'nav',array(
	'id' => 'secondary-navigation',
	// 'class' => 'uk-navbar-container uk-navbar-transparent',
	'itemscope' => 'itemscope',
	'itemtype' => 'https://schema.org/SiteNavigationElement',
	'aria-label' => esc_attr__('bbPress Secondary Navigation','windmill'),
	'role' => 'navigation',
	'uk-navbar' => 'uk-navbar',
));
	/**
	 * @reference (WP)
	 * 	Determines whether a registered nav menu location has a menu assigned to it.
	 * 	https://developer.wordpress.org/reference/functions/has_nav_menu/
	 * @reference (Uikit)
	 * 	https://getuikit.com/docs/navbar
	 * @reference
	 * 	[Child]/lib/controller.php
	*/
	if(has_nav_menu('bbpress_secondary')){
		/**
		 * @reference (WP)
		 * 	Displays a navigation menu.
		 * 	https://developer.wordpress.org/reference/functions/wp_nav_menu/
		*/
		wp_nav_menu(array(
			'theme_location' => 'bbpress_secondary',
			'depth' => 1,
			'items_wrap' => '<ul class="%2$s">%3$s</ul>',	
			'container' => 'uk-navbar-container uk-navbar-transparent',
			'menu_class' => 'uk-navbar-nav',
			'echo' => TRUE,
		));
	}
	else{
		/**
		 * @reference (Beans)
		 * 	Echo output registered by ID.
		 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
		*/
		beans_output_e("_output[{$theme}][{$index}]",esc_html__('Add bbPress Secondary Navigation','windmill'));
	}

beans_close_markup_e("_nav[{$theme}][{$index}]",'nav');
