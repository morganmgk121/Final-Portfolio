<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<title><?php ci_e_title(); ?></title>

	<?php // JS files are loaded via /functions/scripts.php ?>

	<?php // CSS files are loaded via /functions/styles.php ?>
	
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php do_action('after_open_body_tag'); ?>

<div id="page" class="wrap group">
	
	<div id="sidecol">
		<header id="header">
			<hgroup class="logo <?php logo_class(); ?>">
				<?php ci_e_logo('<h1 class="logo">', '</h1>'); ?>
				<?php ci_e_slogan('<h2>', '</h2>'); ?>
			</hgroup>
		</header>

		<nav>
			<?php 
				if(has_nav_menu('ci_main_menu'))
					wp_nav_menu( array(
						'theme_location' 	=> 'ci_main_menu',
						'fallback_cb' 		=> '',
						'container' 		=> '',
						'menu_id' 			=> 'navigation',
						'menu_class' 		=> 'group'
					));
				else
					wp_page_menu(array('menu_class'=>''));
			?>
		</nav>

		<?php get_sidebar(); ?>
	</div> <!-- #sidecol -->
