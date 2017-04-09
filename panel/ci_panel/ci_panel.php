<?php
if(!defined('CI_PANEL_TABS_DIR')) define('CI_PANEL_TABS_DIR', 'theme_tabs');

// Load our default options.
load_ci_defaults();

add_action('admin_init','ci_register_admin_scripts');
function ci_register_admin_scripts() 
{
	wp_register_script('ci-colorpicker', get_template_directory_uri().'/panel/ci_panel/scripts/colorpicker/js/colorpicker.js', array('jquery'));
	wp_register_style('ci-colorpicker', get_template_directory_uri().'/panel/ci_panel/scripts/colorpicker/css/colorpicker.css');

	wp_register_script('ci-panel', get_template_directory_uri().'/panel/ci_panel/scripts/panelscripts.js', array('jquery'));
	wp_register_style('ci-panel-css', get_template_directory_uri().'/panel/ci_panel/panel.css');
}

add_action('admin_enqueue_scripts','ci_enqueue_admin_scripts');
function ci_enqueue_admin_scripts() 
{
	global $pagenow;

	//
	// Enqueue here scripts and styles that are to be loaded on all admin pages.
	//


	if(is_admin() and $pagenow=='themes.php' and isset($_GET['page']) and $_GET['page']=='ci_panel.php')
	{
		//
		// Enqueue here scripts and styles that are to be loaded only on CSSIgniter Settings panel.
		//
		wp_enqueue_script('media-upload');

		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		wp_enqueue_script('ci-colorpicker');
		wp_enqueue_style('ci-colorpicker');

		wp_enqueue_script('ci-panel');
		wp_enqueue_style('ci-panel-css');
	}
}




add_action('admin_menu', 'ci_create_menu');
function ci_create_menu() {
	add_action( 'admin_init', 'ci_register_settings' );

	// Handle reset before anything is outputed in the browser.
	// This is here because it needs the settings to be registered, but because it
	// redirects, it should be called before the ci_settings_page.
	global $pagenow;
	if (is_admin() and isset($_POST['reset']) and ($pagenow == "themes.php") )
	{
		delete_option(THEME_OPTIONS);
		global $ci;
		$ci=array();
		ci_default_options(true);
		wp_redirect( 'themes.php?page=ci_panel.php' );
	}

	add_theme_page(__('Theme Settings', 'acoustic'), __('Theme Settings', 'acoustic'), 'edit_theme_options', basename(__FILE__), 'ci_settings_page');
}

function ci_register_settings() {
	register_setting( 'ci-settings-group', THEME_OPTIONS, 'ci_options_validate');
}


function ci_settings_page() 
{ ?>
	<div class="wrap">
		<h2><?php echo sprintf(_x('%s Settings', 'theme name settings', 'acoustic'), CI_THEME_NICENAME); ?></h2>
	
		<?php $latest_version = ci_theme_update_check(); ?>
		<?php if(($latest_version != -1) and ($latest_version > CI_THEME_VERSION)): ?>
			<div id="theme-update">
				<?php echo sprintf( __('A theme update is available. The latest version is <b>%1$s</b> and you are running <b>%2$s</b>', 'acoustic'), $latest_version, CI_THEME_VERSION); ?>
			</div>
		<?php endif; ?>
	
		<div id="ci_panel">
			<form method="post" action="options.php" id="theform" enctype="multipart/form-data">
				<?php
					 settings_fields('ci-settings-group');
					 $theme_options = get_option(THEME_OPTIONS);
				?>
				<div id="ci_header">
					<?php if(!CI_WHITELABEL): ?>
						<img src="<?php echo get_child_or_parent_file_uri('/panel/ci_panel/img/logo.png'); ?>" />
					<?php endif; ?>
				</div>
	
				<?php if (isset($_POST['reset'])) { ?> <div class="resetbox"><?php _e('Settings reset!', 'acoustic'); ?></div> <?php } ?>
				<div class="success"></div>
	
				<div class="ci_save ci_save_top group">
					<input type="submit" class="button-primary save" value="<?php _e('Save Changes', 'acoustic') ?>" />
				</div>
	
				<div id="ci_main" class="group">
	
					<?php 
						// Each tab is responsible for adding itself to the list of the panel tabs.
						// The priority on add_filter() affects the order of the tabs.
						// Tab files are automatically loaded for initialization by the function load_ci_defaults().
						// Child themes have a chance to load their tabs (or unload the parent theme's tabs) only after
						// the parent theme has initialized its tabs.
						$paneltabs = apply_filters( 'ci_panel_tabs', array() ); 
					?>
	
					<div id="ci_sidebar">
						<ul>
							<?php $tabNum = 1; ?>
							<?php foreach($paneltabs as $name => $title): ?>
								<?php if ($tabNum==1) $firstclass = 'class="active"'; else $firstclass = ''; ?>
								<li id="<?php echo $name; ?>"><a href="#tab<?php echo $tabNum; ?>" rel="tab<?php echo $tabNum; ?>" <?php echo $firstclass; ?>><span><?php echo $title ?></span></a></li>
								<?php $tabNum++; ?>
							<?php endforeach; ?>
						</ul>
					</div><!-- /sidebar -->
	
					<div id="ci_options">
						<?php $tabNum = 1; ?>
						<?php foreach($paneltabs as $name => $title): ?>
							<?php if ($tabNum==1) $firstclass='one'; else $firstclass=''; ?>
							<div id="tab<?php echo $tabNum; ?>" class="tab <?php echo $firstclass?>"><?php get_template_part(CI_PANEL_TABS_DIR.'/'.$name); ?></div>
							<?php $tabNum++; ?>
						<?php endforeach; ?>
					</div><!-- #ci_options -->
	
				</div><!-- #ci_main -->
				<div class="ci_save group"><input type="submit" class="button-primary save" value="<?php _e('Save Changes', 'acoustic'); ?>" /></div>
			</form>
		</div><!-- #ci_panel -->
	
		<div id="ci-reset-box">
			<form method="post" action="">
				<input type="hidden" name="reset" value="reset" />
				<input type="submit" class="button" value="<?php _e('Reset Settings', 'acoustic') ?>" onclick="return confirm('<?php _e('Are you sure? All settings will be lost!', 'acoustic'); ?>'); " />
			</form>
		</div>
	</div><!-- wrap -->
	<?php 
}



