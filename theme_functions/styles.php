<?php
add_action('init', 'ci_register_theme_styles');
if( !function_exists('ci_register_theme_styles') ):
function ci_register_theme_styles()
{
  	//
	// Register all front-end styles here. There is no need to register them conditionally, as the enqueueing can be conditional.
	//
	wp_register_style('patua-one', 'http://fonts.googleapis.com/css?family=Patua+One');
	wp_register_style('normalize', get_template_directory_uri().'/css/normalize.css');
	wp_register_style('foundation', get_template_directory_uri().'/css/foundation.min.css');
	wp_register_style('flexslider', get_template_directory_uri().'/css/flexslider.css');
	wp_register_style('prettyphoto', get_template_directory_uri().'/css/prettyPhoto.css');

	wp_register_style('responsive-slides', get_template_directory_uri().'/js/ResponsiveSlides.js/responsiveslides.css');

	wp_register_style('ci-style', get_bloginfo('stylesheet_url'),
		array(
			'patua-one',
			'normalize',
			'foundation',
			'prettyphoto'
		), CI_THEME_VERSION, 'screen');
		
	wp_register_style('default', get_template_directory_uri().'/colors/'. ci_setting('ci_stylesheet') .'.css');	
	wp_register_style('cc', get_template_directory_uri().'/cc.css',array('default','responsive-slides'));	
}
endif;


add_action('wp_enqueue_scripts', 'ci_enqueue_theme_styles');
if( !function_exists('ci_enqueue_theme_styles') ):
function ci_enqueue_theme_styles()
{
	//
	// Enqueue all (or most) front-end styles here.
	//	
	wp_enqueue_style('ci-style');
	wp_enqueue_style('flexslider');	
	wp_enqueue_style('cc');
}
endif;

?>