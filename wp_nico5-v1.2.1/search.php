<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<article class="entry">
			<?php 
				global $wp_query;
		
				$found = $wp_query->post_count > $wp_query->found_posts ? $wp_query->post_count : $wp_query->found_posts;
				$none = __('No results found. Please broaden your terms and search again.', 'ci_theme');
				$one = __('Just one result found. We either nailed it, or you might want to broaden your terms and search again.', 'ci_theme');
				$many = sprintf(__("%d results found.", 'ci_theme'), $found);
			?>
	
			<h1><?php ci_e_inflect($found, $none, $one, $many); ?></h1>
				<div class="entry-content">
					<?php if($found==0): ?>
						<?php get_search_form(); ?>
					<?php endif; ?>
				</div>
		</article>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="entry-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>

				<div class="entry-content">
					<h1><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'ci_theme'), get_the_title())); ?>"><?php the_title(); ?></a></h1>
	
					<div class="post-meta">
						<time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo sprintf(_x('Posted on %s', 'posted on date', 'ci_theme'), get_the_date()); ?></time>, <a href="<?php comments_link(); ?>" class="entry-comments"><?php comments_number(); ?></a>
					</div>
	
					<?php the_excerpt(); ?>
					<?php ci_read_more(); ?>
	
				</div>

			</article>

		<?php endwhile; endif; ?>

	<?php ci_pagination(); ?>

	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
