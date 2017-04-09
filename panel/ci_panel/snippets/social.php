<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	if( !function_exists('ci_social_services') ):
		function ci_social_services()
		{
			$services = array(
				'twitter' => 'Twitter', 
				'youtube' => 'YouTube', 
				'myspace' => 'MySpace', 
				'facebook' => 'Facebook', 
				'gplus' => 'Google+', 
				'lnkdin' => 'LinkedIn', 
				'pinterest' => 'Pinterest', 
				'flickr' => 'Flickr', 
				'wordpress' => 'WordPress.com', 
				'dribbble' => 'Dribbble',
				'picasa' => 'Picasa',
				'soundcloud' => 'SoundCloud'
			);
			return $services;
		}
	endif;

	$ci_defaults['social_rss_show'] 		= 'enabled';
	$ci_defaults['social_rss_text'] 		= __('Subscribe to our RSS feed.', 'acoustic');

	$ci_defaults['social_twitter_show'] 	= 'enabled';
	$ci_defaults['social_twitter_url'] 		= 'http://twitter.com/cssigniter';
	$ci_defaults['social_twitter_text'] 	= __('Follow us on twitter.', 'acoustic');

	$ci_defaults['social_youtube_show'] 	= '';
	$ci_defaults['social_youtube_url'] 		= '';
	$ci_defaults['social_youtube_text']		= __('Check out our videos on YouTube.', 'acoustic');

	$ci_defaults['social_myspace_show'] 	= '';
	$ci_defaults['social_myspace_url'] 		= '';
	$ci_defaults['social_myspace_text']		= __('Listen to our music on MySpace.', 'acoustic');

	$ci_defaults['social_facebook_show']	= 'enabled';
	$ci_defaults['social_facebook_url'] 	= 'http://www.facebook.com/cssigniter';
	$ci_defaults['social_facebook_text']	= __('Like us on Facebook.', 'acoustic');

	$ci_defaults['social_gplus_show'] 		= '';
	$ci_defaults['social_gplus_url'] 		= '';
	$ci_defaults['social_gplus_text']		= __('Join our circle in Google+', 'acoustic');

	$ci_defaults['social_lnkdin_show'] 		= '';
	$ci_defaults['social_lnkdin_url'] 		= '';
	$ci_defaults['social_lnkdin_text']		= __('Let\'s meet in LinkedIn', 'acoustic');

	$ci_defaults['social_pinterest_show'] 	= '';
	$ci_defaults['social_pinterest_url'] 	= '';
	$ci_defaults['social_pinterest_text']	= __('See our pinboards on Pinterest', 'acoustic');

	$ci_defaults['social_flickr_show'] 		= '';
	$ci_defaults['social_flickr_url'] 		= '';
	$ci_defaults['social_flickr_text']		= __('See our photos on Flickr', 'acoustic');

	$ci_defaults['social_wordpress_show'] 	= '';
	$ci_defaults['social_wordpress_url'] 	= '';
	$ci_defaults['social_wordpress_text']	= __('Visit our Wordpress.com blog', 'acoustic');

	$ci_defaults['social_dribbble_show'] 	= 'enabled';
	$ci_defaults['social_dribbble_url'] 	= 'http://dribbble.com/Klou';
	$ci_defaults['social_dribbble_text']	= __('See our Dribbble shots.', 'acoustic');

	$ci_defaults['social_dribbble_show'] 	= 'enabled';
	$ci_defaults['social_dribbble_url'] 	= 'http://dribbble.com/Klou';
	$ci_defaults['social_dribbble_text']	= __('See our Dribbble shots.', 'acoustic');

	$ci_defaults['social_picasa_show'] 		= '';
	$ci_defaults['social_picasa_url'] 		= '';
	$ci_defaults['social_picasa_text']		= __('See our photos on Picasa.', 'acoustic');

	$ci_defaults['social_picasa_show'] 		= '';
	$ci_defaults['social_picasa_url'] 		= '';
	$ci_defaults['social_picasa_text']		= __('Follow me on SoundCloud', 'acoustic');

	$ci_defaults['social_new_window']		= 'disabled';

?>
<?php else: ?>
	<fieldset class="set">
		<p class="guide"><?php _e('Select wether you want to open the links in a new window or not', 'acoustic'); ?></p>
		<?php ci_panel_checkbox('social_new_window', 'enabled', __('Open links in new window', 'acoustic')); ?>

	</fieldset>
	
	
	<fieldset class="set">
		<p class="guide"><?php _e('Enter the URLs of your accounts on the following social media websites. The relevant icons will be displayed wherever you place the included -=CI SOCIAL=- widget. Unchecking and/or leaving an empty URL will hide the associated icon.' , 'acoustic'); ?></p>
		<fieldset>
			<fieldset>
				<?php $fieldname = 'social_rss_show'; ?>
				<input type="checkbox" class="check" id="<?php echo $fieldname; ?>" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="enabled" <?php checked($ci[$fieldname], 'enabled'); ?> />
				<label for="<?php echo $fieldname; ?>"><?php _e('Enable RSS icon', 'acoustic'); ?></label>	
			</fieldset>
			<fieldset>
				<?php $fieldname = 'social_rss_text'; ?>
				<label for="<?php echo $fieldname; ?>"><?php _e('RSS Text', 'acoustic'); ?></label>
				<input id="<?php echo $fieldname; ?>" type="text" size="60" name="<?php echo THEME_OPTIONS.'['.$fieldname.']'; ?>" value="<?php echo esc_attr($ci[$fieldname]); ?>" />
			</fieldset>
		</fieldset>
		<?php $services = ci_social_services(); ?>
		<?php foreach($services as $key => $value): ?>
			<?php
				$field_show = 'social_'.$key.'_show';
				$field_url = 'social_'.$key.'_url';
				$field_text = 'social_'.$key.'_text';
			?>
			<fieldset class="social-set">
				<fieldset>					
					<input type="checkbox" class="check" id="<?php echo esc_attr($field_show); ?>" name="<?php echo THEME_OPTIONS; ?>[<?php echo esc_attr($field_show); ?>]" value="enabled" <?php checked($ci[$field_show], 'enabled'); ?> />
					<label for="<?php echo $field_show; ?>"><?php echo sprintf(__('Enable %s icon','acoustic'), $value); ?></label>	
				</fieldset>
				<fieldset>
					<label for="<?php echo esc_attr($field_url); ?>"><?php echo sprintf(__('%s URL','acoustic'), $value); ?></label>
					<input id="<?php echo esc_attr($field_url); ?>" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[<?php echo esc_attr($field_url); ?>]" value="<?php echo esc_attr($ci[$field_url]); ?>" />
				</fieldset>
				<fieldset>
					<label for="<?php echo esc_attr($field_text); ?>"><?php echo sprintf(__('%s Text','acoustic'), $value); ?></label>
					<input id="<?php echo esc_attr($field_text); ?>" type="text" size="60" name="<?php echo THEME_OPTIONS; ?>[<?php echo esc_attr($field_text); ?>]" value="<?php echo esc_attr($ci[$field_text]); ?>" />
				</fieldset>
			</fieldset>
		<?php endforeach; ?>
	</fieldset>

<?php endif; ?>