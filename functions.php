<?php
/**
 * School Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package School_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on School Theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Custom Image Sizes

	add_image_size('all-news', 970, 400, true );
	add_image_size('student-size', 200, 300, true);
	add_image_size('all-student', 300, 200, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'school-theme' ),
			'menu-2' => esc_html__( 'Footer', 'school-theme' )
		)

	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'school_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_theme_content_width', 0 );

// Add support for wide and full alignment options
function mytheme_setup() {
    add_theme_support( 'align-wide' );
    add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts() {
	wp_enqueue_style('school-googlefonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap',
	array(),
	null);

	wp_enqueue_style( 'school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue aos scripts and styles
	if(get_post_type() === ('post')){
	wp_enqueue_style('aos', get_template_directory_uri() . '/aos/aos.css');
	
	wp_enqueue_script('aos', get_template_directory_uri() . '/aos/aos.js', array(), '6.5.3', true);
	wp_enqueue_script('aos-init', get_template_directory_uri() . '/js/aos-init.js', array(), '6.5.3', true);
	};
	
}
add_action( 'wp_enqueue_scripts', 'school_theme_scripts' );


// Change placeholder text for Staff CPT Title and the Student CPT Title
// Code example found at wpbeginner.com
function school_change_title_text( $title ){
	$screen = get_current_screen();
  
	if  ( 'school-staff' == $screen->post_type ) {
		 $title = 'Add staff name';
	}

	if  ( 'school-student' == $screen->post_type ) {
		 $title = 'Add student name';
	}
  
	return $title;
}
  
add_filter( 'enter_title_here', 'school_change_title_text' );

// Change excerpt length on student list template
function school_excerpt_length( $length ) {
	if(is_post_type_archive('school-student')){
		return 25;

	} else {
		return $length;
	}
}
add_filter( 'excerpt_length', 'school_excerpt_length', 999);

// Change the excerpt more on student list template
function school_excerpt_more( $more ) {
	if(is_post_type_archive('school-student')){
	$more = '... <a href="'. esc_url(get_permalink()) .'">'.__('Read More About the Student').'</a>';
		return $more;
		
	} else {
		return $more;
	}
}
add_filter( 'excerpt_more', 'school_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// Register CPTs and Taxonomies
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

