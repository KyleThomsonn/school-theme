<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			?>
			<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>

			<div class="entry-content">
			<?php the_content(); 
			?>
			</div>

			<section class="staff">
			<?php

			$terms = get_terms( 
				array(
					'taxonomy' => 'school-staff-category',
				) 
			);
		if ( $terms && ! is_wp_error( $terms ) ) {
    	foreach ( $terms as $term ) {

			$args = array(
				'post_type'      => 'school-staff',
				'posts_per_page' => -1,
				'tax_query'     => array(
					array(
						'taxonomy' => 'school-staff-category',
						'field' => 'slug',
						'terms' => $term->slug
					)
				)
			);
			
			$query = new WP_Query( $args );
			
			if ( $query -> have_posts() ){

				?> <h2><?php echo esc_html( $term->name )?></h2> 
				<?php
				while ( $query -> have_posts() ) {
					$query -> the_post();
					echo '<article>';
					?><h3><?php the_title()?></h3>
					<?php
					
					if(function_exists('get_fields')){
						if(get_field('staff-biography')){
							the_field('staff-biography');
							?><?php
						}
						if(get_field('course')){
							?><p>Courses: <?php the_field('course');?></p><?php
						}
						if(get_field('instructor_website')){
							?><a href=<?php the_field('instructor_website')?>>Instructor Website</a><?php
						}
					}
					echo '</article>';
				}
			}
				wp_reset_postdata();
		}
	}
		
		endwhile; // End of the loop.
		?>
		</section>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
