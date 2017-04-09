<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">

	<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	?>
	<div class="five columns">
		<div class="widget widget_ci_discography_widget">
			<div class="widget-content">
				<div class="widget-content">
					<?php
						$large_id = get_post_thumbnail_id();
						$large_url = wp_get_attachment_image_src($large_id,'large', true);
					?>
					<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title() ?>">
					<?php if(false): ?>
					<div class="album-info title-pair">
						<h3 class="pair-title"><?php echo $album_status; ?></h3>
						<p class="pair-sub"><?php echo $album_text; ?></p>
						<?php if ($album_text_from1 != ""): ?>
							<a href="<?php echo $album_text_url1; ?>" class="btn"><?php echo $album_text_from1; ?></a>
						<?php endif; ?>
						<?php if ($album_text_from2 != ""): ?>
							<a href="<?php echo $album_text_url2; ?>" class="btn"><?php echo $album_text_from2; ?></a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- /latest-album -->
	</div><!-- /three columns -->
	<div class="columns seven">
		<?php
			$soundCloud = get_post_meta($post->ID, 'soundcloud', true);
			if($soundCloud): ?>
		<div class="widget">
			<?php echo do_shortcode('[soundcloud]'.$soundCloud.'[/soundcloud]'); ?>
		</div>
		<?php
			endif;
		?>
		<div>
			<div class="content-inner widget">
				<?php ci_e_content(); ?>
			</div>
		</div>
	</div>
	<div class="five columns widget">
		<?php
			$artistas = get_post_meta($post->ID,'artista');
			foreach ($artistas as $artista):
				if($artista == "")
					continue;
			$categorias = wp_get_post_categories($artista['ID'],array('fields' => 'names'));
		?>
			<div class="widget-content">
			<div class="widget-content">
				<a href="<?php echo get_permalink($artista['ID']); ?>">
					<?php
						$image_id = get_post_thumbnail_id($artista['ID']);
						$image_url = wp_get_attachment_image_src($image_id,'small', true);
					?>
					<img src="<?php echo $image_url[0] ?>" alt="<?php echo $artista['post_title'] ?>">
				</a>
				<div class="album-info">
					<h4 class="pair-title"><?php echo get_the_title($artista['ID']); ?></h4>
					<p class="pair-sub"><?php echo join($categorias,','); ?>.</p>
					<a href="<?php echo get_permalink($artista['ID']); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
				</div>
			</div><!-- widget-content -->
			</div><!-- widget-content -->
		<?php
			endforeach;
		?>
	</div>
	<div class="widget columns">
		<h3 class="widget-title">Otros Discos</h3>
		<?php
			$discos = new WP_Query( array(
				'post_type' => 'discos',
				'posts_where' => 'id != '.$post->ID,
				'orderby'	=> 'rand',
				'posts_per_page' => 4
			));
			if ( $discos->have_posts() ) : while ( $discos->have_posts() ) : $discos->the_post();
			$artistasData = get_post_meta($post->ID,'artista');
			$artistas = array();
			foreach ($artistasData as $artistaData) {
				$artistas[] = $artistaData['post_title'];
			}
		?>
			<div class="columns three marginTop">
				<div class="widget-content">
					<div class="widget-content">
						<a class="discFeature" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('ci_featured'); ?>
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
				</div>
			</div>
		<?php endwhile; endif; wp_reset_postdata();?>
	</div>
<?php endwhile; endif; ?>
</div><!-- /row -->

<?php get_footer(); ?>
