<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			// get_template_part( 'template-parts/content', get_post_type() );
			?>
			<article class="single-student">
				<h2><?php the_title()?></h2>
				<?php the_content()?>
				<?php the_post_thumbnail('all-student')?>
			</article>

			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'school-theme' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'school-theme' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

		endwhile; // End of the loop.
		?>
		<?php 
			
			$terms = get_the_terms(get_the_ID(), 'school-student-category');
				if ($terms && !is_wp_error($terms)) {
					foreach ($terms as $term) {
						$args = array(
							'post_type'      => 'school-student',
							'posts_per_page' => -1,
							'tax_query'     => array(
								array(
									'taxonomy' => 'school-student-category',
									'field' => 'slug',
									'terms' => $term->slug
								)
							)
						);
						$query =  new WP_Query($args);
						if($query -> have_posts()){
							$id = get_the_ID();?>
							<h3>Meet other <?php echo esc_html($term->name); ?> students:</h3>
							<?php
							while ( $query -> have_posts() ) {
								$query -> the_post();
								if(is_single($id) != get_post($id)){
								
								?><a href=<?php echo get_permalink($id)?>><?php the_title()?></a><br>
								<?php
							}
						}
						
					}
				}
			}
			
	?>
	</main><!-- #main -->

<?php
get_footer();
