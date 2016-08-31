<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package musik
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<a name="comments"></a>
<div class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title m-b">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title', 'musik' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'musik' ); ?></h4>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'musik' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'musik' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'div',
					'short_ping' => true,
				) );
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'musik' ); ?></h4>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'musik' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'musik' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'musik' ); ?></p>
	<?php endif; ?>

	<?php $comment_args = array( 
			'fields' => apply_filters( 'comment_form_default_fields', array(
	            'author' => '<div class="form-group row"><div class="col-sm-6">' .
	                        '<label for="author">' . esc_html__( 'Your Name:','musik' ) . '</label> ' .
	                        ( $req ? '<span class="required">*</span>' : '' ) .
	                        '<input class="form-control" id="author" name="author" type="text" value="' .
	                        esc_attr( $commenter['comment_author'] ) . '" size="30" />' .
	                        '</div>',
	            'email'  => '' .
	                        '<div class="col-sm-6"><label for="email">' . esc_html__( 'Your Email:','musik' ) . '</label> ' .
	                        ( $req ? '<span class="required">*</span>' : '' ) .
	                        '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />' .
	                		'</div></div>',
	            'url'    => '' ) 
            ),
            'comment_field' => '' .
                        '<div class="form-group"><label for="comment">' . esc_html__( 'Comment:','musik' ). '</label>' .
                        '<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
                        '</div>',
            'comment_notes_after' => '<input name="submit" class="btn btn-default m-b" type="submit" value="' . esc_html__( 'Post Comment', 'musik' ) . '" />',
            'title_reply' => __( 'Leave a comment', 'musik' ),
        );
        comment_form($comment_args); 
    ?>

</div><!-- #comments -->

<?php if( get_theme_mod( 'ajax-comment' ) == 1 ){ ?>
<script type="text/javascript">
	jQuery('document').ready(function($){
	    var commentform=$('#commentform'); // find the comment form
	    commentform.prepend('<div id="comment-status" ></div>'); // add info panel before the form to provide feedback or errors
	    var statusdiv=$('#comment-status'); // define the infopanel

	    commentform.submit(function(){
	        //serialize and store form data in a variable
	        var formdata=commentform.serialize();
	        //Add a status message
	        statusdiv.html('<p>Processing...</p>');
	        //Extract action URL from commentform
	        var formurl=commentform.attr('action');
	        //Post Form with data
	        $.ajax({
	            type: 'post',
	            url: formurl,
	            data: formdata,
	            error: function(XMLHttpRequest, textStatus, errorThrown)
	                {
	                    statusdiv.html('<p class="ajax-error text-danger" >You might have left one of the fields blank, or be posting too quickly</p>');
	                },
	            success: function(data, textStatus){
	                if(data == "success" || textStatus == "success"){
	                    statusdiv.html('<p class="ajax-success text-success" >Thanks for your comment. We appreciate your response.</p>');
	                }else{
	                    statusdiv.html('<p class="ajax-error text-danger" >Please wait a while before posting your next comment</p>');
	                    commentform.find('textarea[name=comment]').val('');
	                }
	            }
	        });
	        return false;
	    });
	});
</script>
<?php } ?>

