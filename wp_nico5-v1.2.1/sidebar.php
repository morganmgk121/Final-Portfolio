<?php
	if ( (is_single() and get_post_type()=='post') or is_archive() or is_home() ) {
		dynamic_sidebar('blog-sidebar');
	} else {
		dynamic_sidebar('main-sidebar');
	}
?>
