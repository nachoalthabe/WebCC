<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">			
		
		<ol class="row listing">		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				$captions= get_post_meta($post->ID, 'ci_cpt_galleries_caption', true);
				
				$args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_status' => 'inherit', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order');
				$attachments = new WP_Query($args);
				while ( $attachments->have_posts() ) : $attachments->the_post();				
					$attr = array(
						'alt'   => trim(strip_tags( get_post_meta($post->ID, '_wp_attachment_image_alt', true) )),
						'title' => trim(strip_tags( $post->post_title )),
						'class'	=> 'scale-with-grid'
					);
					$img_attrs = wp_get_attachment_image_src( $post->ID, 'ci_media' );													
					$img_attrf = wp_get_attachment_image_src( $post->ID, 'large' );
					echo '<li class="' . ci_column_classes(ci_setting('archive_tpl')) . ' columns"><div class="widget-content">';
					
					if ($captions == 1):
							echo '<a href="'. $img_attrf[0] .'" rel="'.$img_attrs[0].'" title="" data-rel="prettyPhoto[pp_gal]" class="gallery-link gallery-link-pad">'. wp_get_attachment_image( $post->ID, 'ci_featured', false, $attr ).'</a>';
					else:
							echo '<a href="'. $img_attrf[0] .'" rel="'.$img_attrs[0].'" title="" data-rel="prettyPhoto[pp_gal]" class="gallery-link">'. wp_get_attachment_image( $post->ID, 'ci_featured', false, $attr ).'</a>';
					endif;		
					
					if ($captions == 1):
						echo '<div class="album-info"><h4 class="pair-title">';
						echo $post->post_title;
						echo '</h4></div>';
					endif;
					
					echo '</div></li>';
				endwhile;
			
			endwhile; endif; ?>
		</ol><!-- /discography -->
		
	</div><!-- /twelve columns -->
</div><!-- /row -->		

<?php get_footer(); ?>