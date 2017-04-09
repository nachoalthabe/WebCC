<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_social_options', 50);
	if( !function_exists('ci_add_tab_social_options') ):
		function ci_add_tab_social_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Social Options', 'acoustic'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	load_panel_snippet('social');


?>
<?php else: ?>

	<?php load_panel_snippet('social'); ?>
	
<?php endif; ?>