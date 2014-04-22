<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<?php if ( has_post_thumbnail() and !is_singular() ) : ?>
					<a class="entry-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>

				<div class="entry-content">
					<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'ci_theme'), get_the_title())); ?>"><?php the_title(); ?></a></h1>
	
					<div class="post-meta">
						<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo sprintf(_x('Posted on %s', 'posted on date', 'ci_theme'), get_the_date()); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
					</div>
	
					<?php if(is_single() or is_page()): ?>
						<?php ci_the_post_thumbnail(array("class" => "thumb")); ?>
					<?php endif; ?>

					<?php ci_e_content(); ?>
					<?php if( is_singular() ) wp_link_pages(); ?>
					<?php if( ! is_singular() ) ci_read_more(); ?>
	
				</div>

				<?php if (is_singular()): ?>
					<div id="comments">
						<?php comments_template(); ?>
					</div>
			  	<?php endif; ?>
			</article>

		<?php endwhile; endif; ?>

		<?php ci_pagination(); ?>
	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
