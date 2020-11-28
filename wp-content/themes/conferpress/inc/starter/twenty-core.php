<?php
/**
 * @since ConferPress 1.0
 *
 */
/* Echo meta data tags */
function leaf_meta_tags(){
	$description = get_bloginfo('description');
	if(is_single()){
		global $post;
		$description = $post->post_excerpt; ?>
        <meta property="og:title" content="<?php echo get_the_title($post->ID);?>"/>
        <meta property="og:url" content="<?php echo get_permalink($post->ID);?>"/>
        <meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>"/>
        <meta property="og:type" content=""/>
        <meta property="og:description" content="<?php echo esc_attr($description);?>"/>
        <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name'));?>"/>
    <?php } ?>
	<meta property="description" content="<?php echo esc_attr($description);?>"/>
<?php
}

/**
 * add home link.
 */
function leaf_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'leaf_page_menu_args' );


if ( ! function_exists( 'leaf_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since ConferPress 1.0
 */
function leaf_content_nav( $html_id, $custom_query=false ) {
	global $wp_query;
	$current_query = $wp_query;
	if($custom_query){
		$current_query = $custom_query;
	}

	if ( $current_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr($html_id); ?>" class="default-paging" role="navigation">
			<div class="default-nav-item nav-previous alignleft"><?php next_posts_link( esc_html__( '&larr; Older posts', 'conferpress' ),$current_query->max_num_pages ); ?></div>
			<div class="default-nav-item nav-next alignright"><?php previous_posts_link( esc_html__( 'Newer posts &rarr;', 'conferpress' ) ); ?></div>
            <div class="clearfix"></div>
		</nav><!-- #.navigation -->
	<?php endif;
}
endif;


if ( ! function_exists( 'leaf_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own leaf_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function leaf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'conferpress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'conferpress' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<?php printf( '<h3 class="hidden">%1$s</h3> ', get_comment_author_link()); ?>
			<div class="avatar-wrap">
				<?php echo get_avatar( $comment, 80); ?>
			</div>
			<div class="comment-meta comment-author">
            	<div class="comment-edit">
					<?php
                        printf( '<cite class="fn h5 font-2">%1$s</cite> ', get_comment_author_link());
                    ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'conferpress' ), 'after' => ' <span></span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                	<!-- .reply --> 
					<?php 
                    printf( '<time datetime="%2$s">%3$s</time>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( '%1$s '.esc_html__('at', 'conferpress').' %2$s ', get_comment_date(), get_comment_time() )
                        );?>
                        <?php
                    edit_comment_link( esc_html__( 'Edit', 'conferpress' ), '<p class="edit-link">', '</p>' ); ?>
                </div>
				<div class="comment-content">					
					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'conferpress' ); ?></p>
				<?php endif; ?>
					<?php comment_text(); ?>
				</div><!-- .comment-content -->
				
            </div><!-- .comment-meta -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if(!function_exists('leaf_alter_comment_form_fields')){
	function leaf_alter_comment_form_fields($fields){
		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';
		
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
	
		$fields['author'] = '<div class="cm-form-info"><div class="comment-author-field"><div class="auhthor login"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="'.($req ? '' : '').esc_attr__('Your Name *','conferpress').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="100"' . $aria_req . ' /></p></div>';
		$fields['email'] = '<div class="email login"><p class="comment-form-email"><input id="email" placeholder="'.($req ? '' : '').esc_attr__('Your Email *','conferpress').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="100"' . $aria_req . ' /></p></div>';  //removes email field
		$fields['url'] = '<div class="url login"><p class="comment-form-url"><input id="url" placeholder="'.esc_attr__('Your Website','conferpress').'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="100" /></p></div></div></div>';
		
		return $fields;
	}

	add_filter('comment_form_default_fields','leaf_alter_comment_form_fields');
}

//change comment form
if(!function_exists('leaf_comment_form_leaf_custom')){
function leaf_comment_form_leaf_custom( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name','conferpress' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email','conferpress'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website','conferpress'  ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . esc_html__('Required fields are marked %s','conferpress' ), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'conferpress' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'conferpress' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','conferpress'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.','conferpress' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => esc_html__( 'Leave a Reply','conferpress' ),
		'title_reply_to'       => esc_html__( 'Leave a Reply to %s','conferpress'  ),
		'cancel_reply_link'    => esc_html__( 'Cancel reply','conferpress'  ),
		'label_submit'         => esc_html__( 'Submit &rsaquo;' ,'conferpress'),
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>            
            
			<div id="respond" class="comment-respond">
            
              <div class="author-current">
              	<?php $user_ID = get_current_user_id();
					echo get_avatar( $user_ID,80); ?>
              </div>

				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo wp_kses_post($args['must_log_in']); ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php if($html5){?>  novalidate <?php } ?>>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args['logged_in_as'] The logged-in-as HTML-formatted message.
							 * @param array  $commenter            An array containing the comment author's username, email, and URL.
							 * @param string $user_identity        If the commenter is a registered user, the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user, the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo wp_kses_post($args['comment_notes_before']); ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args['comment_field'] The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo wp_kses_post($args['comment_notes_after']); 
						if (!is_user_logged_in() ) :
						foreach ( (array) $args['fields'] as $name => $field ) {
							/**
							 * Filter a comment form field for display.
							 *
							 * The dynamic portion of the filter hook, $name, refers to the name
							 * of the comment form field. Such as 'author', 'email', or 'url'.
							 *
							 * @since 3.0.0
							 *
							 * @param string $field The HTML-formatted output of the comment form field.
							 */
							echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
						}
						endif;
						
						
						?>
						
						<?php echo apply_filters( 'comment_form_submit_field', '', $args ); ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.2
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}


}
//end

if ( ! function_exists( 'leaf_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own leaf_entry_meta() to override in a child theme.
 */
function leaf_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( esc_html__( ', ', 'conferpress' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', esc_html__( ', ', 'conferpress' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( date_i18n(get_option('date_format') ,strtotime(get_the_date())) )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'conferpress' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = esc_html__( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'conferpress' );
	} elseif ( $categories_list ) {
		$utility_text = esc_html__( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'conferpress' );
	} else {
		$utility_text = esc_html__( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'conferpress' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since ConferPress 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function leaf_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'leaf_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since ConferPress 1.0
 */
function leaf_customize_preview_js() {
	wp_enqueue_script( 'leafcolor-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'leaf_customize_preview_js' );

if(!function_exists('get_dynamic_sidebar')){
	function get_dynamic_sidebar($index = 1){
		$sidebar_contents = "";
		ob_start();
		dynamic_sidebar($index);
		$sidebar_contents = ob_get_clean();
		return $sidebar_contents;
	}
}