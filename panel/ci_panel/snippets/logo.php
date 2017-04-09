<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php

	$ci_defaults['logo'] = '';

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Upload your logo here. It will replace the textual logo (site name) on the header.', 'acoustic'); ?></p>
		<?php ci_panel_upload_image('logo', __('Upload your logo', 'acoustic')); ?>
	</fieldset>

<?php endif; ?>