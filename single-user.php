<?php
/**
 * Single User
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
 * @reference (WP)
 * 	Load header template.
 * 	https://developer.wordpress.org/reference/functions/get_header/
*/
?>
<?php get_header(); ?>

<!-- ====================
	<site-content>
 ==================== -->
<section<?php echo apply_filters("_property[section][content]",''); ?><?php echo apply_filters("_attribute[section][content]",''); ?>>
	<div id="content"<?php echo apply_filters("_property[container][content]",esc_attr('site-content')); ?><?php echo apply_filters("_attribute[container][content]",''); ?>>
		<div<?php echo apply_filters("_property[grid][default]",''); ?><?php echo apply_filters("_attribute[grid]",''); ?>>

			<!-- ====================
				<primary>
			 ==================== -->
			<main id="primary"<?php echo apply_filters("_property[column][primary]",esc_attr('site-main')); ?><?php echo apply_filters("_attribute[column][primary]",''); ?>>
				<?php
				/**
				 * @reference (bbp)
				 * 	http://hookr.io/actions/bbp_before_main_content/
				*/
				do_action('bbp_before_main_content');

				/**
				 * @reference (Beans)
				 * 	HTML markup.
				 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
				 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
				*/
				beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array(
					/**
					 * @reference (bbp)
					 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_current_user_id/
					*/
					'id' => 'bbp-user-' . bbp_get_current_user_id(),
					'class' => 'bbp-single-user uk-margin uk-padding',
				));
					beans_open_markup_e("_header[{$theme}][{$index}]",'header',array('class' => 'uk-margin-medium entry-header'));
					beans_close_markup_e("_header[{$theme}][{$index}]",'header');

					beans_open_markup_e("_body[{$theme}][{$index}]",'div',array('class' => 'uk-margin-small entry-content'));
						/**
						 * @reference (bbp)
						 * 	Adds bbPress theme support to any active WordPress theme.
						 * 	http://hookr.io/functions/bbp_get_template_part/
						 * @reference
						 * 	[Plugin]/bbpress/includes/core/template-functions.php
						*/
						bbp_get_template_part('content','single-user');
					beans_close_markup_e("_body[{$theme}][{$index}]",'div');

					beans_open_markup_e("_footer[{$theme}][{$index}]",'footer',array('class' => 'uk-margin-small entry-footer'));
					beans_close_markup_e("_footer[{$theme}][{$index}]",'footer');

				beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');

				/**
				 * @reference (bbp)
				 * 	http://hookr.io/plugins/bbpress/2.5.9/actions/bbp_after_main_content/
				*/
				do_action('bbp_after_main_content');
				?>
			</main>

			<!-- ====================
				<secondary>
			 ==================== -->
			<?php
			/**
			 * @reference (WP)
			 * 	Load sidebar template.
			 * 	https://developer.wordpress.org/reference/functions/get_sidebar/
			*/
			get_sidebar();
			?>

		</div><!-- .row -->

	</div><!-- #content -->
</section>

<?php
/**
 * @reference (WP)
 * 	Load footer template.
 * 	https://developer.wordpress.org/reference/functions/get_footer/
*/
?>
<?php get_footer(); ?>
