<?php
//load translation domain
load_theme_textdomain( 'alestrunda', get_template_directory() . '/languages' );

//theme settings
include_once('functions/theme_settings.php');

//shortcodes
include_once('functions/shortcodes/latest_news.php');
include_once('functions/shortcodes/get_age.php');
include_once('functions/shortcodes/portfolio.php');
include_once('functions/shortcodes/testimonials.php');

//custom posts
include_once('functions/custom_posts.php');



/**
 * Enqueues font stylesheets
 *
 * @return void
 */
function font_styles() {
	// Load FontAwesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css' );
	// Load Google Fonts
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600&amp;subset=latin,latin-ext' );
}
add_action( 'wp_enqueue_scripts', 'font_styles' );


/**
 * Enqueues styles for front end.
 *
 * @return void
 */
function theme_styles() {
	// Load our main stylesheet
	wp_enqueue_style( 'slick-carousel', get_template_directory_uri() . '/slick-carousel/slick.css');
	wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/lightbox/css/lightbox.css');
	wp_enqueue_style( 'main-style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'theme_styles' );


/**
 * Enqueues scripts for front end.
 *
 * @return void
 */
function theme_scripts() {
	// Load JavaScript files
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/external/modernizr.js' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'slick-carousel', get_template_directory_uri() . '/slick-carousel/slick.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/lightbox/js/lightbox.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/external/retina.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery.scrollTo', get_template_directory_uri() . '/js/external/jquery.scrollTo.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery.nav', get_template_directory_uri() . '/js/external/jquery.nav.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/external/isotope.pkgd.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/js/external/skrollr.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'stellar', get_template_directory_uri() . '/js/external/jquery.stellar.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'inview', get_template_directory_uri() . '/js/external/jquery.inview.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'lodash', get_template_directory_uri() . '/js/external/lodash.custom.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.min.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );


//add theme menus
function theme_menus() {
	register_nav_menu( 'subpages', 'Subpages Navigation Menu' );
}
add_action( 'after_setup_theme', 'theme_menus' );


// add thumbnails for posts and pages
add_theme_support( 'post-thumbnails', array( 'post', 'page', 'popup_window', 'work' ) );


// add support for HTML5 search form
add_theme_support( 'html5', array( 'search-form' ) );


//remove automatic adding <p> tags to post content for top_slide posts
add_filter( 'the_content', 'remove_autop_top_slide', 0 );
function remove_autop_top_slide( $content )
{
    'top_slide' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
    return $content;
}
remove_filter( 'the_content', 'wpautop' );


//clean category title
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '', false );
    }
    return __( $title );
});
?>
