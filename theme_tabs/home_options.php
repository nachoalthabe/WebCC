<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_homepage_options', 20);
	if( !function_exists('ci_add_tab_homepage_options') ):
		function ci_add_tab_homepage_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Homepage Options', 'acoustic'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['slider_show']		= 'enabled';
	$ci_defaults['slider-no'] 		= '5';
	$ci_defaults['news-no'] 		= '5';
	$ci_defaults['news-cat'] 		= '';
	$ci_defaults['latest_media'] 	= 'enabled';
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Display Latest Media section?', 'acoustic'); ?></p>
		<?php ci_panel_checkbox('latest_media', 'enabled', __('Show Latest Media', 'acoustic')); ?>
	</fieldset>

	
	<fieldset class="set">
		<p class="guide"><?php _e('Control whether you want to display the slider on the homepage.', 'acoustic'); ?></p>
		<?php ci_panel_checkbox('slider_show', 'enabled', __('Show slider on homepage', 'acoustic')); ?>
	</fieldset>
	
	<fieldset class="set">
		<p class="guide"><?php _e('You can set the number of items that will be displayed in the slider.', 'acoustic'); ?></p>
		<?php ci_panel_input('slider-no', __('Number of items on slider', 'acoustic')); ?>
	</fieldset>
	
	<fieldset class="set">
		<p class="guide"><?php _e('You can set the number of items that will be displayed in the news section.', 'acoustic'); ?></p>
		<?php ci_panel_input('news-no', __('Number of items on news section', 'acoustic')); ?>
	</fieldset>
	
	<fieldset class="set">
		<p class="guide"><?php _e('Include the following categories from the homepage news. Enter the category IDs seperated by comma like this 4,5,8,10.', 'acoustic'); ?></p>
		<?php ci_panel_input('news-cat', __('Categories IDs', 'acoustic')); ?>
	</fieldset>
	
<?php endif; ?>