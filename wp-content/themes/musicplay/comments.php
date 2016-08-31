<?php
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _n( '%2$s 1 Reply', '%2$s %1$s Replies', get_comments_number() ),
				number_format_i18n( get_comments_number() ), '' );
			?>
		</h3>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'atp_custom_comment' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'musicplay' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'musicplay' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'musicplay' ) ); ?></div>
			</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'musicplay' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>
	<?php

		// Comment Form Args
		$comments_args = array(
			'label_submit'=> __('Submit','musicplay'),
			'title_reply'=>'<h4 class="fancyheading textleft"><span>'.__( 'Leave a Reply' , 'musicplay' ).'</span></h4>' 
		);

		// Comment Form
		comment_form($comments_args); ?>

</div><!-- #comments .comments-area -->