<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'acoustic'));
	if ( post_password_required() ) {
		echo '<p class="nocomments">' . _e('This post is password protected. Enter the password to view comments.', 'acoustic') . '</p>';
		return;
	}
?>

<?php if(comments_open()): ?>
	<div class="row" id="respond">
		<div class="twelve columns">
			<div class="pad">
				<fb:comments href="<?php echo get_permalink(); ?>" num_posts="10"></fb:comments>
			</div>
		</div>
	</div>
<?php endif; ?>		
