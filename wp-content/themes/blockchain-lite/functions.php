<?php
/**
 * Blockchain_Lite functions and definitions
 */

if ( ! defined( 'BLOCKCHAIN_LITE_NAME' ) ) {
	define( 'BLOCKCHAIN_LITE_NAME', 'blockchain-lite' );
}
if ( ! defined( 'BLOCKCHAIN_LITE_WHITELABEL' ) ) {
	// Set the following to true, if you want to remove any user-facing CSSIgniter traces.
	define( 'BLOCKCHAIN_LITE_WHITELABEL', false );
}

if ( ! function_exists( 'blockchain_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blockchain_lite_setup() {

	// Default content width.
	$GLOBALS['content_width'] = 850;

	// Make theme available for translation.
	load_theme_textdomain( 'blockchain-lite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	$menus = array(
		'menu-1' => esc_html__( 'Main Menu', 'blockchain-lite' ),
		'menu-2' => esc_html__( 'Main Menu - Right', 'blockchain-lite' ),
	);
	if ( ! apply_filters( 'blockchain_lite_support_menu_2', true ) ) {
		unset( $menus['menu-2'] );
	}
	register_nav_menus( $menus );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', apply_filters( 'blockchain_lite_add_theme_support_html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) ) );

	// Add theme support for custom logos.
	add_theme_support( 'custom-logo', apply_filters( 'blockchain_lite_add_theme_support_custom_logo', array() ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blockchain_lite_custom_background_args', array() ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	// Image sizes
	set_post_thumbnail_size( 850, 567, true );
	add_image_size( 'blockchain_lite_item', 555, 400, true );
	add_image_size( 'blockchain_lite_item_tall', 555 );
	add_image_size( 'blockchain_lite_item_media', 80, 80, true );
	add_image_size( 'blockchain_lite_brand_logo', 0, 80, false );
	add_image_size( 'blockchain_lite_fullwidth', 1140, 650, true );
	add_image_size( 'blockchain_lite_hero', 1920, 500, true );
	add_image_size( 'blockchain_lite_slide', 1920, 850, true );

	add_theme_support( 'blockchain-lite-hero', apply_filters( 'blockchain_lite_theme_support_hero_args', wp_parse_args( array(
		'front-page-template'   => false,
		'front-page-classes'    => 'page-hero-lg',
		'front-page-image-size' => 'blockchain_lite_slide',
		'text-align'            => 'left',
	), blockchain_lite_theme_support_hero_defaults() ) ) );


	add_theme_support( 'blockchain-lite-hide-single-featured', apply_filters( 'blockchain_lite_theme_support_hide_single_featured_post_types', array(
		'post',
		'page',
	) ) );

	add_theme_support( 'block/gutenbee/container', array(
		'themeGrid' => true,
	) );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'inc/assets/css/admin/editor-styles.css' );
}
endif;
add_action( 'after_setup_theme', 'blockchain_lite_setup' );

/**
 * Template tags.
 */
require_once get_theme_file_path( '/inc/template-tags.php' );

/**
 * Sanitization functions.
 */
require_once get_theme_file_path( '/inc/sanitization.php' );

/**
 * Hooks.
 */
require_once get_theme_file_path( '/inc/default-hooks.php' );

/**
 * Scripts and styles.
 */
require_once get_theme_file_path( '/inc/scripts-styles.php' );

/**
 * Sidebars and widgets.
 */
require_once get_theme_file_path( '/inc/sidebars-widgets.php' );

/**
 * Customizer controls.
 */
require_once get_theme_file_path( '/inc/customizer.php' );

/**
 * Various helper functions, so that this functions.php is cleaner.
 */
require_once get_theme_file_path( '/inc/helpers.php' );

/**
 * Theme layout functions.
 */
require_once get_theme_file_path( '/inc/layout.php' );

/**
 * Theme hero functions.
 */
require_once get_theme_file_path( '/inc/hero.php' );

/**
 * Post Meta functions.
 */
require_once get_theme_file_path( '/inc/post-meta.php' );


/**
 * WooCommerce integration.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_theme_file_path( '/inc/woocommerce.php' );
}

/**
 * User onboarding.
 */
require_once get_theme_file_path( '/inc/onboarding.php' );
