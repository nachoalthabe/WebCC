<?php
add_action('init', 'ci_register_theme_scripts');
if( !function_exists('ci_register_theme_scripts') ):
function ci_register_theme_scripts()
{
	//
	// Register all front-end scripts here. There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	
	wp_register_script('jwplayer', get_template_directory_uri().'/jwplayer/jwplayer.js','',false,false);
	wp_register_script('google-maps', 'http://maps.googleapis.com/maps/api/js?v=3.5&sensor=false');
	wp_register_script('jquery-superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), false, false);
	wp_register_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false, false);
	wp_register_script('jquery-equal', get_template_directory_uri().'/js/jquery.equalHeights.js', array('jquery'), false, false);
	wp_register_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.js', array('jquery'), false, false);
	wp_register_script('jquery-prettyphoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), false, false);

	wp_register_script('google-maps', 'http://maps.googleapis.com/maps/api/js?v=3.5&sensor=false');
	wp_register_script('responsive-slides', get_template_directory_uri().'/js/ResponsiveSlides.js/responsiveslides.min.js', array('jquery'), false, false);
	wp_register_script('soundmanager', get_template_directory_uri().'/js/soundmanagerv297a-20130101/script/soundmanager2-jsmin.js', array('jquery'), false, false);
	wp_register_script('discos', get_template_directory_uri().'/js/discos.js', array('soundmanager'), false, false);
	wp_register_script('slides', get_template_directory_uri().'/js/slides.js', array('jquery'), false, false);
	wp_register_script('contacto', get_template_directory_uri().'/js/contacto.js', array('jquery'), false, false);
	wp_register_script('evento', get_template_directory_uri().'/js/evento.js', array('jquery'), false, false);
	wp_register_script('sharrre', get_template_directory_uri().'/js/sharrre/jquery.sharrre-1.3.4.min.js', array('jquery'), false, false);

	wp_register_script('ci-front-scripts', get_template_directory_uri().'/js/scripts.js',
		array(
			'jquery',
			'jquery-superfish',
			'jquery-flexslider',
			'jquery-equal',
			'jquery-fitvids',
			'jquery-prettyphoto',
			'responsive-slides',
			'soundmanager',
			'discos',
			'slides',
			'contacto',
			'evento',
			'google-maps',
			'sharrre'
		),
		false, false);
	
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.js');		
}
endif;

add_action('wp_enqueue_scripts', 'ci_enqueue_theme_scripts');
if( !function_exists('ci_enqueue_theme_scripts') ):
function ci_enqueue_theme_scripts()
{
	//
	// Enqueue all (or most) front-end scripts here.
	// They can be also enqueued from within template files.
	//	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	if (ci_setting('jwplayer_active') == 'enabled') 
		wp_enqueue_script('jwplayer');

	wp_enqueue_script('ci-front-scripts');

	$params['theme_url'] = get_template_directory_uri();
	wp_localize_script('ci-front-scripts', 'ThemeOption', $params);

	wp_enqueue_script('modernizr');
	wp_enqueue_script('google-maps');

}
endif;

?>