function ci_options_validate($set)
{
	$set = (array)$set;
	foreach ($set as &$item)
	{
		if (is_string($item)){
			$item = htmlentities($item,ENT_COMPAT,'UTF-8',false);
		}
	}

	return $set;
}



function load_ci_defaults()
{
	global $load_defaults, $ci, $ci_defaults;
	$load_defaults = TRUE;

	// All php files in CI_PANEL_TABS_DIR are loaded by default.
	// Those files (tabs) are responsible for adding themselves on the actual tabs that will be show,
	// by hooking on the 'ci_panel_tabs' filter.
	$paths = array();
	$paths[] = get_template_directory();
	if( is_child_theme() ) {
		$paths[] = get_stylesheet_directory();
	}

	foreach($paths as $path)
	{
		$path .= '/' . CI_PANEL_TABS_DIR;
	
		if (file_exists($path) and $handle = opendir($path)) {
		    while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
		        	$file_info = pathinfo($path.'/'.$file);
		        	if(isset($file_info['extension']) and $file_info['extension']=='php') {						        	
		        		get_template_part( CI_PANEL_TABS_DIR . '/' . basename( $file, '.php' ) );
		        	}
		        }
		    }
			closedir($handle);
		}
	}

	$load_defaults = FALSE;

	$ci_defaults = apply_filters('ci_defaults', $ci_defaults);
}

function load_panel_snippet( $slug, $name = null )
{
	$slug = 'panel/ci_panel/snippets/' . $slug;
	
	do_action( "get_template_part_{$slug}", $slug, $name );

	$templates = array();
	if ( isset($name) )
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";

	locate_template($templates, true, false);
}

//
//
// CSSIgniter panel control generators
//
//
function ci_panel_textarea($fieldname, $label)
{
	global $ci;
	?>
	<label for="<?php echo $fieldname; ?>"><?php echo $label; ?></label>
	<textarea id="<?php echo $fieldname; ?>" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" rows="5"><?php echo esc_textarea($ci[$fieldname]); ?></textarea>
	<?php
}

function ci_panel_input($fieldname, $label)
{
	global $ci;
	?>
	<label for="<?php echo $fieldname; ?>"><?php echo $label; ?></label>
	<input id="<?php echo $fieldname; ?>" type="text" size="60" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="<?php echo esc_attr($ci[$fieldname]); ?>" />
	<?php
}

// $fieldname is the actual name="" attribute common to all radios in the group.
// $optionname is the id of the radio, so that the label can be associated with it.
function ci_panel_radio($fieldname, $optionname, $optionval, $label)
{
	global $ci;
	?>
	<input type="radio" class="radio" id="<?php echo $optionname; ?>" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="<?php echo $optionval; ?>" <?php checked($ci[$fieldname], $optionval); ?> />
	<label for="<?php echo $optionname; ?>" class="radio"><?php echo $label; ?></label>
	<?php
}

function ci_panel_checkbox($fieldname, $value, $label)
{
	global $ci;
	?>
	<input type="checkbox" id="<?php echo $fieldname; ?>" class="check" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="<?php echo $value; ?>" <?php checked($ci[$fieldname], $value); ?> />
	<label for="<?php echo $fieldname; ?>"><?php echo $label; ?></label>
	<?php
}

function ci_panel_upload_image($fieldname, $label)
{
	global $ci;
	?>
	<label for="<?php echo $fieldname; ?>"><?php echo $label; ?></label>
	<input id="<?php echo $fieldname; ?>" type="text" size="60" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="<?php echo esc_attr($ci[$fieldname]); ?>" class="uploaded" />
	<input type="submit" class="ci-upload button" value="<?php _e('Upload image', 'acoustic'); ?>" />
	<div class="up-preview"><?php echo (isset($ci[$fieldname]) ? '<img src="'.esc_attr($ci[$fieldname]).'" />' : '' );  ?></div>
	<?php
}

function ci_panel_dropdown($fieldname, $options, $label)
{
	global $ci;
	$options = (array)$options;
	?>
	<label for="<?php echo $fieldname; ?>"><?php echo $label; ?></label>
	<select id="<?php echo $fieldname; ?>" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>">
		<?php foreach($options as $opt_val => $opt_label): ?>
			<option value="<?php echo $opt_val; ?>" <?php selected($ci[$fieldname], $opt_val); ?>><?php echo $opt_label; ?></option>
		<?php endforeach; ?>
	</select>
	<?php
}
?>