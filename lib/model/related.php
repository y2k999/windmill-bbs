<?php
/**
 * The template for displaying content in card format.
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

/**
 * @reference (Beans)
 * 	Section headline.
 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
 * @reference (Uikit)
 * 	https://getuikit.com/docs/background
 * @reference
 * 	[Parent]/inc/customizer/option.php
 * 	[Parent]/inc/utility/general.php
*/
beans_open_markup_e("_heading[{$theme}][content]",'div',array(
	'class' => 'uk-background-secondary uk-light uk-padding-small uk-margin-medium-top uk-margin-medium-bottom',
));
	beans_open_markup_e("_paragraph[{$theme}][content]",__utility_get_option('tag_site-description'),array('class' => 'uk-text-center uk-text-middle'));
	beans_close_markup_e("_paragraph[{$theme}][content]",__utility_get_option('tag_site-description'));
beans_close_markup_e("_heading[{$theme}][content]",'div');

$src = '';

// WP global.
global $post;
if(!$post){
	// Get current post data.
	$post = __utility_get_post_object();
}

/**
 * @reference (WP)
 * 	Retrieves post categories.
 * 	https://developer.wordpress.org/reference/functions/get_the_category/
*/
$categories = get_the_category($post->ID);
foreach((array)$categories as $category){
	/**
	 * @reference (WP)
	 * 	Retrieves an array of the latest posts, or posts matching the given criteria.
	 * 	https://developer.wordpress.org/reference/functions/get_posts/
	*/
	$related_posts = get_posts(array(
		'category__in' => array($category->cat_ID),
		'exclude' => $post->ID,
		'numberposts' => 4
	));
	$related_catname = $category->cat_name;
	if($related_posts){
		/**
		 * @reference (Beans)
		 * 	HTML markup.
		 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
		 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
		 * @reference (Uikit)
		 * 	https://getuikit.com/docs/lightbox
		*/
		beans_open_markup_e("_grid[{$theme}][content]",'div',array(
			'class' => 'uk-grid uk-child-width-1-3',
			'uk-grid' => '',
			'uk-lightbox' => '',
		));
			foreach($related_posts as $related_post){
				/**
				 * @reference (WP)
				 * 	Retrieve post thumbnail ID.
				 * 	https://developer.wordpress.org/reference/functions/get_post_thumbnail_id/
				*/
				$thumbnail = get_post_thumbnail_id($related_post->ID);

				/**
				 * @reference (WP)
				 * 	Retrieves an image to represent an attachment.
				 * 	https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
				*/
				$src_info = wp_get_attachment_image_src($thumbnail,'full');
				if($src_info){
					$src = $src_info[0];
				}
				$title = $related_post->post_title;

				beans_open_markup_e("_figure[{$theme}][content]",'figure');
					beans_open_markup_e("_link[{$theme}][content]",'a',array('href' => get_the_permalink($related_post->ID)));
						echo '<img src="' . $src . '" alt="' . esc_attr($title) . '"/>';
					beans_close_markup_e("_link[{$theme}][content]",'a');
					beans_open_markup_e("_figcaption[{$theme}][content]",'figcaption',array('class' => 'uk-text-small uk-text-muted uk-text-center uk-padding-small uk-visible@s'));
						echo esc_html($title);
					beans_close_markup_e("_figcaption[{$theme}][content]",'figcaption');
				beans_close_markup_e("_figure[{$theme}][content]",'figure');
			}
		beans_close_markup_e("_grid[{$theme}][content]",'div');
	}
}
