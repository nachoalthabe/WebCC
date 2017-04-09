<?php 
get_template_part('panel/functions/constants');

load_theme_textdomain( 'acoustic', get_template_directory() . '/lang' );

// This is the main options array. Can be accessed as a global in order to reduce function calls.
$ci = get_option(THEME_OPTIONS);
$ci_defaults = array();

// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
if ( ! isset( $content_width ) ) $content_width = 710;

//
// Let's bootstrap the theme.
//
get_template_part('panel/functions/bootstrap');
get_template_part('theme_functions/shortcodes');

//
// Define our various image sizes.
//
add_theme_support( 'post-thumbnails' );
add_image_size('ci_home_slider', 1210, 540, true);
add_image_size('ci_featured', 710, 450, true);
add_image_size('ci_width', 710, 9999, false);
add_image_size('ci_rectangle', 700, 700, true);
add_image_size('ci_page', 900, 400, true);
add_image_size('ci_fullwidth', 1210, 600, true);

//
// Columns helper
//
function ci_column_classes($cols_number, $reset=false) {
  static $i = 1;

  if($reset) {
    $i = 1;
    return;
  }

  $cols = array(
    2 => 'two',
    3 => 'three',
    4 => 'four',
    8 => 'eight'
  );

  $classes = $cols[$cols_number].' ';

  $i++;
  return $classes;
}

//
// Date helper
// Evidentemente toqueteado por quien redacta...
//
function themonth($m) {
  $MesesEspaniol = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
  $t = mktime(0, 0, 0, $m, 1, 2000);  
  $i = intval(date('m',$t));
  echo $MesesEspaniol[$i-1];
}

//
// Custom wp_page_menu classes
//
function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul id="nav" class="nav sf-menu">', $ulclass, 1);
}
add_filter('wp_page_menu','add_menuclass');
?>