<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php while (have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('entry group'); ?>>

			<h1><?php the_title(); ?></h1>

			<?php ci_the_post_thumbnail(array("class" => "thumb")); ?>

			<?php the_content(); ?>
			<?php wp_link_pages(); ?>

			<div id="comments">
				<?php comments_template(); ?>
			</div>

		</article>
	<?php endwhile; ?>

	<?php ci_pagination(); ?>

	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
