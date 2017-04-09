<?php

	// Get vital theme files.
	get_template_part('panel/functions/development');
	get_template_part('panel/functions/generic');
	get_template_part('panel/functions/widgets');
	get_template_part('theme_functions/nav_menus');
	get_template_part('theme_functions/comments');
	get_template_part('theme_functions/sidebars');
	get_template_part('theme_functions/scripts');
	get_template_part('theme_functions/styles');
	get_template_part('theme_functions/post_types');
	get_template_part('theme_functions/template_hooks');
	get_template_part('panel/ci_panel/ci_panel');


	// Handle Feeds.
	ci_register_custom_feed();


	
	//
	// Don't move this function.
	// Writes defaults or initialises the theme options' array.
	//
	if( !function_exists('ci_default_options') ):
	function ci_default_options($assign_defaults=false)
	{
		global $ci, $ci_defaults;
		
		if ($assign_defaults==true)
		{
			$ci = wp_parse_args($ci, $ci_defaults);
			update_option(THEME_OPTIONS, $ci);
		}
		else
		{
			// If there are unset options, just set them to empty string to avoid warnings, such as, index not found.
			foreach ($ci_defaults as $name=>$value)
			{
				if(!isset($ci[$name]))
					$ci[$name]='';
			}
		}
		
	}
	endif;


	//
	// If just activated, save default theme options and go to our options page.
	//
	global $pagenow; 
	if ( is_admin() and isset($_GET['activated'] ) and $pagenow == "themes.php" )
	{
		ci_default_options(true);
		wp_redirect( 'themes.php?page=ci_panel.php' );
	}

	//
	// Make sure the theme options array has no undefined options.
	//
	add_action('after_setup_theme', 'ci_default_fields_set');
	if( !function_exists('ci_default_fields_set') ):
	function ci_default_fields_set() 
	{ 
		ci_default_options(false); 
	}
	endif;


?>