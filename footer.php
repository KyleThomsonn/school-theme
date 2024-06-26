<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>

	<footer id="colophon" class="site-footer">

		<div class="site-logo">
			<?php
				the_custom_logo();
			?>
		</div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'school-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'school-theme' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-theme' ), 'school-theme', '<a href="https://www.kylescode.com/school/">Kyle Thomson, Yasin Colak</a>' );
				?>
		</div><!-- .site-info -->
		<div class="footer-nav">
			<h3>Links</h3>
			<nav class="footer-nav-links">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-2') ); 
				?>
			</nav>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
