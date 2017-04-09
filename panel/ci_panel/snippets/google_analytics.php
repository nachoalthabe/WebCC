<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['ga_code'] = '';

	add_action('wp_head', 'ci_output_google_analytics_code');
	if( !function_exists('ci_output_google_analytics_code') ):
		function ci_output_google_analytics_code()
		{
			// Load Google Analytics code, if available.
			if(ci_setting('ga_code'))
			{
				echo html_entity_decode(ci_setting('ga_code'));
			}
		}
	endif;
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Paste here your Google Analytics Code, as given by the Analytics website (including the <b>&lt;script&gt;</b> and <b>&lt;/script&gt;</b> tags), and it will be automatically included on every page.', 'acoustic'); ?></p>
		<?php ci_panel_textarea('ga_code', __('Google Analytics Code', 'acoustic') ); ?>
	</fieldset>

<?php endif; ?>