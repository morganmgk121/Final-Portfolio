<?php
/*
Template Name: Archive
*/
?>
<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>

				<div class="entry-content">
					<h1><?php the_title(); ?></h1>

					<?php 
						global $paged;
						$arrParams = array(
							'paged' => $paged,
							'ignore_sticky_posts' => 1,
							'showposts' => ci_setting('archive_no'));
						query_posts($arrParams);
					?>
					<h2><?php _e('Latest posts', 'ci_theme'); ?></h2>
					<ul class="lst archive">
						<?php while (have_posts() ) : the_post(); ?>
							<li><a href="<?php the_permalink(); ?>" title="Permalink to: <?php the_title(); ?>"><?php the_title(); ?></a> - <?php echo get_the_date(); ?><?php the_excerpt(); ?></li>
						<?php endwhile; ?>
					</ul>
					
					<?php wp_reset_query(); ?>
				
					<?php if (ci_setting('archive_week')=='enabled'): ?>
						<h2 class="hdr"><?php _e('Weekly Archive', 'ci_theme'); ?></h2>
						<ul class="lst archive"><?php wp_get_archives('type=weekly&show_post_count=1') ?></ul>
					<?php endif; ?>
					
					<?php if (ci_setting('archive_month')=='enabled'): ?>
						<h2 class="hdr"><?php _e('Monthly Archive', 'ci_theme'); ?></h2>
						<ul class="lst archive"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
					<?php endif; ?>
					
					<?php if (ci_setting('archive_year')=='enabled'): ?>
						<h2 class="hdr"><?php _e('Yearly Archive', 'ci_theme'); ?></h2>
						<ul class="lst archive"><?php wp_get_archives('type=yearly&show_post_count=1') ?></ul>
					<?php endif; ?>
	
				</div>

			</article>

		<?php endwhile; endif; ?>

		<?php ci_pagination(); ?>
	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
