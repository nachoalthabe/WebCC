<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_color_options', 40);
	if( !function_exists('ci_add_tab_color_options') ):
		function ci_add_tab_color_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Color Options', 'acoustic'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	
	$ci_defaults['ci_stylesheet'] = 'default';
	
	load_panel_snippet('custom_background');

?>
<?php else: ?>

		<fieldset class="set">
			<p class="guide"><?php _e('Select your color scheme', 'acoustic'); ?></p>
			<fieldset>
				<?php
					$options = array(
						'aglet'			=> __('Aglet', 'acoustic'),
						'apple'			=> __('Apple', 'acoustic'),
						'aqua'			=> __('Aqua', 'acoustic'),
						'blush'			=> __('Blush', 'acoustic'),
						'default'		=> __('Default', 'acoustic'),
						'cielo_light'	=> __('Cielo Light', 'acoustic'),
						'cloudy_purple'	=> __('Cloudy Purple', 'acoustic'),
						'dalifa'		=> __('Dalifa', 'acoustic'),
						'dress'			=> __('Dress', 'acoustic'),
						'easter_pink'	=> __('Easter Pink', 'acoustic'),
						'koala'			=> __('Koala', 'acoustic'),
						'light_blue'	=> __('Light Blue', 'acoustic'),
						'lovely'		=> __('Lovely', 'acoustic'),
						'marsh'			=> __('Marsh', 'acoustic'),
						'metro'			=> __('Metro', 'acoustic'),
						'mint'			=> __('Mint', 'acoustic'),
						'orange'		=> __('Orange', 'acoustic'),
						'pondwater'		=> __('Pond Water', 'acoustic'),
						'rayne'			=> __('Rayne', 'acoustic'),
						'red'			=> __('Red', 'acoustic'),
						'rose_pink'		=> __('Rose Pink', 'acoustic'),
						'shamrock'		=> __('Shamrock', 'acoustic'),
						'tree_topper'	=> __('Tree Topper', 'acoustic'),
						'wood'			=> __('Wood #1', 'acoustic'),
					);
					ci_panel_dropdown('ci_stylesheet', $options, __('Default', 'acoustic')); 
				?>
			</fieldset>
		</fieldset>

	<?php load_panel_snippet('custom_background'); ?>

<?php endif; ?>