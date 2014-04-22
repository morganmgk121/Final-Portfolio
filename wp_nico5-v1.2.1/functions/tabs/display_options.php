<?php global $ci, $ci_defaults, $load_defaults, $content_width; ?>
<?php if ($load_defaults===TRUE): ?>
<?php
	add_filter('ci_panel_tabs', 'ci_add_tab_display_options', 40);
	if( !function_exists('ci_add_tab_display_options') ):
		function ci_add_tab_display_options($tabs) 
		{ 
			$tabs[sanitize_key(basename(__FILE__, '.php'))] = __('Display Options', 'ci_theme'); 
			return $tabs; 
		}
	endif;
	
	// Default values for options go here.
	// $ci_defaults['option_name'] = 'default_value';
	// or
	// load_panel_snippet( 'snippet_name' );
	$ci_defaults['hero_title'] 		= 'My name is <span class="color">Nico</span> Escobar';
	$ci_defaults['hero_description']= 'Stripped to our shirts and drawers, we sprang to the white-ash, and after several hours pulling were an almost disposed to renounce the chase, when a general pausing commotion among.';

	$ci_defaults['hero_show_front']= 'enabled';
	$ci_defaults['hero_show_portfolio']= 'enabled';
	$ci_defaults['hero_show_blog']= 'enabled';
	$ci_defaults['hero_show_page']= 'enabled';
	$ci_defaults['hero_show_search']= 'enabled';
	$ci_defaults['hero_show_404']= 'enabled';
	$ci_defaults['hero_show_default']= 'enabled';

	load_panel_snippet('excerpt');
	load_panel_snippet('seo');
	load_panel_snippet('comments');

	function ci_show_hero()
	{
		$skip = false;
		if(is_page_template('template-front.php')) if(ci_setting('hero_show_front')=='enabled') return true; else $skip=true;
		elseif(is_single() and get_post_type()=='portfolio') if(ci_setting('hero_show_portfolio')=='enabled') return true; else $skip=true;
		elseif(is_home() or is_single() or is_archive()) if(ci_setting('hero_show_blog')=='enabled') return true; else $skip=true;

		elseif(is_page()) if(ci_setting('hero_show_page')=='enabled') return true; else $skip=true;
		elseif(is_search()) if(ci_setting('hero_show_search')=='enabled') return true; else $skip=true;
		elseif(is_404()) if(ci_setting('hero_show_404')=='enabled') return true; else $skip=true;
		
		if($skip===true)
			return false;
		else
			return ci_setting('hero_show_default')=='enabled' ? true : false;
	}

	//add_filter('ci_featured_image_post_types', 'ci_add_featured_img_cpt');
	//if( !function_exists('ci_add_featured_img_cpt') ):
	//function ci_add_featured_img_cpt($post_types)
	//{
	//	$post_types[] = 'release';
	//	return $post_types;		
	//}
	//endif;
	load_panel_snippet('featured_image_single');
	
?>
<?php else: ?>

	<fieldset class="set">
		<p class="guide"><?php _e('Set your introduction title and introduction text here. This is complementary to the site\'s title and slogan, and it appears on top of all posts and pages. You can emphasize any piece of text by having <strong>&lt;span class="color"></strong> in front of the text, and <strong>&lt;/span></strong> right after the text.', 'ci_theme'); ?></p>
		<fieldset>
			<?php ci_panel_input('hero_title', __('Introduction title', 'ci_theme')); ?>
			<?php ci_panel_input('hero_description', __('Introduction description', 'ci_theme')); ?>
		</fieldset>

		<p class="guide"><?php _e('You can enable and disable the introduction title and text on individual types of pages. Uncheck the pages you don\'t want the intro to appear.' , 'ci_theme'); ?></p>
		<fieldset class="mb10">
			<?php ci_panel_checkbox('hero_show_front', 'enabled', __('Show on homepage', 'ci_theme')); ?>
			<?php ci_panel_checkbox('hero_show_portfolio', 'enabled', __('Show on portfolio pages', 'ci_theme')); ?>
			<?php ci_panel_checkbox('hero_show_blog', 'enabled', __('Show on blog and posts', 'ci_theme')); ?>
		</fieldset>
		<fieldset class="mb10">
			<?php ci_panel_checkbox('hero_show_page', 'enabled', __('Show on pages', 'ci_theme')); ?>
			<?php ci_panel_checkbox('hero_show_search', 'enabled', __('Show on search', 'ci_theme')); ?>
			<?php ci_panel_checkbox('hero_show_404', 'enabled', __('Show on 404', 'ci_theme')); ?>
		</fieldset>
		<fieldset class="mb10">
			<?php ci_panel_checkbox('hero_show_default', 'enabled', __('Show on all unhandled cases? (just in case)', 'ci_theme')); ?>
		</fieldset>
	</fieldset>

	<?php load_panel_snippet('excerpt'); ?>	

	<?php load_panel_snippet('seo'); ?>	

	<?php load_panel_snippet('comments'); ?>
	
	<?php load_panel_snippet('featured_image_single'); ?>

	<?php load_panel_snippet('featured_image_fullwidth'); ?>

<?php endif; ?>
