<?php
/*
Template Name: Novedades
*/
get_header(); ?>
<?php get_template_part('inc_section'); ?>

	<div class="row main">

			<div class="nine columns content widget">
				<?php
                $wpq = array(
                                    'post_type' => 'post',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'posts_type',
                                            'field' => 'slug',
                                            'terms' => array('sello', 'artista'),
                                        ),
                                    ),
                                );
                $query = new WP_Query($wpq);

        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<?php
                $type = wp_get_post_terms($post->ID, 'posts_type')[0];
                if ($type->slug == 'sello'):?>
					<article <?php post_class('post'); ?>>
						<div class="post-featured">
							<?php
                                if (ci_setting('featured_single_show') == 'enabled') {
                                    the_post_thumbnail('ci_featured');
                                }
                            ?>
						</div><!-- /post-featured -->
						<div class="post-body row">
							<div class="post-copy-wrap twelve columns">
								<div class="post-copy">
									<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'acoustic').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
									<p class="post-meta">
											<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo get_the_date('M'); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time>
									</p>
									<?php the_content(); ?>
									<a class="btn" href="<?php echo get_permalink(); ?>">ver más</a>
								</div><!-- /post-copy -->
							</div><!-- /post-copy-wrap -->
						</div><!-- /post-body -->
					</article><!-- /post -->
				<?php else: ?>
					<article <?php post_class('post'); ?>>
						<div class="post-featured">
							<?php
                                if (ci_setting('featured_single_show') == 'enabled') {
                                    the_post_thumbnail('ci_featured');
                                }
                            ?>
						</div><!-- /post-featured -->
						<div class="post-body row">
							<div class="post-copy-wrap twelve columns">
								<div class="post-copy">
									<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'acoustic').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
									<p class="post-meta">
											<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><span class="day"><?php echo get_the_date('d'); ?></span> <span class="month"><?php echo get_the_date('M'); ?></span> <span class="year"><?php echo get_the_date('Y'); ?></span></time>
									</p>
									<?php the_excerpt(); ?>
									<a class="btn" href="<?php echo get_permalink(); ?>">ver más</a>
								</div><!-- /post-copy -->
							</div><!-- /post-copy-wrap -->
						</div><!-- /post-body -->
					</article><!-- /post -->
				<?php endif; ?>
				<?php endwhile; endif;?>
                <?php
                wp_reset_query(); ?>

			</div>
			<aside class="three columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-two'); ?>
			</aside><!-- /sidebar -->

	</div><!-- /row -->

<?php get_footer(); ?>
