<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
					
		<div class="nine columns">
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
				<article <?php post_class('post'); ?>>				
					
					<?php the_post_thumbnail('ci_page'); ?>			
					<div class="post-body row">
						<div class="post-copy-wrap twelve columns">	
							<div class="post-copy post-page group">
								<h2><?php the_title(); ?></h2>
								<?php ci_e_content(); ?>
							</div>
						</div><!-- /post-body-wrap -->	
					</div><!-- /post-body -->
					
					<?php comments_template(); ?>
								
				</article><!-- /article -->
				
			<?php endwhile; endif; ?>
		
		</div><!-- /twelve columns -->
		
		<aside class="three columns sidebar">
			<?php dynamic_sidebar('pages-sidebar'); ?>
		</aside><!-- /three columns -->

</div><!-- /row -->		

<?php get_footer(); ?>