<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_color_options', 20);
	if( !function_exists('ci_add_tab_color_options') ):
		function ci_add_tab_color_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Color Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['textured_bg'] = 'textured';

	load_panel_snippet('color_scheme');

	load_panel_snippet('custom_background');
	add_action('ci_custom_background', 'ci_custom_background_texture_handler', 20);
	// Extra handler for custom background texture.
	// We need to print some extra styles for the body.textured class
	// so we don't override the default action, we just hook another function.
	if( !function_exists('ci_custom_background_texture_handler')):
	function ci_custom_background_texture_handler($options)
	{
		echo apply_filters('ci_custom_background_texture_applied_element', 'body.textured');
		echo ' { ';
		if ($options['bg_image_disable']=='enabled') echo 'background-image: none;';
		if (!empty($options['bg_color'])) echo 'background-color: '.$options['bg_color'].';';
		echo ' } ';
	}
	endif;

	add_filter('body_class', 'ci_body_textured_class_names');
	if( !function_exists('ci_body_textured_class_names')):
	function ci_body_textured_class_names($classes) {
		if(ci_setting('textured_bg')=='textured')
			$classes[] = 'textured';

		return $classes;
	}	
	endif;
	
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide mt15"><?php _e('You can enable or disable the textured background of the sidebar.' , 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('textured_bg', 'textured', __('Enable textured background', 'ci_theme')); ?>
	</fieldset>

	<?php load_panel_snippet('color_scheme'); ?>

	<?php load_panel_snippet('custom_background'); ?>

<?php endif; ?>
