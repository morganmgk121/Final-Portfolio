<?php
/*
Template Name: Front Page
*/
?>

<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php
			$ci_portfolio_query = new WP_Query(array(
				'post_type' => 'portfolio',
				'posts_per_page' => ci_setting('home_portfolio_num'),
				'meta_query' => array(
					array(
						'key'=> 'ci_cpt_portfolio_on_homepage',
						'value' => 'enabled',
						'compare' => '='
					)
				)
			));

			$skills = array();
			while($ci_portfolio_query->have_posts())
			{
				$ci_portfolio_query->the_post();
				$item_skills = wp_get_object_terms($post->ID, 'skill');
				foreach($item_skills as $skill)
				{
					$skills[$skill->term_id] = $skill;
				}
			}
			$ci_portfolio_query->rewind_posts();
		?>

		<section id="portfolio-list">
			<ul class="portfolio-nav group">
				<li><a href="#filter" class="selected" data-filter="*"><?php _e('All Works', 'ci_theme'); ?></a></li>
				<?php foreach ( $skills as $skill ) :	?>
					<li><a href="#filter" data-filter=".<?php echo $skill->slug; ?>"><?php echo $skill->name; ?></a></li>
				<?php endforeach; ?>
			</ul>


			<ul class="portfolio-items group <?php echo ci_get_columns_class(); ?>">
				<?php if ( $ci_portfolio_query-> have_posts() ) : while ( $ci_portfolio_query->have_posts() ) : $ci_portfolio_query->the_post(); ?>
					<?php $item_skills = wp_get_object_terms($post->ID, 'skill');	?>
					<li class="item <?php foreach ( $item_skills as $item_skill ) : echo $item_skill->slug.' '; endforeach; ?>">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'ci_theme'), get_the_title())); ?>">
							<?php the_post_thumbnail(ci_get_columns_thumb()); ?>
							<span class="zoom-icon"></span>
						</a>
					</li>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</ul>
		</section>
	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
