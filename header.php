<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xmlns:fb="http://ogp.me/ns/fb#" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title><?php ci_e_title(); ?></title>
	<link rel="shortcut icon" href="/favicon.png" />

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- JS files are loaded via /theme_functions/scripts.php -->

	<!-- CSS files are loaded via /theme_functions/styles.php -->

	<!--[if lt IE 9]>
		<link rel='stylesheet' href='<?php echo get_template_directory_uri() . "/css/ie.css" ?>' type='text/css' media='all' />
	<![endif]-->

	<?php wp_head(); ?>

</head>
<body <?php body_class(ci_setting('ci_stylesheet')); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=336737316448521";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">(function(d){
  var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
  p.type = 'text/javascript';
  p.async = true;
  p.src = '//assets.pinterest.com/js/pinit.js';
  f.parentNode.insertBefore(p, f);
}(document));</script>

<header class="row header">
	<?php
		$cabecera = new WP_Query( array(
			'post_type' => 'cabecera',
			'post_status' => 'publish',
			'orderby' => 'rand',
			'posts_per_page' => 1
		));

		if ( $cabecera->have_posts() ) {
			$cabecera->the_post();
			$bgSrc = wp_get_attachment_url( get_post_thumbnail_id(), 'full');
			$title = get_the_title();
		}else{
			$bgSrc= '';
		}

		wp_reset_postdata();

	?>
	<div class="header-image" style="background-image: url(<?php echo $bgSrc; ?>)">
		<div id="ci_social_widget-2" class="widget_ci_social_widget widget group">
			<div class="widget-content">
				<a target="_blank" href="/feed/" title="">r</a><a target="_blank" href="https://twitter.com/concepto0" title="">t</a><a target="_blank" href="http://www.facebook.com/concepto0" title="">f</a><a target="_blank" href="http://www.youtube.com/conceptocerotv" title="">x</a><a target="_blank" href="https://soundcloud.com/conceptocero" title="">!</a>
			</div>
		</div>
		<div class="six columns socials-top">
		</div>
		<div class="six columns logo-container">
			<?php ci_e_logo('<h1>', '</h1>'); ?>
		</div>
	</div>
	<nav class="twelve columns navigation top-navigation">
		<?php
			if(has_nav_menu('ci_main_menu'))
				wp_nav_menu( array(
					'theme_location' 	=> 'ci_main_menu',
					'fallback_cb' 		=> '',
					'container' 		=> '',
					'menu_id' 			=> '',
					'menu_class' 		=> 'nav sf-menu'
				));
			else
				wp_page_menu();
		?>
	</nav>

</header><!-- /header -->
