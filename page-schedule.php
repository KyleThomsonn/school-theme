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

			<section style="overflow-x: auto;">
			<?php
			if(function_exists ('get_field')){
				if(get_field('course_schedule')){
					if(have_rows ('course_schedule')){
					?>

					<table class="schedule">
						<caption>Weekly Course Schedule</caption>
						<tbody>
							<tr>
								<td><strong>Date</strong></td>
								<td><strong>Course</strong></td>
								<td><strong>Instructor</strong></td>
							</tr>

					<?php while(has_sub_field('course_schedule')): ?>
					
							<tr>
								<td><?php the_sub_field('date'); ?></td>
								<td><?php the_sub_field('course'); ?></td>
								<td><?php the_sub_field('instructor'); ?></td>
							</tr>

					<?php endwhile; ?>
						</tbody>
					</table>
					
					<?php
				}
			}
		}
		
		endwhile; // End of the loop.
		?>
		</section>

	</main><!-- #main -->

<?php
get_footer();
