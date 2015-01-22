<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'Comments', '', get_comments_number(), 'comments title', 'material' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'material_comment' ) ); ?>
		</ol><!-- .comment-list -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'material' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
