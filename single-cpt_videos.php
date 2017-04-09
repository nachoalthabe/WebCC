<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

	<div class="row main">			
			
			<aside class="three columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-one'); ?>		
			</aside><!-- /sidebar -->

			<div class="six columns content content-single">

				<?php                
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                $video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
				$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);	
                ?>
				<article <?php post_class('post'); ?>>
					<div class="post-featured">
						<div class="video-single">
							<?php if ($video_type == 1): ?>
							<div id="player<?php echo $i; ?>-wrap" class="video-player">
								<div id="player<?php echo $i; ?>"><?php _e('Loading the player','acoustic'); ?></div>
								<script type="text/javascript">
									setupvjw('player<?php echo $i; ?>','<?php echo $video_url; ?>');												
								</script>
							</div><!-- /player-wrapp -->																			
							<?php else: 
								echo wp_oembed_get($video_url);
								endif;	
							?>										
						</div>					
					</div><!-- /post-featured -->
					<div class="post-body row">
						<div class="post-copy-wrap twelve columns">	
							<div class="post-copy">
								<h2><a href="<?php the_permalink(); ?>" title="<?php echo __('Permalink to', 'acoustic').' '.esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>								
								<?php ci_e_content(); ?>
							</div><!-- /post-copy -->
						</div><!-- /post-copy-wrap -->
					</div><!-- /post-body -->

					<?php comments_template(); ?>
				
				</article><!-- /post -->				
				<?php endwhile; endif; ?>

			</div>

			<aside class="three columns sidebar">
				<?php dynamic_sidebar('homepage-sidebar-two'); ?>
			</aside><!-- /sidebar -->

	</div><!-- /row -->

<?php get_footer(); ?>