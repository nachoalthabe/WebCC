<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	
	<div class="twelve columns">			
		
		<ol class="row listing">											
			<?php								
				$i = 1;
				if ( have_posts() ) : while ( have_posts() ) : the_post();		
			?>		
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="widget-content">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('ci_featured'); ?>
					</a>
					<div class="album-info">
						<h4 class="pair-title"><?php the_title(); ?></h4>
						<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
					</div>
				</div><!-- widget-content -->
			</li>
			<?php $i++; endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>
		
	</div><!-- /twelve columns -->
</div><!-- /row -->		

<?php get_footer(); ?>