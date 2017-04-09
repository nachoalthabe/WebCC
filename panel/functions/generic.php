<?php
//
// Domain for translations must be 'acoustic'
//


if( !function_exists('ci_human_time_diff')):
function ci_human_time_diff($from, $to = '')
{
	if ( empty($to) )
		$to = time();
	$diff = (int) abs($to - $from);
	if ($diff < 60) {
		$since = __('Less than a minute ago', 'acoustic');
	} else if ($diff <= 3600) {
		$mins = round($diff / 60);
		if ($mins <= 1) {
			$mins = 1;
		}
		/* translators: min=minute */
		$since = sprintf(_n('%s minute ago', '%s minutes ago', $mins, 'acoustic'), $mins);
	} else if (($diff <= 86400) && ($diff > 3600)) {
		$hours = round($diff / 3600);
		if ($hours <= 1) {
			$hours = 1;
		}
		$since = sprintf(_n('%s hour ago', '%s hours ago', $hours, 'acoustic'), $hours);
	} elseif ($diff >= 86400) {
		$days = round($diff / 86400);
		if ($days <= 1) {
			$days = 1;
		}
		$since = sprintf(_n('%s day ago', '%s days ago', $days, 'acoustic'), $days);
	} elseif ($diff >= (60*60*24*30)) {
		$months = round($diff / (60*60*24*30));
		if ($months <= 1) {
			$months = 1;
		}
		$since = sprintf(_n('%s month ago', '%s months ago', $months, 'acoustic'), $months);
	}
	return $since;
	
}
endif;


if( !function_exists('get_child_or_parent_file_uri')):
function get_child_or_parent_file_uri($path)
{
	if(file_exists(get_stylesheet_directory().$path))
		return get_stylesheet_directory_uri().$path;
	else
		return get_template_directory_uri().$path;
}
endif;

if( !function_exists('ci_column_classes')):
function ci_column_classes($cols_number, $reset=false)
{
	static $i = 1;
	
	if($reset===true) {
		$i = 1;
		return;
	}
	
	$cols = array(
		2 => 'eight',
		3 => 'one-third',
		4 => 'four'
	);
	
	if(!isset($cols[$cols_number]))
		$classes = $cols[2].' ';
	else
		$classes = $cols[$cols_number].' ';
		
	if($i == 1) $classes .= 'alpha';
	if($i == $cols_number) $classes .= 'omega';

	$i++;

	return $classes;
}
endif;



/**
 * Returns an associative array of theme-dependend strings, that can be used as class names.
 * 
 * @access public
 * @return array
 */
if( !function_exists('ci_theme_classes')):
function ci_theme_classes()
{
	$version = str_replace('.', '-', CI_THEME_VERSION);
	$classes['theme'] = "ci-" . CI_THEME_NAME;
	$classes['theme_version'] = "ci-" . CI_THEME_NAME . '-' . $version;
	return $classes;	
}
endif;

add_filter('body_class','ci_body_class_names');
if( !function_exists('ci_body_class_names')):
function ci_body_class_names($classes) {
	$ci_classes = ci_theme_classes();
	return array_merge($classes, $ci_classes);
}	
endif;


/**
 * Echoes the content or the excerpt, depending on user preferences.
 * 
 * @access public
 * @return void
 */
if( !function_exists('ci_e_content')):
function ci_e_content($more_link_text = null, $stripteaser = false)
{
	global $post, $ci;
	if (is_single() or is_page())
		the_content(); 
	else
	{
		if(ci_setting('preview_content')=='enabled')
		{
			the_content($more_link_text, $stripteaser);
		}
		else
		{
			the_excerpt();
		}
	}
}
endif;

/**
 * Returns a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is returned.
 * When $num equals one, string $one is returned.
 * When $num is greater than one, string $many is returned.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return string
 */
if( !function_exists('ci_inflect')):
function ci_inflect($num, $none, $one, $many){
	if ($num==0)
		return $none;
	if ($num==1)
		return $one;
	if ($num>1)
		return $many;
}
endif;

/**
 * Echoes a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is echoed.
 * When $num equals one, string $one is echoed.
 * When $num is greater than one, string $many is echoed.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return void
 */
if( !function_exists('ci_e_inflect')):
function ci_e_inflect($num, $none, $one, $many){
	echo ci_inflect($num, $none, $one, $many);
}
endif;


/**
 * Returns a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return string
 */
if( !function_exists('ci_list_cat_tag_tax')):
function ci_list_cat_tag_tax($separator=', ')
{
	global $post;

	$taxonomies = get_post_taxonomies();

	$i = 0;
	$the_terms = array();
	$the_terms_temp = array();
	$the_terms_list = '';
	foreach($taxonomies as $taxonomy)
	{
		$the_terms_temp[] = get_the_term_list($post->ID, $taxonomy, '', $separator, '');
	}

	foreach($the_terms_temp as $term)
	{
		if(!empty($term))
			$the_terms[] = $term;
	}
	
	$terms_count = count($the_terms);
	for($i=0; $i < $terms_count; $i++)
	{
		$the_terms_list .= $the_terms[$i];
		if ($i < ($terms_count-1))
			$the_terms_list .= $separator;
	}
	
	if (!empty($the_terms_list))
		return $the_terms_list;	
	else
		return __('Uncategorized', 'acoustic');
}
endif;

