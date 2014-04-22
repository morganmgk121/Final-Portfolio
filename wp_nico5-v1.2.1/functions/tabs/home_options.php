<?php global $ci, $ci_defaults, $load_defaults; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_homepage_options', 30);
	if( !function_exists('ci_add_tab_homepage_options') ):
		function ci_add_tab_homepage_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Homepage Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['portfolio_cols']	= '3';
	$ci_defaults['home_portfolio_num']	= 5;

	if( !function_exists('ci_get_columns_class') ):
	function ci_get_columns_class()
	{
		global $ci;
		switch($ci['portfolio_cols']){
			case 2: return 'two-col';
			case 3: return 'three-col';
			case 4: return 'four-col';
			default: return 'three-col';
		}
	}
	endif;
	
	if( !function_exists('ci_get_columns_thumb') ):
	function ci_get_columns_thumb()
	{
		global $ci;
		switch($ci['portfolio_cols']){
			case 2: return 'two_col_thumb';
			case 3: return 'three_col_thumb';
			case 4: return 'four_col_thumb';
			default: return 'three_col_thumb';
		}
	}
	endif;

?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Control how many columns the portfolio area should be divided into. This applies both to the homepage and the <strong>Portfolio Listing</strong> template.', 'ci_theme'); ?></p>
		<fieldset class="mb5">
			<?php
				$columns = $ci['portfolio_cols'];
				$options = array(
					'2' => __('2', 'ci_theme'),
					'3' => __('3 (Default)', 'ci_theme'),
					'4' => __('4', 'ci_theme'),
				);
				ci_panel_dropdown('portfolio_cols', $options, __('Number of columns', 'ci_theme'));
			?>
		</fieldset>
	</fieldset>

	<fieldset class="set">
		<p class="guide"><?php _e('This option controls the maximum number of portfolio items shown on the front page, in a "most recent" fashion. For example, if you set this value to 5, and have 20 portfolio items of which 10 have the <strong>Show this portfolio item on the homepage</strong> option set, then only the 5 most recent items out of those 10 will be shown.', 'ci_theme'); ?></p>
		<?php ci_panel_input('home_portfolio_num', __('Maximum portfolio items on homepage', 'ci_theme')); ?>
	</fieldset>

<?php endif; ?>
