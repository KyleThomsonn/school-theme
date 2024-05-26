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
			the_post();?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php school_theme_post_thumbnail(); ?>

			<div class="entry-content">
			<?php
			the_content();
			?>
			</div>

			<section class="home-blog">
			<h2>Recent News</h2>
			<?php 
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 3
			);

			$blog_query = new WP_Query ( $args );

			if ( $blog_query -> have_posts() ) {
				while ( $blog_query -> have_posts() ) {
					$blog_query -> the_post();
					?>
					<article>
						<a href="<?php the_permalink();?>">
							<?php the_post_thumbnail('medium');?>
							<h3><?php the_title(); ?></h3>
						</a>
					</article>
					<?php
				}
				wp_reset_postdata();
			}
			?>
			<p>
				<a href=<?php the_permalink(9)?>>See All News</a>
			</p>
		</section>
		</article>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
