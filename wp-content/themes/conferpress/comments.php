<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
if (!comments_open() && !have_comments())
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
    <div class="ia-heading">
    	<h2 class="h3 font-2"><?php echo comments_number('');?></h2>
        <div class="clearfix"></div>
    </div>
		<ul class="commentlist">
			<?php wp_list_comments( array( 'type'=>'all', 'callback' => 'leaf_comment', 'style' => 'ul' ) ); ?>
		</ul><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav class="comment-nav-below row" role="navigation">
			<div class="nav-previous col-xs-6"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'conferpress' ) ); ?></div>
			<div class="nav-next col-xs-6 text-right"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'conferpress' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments ?>
    
    <?php if (comments_open()) { ?>
    <div class="comment-form">
	    <div class="ia-heading">
	    	<h2 class="h3 font-2"><?php esc_html_e('Leave a comment','conferpress'); ?></h2>
	        <div class="clearfix"></div>
	    </div>

		<?php leaf_comment_form_leaf_custom(array('logged_in_as'=>'','comment_notes_before'=>'',
			'comment_field'=>'<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" required placeholder="'.esc_attr__('Your comment...','conferpress').'"></textarea></p>',
			'title_reply'=>'',
			'id_submit'=>'comment-submit'));
		ob_start();
		comment_form();
		$output_comment = ob_get_contents();
		ob_end_clean();
		?>
    </div>
    <?php } ?>
</div><!-- #comments .comments-area -->