<?php if (ci_setting('latest_media') == 'enabled'): ?>
<div class="row latest-media">
	<div class="twelve columns">
			<h3 class="widget-title"><?php _e('LATEST MEDIA','acoustic'); ?></h3>	
	
			<div class="row latest-media-generate ">
				<?php
					$args = array( 'post_type' => array('cpt_videos','cpt_galleries'), 'posts_per_page' => 4, 'orderby' => 'rand');
					$latest_media = new WP_Query($args);
			
				while ( $latest_media->have_posts() ) : $latest_media->the_post();
				$cpt = get_post_type( $post->ID ); 
				?>
				<?php if ($cpt == 'cpt_videos'): 
						$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
						$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);	
				?>
				
				<div class="three columns">
					<div class="media-block media-video widget-content">
						<a href="<?php if ($video_type == 1): echo "#player" . $i . "-wrap"; else: echo $video_url; endif; ?>" data-rel="prettyPhoto">
							<span class="media-act"></span>
							<?php the_post_thumbnail('ci_featured'); ?>
						</a>	
						<div class="media-block-details title-pair">
							<h3 class="pair-title"><?php the_title(); ?></h3>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a>
						</div>
						<?php if ($video_type == 1): ?>
						<div id="player<?php echo $i; ?>-wrap" class="video-player video-player-archive">
							<div id="player<?php echo $i; ?>"><?php _e('Loading the player','acoustic'); ?></div>
							<script type="text/javascript">
								setupvjw('player<?php echo $i; ?>','<?php echo $video_url; ?>');												
							</script>
						</div><!-- /player-wrapp -->																			
						<?php endif; ?>								
					</div>
				</div><!-- /media-block -->
			
				<?php else:
					$gal_location 	= get_post_meta($post->ID, 'ci_cpt_galleries_location', true);
					$gal_venue 		= get_post_meta($post->ID, 'ci_cpt_galleries_venue', true);
				 ?>
				
				<div class="three columns">
					<div class="media-block media-photo widget-content">
						<a href="<?php the_permalink(); ?>">
							<span class="media-act"></span>
							<?php the_post_thumbnail('ci_featured'); ?>
						</a>	
						<div class="media-block-details title-pair">
							<h3 class="pair-title"><?php echo $gal_venue; ?></h3>
							<p class="pair-sub"><?php echo $gal_location; ?></p>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('View set','acoustic'); ?></a>
						</div>
					</div>
				</div><!-- /media-block -->
				
				<?php endif; ?>
			
				<?php
					endwhile;
					wp_reset_postdata();
				?>	
		</div>
	</div>	
</div><!-- /latest-media -->
<?php endif; ?>