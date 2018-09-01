<?php 
function meydjer_comment($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
	<?php /* start the comments list */ ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	
	<?php /* Content containner */ ?>
	<div id="comment-<?php comment_ID(); ?>" class="comment_box">
	
	<?php /* Load only approved comments */ ?>
	<?php if ($comment->comment_approved == '0') : ?>
	   <strong><?php _e('Your comment is awaiting moderation.','meydjer') ?></strong><br /><br />
	<?php endif; ?>

		<?php /* Comment author avatar */ ?>
		<?php echo get_avatar($comment,$size='60'); ?>

		<?php /* Comment author and date */ ?>
			<span class="comment-author"><?php comment_author_link(); ?></span><br />
			<span class="comment-date-time"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date('F j, Y - '); echo get_comment_time('H:ia'); ?></a></span>
			<?php /* Add a "(Edit)" link to the comments */ ?>
			<span class="comment-edit"><?php edit_comment_link(__('(Edit)','meydjer'),'  ',''); ?></span>
			<div class="clearfix"></div>
		
		<?php /* Comment content */ ?>
		<div class="comment-content">
			<?php comment_text() ?>
			<div class="comment-nav">
				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>
		</div>
	</div>
<?php } ?>