<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">			
		
		<ol class="row listing">	
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					$gal_location 	= get_post_meta($post->ID, 'ci_cpt_galleries_location', true);
					$gal_venue 		= get_post_meta($post->ID, 'ci_cpt_galleries_venue', true);
			 ?>		
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">				
			
				<div class="widget-content">
					<a href="<?php the_permalink(); ?>">
						<?php
							$attr = array('class'=> "scale-with-grid");
							the_post_thumbnail('ci_featured', $attr);
						?>
					</a>
					<div class="album-info">
						<h4 class="pair-title"><?php echo $gal_venue; ?></h4>
						<p class="pair-sub"><?php echo $gal_location; ?></p>
						<a href="<?php the_permalink(); ?>" class="btn"><?php _e('View set','acoustic'); ?></a>
					</div>
				</div><!-- widget-content -->
				
			</li>
			<?php endwhile; endif; ?>
		</ol><!-- /discography -->
		
		<?php ci_pagination(); ?>
		
	</div><!-- /twelve columns -->
</div><!-- /row -->		

<?php get_footer(); ?>