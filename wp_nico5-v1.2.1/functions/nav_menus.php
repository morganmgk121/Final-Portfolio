<?php

register_nav_menus(
	array(
	  'ci_main_menu' => __('Main Menu', 'ci_theme')
	)
);

// Add ID and Class attributes to the first <ul> occurence in wp_page_menu
if( !function_exists('mainmenu_add_ul_atributes') ):
function mainmenu_add_ul_atributes($ul_attributes) {
	return preg_replace('/<ul>/', '<ul id="navigation" class="group">', $ul_attributes, 1);
}
endif;
add_filter('wp_page_menu','mainmenu_add_ul_atributes');

// Remove page parent from portfolio post type
// page_css_class filter applies to wp_page_menu()
// nav_menu_css_class applies to wp_nav_menu()
add_filter('page_css_class', 'remove_portfolio_parent_class');
add_filter('nav_menu_css_class', 'remove_portfolio_parent_class');

if( !function_exists('remove_portfolio_parent_class') ):
function remove_portfolio_parent_class($classes)
{
	if(is_single() and get_post_type()=='portfolio')
		return array_filter($classes, 'portfolio_remove_parent_classes_callback');
	else
		return $classes;
}
endif;

if( !function_exists('portfolio_remove_parent_classes_callback') ):
function portfolio_remove_parent_classes_callback($class)
{
	// check for current page classes, return false if they exist.
	return ($class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor') ? FALSE : TRUE;
}
endif;
?>
