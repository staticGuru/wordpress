<?php
/**
 * Return default args for add_theme_support( 'blockchain-lite-hero' )
 *
 * Used when declaring support for theme hero section, so that unchanged args can be omitted. E.g.:
 *
 *  	add_theme_support( 'blockchain-lite-hero', apply_filters( 'blockchain_lite_theme_support_hero_args', wp_parse_args( array(
 *  		'required' => true,
 *  	), blockchain_lite_theme_support_hero_defaults() ) ) );
 *
 * @return array
 */
function blockchain_lite_theme_support_hero_defaults() {
	return apply_filters( 'blockchain_lite_theme_support_hero_defaults', array(
		'required'              => false, // When true, there will be no option to hide the hero section.
		'show-default'          => false, // The default state of the 'hero_show' option.
		'show-if-text-empty'    => false, // Show hero when title and subtitle are empty. If 'required' = true this is ignored (and hero is always shown).
		'image-size'            => 'blockchain_lite_hero', // The default image size for the background image.
		'front-page-template'   => 'templates/front-page.php', // The front page template slug. Set to false if theme doesn't have a front page template.
		'front-page-classes'    => '', // Extra hero classes for the front page.
		'front-page-image-size' => false, // The image size for the front page, if different. False means same as 'image-size'.
		'text-align'            => 'left', // The default text-align for the hero text. One of: 'left', 'center', 'right'.
	) );
}

function blockchain_lite_the_hero_classes( $echo = true ) {
	$classes = array( 'page-hero' );

	$hero_support = get_theme_support( 'blockchain-lite-hero' );
	$hero_support = $hero_support[0];
	if ( $hero_support['front-page-template'] && is_page_template( $hero_support['front-page-template'] ) ) {
		$classes[] = $hero_support['front-page-classes'];
	}

	$classes = apply_filters( 'blockchain_lite_hero_classes', $classes );
	$classes = array_filter( $classes );
	if ( $echo ) {
		echo esc_attr( implode( ' ', $classes ) );
	} else {
		return $classes;
	}
}

function blockchain_lite_get_hero_data( $post_id = false ) {
	if ( is_singular() && false === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! current_theme_supports( 'blockchain-lite-hero' ) ) {
		return array(
			'show'            => 0,
			'page_title_hide' => 0,
		);
	}

	$support = get_theme_support( 'blockchain-lite-hero' );
	$support = $support[0];

	$title    = '';
	$subtitle = '';

	if ( is_home() ) {
		$title = get_theme_mod( 'title_blog', __( 'From the blog', 'blockchain-lite' ) );
	} elseif ( is_search() ) {
		$title = get_theme_mod( 'title_search', __( 'Search results', 'blockchain-lite' ) );

		global $wp_query;
		$found = intval( $wp_query->found_posts );
		/* translators: %d is the number of search results. */
		$subtitle = esc_html( sprintf( _n( '%d result found.', '%d results found.', $found, 'blockchain-lite' ), $found ) );

	} elseif ( is_404() ) {
		$title = get_theme_mod( 'title_404', __( 'Page not found', 'blockchain-lite' ) );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$title    = single_term_title( '', false );
		$subtitle = term_description();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	}

	$generic_data = array(
		'show'             => get_theme_mod( 'hero_show', $support['show-default'] ),
		'title'            => $title,
		'subtitle'         => $subtitle,
		'text_align'       => $support['text-align'],
		'page_title_hide'  => 0,
		'bg_color'         => get_theme_mod( 'hero_bg_color' ),
		'text_color'       => get_theme_mod( 'hero_text_color' ),
		'overlay_color'    => get_theme_mod( 'hero_overlay_color' ),
		'image_id'         => '',
		'image'            => get_theme_mod( 'hero_image' ),
		'image_repeat'     => get_theme_mod( 'hero_image_repeat', 'no-repeat' ),
		'image_position_x' => get_theme_mod( 'hero_image_position_x', 'center' ),
		'image_position_y' => get_theme_mod( 'hero_image_position_y', 'center' ),
		'image_attachment' => get_theme_mod( 'hero_image_attachment', 'scroll' ),
		'image_cover'      => get_theme_mod( 'hero_image_cover', 1 ),
	);

	$data = $generic_data;

	$single_data = array();

	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_taxonomy() || is_product() ) ) {
		// The conditionals can only be used AFTER the 'posts_selection' action (i.e. in 'wp'), so calling this function earlier,
		// e.g. on 'init' will not work properly. In that case, provide the shop's page ID explicitly when calling.
		// Example usage can be found on the Spencer theme.
		$shop_page = wc_get_page_id( 'shop' );
		if ( $shop_page > 0 ) {
			$post_id = $shop_page;
		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if ( is_product() ) {
			$data['title']    = get_the_title( $shop_page ); // May be custom title from hooked blockchain_lite_replace_the_title()
			$data['subtitle'] = get_post_meta( $shop_page, 'subtitle', true );
		} elseif ( is_product_taxonomy() ) {
			$data['title']    = single_term_title( '', false );
			$data['subtitle'] = term_description();
		}
	}

	// Disable hero if no text exists.
	if ( false === $support['show-if-text-empty'] && empty( $data['title'] ) && empty( $data['subtitle'] ) ) {
		$data['show'] = 0;
	}

	// Enable hero if required, ignoring previous limitations ( e.g. false === $support['show-if-text-empty'] ).
	if ( $support['required'] ) {
		$data['show'] = 1;
	}

	return apply_filters( 'blockchain_lite_hero_data', $data, $post_id, $generic_data, $single_data );
}
