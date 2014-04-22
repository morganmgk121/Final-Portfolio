<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_site_options', 10);
	if( !function_exists('ci_add_tab_site_options') ):
		function ci_add_tab_site_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Site Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;

	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['layout'] = 'default';

	load_panel_snippet('logo');
	load_panel_snippet('favicon');
	load_panel_snippet('touch_favicon');
	load_panel_snippet('footer_text');

	add_filter('body_class', 'ci_body_layout_class_names');
	if( !function_exists('ci_body_layout_class_names')):
	function ci_body_layout_class_names($classes) {
		if(ci_setting('layout')=='alt')
			$classes[] = 'alt';

		return $classes;
	}	
	endif;

?>
<?php else: ?>

	<?php load_panel_snippet('logo'); ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Select the layout of the site. This affects every post/page/etc of the site.', 'ci_theme'); ?></p>
		<?php
			$options = array(
				'default' => __('Default - Centered', 'ci_theme'),
				'alt' => __('Alternative - Left aligned', 'ci_theme')
			);
			ci_panel_dropdown('layout', $options, __('Site layout', 'ci_theme'));
		?>
	</fieldset>

	<?php load_panel_snippet('favicon'); ?>

	<?php load_panel_snippet('touch_favicon'); ?>

	<?php load_panel_snippet('footer_text'); ?>

	<?php load_panel_snippet('sample_content'); ?>

<?php endif; ?>
