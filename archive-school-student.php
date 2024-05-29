<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				?><h1 class="page-title">The Class</h1><?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

		<?php
				
			$args = array(
				'post_type' => 'school-student',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC' 
			);
			$query = new WP_Query( $args );

			if($query->have_posts()) {
				echo '<section class="students">';
				while($query->have_posts()) {
					$query->the_post();
					?>
					<article class="students-article">
						<a href="<?php the_permalink(); ?>">
							<h2><?php the_title();?></h2>
							<?php the_post_thumbnail('medium'); ?>
						</a>
						<?php the_excerpt(); ?>
						<p>Specialty:
    					<?php
    					$terms = get_the_terms(get_the_ID(), 'school-student-category');
    						if ($terms && !is_wp_error($terms)) {
    							foreach ($terms as $term) {
    							    ?><a href="<?php echo get_term_link($term);?>"><?php echo esc_html($term->name);?></a>
								<?php
    							}
    						}
    					?>
						</p>
					</article>
							<?php
					}
					wp_reset_postdata();
				};
				echo "</section>";
					
				else :
		
					get_template_part( 'template-parts/content', 'none' );
		
				endif;
				?>
		
			</main><!-- #main -->
		
		<?php
		get_footer();
