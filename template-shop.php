<?php
/*
Template Name: Shop
*/
?>

<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row">
	
	<div class="twelve columns content content-single content-fullwidth">
		
		<article class="post">				
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>			
			<div class="post-body row">
				<div class="post-copy-wrap twelve columns">	
					<?php the_content(); ?>
				</div><!-- /post-body-wrap -->	
			</div><!-- /post-body -->
			
			<?php endwhile; endif; ?>					
			<?php //comments_template(); ?> 
		</article><!-- /article -->
				
	</div><!-- /content -->
	      
</div><!-- /row -->
<?php get_footer(); ?>