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
 * @reference (WP)
 * 	The WordPress Query class.
 * 	https://developer.wordpress.org/reference/classes/wp_query/
*/
$args = array(
	'posts_per_page' => 3,
	'post_status' => 'publish',
	'ignore_sticky_posts' => TRUE,
	'no_found_rows' => TRUE,
);
$r = new WP_Query($args);

if($r->have_posts()) :
	/**
	 * @reference (Beans)
	 * 	HTML markup.
	 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
	 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
	*/
	beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array('class' => 'uk-flex'));

		/**
		 * @reference (WP)
		 * 	Determines whether current WordPress query has posts to loop over.
		 * 	https://developer.wordpress.org/reference/functions/have_posts/
		 * 	Iterate the post index in the loop.
		 * 	https://developer.wordpress.org/reference/functions/the_post/
		*/
		while($r->have_posts()) :	$r->the_post();

			beans_open_markup_e("_card[{$theme}][{$index}]",'div',array('class' => 'uk-card uk-card-hover'));
				beans_open_markup_e("_media[{$theme}][{$index}]",'div',array('class' => 'uk-card-media uk-padding-small'));
					beans_open_markup_e("_effect[{$theme}][{$index}]",'div',array('class' => 'uk-inline-clip uk-transition-toggle'));

						beans_open_markup_e("_link[{$theme}][{$index}]",'a',array('href' => get_the_permalink()));
							/**
							 * @reference (WP)
							 * 	Display the post thumbnail.
							 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
							*/
							the_post_thumbnail('media');
						beans_close_markup_e("_link[{$theme}][{$index}]",'a');

						beans_open_markup_e("_label[{$theme}][{$index}]",'span',array('class' => 'pv-count'));
							/**
							 * @reference (WP)
							 * 	Retrieves a post meta field for the given post ID.
							 * https://developer.wordpress.org/reference/functions/get_post_meta/
							*/
							$pv = get_post_meta($post->ID,'post_views_count',TRUE);
							if($pv == NULL || $pv == ''){
								echo '0';
							}
							else{
								echo $pv;
							}
							echo esc_html('PV');
						beans_close_markup_e("_label[{$theme}][{$index}]",'span');

						beans_open_markup_e("_overlay[{$theme}][{$index}]",'div',array('class' => 'uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-primary'));
							/**
							 * @reference (WP)
							 * 	Display or retrieve the current post title with optional markup.
							 * 	https://developer.wordpress.org/reference/functions/the_title/
							*/
							the_title(sprintf('<h5><a href="%s" rel="bookmark">',esc_url(get_permalink())),'</a></h5>');

							beans_open_markup_e("_meta[{$theme}][{$index}]",'span',array('class' => 'uk-text-meta uk-margin-small-right'));
								/**
								 * @reference (WP)
								 * 	Displays the language string for the number of comments the current post has.
								 * 	https://developer.wordpress.org/reference/functions/comments_number/
								*/
								comments_number('0','1','%');
								esc_html_e('Comment','windmill');
							beans_close_markup_e("_meta[{$theme}][{$index}]",'span');

						beans_close_markup_e("_overlay[{$theme}][{$index}]",'div');

					beans_close_markup_e("_effect[{$theme}][{$index}]",'div');
				beans_close_markup_e("_media[{$theme}][{$index}]",'div');
			beans_close_markup_e("_card[{$theme}][{$index}]",'div');
		endwhile;

	beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');

endif;

/**
 * @since 1.0.1
 * 	Only reset the query if a filter is set.
 * @reference (WP)
 * 	After looping through a separate query, this function restores the $post global to the current post in the main query.
 * 	https://developer.wordpress.org/reference/functions/wp_reset_postdata/
*/
wp_reset_postdata();
