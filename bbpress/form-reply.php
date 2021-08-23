<?php
/**
 * New/Edit Reply
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
 * @reference (Beans)
 * 	Check if current page is a reply edit page
 * 	https://www.getbeans.io/code-reference/functions/beans_open_markup_e/
 * 	https://www.getbeans.io/code-reference/functions/beans_close_markup_e/
 * @reference
 * 	[Plugin]/bbpress/includes/common/template.php
*/
if(bbp_is_reply_edit()){
	beans_open_markup_e("_container[{$theme}][{$index}]",'div',array(
		'id' => 'bbpress-forums',
		'class' => 'bbpress-wrapper',
	));
		/**
		 * @since 1.0.1
		 * 	Output a breadcrumb
		 * @reference
		 * 	[Plugin]/bbpress/includes/common/template.php
		*/
		bbp_breadcrumb();
}

/**
 * @reference (bbp)
 * 	Performs a series of checks to ensure the current user can create replies.
 * 	http://hookr.io/functions/bbp_current_user_can_access_create_reply_form/
*/
if(bbp_current_user_can_access_create_reply_form()){
	beans_open_markup_e("_wrapper[{$theme}][{$index}]",'div',array(
		/**
		 * @reference (bbp)
		 * 	Return the topic id.
		 * 	http://hookr.io/functions/bbp_get_topic_id/
		*/
		'id' => 'new-reply-' . bbp_get_topic_id(),
		'class' => 'bbp-reply-form',
	));
	?>
		<form id="new-post" name="new-post" method="post">

			<?php do_action('bbp_theme_before_reply_form'); ?>

			<fieldset class="bbp-form">
				<legend>
					<?php
					printf(
						esc_html__('Reply To: %s','windmill'),
						/**
						 * @reference (bbp)
						 * 	The bbPress bbp get form reply to hook.
						 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_form_reply_to/
						*/
						(bbp_get_form_reply_to()) ? sprintf(esc_html__('Reply #%1$s in %2$s','windmill'),
						bbp_get_form_reply_to(),
						/**
						 * @reference (bbp)
						 * 	The bbPress bbp get topic title hook.
						 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_topic_title/
						*/
						bbp_get_topic_title()) : bbp_get_topic_title()
					);
					?>
				</legend>

				<?php do_action('bbp_theme_before_reply_form_notices'); ?>

				<?php if(!bbp_is_topic_open() && !bbp_is_reply_edit()) : ?>
					<div class="bbp-template-notice">
						<ul><li><?php esc_html_e('This topic is marked as closed to new replies, however your posting capabilities still allow you to reply.','windmill'); ?></li></ul>
					</div><!-- .bbp-template-notice -->
				<?php endif; ?>

				<?php if(!bbp_is_reply_edit() && bbp_is_forum_closed()) : ?>
					<div class="bbp-template-notice">
						<ul><li><?php esc_html_e('This forum is closed to new content, however your posting capabilities still allow you to post.','windmill'); ?></li></ul>
					</div><!-- .bbp-template-notice -->
				<?php endif; ?>

				<?php if(current_user_can('unfiltered_html')) : ?>
					<div class="bbp-template-notice">
						<ul><li><?php esc_html_e('Your account has the ability to post unrestricted HTML content.','windmill'); ?></li></ul>
					</div><!-- .bbp-template-notice -->
				<?php endif; ?>

				<?php do_action('bbp_template_notices'); ?>

				<div>
					<?php
					/**
					 * @reference (bbp)
					 * 	The bbPress bbp get template part hook.
					 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_template_part/
					*/
					bbp_get_template_part('form','anonymous');

					do_action('bbp_theme_before_reply_form_content');

					/**
					 * @reference (bbp)
					 * 	Output a textarea or TinyMCE if enabled.
					 * 	http://hookr.io/functions/bbp_the_content/
					*/
					bbp_the_content(array('context' => 'reply'));

					do_action('bbp_theme_after_reply_form_content');
					?>

					<?php if(!(bbp_use_wp_editor() || current_user_can('unfiltered_html'))) : ?>
						<p class="form-allowed-tags">
							<label><?php esc_html_e('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','windmill'); ?></label><br />
							<code>
								<?php
								/**
								 * @reference (bbp)
								 * 	Output all of the allowed tags in HTML format with attributes.
								 * 	http://hookr.io/plugins/bbpress/2.5.9/functions/bbp_allowed_tags/
								*/
								bbp_allowed_tags();
								?>
							</code>
						</p><!-- .form-allowed-tags -->
					<?php endif; ?>

					<?php if(bbp_allow_topic_tags() && current_user_can('assign_topic_tags',bbp_get_topic_id())) : ?>

						<?php do_action('bbp_theme_before_reply_form_tags'); ?>

						<p>
							<label for="bbp_topic_tags"><?php esc_html_e('Tags:','windmill'); ?></label><br />
							<input type="text" value="<?php bbp_form_topic_tags(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" <?php disabled(bbp_is_topic_spam()); ?> />
						</p>

						<?php do_action('bbp_theme_after_reply_form_tags'); ?>

					<?php endif; ?>

					<?php if(bbp_is_subscriptions_active() && !bbp_is_anonymous() && (!bbp_is_reply_edit() || (bbp_is_reply_edit() && !bbp_is_reply_anonymous()))) : ?>

						<?php do_action('bbp_theme_before_reply_form_subscription'); ?>

						<p>
							<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe"<?php bbp_form_topic_subscribed(); ?> />
							<?php if(bbp_is_reply_edit() && (bbp_get_reply_author_id() !== bbp_get_current_user_id())) : ?>
								<label for="bbp_topic_subscription"><?php esc_html_e('Notify the author of follow-up replies via email','windmill'); ?></label>
							<?php else : ?>
								<label for="bbp_topic_subscription"><?php esc_html_e('Notify me of follow-up replies via email','windmill'); ?></label>
							<?php endif; ?>
						</p>

						<?php do_action('bbp_theme_after_reply_form_subscription'); ?>

					<?php endif; ?>

					<?php if(bbp_is_reply_edit()) : ?>
						<?php if(current_user_can('moderate',bbp_get_reply_id())) : ?>

							<?php do_action('bbp_theme_before_reply_form_reply_to'); ?>

							<p class="form-reply-to">
								<label for="bbp_reply_to"><?php esc_html_e('Reply To:','windmill'); ?></label><br />
								<?php bbp_reply_to_dropdown(); ?>
							</p><!-- .form-reply-to -->

							<?php do_action('bbp_theme_after_reply_form_reply_to'); ?>

							<?php do_action('bbp_theme_before_reply_form_status'); ?>

							<p>
								<label for="bbp_reply_status"><?php esc_html_e('Reply Status:','windmill'); ?></label><br />
								<?php bbp_form_reply_status_dropdown(); ?>
							</p>

							<?php do_action('bbp_theme_after_reply_form_status'); ?>

						<?php endif; ?>

						<?php if(bbp_allow_revisions()) : ?>

							<?php do_action('bbp_theme_before_reply_form_revisions'); ?>

							<fieldset class="bbp-form">
								<legend>
									<input name="bbp_log_reply_edit" id="bbp_log_reply_edit" type="checkbox" value="1" <?php bbp_form_reply_log_edit(); ?> />
									<label for="bbp_log_reply_edit"><?php esc_html_e('Keep a log of this edit:','windmill'); ?></label><br />
								</legend>
								<div>
									<label for="bbp_reply_edit_reason">
										<?php
										printf(
											esc_html__('Optional reason for editing:','windmill'),
											/**
											 * @reference (bbp)
											 * 	The bbPress bbp get current user name hook.
											 * 	http://hookr.io/plugins/bbpress/2.5.8/filters/bbp_get_current_user_name/
											*/
											bbp_get_current_user_name()
										);
										?>
									</label>
									<br />
									<input type="text" value="<?php bbp_form_reply_edit_reason(); ?>" size="40" name="bbp_reply_edit_reason" id="bbp_reply_edit_reason" />
								</div>
							</fieldset>

							<?php do_action('bbp_theme_after_reply_form_revisions'); ?>

						<?php endif; ?>
					<?php endif; ?>

					<?php do_action('bbp_theme_before_reply_form_submit_wrapper'); ?>

					<div class="bbp-submit-wrapper">

						<?php do_action('bbp_theme_before_reply_form_submit_button'); ?>

						<?php
						/**
						 * @reference (bbp)
						 * 	Output the reply to a reply cancellation link.
						 * 	http://hookr.io/plugins/bbpress/2.5.9/functions/bbp_cancel_reply_to_link/
						*/
						bbp_cancel_reply_to_link();
						?>

						<button type="submit" id="bbp_reply_submit" name="bbp_reply_submit" class="uk-button uk-button-primary uk-button-large"><?php esc_html_e('Submit','windmill'); ?></button>

						<?php do_action('bbp_theme_after_reply_form_submit_button'); ?>

					</div><!-- .bbp-submit-wrapper -->

					<?php do_action('bbp_theme_after_reply_form_submit_wrapper'); ?>

				</div>

				<?php bbp_reply_form_fields(); ?>

			</fieldset>

			<?php do_action('bbp_theme_after_reply_form'); ?>

		</form>
	<?php
	beans_close_markup_e("_wrapper[{$theme}][{$index}]",'div');
	?>

<?php }elseif(bbp_is_topic_closed()){ ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bbp-template-notice">
			<ul><li><?php printf(esc_html__('The topic &#8216;%s&#8217; is closed to new replies.','windmill'),bbp_get_topic_title()); ?></li></ul>
		</div><!-- .bbp-template-notice -->
	</div><!-- #no-reply -->

<?php }elseif(bbp_is_forum_closed(bbp_get_topic_forum_id())){ ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bbp-template-notice">
			<ul><li><?php printf(esc_html__('The forum &#8216;%s&#8217; is closed to new topics and replies.','windmill'),bbp_get_forum_title(bbp_get_topic_forum_id())); ?></li></ul>
		</div><!-- .bbp-template-notice -->
	</div><!-- #no-reply -->

<?php }else{ ?>

	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bbp-template-notice">
			<ul><li><?php is_user_logged_in() ? esc_html_e('You cannot reply to this topic.','windmill') : esc_html_e('You must be logged in to reply to this topic.','windmill'); ?></li></ul>
		</div><!-- .bbp-template-notice -->

		<?php if(!is_user_logged_in()) : ?>
			<?php bbp_get_template_part('form','user-login'); ?>
		<?php endif; ?>
	</div><!-- #no-reply -->

<?php
}

if(bbp_is_reply_edit()){
	beans_close_markup_e("_container[{$theme}][{$index}]",'div');
}
