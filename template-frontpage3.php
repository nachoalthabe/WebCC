<?php
/*
Template Name: Homepage (Content / Sidebar #1)
*/
?>

<?php get_header(); ?>
<?php get_template_part('inc_slider'); ?>
<?php get_template_part('inc_media'); ?>

<!-- ########################### MAIN ########################### -->
	<div class="row main">			
			
			<div class="nine columns content">

				<h3 class="widget-title"><?php _e('LATEST NEWS','acoustic'); ?></h3>

				<?php
                global $post;
                $paged = get_query_var('page') ? get_query_var('page') : 1;
                $args = array(
	            	'post_type'=>'post',
            		'paged' => $paged,
   					'posts_per_page' => ci_setting('news-no'),
					'cat' => ci_setting('news-cat')
            	);
                query_posts($args);
                
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="post">
					<div class="post-featured">
						<?php
							if(ci_setting('featured_single_show')=='enabled') {
								the_post_thumbnail('ci_page');
							}
						?>
						<time class="post-date" datetime="<?php echo get_the_date('Y-m-d'); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo strtoupper(get_the_date('M')); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time>						
					</div><!-- /post-featured -->
					<div class="post-body row">
						<div class="post-copy-wrap twelve columns">	
							<div class="post-copy">
								<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'acoustic').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>								
								<p class="post-meta">
									<?php if (! has_post_thumbnail() ) { ?>
										<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo get_the_date('M'); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time> &mdash;					
									<?php } ?>
									<?php _e('Filed Under: ', 'acoustic'); the_category(', '); ?>
								</p>
								<?php ci_e_content(); ?>
							</div><!-- /post-copy -->
						</div><!-- /post-copy-wrap -->
					</div><!-- /post-body -->
				</article><!-- /post -->				
				<?php endwhile; endif; ?>

                <?php ci_pagination(); wp_reset_query(); ?>

			</div>
			
			<aside class="three columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-one'); ?>		
			</aside><!-- /sidebar -->
			
	</div><!-- /row -->

<?php get_footer(); ?>