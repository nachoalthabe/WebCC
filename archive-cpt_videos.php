<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	
	<div class="twelve columns">			
		
		<ol class="row listing video-listing">
											
			<?php								
				$i = 1;
				if ( have_posts() ) : while ( have_posts() ) : the_post();	
				$video_url 	= get_post_meta($post->ID, 'ci_cpt_videos_url', true);
				$video_type = get_post_meta($post->ID, 'ci_cpt_videos_self', true);			
	
			?>		
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="media-block widget-content">
					<a href="<?php
								 if ($video_type == 1):
								  echo "#player" . $i . "-wrap";
								 else:
								  echo $video_url;
								 endif; ?>" data-rel="prettyPhoto">
					<span class="media-act"></span>
						<?php the_post_thumbnail('ci_featured'); ?>
					</a>
					<div class="album-info">
						<h4 class="pair-title"><?php the_title(); ?></h4>
						<?php if ($post->post_content != ""): ?><a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read more','acoustic'); ?></a><?php endif; ?>
					</div>
					<?php if ($video_type == 1): ?>
					<div id="player<?php echo $i; ?>-wrap" class="video-player video-player-archive">
						<div id="player<?php echo $i; ?>"><?php _e('Loading the player','acoustic'); ?></div>
						<script type="text/javascript">
							setupvjw('player<?php echo $i; ?>','<?php echo $video_url; ?>');												
						</script>
					</div><!-- /player-wrapp -->																			
					<?php endif; ?>	
				</div><!-- widget-content -->
			</li>
			<?php $i++; endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>
		
	</div><!-- /twelve columns -->
</div><!-- /row -->		

<?php get_footer(); ?>