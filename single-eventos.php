<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">
					
			<div class="three columns">
				<div class="widget widget-single-event">
					<div class="widget-content">
						<?php
							$event_thumb_id = get_post_thumbnail_id();
							$event_thumb_url = wp_get_attachment_image_src($event_thumb_id,'large', true);						
						?>
						<a href="<?php echo $event_thumb_url[0]; ?>" data-rel="prettyPhoto">
						<?php
							$attr = array('class'=> "scale-with-grid");
							the_post_thumbnail('ci_width', $attr);
						?>
						</a>
					</div><!-- widget-content -->
				</div><!-- /widget -->
				<?php 
					$artistas = get_post_meta($post->ID,'artistas');
					if(count($artistas) > 0):
				?>
				<div class="widget-artistas widget">
					<div class="widget-content">
						<?php foreach ($artistas as $artista):
						$categoriasInfo = wp_get_post_categories( $artista['ID'] );
						$categorias = array();
						foreach ($categoriasInfo as $key => $categoriaID) {
							$categoria = get_category($categoriaID);
							$categorias[] = $categoria->name;
						}
						?>
						<div class="widget-content">
							<a class="feature" href="<?php echo get_permalink($artista['ID']); ?>">	
								<?php
									$artista_thumb_id = get_post_thumbnail_id($artista['ID']);
									$artista_thumb_url = wp_get_attachment_image_src($artista_thumb_id,'large', true);	
								?>
								<img src="<?php echo $artista_thumb_url[0] ?>">
								<div class="player" soundcloud="<?php echo get_post_meta($artista['ID'], 'soundcloud', true) ?>">
									<div class="play"></div>
								</div>
							</a>
							<div class="album-info title-pair">
								<h4 class="pair-title"><?php echo get_the_title($artista['ID']); ?></h4>
								<p class="pair-sub"><?php echo implode(', ', $categorias)?>.</p>
								<a href="<?php echo get_permalink($artista['ID']); ?>" class="btn"><?php _e('ver más','acoustic'); ?></a>
							</div>
						</div><!-- widget-content -->
						<?php 
							endforeach;
						?>
					</div>
				</div>
				<?php 
					endif;
				?>
				<div id="single-sidebar">
					<?php dynamic_sidebar('events-sidebar'); ?>
				</div>
			</div><!-- /three columns -->
			<div class="six columns">
				<div class="widget">
					<div class="widget-content">
						<div class="widget-content">
								<?php 
									$fecha = explode('.',get_post_meta($post->ID,'fecha',true));
									$hora = explode(':',get_post_meta($post->ID,'hora',true));
									$lugar = get_post_meta($post->ID,'lugar',true);
								?>
								<div class="table">
									<div class="row">
										<div class="cell"><b>Fecha:</b> <?php echo $fecha[0]; ?> - <?php echo themonth($fecha[1]); ?> - <?php echo $fecha[2]; ?></div>
										<div class="cell"><b>Hora:</b> <?php echo $hora[0]; ?>:<?php echo $hora[1]; ?></div>
									</div>
									<?php if($lugar):?>
									<div class="row">
										<div class="cell"><b>Lugar:</b> <?php echo get_the_title($lugar['ID']); ?></div>
										<div class="cell"><b>Dirección:</b> <?php echo get_post_meta($lugar['ID'],'direccion',true); ?></div>
									</div>
									<?php endif; ?>
								</div>
						</div><!-- /meta-wrap -->
					</div>
				</div><!-- /content-inner -->
				<div class="content-inner">
					<h2><?php the_title(); ?></h2>
					<?php ci_e_content(); ?>										
				</div><!-- /content-inner -->
			</div><!-- /nine columns -->
			<div class="three columns">
				<div class="mapBox widget widget-single-event">
					<?php if($lugar): ?>
					<div class="widget-content">
						<?php 
							$lugar = get_post_meta($post->ID,'lugar',true);
							$posicion = get_post_meta($lugar['ID'],'posicion',true);
						?>
						<div class="widget-content">
								<div class="mapContainer" icon="<?php echo $imagen[0] ?>">
									<?php echo $posicion; ?>
								</div>
								<a href="#lugar-<?php echo $post->ID; ?>" class="btn mapBtn">Como Llegar?</a>
								<?php
									$lugar_thumb_id = get_post_thumbnail_id($lugar['ID']);
									$lugar_thumb_url = wp_get_attachment_image_src($lugar_thumb_id,'large', true);						
								?>
								<a href="<?php //echo get_permalink($lugar['ID']) ?>" class="foto-lugar">
									<img src="<?php echo $lugar_thumb_url[0]; ?>">
								</a>
						</div><!-- widget-content -->
					</div>
					<?php endif; ?>
				</div><!-- /widget -->
			
				<div id="single-sidebar">
					<?php dynamic_sidebar('events-sidebar'); ?>
				</div>
			</div><!-- /three columns -->
		
</div><!-- /row -->		

<?php get_footer(); ?>