/**
 * Echoes a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return void
 */
if( !function_exists('ci_e_list_cat_tag_tax')):
function ci_e_list_cat_tag_tax($separator=', ')
{
	echo ci_list_cat_tag_tax($separator);
}
endif;



/**
 * Echoes pagination links if applicable. If wp_pagenavi plugin exists, it uses it instead.
 * 
 * @access public
 * @return void. 
 */
if( !function_exists('ci_pagination')):
function ci_pagination($args=array())
{ 
	$defaults = array(
		'container_id' => 'paging',
		'container_class' => 'navigation group',
		'prev_link_class' => 'nav-prev alignleft shadow',
		'next_link_class' => 'nav-next alignright shadow',
	);
	$args = wp_parse_args( $args, $defaults );
	
	global $wp_query;
	if ($wp_query->max_num_pages > 1): ?>
		<div 
			<?php echo (empty($args['container_id']) ? '' : 'id="'.$args['container_id'].'"'); ?> 
			<?php echo (empty($args['container_class']) ? '' : 'class="'.$args['container_class'].'"'); ?>
		>
			<?php if (function_exists('wp_pagenavi')): ?>
				<?php wp_pagenavi(); ?>
			<?php else: ?>
				<div <?php echo (empty($args['prev_link_class']) ? '' : 'class="'.$args['prev_link_class'].'"'); ?>><?php next_posts_link( '< Pasados' ); ?></div>
				<div <?php echo (empty($args['next_link_class']) ? '' : 'class="'.$args['next_link_class'].'"'); ?>><?php previous_posts_link( 'Nuevos >' ); ?></div>
			<?php endif; ?>
		</div>
	<?php endif;
}
endif;


/**
 * Echoes a CSSIgniter setting.
 * 
 * @access public
 * @param string $setting
 * @return void
 */
if( !function_exists('ci_e_setting')):
function ci_e_setting($setting)
{
	echo ci_setting($setting);
}
endif;

/**
 * Returns a CSSIgniter setting, or boolean FALSE on failure.
 * 
 * @access public
 * @param string $setting
 * @return string|false
 */
if( !function_exists('ci_setting')):
function ci_setting($setting)
{
	global $ci;
	if (isset($ci[$setting]) and (!empty($ci[$setting])))
		return $ci[$setting];
	else
		return FALSE;
}
endif;


/**
 * Returns the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
if( !function_exists('ci_logo')):
function ci_logo($before="", $after=""){ 
	$snippet = $before;
		
    $snippet .= '<a href="'.home_url().'">';

    if(ci_setting('logo')){
		$snippet .= '<img src="'.ci_setting('logo').'" alt="'.get_bloginfo('name').'" />';
	} 
	else{
		$snippet .= get_bloginfo('name');
	}

    $snippet .= '</a>';
    
    $snippet .= $after;

    return $snippet;
}
endif;

/**
 * Echoes the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
if( !function_exists('ci_e_logo')):
function ci_e_logo($before="", $after=""){ 
	echo ci_logo($before, $after);
}
endif;


/**
 * Returns the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, false is returned.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
if( !function_exists('ci_slogan')):
function ci_slogan($before="", $after=""){ 
	$slogan = get_bloginfo('description');
	$snippet = $before.$slogan.$after;
	if (!empty($slogan))
		return $snippet;
	else
		return FALSE;
}
endif;

/**
 * Echoes the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, nothing is echoed.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
if( !function_exists('ci_e_slogan')):
function ci_e_slogan($before="", $after=""){ 
	$slogan = ci_slogan($before, $after);
	if ($slogan) echo $slogan;
}
endif;

if( !function_exists('logo_class')):
function logo_class() {
	echo get_logo_class();
}
endif;

if( !function_exists('get_logo_class')):
function get_logo_class() {
	return ci_setting('logo') != '' ? 'imglogo' : 'textual';
}
endif;


/**
 * Returns the date and time of the last posted post.
 * 
 * @access public
 * @return array
 */
if( !function_exists('ci_last_update')):
function ci_last_update()
{
	global $post;
	$data = array();
	$posts = get_posts('posts_per_page=1&order=DESC&orderby=date');
	foreach ($posts as $post)
	{
		setup_postdata($post);	
		$data['date'] = get_the_date();
		$data['time'] = get_the_time();
	}
	return $data;
}
endif;


/**
 * Checks whether the current post has a Read More tag. Must be used inside the loop.
 * 
 * @access public
 * @return true|false
 */
if( !function_exists('has_readmore')):
function has_readmore()
{
	global $post;
	if(strpos(get_the_content(), "#more-")===FALSE)
		return FALSE;
	else
		return TRUE;
}
endif;

