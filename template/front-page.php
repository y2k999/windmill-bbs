<?php
/**
 * The template for displaying front page of the child theme.
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
 * 	Custom front page template for this child theme.
 * 	Copy from original template ([Parent]/template/content/singular.php) and modify it.
 * 	 - Echo the list of bbPress forums and topics.
 * @reference
 * 	[Child]/front-page.php
 * 	[Parent]/controller/layout.php
 * 	[Parent]/controller/render/column.php
 * 	[Parent]/controller/render/container.php
 * 	[Parent]/controller/render/grid.php
 * 	[Parent]/controller/render/section.php
 * 	[Parent]/inc/setup/constant.php
*/
?>
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
			 * @hooked
			 * 	_fragment_title::__the_page()
			 * @reference
			 * 	[Parent]/controller/fragment/title.php
			*/
			do_action(HOOK_POINT['primary']['prepend']);

			/**
			 * @reference (bbp)
			 * 	Display widget area if bbPress widgets are registerd.
			 * 	https://www.buddyboss.com/resources/reference/classes/bbp_forums_widget/
			 * @reference (WP)
			 * 	Output an arbitrary widget as a template tag.
			 * 	https://developer.wordpress.org/reference/functions/the_widget/
			*/
			the_widget('BBP_Forums_Widget',NULL,array(
				'before_widget' => '<section class="widget">',
				'after_widget' => '</section>',
				'before_title' => '<div class="uk-background-secondary uk-light uk-margin-medium-top uk-margin-medium-bottom"><h4 class="widget-title">',
				'after_title' => '</h4></div>'
			));

			the_widget('BBP_Topics_Widget',NULL,array(
				'before_widget' => '<section class="widget">',
				'after_widget' => '</section>',
				'before_title' => '<div class="uk-background-secondary uk-light uk-margin-medium-top uk-margin-medium-bottom"><h4 class="widget-title">',
				'after_title' => '</h4></div>'
			));

			/**
			 * @reference (Beans)
			 * 	Display blog posts.
			 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
			 * 	https://www.getbeans.io/code-reference/functions/beans_output_e/
			 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
			 * @reference
			 * 	[Parent]/inc/customizer/option.php
			 * 	[Parent]/inc/utility/general.php
			*/
			beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array('class' => 'uk-background-secondary uk-light uk-margin-medium-top uk-margin-medium-bottom'));
				beans_open_markup_e("_tag[{$theme}][{$index}]",__utility_get_option('tag_widget-title'),array('class' => 'widget-title'));
					beans_output_e("_output[{$theme}][{$index}]",esc_html__('Latest Posts','windmill'));
				beans_close_markup_e("_tag[{$theme}][{$index}]",__utility_get_option('tag_widget-title'));
			beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');

			beans_open_markup_e("_container[{$theme}][{$index}]",'div',array('class' => 'uk-padding-small ' . $theme));

				/**
				 * @reference (WP)
				 * 	The WordPress Query class.
				 * 	https://developer.wordpress.org/reference/classes/wp_query/
				*/
				$paged = (int) get_query_var('paged');
				$args = array(
					'posts_per_page' => get_option('posts_per_page'),
					'paged' => $paged,
					'post_type' => array('post'),
					'post_status' => 'publish',
					'ignore_sticky_posts' => TRUE,
				);
				$r = new WP_Query($args);

				/**
				 * @reference (WP)
				 * 	Determines whether current WordPress query has posts to loop over.
				 * 	https://developer.wordpress.org/reference/functions/have_posts/
				*/
				if(!$r->have_posts()) :
					beans_open_markup_e("_paragraph[{$theme}][{$index}]",__utility_get_option('tag_site-description'),array('class' => 'uk-alert-warning'));
						/**
						 * @description
						 * 	Display nopost message.
						 * @reference
						 * 	[Parent]/inc/utility/general.php
						 * 	[Parent]/inc/customizer/option.php
						*/
						beans_output_e("_output[{$theme}][{$index}][nopost]",__utility_get_option('message_nopost'));
					beans_close_markup_e("_paragraph[{$theme}][{$index}]",__utility_get_option('tag_site-description'));
				endif;

				/**
				 * @reference (WP)
				 * 	Iterate the post index in the loop.
				 * 	https://developer.wordpress.org/reference/functions/the_post/
				 * 	Loads a template part into a template.
				 * 	https://developer.wordpress.org/reference/functions/get_template_part/
				 * @reference
				 * 	[Parent]/inc/setup/constant.php
				*/
				while($r->have_posts()) :$r->the_post();
					get_template_part(SLUG['item'] . 'list');
				endwhile;

				/**
				 * @reference (Beans)
				 * 	HTML markup.
				 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
				 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
				 * @reference (WP)
				 * 	Retrieves paginated links for archive post pages.
				 * 	https://developer.wordpress.org/reference/functions/paginate_links/
				*/
				if($r->max_num_pages > 1){
					$page_links = paginate_links(array(
						'base' => get_pagenum_link(1) . '%_%',
						'format' => 'page/%#%/',
						'current' => max(1,$paged),
						'total' => $r->max_num_pages,
						'prev_text' => FALSE,
						'next_text' => FALSE,
						'type' => 'array',
					));
					beans_open_markup_e("_list[{$theme}][{$index}][paginate_links]",'ul',array('class' => 'uk-pagination uk-flex-center uk-padding'));
						beans_open_markup_e("_item[{$theme}][{$index}][paginate_links]",'li');
							beans_output_e("_output[{$theme}][{$index}][paginate_links]",join('</li><li>',$page_links));
						beans_close_markup_e("_item[{$theme}][{$index}][paginate_links]",'li');
					beans_close_markup_e("_list[{$theme}][{$index}][paginate_links]",'ul');
				}

				/**
				 * @since 1.0.1
				 * 	Only reset the query if a filter is set.
				 * @reference (WP)
				 * 	After looping through a separate query, this function restores the $post global to the current post in the main query.
				 * 	https://developer.wordpress.org/reference/functions/wp_reset_postdata/
				*/
				wp_reset_postdata();

			beans_close_markup_e("_container[{$theme}][{$index}]",'div');

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
