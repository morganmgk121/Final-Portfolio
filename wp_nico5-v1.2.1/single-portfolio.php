<?php get_header(); ?>

	<div id="maincol">
		<?php get_template_part('hero'); ?>

		<?php while (have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID();?>" <?php post_class('entry group'); ?>>

			<h1><?php the_title(); ?></h1>

			<?php if(get_post_meta($post->ID, 'ci_cpt_portfolio_internal_slider', true) != 'disabled'): ?>

				<?php
					$args = array(
						'order'          => 'ASC',
						'orderby'        => 'menu_order ID',  
						'post_type'      => 'attachment',
						'post_parent'    => $post->ID,
						'post_mime_type' => 'image',
						'post_status'    => null,
						'posts_per_page' => -1
					);
					$attachments = get_posts($args);
				?>
				
				<?php if ($attachments): ?>
						<div class="sld-container">
							<div class="slideshow">
							<?php
								// Big slides
								foreach ( $attachments as $attachment )
								{
									$alt_text = trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ));
									$attr = array(
										'alt'   => $alt_text,
										'title' => trim(strip_tags( $attachment->post_title ))
									);
									$img_attrs = wp_get_attachment_image_src( $attachment->ID, 'full' );
									echo '<a href="'.$img_attrs[0].'" rel="prettyPhoto-gal['.get_the_ID().']" title="'.esc_attr($alt_text).'">'.wp_get_attachment_image( $attachment->ID, 'fullsize_thumb', false, $attr ).'</a>';
								}
							?>
							</div>
							<?php if (count($attachments) > 1): ?>
							<ul class="sld-nav group">
								<?php
									// Pager thumbs
									foreach ( $attachments as $attachment )
									{
										$alt_text = trim(strip_tags( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ));
										$attr = array(
											'alt'   => $alt_text,
											'title' => trim(strip_tags( $attachment->post_title ))
										);
										$img_attrs = wp_get_attachment_image_src( $attachment->ID, 'fullsize_thumb' );
										echo '<li><a href="#">'.wp_get_attachment_image( $attachment->ID, 'slider_thumb', false, $attr ).'</a></li>';
									}
								?>
							</ul>
							<?php endif; ?>
						</div>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>

			<?php the_content(); ?>
			<?php wp_link_pages(); ?>

			<?php if(ci_setting('show_related_portfolios')=='enabled'): ?>
				<div class="similar-work">
					<h2><?php _e('Other projects', 'ci_theme'); ?></h2>
					<ul class="portfolio-items group three-col">
						<?php
							$term_list = array();
							$terms = get_the_terms(get_the_ID(), 'skill');
							if(is_array($terms))
							{
								foreach($terms as $term)
								{
									$term_list[] = $term->slug;
								}
							}
							
							$args = array( 
								'post_type' => 'portfolio', 
								'numberposts' => 3, 
								'post_status' => 'published', 
								'post__not_in' => array(get_the_ID()),
								'orderby' => 'rand',
								'tax_query' => array(
									array(
										'taxonomy' => 'skill',
										'field' => 'slug',
										'terms' => $term_list
									)
								) 
							);
							$related_posts = get_posts($args);
						?>
						<?php 
							foreach($related_posts as $rpost)
							{
								$attr = array(
									'title' => trim(strip_tags( $rpost->post_title ))
								);
		
								echo '<li class="item"><a href="'.get_permalink($rpost->ID).'" title="'.esc_attr(get_the_title($rpost->ID)).'">'.get_the_post_thumbnail($rpost->ID, 'three_col_thumb', $attr).'</a><span class="zoom-icon"></span></li>';
							}
						?>
						
						<?php wp_reset_postdata(); ?>
					</ul><!-- #similar-portfolios -->
				</div>
			<?php endif; ?>
			
			<div id="comments">
				<?php comments_template(); ?>
			</div>

		</article>
	<?php endwhile; ?>

	</div> <!-- #maincol -->
</div> <!-- #page -->

<?php get_footer(); ?>