/**
 * Checks whether a page uses a specific page template.
 * 
 * @access public
 * @param string $page_template The page template you want to check if it's used.
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
if( !function_exists('has_page_template')):
function has_page_template($page_template, $pageid=null)
{
	$template = get_template_of_page($pageid);
	if($template == $page_template)
	{
		return TRUE;
	}
	return FALSE;
}
endif;

/**
 * Returns the page template that is used on a specific page.
 * 
 * @access public
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
if( !function_exists('get_template_of_page')):
function get_template_of_page($pageid=null)
{
	if ($pageid===null)
	{
		global $post;
		$pageid = $post->ID;
	}
	return get_post_meta($pageid, '_wp_page_template', true);
}
endif;

if( !function_exists('ci_the_post_thumbnail')):
function ci_the_post_thumbnail($attr = '' ) {
	if(ci_setting('featured_single_show')=='enabled')
	{
		if(isset($attr['class']))
			$attr['class'] = $attr['class'].' '.ci_setting('featured_single_align').' ';
		else
			$attr['class'] = ci_setting('featured_single_align');
		
		the_post_thumbnail('ci_featured_single', $attr);
	}
}
endif;


/**
 * Formats a price (amount of money) with a currency symbol, according to the setting specified in the panel.
 * 
 * @access public
 * @param float $amount An amount of money to format.
 * @return string
 */
if( !function_exists('format_price')):
function format_price($amount, $return_empty=FALSE)
{
	$string = '';
	if($return_empty===FALSE and empty($amount))
	{
		return FALSE;
	}
	
	if(ci_setting('price_currency'))
	{
		if(ci_setting('currency_position')=='before')
		{
			return ci_setting('price_currency') . $amount;
		}
		else
		{
			return $amount . ci_setting('price_currency');
		}
	}
	else
	{
		return $amount;
	}
}
endif;



/**
 * Retrieve or display list of posts as a dropdown (select list).
 *
 * @since 2.1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @param string $name Optional. Name of the select box.
 *  * @return string HTML content, if not displaying.
 */
if( !function_exists('wp_dropdown_posts')):
function wp_dropdown_posts($args = '', $name='post_id') {
	$defaults = array(
		'depth' => 0, 
		'post_parent' => 0,
		'selected' => 0, 
		'echo' => 1,
		//'name' => 'page_id', // With this line, get_posts() doesn't work properly. 
		'id' => '',
		'show_option_none' => '', 'show_option_no_change' => '',
		'option_none_value' => '', 
		'post_type' => 'post', 'post_status' => 'publish'
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$pages = get_posts($r);
	$output = '';
	// Back-compat with old system where both id and name were based on $name argument
	if ( empty($id) )
		$id = $name;

	if ( ! empty($pages) ) {
		$output = "<select name='" . esc_attr( $name ) . "' id='" . esc_attr( $id ) . "'>\n";
		if ( $show_option_no_change )
			$output .= "\t<option value=\"-1\">$show_option_no_change</option>";
		if ( $show_option_none )
			$output .= "\t<option value=\"" . esc_attr($option_none_value) . "\">$show_option_none</option>\n";
		$output .= walk_page_dropdown_tree($pages, $depth, $r);
		$output .= "</select>\n";
	}

	$output = apply_filters('wp_dropdown_posts', $output);

	if ( $echo )
		echo $output;

	return $output;
}
endif;

/**
 * Determine if the WooCommerce plugin is enabled.
 *
 * @return bool True if enabled, false otherwise.
 */
if( !function_exists('woocommerce_enabled')):
function woocommerce_enabled()
{
	if(class_exists('Woocommerce'))
		return true;
	else
		return false;
}
endif;

/**
 * Multi-byte version of str_replace.
 *
 * @param string $needle The value being searched.
 * @param string $replacement The value that replaces the found needle.
 * @param string $haystack The string being searched and replaced on.
 * @return string
 */

if( !function_exists('mb_str_replace')):
function mb_str_replace($needle, $replacement, $haystack)
{
	return implode($replacement, mb_split($needle, $haystack));
}
endif;



if( !function_exists('ci_theme_update_check')):
function ci_theme_update_check()
{
/*
	if( CI_THEME_UPDATES === false ) return;
	
	$transient_name = CI_THEME_NAME.'_latest_version';
	
	delete_transient($transient_name);
	if( false === ( $latest_version = get_transient($transient_name) ) )
	{
		$themes_versions = @file_get_contents('http://www.cssigniter.com/theme_versions.json');

		if(empty($themes_versions)) {
			set_transient( $transient_name, -1, 60*60*24 );
			return -1;
		}
		
		$themes_versions = json_decode($themes_versions, true);

		$error = json_last_error();
		if($error !== JSON_ERROR_NONE) {
			set_transient( $transient_name, -1, 60*60*24 );
			return -1;
		}

		if(!isset($themes_versions[CI_THEME_NAME])) {
			set_transient( $transient_name, -1, 60*60*24 );
			return -1;
		}

		$latest_version = $themes_versions[CI_THEME_NAME];
		
		set_transient( $transient_name, $latest_version, 60*60*24 );
	}
	
	return $latest_version;
*/
}
endif;

?>