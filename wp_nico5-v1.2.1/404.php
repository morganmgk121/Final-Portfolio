<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<article class="entry">
			<h1><?php _e( 'Not Found', 'ci_theme' ); ?></h1>

			<p><?php _e( 'Oh, no! The page you requested could not be found. Perhaps searching will help...', 'ci_theme' ); ?></p>

			<?php get_search_form(); ?>
		</article>

	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
