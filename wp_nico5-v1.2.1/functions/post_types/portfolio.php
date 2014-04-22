<?php
//
// Portfolio Post Type related functions.
//
add_action('init', 'ci_create_cpt_portfolio');
add_action('admin_init', 'ci_add_cpt_portfolio_meta');
add_action('save_post', 'ci_update_cpt_portfolio_meta');

if( !function_exists('ci_create_cpt_portfolio') ):
function ci_create_cpt_portfolio() {
	$labels = array(
		'name' => _x('Portfolios', 'post type general name', 'ci_theme'),
		'singular_name' => _x('Portfolio', 'post type singular name', 'ci_theme'),
		'add_new' => __('New Portfolio', 'ci_theme'),
		'add_new_item' => __('Add New Portfolio', 'ci_theme'),
		'edit_item' => __('Edit Portfolio', 'ci_theme'),
		'new_item' => __('New Portfolio', 'ci_theme'),
		'view_item' => __('View Portfolio', 'ci_theme'),
		'search_items' => __('Search Portfolios', 'ci_theme'),
		'not_found' =>  __('No Portfolios found', 'ci_theme'),
		'not_found_in_trash' => __('No Portfolios found in the trash', 'ci_theme'), 
		'parent_item_colon' => __('Parent Portfolio:', 'ci_theme')
	);

	$args = array(
		'labels' => $labels,
		'singular_label' => __('Portfolio', 'ci_theme'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'has_archive' => false,
		'rewrite' => true,
		'menu_position' => 5,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
	);

	register_post_type( 'portfolio' , $args );
}
endif;

if( !function_exists('ci_add_cpt_portfolio_meta') ):
function ci_add_cpt_portfolio_meta(){
	add_meta_box("ci_cpt_portfolio_meta", __('Portfolio Details', 'ci_theme'), "ci_add_cpt_portfolio_meta_box", "portfolio", "normal", "high");
}
endif;

if( !function_exists('ci_update_cpt_portfolio_meta') ):
function ci_update_cpt_portfolio_meta($post_id){
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if (isset($_POST['post_view']) and $_POST['post_view']=='list') return;

	if (isset($_POST['post_type']) && $_POST['post_type'] == "portfolio")
	{
		update_post_meta($post_id, "ci_cpt_portfolio_on_homepage", (isset($_POST["ci_cpt_portfolio_on_homepage"]) ? $_POST["ci_cpt_portfolio_on_homepage"] : '') );
		update_post_meta($post_id, "ci_cpt_portfolio_internal_slider", (isset($_POST["ci_cpt_portfolio_internal_slider"]) ? $_POST["ci_cpt_portfolio_internal_slider"] : '') );
	}
}
endif;

if( !function_exists('ci_add_cpt_portfolio_meta_box') ):
function ci_add_cpt_portfolio_meta_box(){
	global $post;
	$on_homepage = get_post_meta($post->ID, 'ci_cpt_portfolio_on_homepage', true);
	$internal_slider = get_post_meta($post->ID, 'ci_cpt_portfolio_internal_slider', true);
	?>
	<p><?php _e('You should upload your work you want to promote. You need to upload at least 2 images on this portfolio for the slider to work. You should also upload and/or select a Featured Image, so that it will be used as the cover of the portfolio.', 'ci_theme'); ?></p>
	<input id="ci_cpt_portfolio_upload" type="button" class="button ci-upload" value="<?php _e('Upload', 'ci_theme'); ?>" />
	<p><input type="checkbox" id="ci_cpt_portfolio_on_homepage" name="ci_cpt_portfolio_on_homepage" value="enabled" <?php checked($on_homepage, 'enabled'); ?> /> <label for="ci_cpt_portfolio_on_homepage"><?php _e('Show this portfolio item on the homepage.', 'ci_theme'); ?></label></p>
	<p><input type="checkbox" id="ci_cpt_portfolio_internal_slider" name="ci_cpt_portfolio_internal_slider" value="disabled" <?php checked($internal_slider, 'disabled'); ?> /> <label for="ci_cpt_portfolio_internal_slider"><?php _e('Disable the internal portfolio slider (displayed when this portfolio is viewed).', 'ci_theme'); ?></label></p>
	<?php
}
endif;

//
// Portfolio post type custom admin list
//
add_filter("manage_edit-portfolio_columns", "ci_cpt_portfolio_edit_columns");  
add_action("manage_posts_custom_column",  "ci_cpt_portfolio_custom_columns");  

if( !function_exists('ci_cpt_portfolio_edit_columns') ):
function ci_cpt_portfolio_edit_columns($columns){  
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => __('Portfolio Name', 'ci_theme'),  
		"taxonomy-skill" => _x('Skills', 'taxonomy general name', 'ci_theme'),  
		"slider" => __("Has Slider", 'ci_theme')
	);  
	
	return $columns;  
}  
endif;
  
if( !function_exists('ci_cpt_portfolio_custom_columns') ):
function ci_cpt_portfolio_custom_columns($column){  
	global $post, $wp_version;  
	switch ($column)  
	{  
		case "slider":  
			if (get_post_meta($post->ID, 'ci_cpt_portfolio_internal_slider', true) != 'disabled') 
				echo "&radic;"; 
		break;  
		case "taxonomy-skill":
			if(version_compare($wp_version, '3.5', '<'))
			{
				$terms = wp_get_post_terms($post->ID, 'skill');
				$list='';
				foreach($terms as $term)
				{
					$list .= $term->name.'<br />';
				}
				$list = substr($list, 0, -6);
				echo $list;
			}
		break;

	}  
} 
endif;

?>
