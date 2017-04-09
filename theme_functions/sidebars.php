<?php
add_action( 'widgets_init', 'ci_widgets_init' );
if( !function_exists('ci_widgets_init') ):
function ci_widgets_init() {

	register_sidebar(array(
		'name' => __( 'Top Social Sidebar', 'acoustic'),
		'id' => 'top-social-sidebar',
		'description' => __( 'In this sidebar you can place only the CI Social widget', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Homepage sidebar #1', 'acoustic'),
		'id' => 'homepage-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #1', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));

	register_sidebar(array(
		'name' => __( 'Homepage sidebar #2', 'acoustic'),
		'id' => 'homepage-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your homepage sidebar #2', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Pages Sidebar', 'acoustic'),
		'id' => 'pages-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your pages', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Blog Sidebar', 'acoustic'),
		'id' => 'blog-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your blog sidebar', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));

	register_sidebar(array(
		'name' => __( 'Events Sidebar', 'acoustic'),
		'id' => 'events-sidebar',
		'description' => __( 'Place here the widgets that you want to display on your events sidebar', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Album Sidebar', 'acoustic'),
		'id' => 'album-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each album under the featured image', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Artist Sidebar', 'acoustic'),
		'id' => 'artist-sidebar',
		'description' => __( 'Place here the widgets that you want to display in the details page of each artist under the featured image', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
	
	register_sidebar(array(
		'name' => __( 'Footer sidebar #1', 'acoustic'),
		'id' => 'footer-sidebar-one',
		'description' => __( 'Place here the widgets that you want to display on your footer column #1', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #2', 'acoustic'),
		'id' => 'footer-sidebar-two',
		'description' => __( 'Place here the widgets that you want to display on your footer column #2', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #3', 'acoustic'),
		'id' => 'footer-sidebar-three',
		'description' => __( 'Place here the widgets that you want to display on your footer column #3', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));

	register_sidebar(array(
		'name' => __( 'Footer sidebar #4', 'acoustic'),
		'id' => 'footer-sidebar-four',
		'description' => __( 'Place here the widgets that you want to display on your footer column #4', 'acoustic'),
		'before_widget' => '<div id="%1$s" class="%2$s widget group">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-content">'
	));
											
}
endif;
?>