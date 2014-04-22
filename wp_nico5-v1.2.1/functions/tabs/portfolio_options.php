<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_portfolio_options', 50);
	if( !function_exists('ci_add_tab_portfolio_options') ):
		function ci_add_tab_portfolio_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Portfolio Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['portfolio_single_height']	= "0";
	$ci_defaults['show_related_portfolios']	= 'enabled';

	load_panel_snippet('slider_cycle_internal');

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('This option controls the height (in pixels) of the images appearing on the slider of each individual portfolio page. If you set this option to <strong>0</strong>, images will be resized proportionally. If you set it to any other integer number, the image will be automatically cropped to fit. In any case, the slider will be automatically resized to accommodate each image. Note that if you change the width and/or the height of the featured image, you will need to regenerate all your thumbnails using an appropriate plugin, such as the <a href="http://wordpress.org/extend/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin, otherwise your images may appear distorted.', 'ci_theme'); ?></p>
		<?php ci_panel_input('portfolio_single_height', __('Portfolio slider height', 'ci_theme')); ?>
	</fieldset>

	<?php load_panel_snippet('slider_cycle_internal'); ?>

	<fieldset class="set">
		<p class="guide"><?php _e('You can enable or disable the "Similar Work" section that appears on each portolio item\'s page, just below the content.' , 'ci_theme'); ?></p>
		<?php ci_panel_checkbox('show_related_portfolios', 'enabled', __('Show Similar Work', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>
