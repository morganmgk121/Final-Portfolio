<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php while (have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>

			<h1><?php the_title(); ?></h1>
			<div class="post-meta">
				<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo sprintf(_x('Posted on %s', 'posted on date', 'ci_theme'), get_the_date()); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
				<p class="post-cats"><?php _e('Posted under:', 'ci_theme'); ?> <?php the_category(',') ?></p>
			</div>

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
