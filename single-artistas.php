<?php get_header(); ?>
<?php get_template_part('inc_section'); ?>

<div class="row main">		

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
		<div class="six columns widget content">	
			<div class="content-inner">		
				<?php ci_e_content(); ?>																
			</div>
		</div><!-- /twelve columns -->
		<?php 
		$contacto = get_post_meta($post->ID, 'formulario_contacto', true);
		if($contacto): ?>
		<div class="three columns widget">
			<h3 class="widget-title">Contacto</h3>
			<div class="widget-content">
				<div class="widget-content">
					<?php echo do_shortcode( '[contact-form-7 id="3490"]' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="three columns widget">
			<h3 class="widget-title">Files</h3>
			<div class="widget-content">
				<div class="widget-content">
					<center><a href="#" class="btn">Press Kit</a><?php if(!has_term( 'visual', 'tipos_de_artista' )): ?>&nbsp&nbsp<a href="#" class="btn">Rider Técnico</a><?php endif; ?></center>
				</div>
			</div>
		</div>
		<aside class="six columns widget sidebar">
			<div class="widget widget-single-artist">
				<div class="widget-content">
					<?php
						$large_id = get_post_thumbnail_id();
						$large_url = wp_get_attachment_image_src($large_id,'large', true);
					?>
					<img src="<?php echo $large_url[0] ?>" alt="<?php echo get_the_title($post->ID) ?>" />
				</div><!-- widget-content -->
			</div><!-- /widget -->
				
			<div id="single-sidebar">
				<?php dynamic_sidebar('artist-sidebar'); ?>
			</div>	
				
		</aside>
		<?php 
			if(($video = get_post_meta($post->ID,'youtube',true))!= ''):
		?>
		<div class="six columns widget">
			<h3 class="widget-title">Video</h3>
			<?php 
			echo do_shortcode("[youtube]".$video."[/youtube]") 
			?>
		</div>
		<?php 
			endif;
		if(has_term( 'visual', 'tipos_de_artista' )):
			if(($imagen = get_post_meta($post->ID,'flickr',true))!= ''):
			?>
		<div class="six columns widget">
			<h3 id="flickr_title" class="widget-title">Imagen</h3>
			<div id="flickr_content" class="home-box">
				<?php echo get_post_meta($post->ID,'flickr',true); ?>
			</div>
			<script type="text/javascript">
				var flickr = function($){
					var content = $("#flickr_content"),
						title = $("#flickr_title");
					var flickrID = content.text().trim();
					content.text('');
					console.log(flickrID);
					$.ajax({
						url: "http://api.flickr.com/services/rest/?jsoncallback=?",
						dataType: "jsonp",
						data: {
							method: "flickr.people.getInfo",
							api_key: "ec1dd8afd03569cf213f288d2338fde1",
							user_id: flickrID,
							format: "json"
						}
					}).done(function(data){
						var user = data.person;
						title.css( "backgroundImage", "url(http://farm"+user.iconfarm+".staticflickr.com/"+user.iconserver+"/buddyicons/"+user.nsid+".jpg)" );
						$("<a class=\"btn\" target=\"_blank\">").attr('href',user.photosurl._content).text(user.realname._content).append($("<div>").append($("<img>").attr('src',"http://farm"+user.iconfarm+".staticflickr.com/"+user.iconserver+"/buddyicons/"+user.nsid+".jpg"))).prependTo(content);
					});
					$.ajax({
						url: "http://api.flickr.com/services/rest/?jsoncallback=?",
						dataType: "jsonp",
						data: {
							api_key: "ec1dd8afd03569cf213f288d2338fde1",
							user_id: flickrID,
							per_page: 10,
							safe_search: 1,
							method: "flickr.people.getPublicPhotos",
							format: "json"
						}
					}).done(function( data ) {
						console.log('response',data);
						$.each( data.photos.photo, function( i, item ) {
							$( "<img/>" ).attr( "src", 
								"http://farm"+item.farm+
								".staticflickr.com/"+item.server+
								"/"+item.id+"_"+item.secret+
								".jpg" ).appendTo(content);
							if ( i === 3 ) 
								return false;
						});
					});
				}(jQuery);
			</script>
		</div>
		<?php 
			endif;
		endif; 
			if(($sonido = get_post_meta($post->ID,'soundcloud',true))!= ''):?>
		<div class="six columns widget">
			<h3 class="widget-title">Sonido</h3>
			<?php 
			echo do_shortcode("[soundcloud]".$sonido."[/soundcloud]") 
			?>
		</div>
		<?php 
			endif;
		endwhile; endif; ?>
		
</div><!-- /row -->		

<?php get_footer(); ?>