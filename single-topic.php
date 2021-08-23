<?php
/**
 * Single Topic
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
				 * 	http://hookr.io/actions/bbp_template_notices/
				*/
				do_action('bbp_before_main_content');
				do_action('bbp_template_notices');

				/**
				 * @reference (bbp)
				 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_topic_forum_id/
				*/
				if(bbp_user_can_view_forum(array('forum_id' => bbp_get_topic_forum_id()))){
					/**
					 * @descripton
					 * 	Start the loop.
					 * @reference (WP)
					 * 	Determines whether current WordPress query has posts to loop over.
					 * 	https://developer.wordpress.org/reference/functions/have_posts/
					 * 	Iterate the post index in the loop.
					 * 	https://developer.wordpress.org/reference/functions/the_post/
					*/
					while(have_posts()) : the_post();
						/**
						 * @reference (Beans)
						 * 	HTML markup.
						 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
						 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
						*/
						beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array(
							/**
							 * @reference (bbp)
							 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_topic_id/
							*/
							'id' => 'bbp-topic-wrapper-' . bbp_get_topic_id(),
							'class' => 'bbp-topic-wrapper uk-margin uk-padding',
							
						));
							beans_open_markup_e("_header[{$theme}][{$index}]",'header',array('class' => 'uk-margin-medium entry-header'));
								/**
								 * @reference (Uikit)
								 * 	https://getuikit.com/docs/background
								 * 	https://getuikit.com/docs/height
								 * 	https://getuikit.com/docs/image
								 * @reference (WP)
								 * 	Retrieve the URL for an attachment.
								 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_url/
								 * 	Retrieve post thumbnail ID.
								 * 	https://developer.wordpress.org/reference/functions/get_post_thumbnail_id/
								*/
								$url = wp_get_attachment_url(get_post_thumbnail_id());
								if($url){
									beans_open_markup_e("_image[{$theme}][{$index}]",'div',array(
										'class' => 'uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light',
										'data-src' => $url,
										'uk-img' => '',
									));
								}

								beans_open_markup_e("_tag[{$theme}][{$index}]",__utility_get_option('tag_post-title'),array('class' => 'entry-title uk-text-emphasis'));
									/**
									 * @reference (bbp)
									 * 	This function can be used inside template files to display the forum title.
									 * 	https://codex.bbpress.org/bbp_forum_title/
									 * @reference
									 * 	[Parent]/inc/customizer/option.php
									 * 	[Parent]/inc/utility/general.php
									*/
									bbp_forum_title();
								beans_close_markup_e("_tag[{$theme}][{$index}]",__utility_get_option('tag_post-title'));
								if($url){
									beans_close_markup_e("_image[{$theme}][{$index}]",'div');
								}
							beans_close_markup_e("_header[{$theme}][{$index}]",'header');

							beans_open_markup_e("_body[{$theme}][{$index}]",'div',array('class' => 'uk-margin-small entry-content'));
								/**
								 * @reference (bbp)
								 * 	Adds bbPress theme support to any active WordPress theme.
								 * 	http://hookr.io/functions/bbp_get_template_part/
								 * @reference
								 * 	[Plugin]/bbpress/includes/core/template-functions.php
								*/
								bbp_get_template_part('content','single-topic');
							beans_close_markup_e("_body[{$theme}][{$index}]",'div');

							beans_open_markup_e("_footer[{$theme}][{$index}]",'footer',array('class' => 'uk-margin-small entry-footer'));
							beans_close_markup_e("_footer[{$theme}][{$index}]",'footer');

						beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');
					endwhile;
				}
				elseif(bbp_is_forum_private(bbp_get_topic_forum_id(),FALSE)){
					/**
					 * @reference (bbp)
					 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_is_forum_private/
					 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_reply_forum_id/
					*/
					bbp_get_template_part('feedback','no-access');
				}

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
