<?php
/*
Template Name: Homepage (Sidebar #1 / Content / Sidebar #2)
*/
?>

<?php get_header(); ?>
<?php //get_template_part('inc_slider'); ?>
<?php get_template_part('inc_section'); ?>

<!-- ########################### MAIN ########################### -->
	<div class="row main">
			<?php if(false): ?>
			<aside class="three columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-one'); ?>
			</aside><!-- /sidebar -->
			<?php endif; ?>
			<div class="eight columns content">

				<?php the_content(); ?>

			</div>

			<aside class="four columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-two'); ?>
			</aside><!-- /sidebar -->

	</div><!-- /row -->

<?php get_footer(); ?>
