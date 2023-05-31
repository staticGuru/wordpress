<?php
/**
 * Blockchain_Lite scripts and styles related functions.
 */

/**
 * Register Google Fonts
 */
function blockchain_lite_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'blockchain-lite' ) ) {
		$fonts[] = 'Roboto:400,400i,500,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Register scripts and styles unconditionally.
 */
function blockchain_lite_register_scripts() {
	$suffix = blockchain_lite_scripts_styles_suffix();

	wp_register_style( 'font-awesome', get_template_directory_uri() . '/inc/assets/vendor/fontawesome/css/fontawesome.min.css', array(), blockchain_lite_asset_version( '4.7.0' ) );

	wp_register_style( 'jquery-magnific-popup', get_template_directory_uri() . "/inc/assets/vendor/magnific-popup/magnific{$suffix}.css", array(), blockchain_lite_asset_version( '1.0.0' ) );
	wp_register_script( 'jquery-magnific-popup', get_template_directory_uri() . "/inc/assets/vendor/magnific-popup/jquery.magnific-popup{$suffix}.js", array( 'jquery' ), blockchain_lite_asset_version( '1.0.0' ), true );
	wp_register_script( 'blockchain-lite-magnific-init', get_template_directory_uri() . "/inc/assets/js/magnific-init{$suffix}.js", array( 'jquery-magnific-popup' ), blockchain_lite_asset_version(), true );

	wp_register_style( 'blockchain-lite-google-font', blockchain_lite_fonts_url(), array(), null );

	wp_register_style( 'blockchain-lite-dependencies', false, array(
		'blockchain-lite-google-font',
		'font-awesome',
	), blockchain_lite_asset_version() );

	if ( is_child_theme() ) {
		wp_register_style( 'blockchain-lite-style-parent', get_template_directory_uri() . '/style.css', array(
			'blockchain-lite-dependencies',
		), blockchain_lite_asset_version() );
	}

	wp_register_style( 'blockchain-lite-style', get_stylesheet_uri(), array(
		'blockchain-lite-dependencies',
	), blockchain_lite_asset_version() );

	wp_register_script( 'isotope', get_template_directory_uri() . "/inc/assets/vendor/isotope/isotope.pkgd{$suffix}.js", array( 'jquery' ), blockchain_lite_asset_version( '3.0.2' ), true );

	wp_register_script( 'isotope-init', get_template_directory_uri() . "/inc/assets/js/isotope-init{$suffix}.js", array( 'isotope' ), blockchain_lite_asset_version(), true );

	wp_register_script( 'blockchain-lite-dependencies', false, array(
		'jquery',
	), blockchain_lite_asset_version(), true );

	wp_register_script( 'blockchain-lite-front-scripts', get_template_directory_uri() . "/inc/assets/js/scripts{$suffix}.js", array(
		'blockchain-lite-dependencies',
	), blockchain_lite_asset_version(), true );

}
add_action( 'init', 'blockchain_lite_register_scripts' );

/**
 * Enqueue scripts and styles.
 */
function blockchain_lite_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( get_theme_mod( 'theme_lightbox', 1 ) ) {
		wp_enqueue_style( 'jquery-magnific-popup' );
		wp_enqueue_script( 'jquery-magnific-popup' );
		wp_enqueue_script( 'blockchain-lite-magnific-init' );
	}

	if ( get_theme_mod( 'archive_masonry', 1 ) ) {
		wp_enqueue_script( 'isotope-init' );
	}

	if ( is_child_theme() ) {
		wp_enqueue_style( 'blockchain-lite-style-parent' );
	}

	wp_enqueue_style( 'blockchain-lite-style' );
	wp_add_inline_style( 'blockchain-lite-style', blockchain_lite_get_all_customizer_css() );

	wp_enqueue_script( 'blockchain-lite-front-scripts' );

}
add_action( 'wp_enqueue_scripts', 'blockchain_lite_enqueue_scripts' );

/**
 * Enqueue Google Font for the block editor.
 */
add_action( 'enqueue_block_editor_assets', 'blockchain_lite_block_editor_font_family' );
function blockchain_lite_block_editor_font_family() {
	wp_enqueue_style( 'blockchain-lite-google-font' );
	wp_enqueue_style( 'font-awesome' );
}

add_action( 'init', 'blockchain_lite_register_block_editor_block_styles' );
/**
 * Registers custom block styles.
 *
 * @since 1.4.0
 */
function blockchain_lite_register_block_editor_block_styles() {
	register_block_style( 'core/social-links', array(
		'name'  => 'blockchain-lite-socials',
		'label' => __( 'Square Icons', 'blockchain-lite' ),
	) );
}