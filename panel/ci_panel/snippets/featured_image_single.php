<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	
	if( !function_exists('ci_cpt_with_featured_image') ):
	function ci_cpt_with_featured_image()
	{
		return apply_filters('ci_featured_image_post_types', array('post', 'page'));
	}
	endif;


	if( !function_exists('ci_the_post_thumbnail')):
	function ci_the_post_thumbnail($attr = '' ) {
		$post_type = get_post_type();
		if(ci_setting('featured_single_'.$post_type.'_show')=='enabled')
		{
			if(isset($attr['class']))
				$attr['class'] = $attr['class'].' '.ci_setting('featured_single_align').' ';
			else
				$attr['class'] = ci_setting('featured_single_align');
			
			the_post_thumbnail('ci_featured_single', $attr);
		}
	}
	endif;


	$img_cpt = ci_cpt_with_featured_image();
	foreach($img_cpt as $post_type)
	{
		$ci_defaults['featured_single_'.$post_type.'_show'] = 'enabled';
	}

	$ci_defaults['featured_single_width']	= intval($content_width);
	$ci_defaults['featured_single_height']	= intval($content_width/2);
	$ci_defaults['featured_single_align']	= 'alignnone';

	add_image_size( 'ci_featured_single', ci_setting('featured_single_width'), ci_setting('featured_single_height'), true);

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide">
			<?php 
				echo sprintf(__('Control whether you want the featured image of each post to be displayed when viewing that post\'s page. The featured image can be shown/hidden on each individual post type, with common dimentions. You can define its width and height <em>(defaults to the content width, currently: %d pixels)</em>, and whether you want it aligned on the left, right or middle of the page.', 'acoustic'), $content_width); 
				echo " "; _e('Note that if you change the width and/or the height of the featured images, you will need to regenerate all your thumbnails using an appropriate plugin, such as the <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin, otherwise your images may appear distorted.', 'acoustic'); 
			?>
		</p>
		<?php
			$thumb_types = ci_cpt_with_featured_image();
			foreach($thumb_types as $post_type)
			{
				$obj = get_post_type_object($post_type);
				ci_panel_checkbox('featured_single_'.$post_type.'_show', 'enabled', sprintf(__('Show featured images on <em>%s</em>', 'acoustic'), $obj->labels->name));
			}
		?>
		<fieldset class="mt10">
			<?php ci_panel_input('featured_single_width', __('Featured image Width', 'acoustic')); ?>
			<?php ci_panel_input('featured_single_height', __('Featured image Height', 'acoustic')); ?>
			<?php 
				$align_options = array(
					'alignnone' => __('None', 'acoustic'),
					'alignleft' => __('Left', 'acoustic'),
					'aligncenter' => __('Center', 'acoustic'),
					'alignright' => __('Right', 'acoustic')
				);
				ci_panel_dropdown('featured_single_align', $align_options, __('Featured image alignment', 'acoustic')); 
			?>
		</fieldset>
	</fieldset>
			
<?php endif; ?>