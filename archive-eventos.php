<?php get_header(); ?>
<?php get_template_part('inc_section');
// add_query_arg(array(
// 	'meta_key' => 'fecha',
// 	'meta_value' => date('Y-m-d'),
// 	'meta_compare' => '>=',
// 	'orderby' => 'fecha',
// 	'order' => 'desc'
// ));
$next_events = new WP_Query( array(
				'post_type' => 'eventos',
				'meta_key' => 'fecha',
				'meta_value' => date('Y-m-d'),
				'meta_compare' => '>=',
				'orderby' => 'fecha',
				'order' => 'desc'
			));
?>

<div class="row main">
	<div class="twelve columns">
		<ol class="row listing fluid-container">
			<?php
				if ( $next_events->have_posts() ) : while ( $next_events->have_posts() ) : $next_events->the_post();
				$categorias = wp_get_post_categories($post->ID,array('fields' => 'names'));
				$fecha = explode(".",get_post_meta($post->ID, 'fecha', true));
				$hora = get_post_meta($post->ID, 'hora', true);
			?>
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="widget-content">
					<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>">
						<?php
						$large_id = get_post_thumbnail_id();
						$large_url = wp_get_attachment_image_src($large_id,'large', true);
						?>
						<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title($post->ID) ?>" />

					</a>
					<?php endif; ?>
					<div class="album-info table">
						<div class="cell">
							<h4 class="pair-title"><?php the_title(); ?></h4>
							<p class="pair-sub"><?php echo join($categorias,','); ?>.</p>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
						</div>
						<div class="cell event-date">
							<p><span class="day"><?php echo $fecha[2]; ?></span> <span class="year"><?php echo strtoupper(themonth($fecha[1])); ?></span><?php if($hora != ""): ?><span class="month"><?php echo $hora; ?></span><?php endif; ?></p>
						</div>
					</div>
				</div><!-- widget-content -->
			</li>
			<?php endwhile; endif;wp_reset_postdata(); ?>
		</ol><!-- /discography -->
		<h3 class="section-title">Pasados</h3>
		<ol class="row listing fluid-container">
		<?php
			$past_events = new WP_Query( array(
				'post_type' => 'eventos',
				'meta_key' => 'fecha',
				'meta_value' => date('Y-m-d'),
				'meta_compare' => '<',
				'orderby' => 'fecha',
				'order' => 'desc'
			));
			if ( $past_events->have_posts() ):
				while ( $past_events->have_posts() ) : $past_events->the_post();
					$categorias = wp_get_post_categories($post->ID,array('fields' => 'names'));
					$fecha = explode(".",get_post_meta($post->ID, 'fecha', true));
					$hora = get_post_meta($post->ID, 'hora', true);
			?>
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); ?> columns">
				<div class="widget-content">
					<?php if ( has_post_thumbnail() ): ?>
					<a href="<?php the_permalink(); ?>">
						<?php
						$large_id = get_post_thumbnail_id();
						$large_url = wp_get_attachment_image_src($large_id,'large', true);
						?>
						<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title($post->ID) ?>" />
					</a>
					<?php endif; ?>
					<div class="album-info">
						<div class="cell">
							<h4 class="pair-title"><?php the_title(); ?></h4>
							<p class="pair-sub"><?php echo join($categorias,','); ?>.</p>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
						</div>
						<div class="cell event-date">
							<p><span class="day"><?php echo $fecha[2]; ?></span> <span class="year"><?php echo strtoupper(themonth($fecha[1])); ?></span><?php if($hora != ""): ?><span class="month"><?php echo $hora; ?></span><?php endif; ?></p>
						</div>
					</div>
				</div><!-- widget-content -->
			</li>
			<?php endwhile; endif;wp_reset_postdata(); ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>

	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>
