<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">

		<ol class="row listing fluid-container">
			<?php
				// add_query_arg(array(
				// 	'meta_key' => 'lanzamiento',
				// 	'orderby' => 'lanzamiento',
				// 	'order' => 'DESC'
				// ));
				$discos = new WP_Query(array(
				   'post_type' => 'discos',
				   'meta_key' => 'lanzamiento',
				   'orderby' => 'lanzamiento',
				   'order' => 'DESC'
				));
				if ( $discos->have_posts() ) : while ( $discos->have_posts() ) :
				global $post;
				$discos->the_post();
				$artistasData = get_post_meta($post->ID,'artista');
				$artistas = array();
				foreach ($artistasData as $artistaData) {
					$artistas[] = $artistaData['post_title'];
				}
			?>
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="widget-content">
					<a class="discFeature" href="<?php the_permalink(); ?>">
						<?php
							$large_id = get_post_thumbnail_id();
							$large_url = wp_get_attachment_image_src($large_id,[280,280], false);
						?>
						<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title() ?>">
						<div class="player" soundcloud="<?php echo get_post_meta($post->ID, 'soundcloud', true) ?>">
							<div class="play"></div>
						</div>
					</a>
					<div class="album-info">
						<h4 class="pair-title"><?php the_title(); ?></h4>
						<p class="pair-sub"><?php echo (count($artistas)>1)?'Varios':$artistas[0] ?>.</p>
						<a href="<?php the_permalink(); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
					</div>
				</div><!-- widget-content -->
			</li>
			<?php endwhile; endif;wp_reset_query(); ?>
		</ol><!-- /discography -->
	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>
