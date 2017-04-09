<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">

		<ol class="row listing fluid-container">
			<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				$categorias = wp_get_post_categories($post->ID,array('fields' => 'names'));
				$tipos = wp_get_post_terms($post->ID, 'tipos_de_artista',array("fields" => "names") );
			?>
			<li class="<?php echo ci_column_classes(ci_setting('archive_tpl')); echo implode(' ',$tipos);?> columns">
				<div class="widget-content">
					<a class="full_image" href="<?php the_permalink(); ?>">
						<?php
						$large_id = get_post_thumbnail_id();
						$large_url = wp_get_attachment_image_src($large_id,'large', true);
						?>
						<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title($post->ID) ?>" />
					</a>
					<div class="album-info">
						<h4 class="pair-title"><?php the_title(); ?></h4>
						<p class="pair-sub"><?php echo join($categorias,','); ?>.</p>
						<a href="<?php the_permalink(); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
					</div>
				</div><!-- widget-content -->
			</li>
			<?php endwhile; endif; ?>
		</ol><!-- /discography -->
		<?php ci_pagination(); ?>

	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>
