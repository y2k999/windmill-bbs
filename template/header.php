<?php
/**
 * The template for displaying masthead(topbar and navbar).
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
 * @since 1.0.1
 * 	Custom header template for this child theme.
 * 	Copy from original template ([Parent]/template/header/header.php) and modify it.
 * 	 - Remove topbar icons of the parent theme.
 * 	 - Instead, add and echo the latest posts on topbar.
 * @reference
 * 	[Child]/header.php
 * 	[Parent]/controller/layout.php
 * 	[Parent]/controller/render/column.php
 * 	[Parent]/controller/render/container.php
 * 	[Parent]/controller/render/grid.php
 * 	[Parent]/controller/render/section.php
 * 	[Parent]/inc/setup/constant.php
*/

/**
 * @hooked
 * 	_structure_header::__the_loader()
 * @reference
 * 	[Parent]/controller/structure/header.php
*/
do_action(HOOK_POINT['masthead']['before']);
?>

<!-- ====================
	<masthead>
 ==================== -->
<section<?php echo apply_filters("_property[section][masthead]",''); ?><?php echo apply_filters("_attribute[section][masthead]",''); ?>>
<header id="masthead"<?php echo apply_filters("_property[container][masthead]",esc_attr('site-header')); ?>>

	<div<?php echo apply_filters("_property[grid][masthead][main]",''); ?><?php echo apply_filters("_attribute[grid]",''); ?>>
		<div class="uk-width-1-1@s uk-width-1-4@m uk-padding">
			<?php
			/**
			 * @since 1.0.1
			 * 	Displays header site branding.
			 * @reference
			 * 	[Parent]/inc/utility/theme.php
			 * 	[Parent]/model/app/branding.php
			*/
			__utility_app_branding();
			?>
		</div>
		<div class="uk-width-1-1@s uk-width-3-4@m">
			<?php get_template_part('lib/model/recent'); ?>
		</div>
	</div>

	<nav class="uk-navbar-container" uk-navbar>
		<div class="uk-navbar-center">
			<?php
			/**
			 * @reference (WP)
			 * 	Determines whether a registered nav menu location has a menu assigned to it.
			 * 	https://developer.wordpress.org/reference/functions/has_nav_menu/
			*/
			if(has_nav_menu('bbpress_primary')){
				/**
				 * @reference (Uikit)
				 * 	https://getuikit.com/docs/navbar
				 * @reference (WP)
				 * 	Displays a navigation menu.
				 * 	https://developer.wordpress.org/reference/functions/wp_nav_menu/
				 * @reference
				 * 	[Child]/lib/controller.php
				*/
				wp_nav_menu(array(
					'theme_location' => 'bbpress_primary',
					'depth' => 1,
					'items_wrap' => '<ul class="%2$s">%3$s</ul>',	
					'container_id' => '',
					'container_class' => '',
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
				beans_output_e("_output[{$theme}][{$index}]",esc_html__('Add bbPress Primary Navigation','windmill'));
			}
			?>
		</div>
	</nav>

</header>
</section>

<?php do_action(HOOK_POINT['masthead']['after']); ?>
