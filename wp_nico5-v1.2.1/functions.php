<?php 
	get_template_part('panel/constants');

	load_theme_textdomain( 'ci_theme', get_template_directory() . '/lang' );

	// This is the main options array. Can be accessed as a global in order to reduce function calls.
	$ci = get_option(THEME_OPTIONS);
	$ci_defaults = array();

	// The $content_width needs to be before the inclusion of the rest of the files, as it is used inside of some of them.
	if ( ! isset( $content_width ) ) $content_width = 675;

	//
	// Let's bootstrap the theme.
	//
	get_template_part('panel/bootstrap');


	//
	// Define our various image sizes.
	//
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 200, 180, true );
	add_image_size( 'three_col_thumb', 213, 140, true);
	add_image_size( 'four_col_thumb', 156, 140, true);
	add_image_size( 'two_col_thumb', 320, 200, true);
	add_image_size( 'fullsize_thumb', 675, ci_setting('portfolio_single_height'), true);
	add_image_size( 'slider_thumb', 90, 90, true);


	// Let the user choose a color scheme on each post individually.
	add_ci_theme_support('post-color-scheme', array('page', 'post'));


	add_filter('the_content', 'prettyphotorel', 12);
	add_filter('get_comment_text', 'prettyphotorel');
	if( !function_exists('prettyphotorel') ):
	function prettyphotorel ($content)
	{   global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	    $replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
	    $content = preg_replace($pattern, $replacement, $content);
	    return $content;
	}
	endif;
	
?>
