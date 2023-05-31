<?php
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blockchain_lite_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blockchain_lite_pingback_header' );


add_filter( 'excerpt_length', 'blockchain_lite_excerpt_length' );
function blockchain_lite_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 55 );
}

add_filter( 'the_content', 'blockchain_lite_lightbox_rel', 12 );
add_filter( 'get_comment_text', 'blockchain_lite_lightbox_rel' );
if ( ! function_exists( 'blockchain_lite_lightbox_rel' ) ) :
	function blockchain_lite_lightbox_rel( $content ) {
		if ( get_theme_mod( 'theme_lightbox', 1 ) ) {
			global $post;
			$pattern     = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
			$replacement = '<a$1href=$2$3.$4$5 data-lightbox="gal[' . $post->ID . ']"$6>$7</a>';
			$content     = preg_replace( $pattern, $replacement, $content );
		}

		return $content;
	}
endif;

add_filter( 'wp_get_attachment_link', 'blockchain_lite_wp_get_attachment_link_lightbox_caption', 10, 6 );
function blockchain_lite_wp_get_attachment_link_lightbox_caption( $html, $id, $size, $permalink, $icon, $text ) {
	if ( get_theme_mod( 'theme_lightbox', 1 ) && false === $permalink ) {
		$found = preg_match( '#(<a.*?>)<img.*?></a>#', $html, $matches );
		if ( $found ) {
			$found_title = preg_match( '#title=([\'"])(.*?)\1#', $matches[1], $title_matches );

			// Only continue if title attribute doesn't exist.
			if ( 0 === $found_title ) {
				$caption = blockchain_lite_get_image_lightbox_caption( $id );

				if ( $caption ) {
					$new_a = $matches[1];
					$new_a = rtrim( $new_a, '>' );
					$new_a = $new_a . ' title="' . esc_attr( $caption ) . '">';

					$html = str_replace( $matches[1], $new_a, $html );
				}
			}
		}
	}

	return $html;
}

add_filter( 'the_title', 'blockchain_lite_replace_the_title', 10, 2 );
if ( ! function_exists( 'blockchain_lite_replace_the_title' ) ) :
	function blockchain_lite_replace_the_title( $title, $id ) {
		if ( is_admin() ) {
			return $title;
		}

		$alt_title = get_post_meta( $id, 'title', true );

		if ( $alt_title ) {
			$title = $alt_title;
		}

		return $title;
	}
endif;

add_action( 'wp', 'blockchain_lite_hero_hide_woocommerce_shop_title' );
if ( ! function_exists( 'blockchain_lite_hero_hide_woocommerce_shop_title' ) ) :
	// This function needs to be called on 'wp' or later, as blockchain_lite_get_hero_data() utilizes WC conditional tags.
	// If a need arises to call earlier, then the shop's page ID must be passed explicitly to blockchain_lite_get_hero_data().
	function blockchain_lite_hero_hide_woocommerce_shop_title() {
		$hero = blockchain_lite_get_hero_data();
		if ( $hero['page_title_hide'] ) {
			add_filter( 'woocommerce_show_page_title', '__return_false' );
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		}
	}
endif;

// Wraps the core's archive widget's post counts in span.ci-count
add_filter( 'get_archives_link', 'blockchain_lite_wrap_archive_widget_post_counts_in_span', 10, 2 );
if ( ! function_exists( 'blockchain_lite_wrap_archive_widget_post_counts_in_span' ) ) :
	function blockchain_lite_wrap_archive_widget_post_counts_in_span( $output ) {
		$output = preg_replace_callback( '#(<li>.*?<a.*?>.*?</a>.*?)&nbsp;(\(.*?\))(.*?</li>)#', 'blockchain_lite_replace_archive_widget_post_counts_in_span', $output );

		return $output;
	}
endif;

if ( ! function_exists( 'blockchain_lite_replace_archive_widget_post_counts_in_span' ) ) :
	function blockchain_lite_replace_archive_widget_post_counts_in_span( $matches ) {
		return sprintf( '%s <span class="ci-count">%s</span>%s',
			$matches[1],
			$matches[2],
			$matches[3]
		);
	}
endif;

// Wraps the core's category widget's post counts in span.ci-count
add_filter( 'wp_list_categories', 'blockchain_lite_wrap_category_widget_post_counts_in_span', 10, 2 );
if ( ! function_exists( 'blockchain_lite_wrap_category_widget_post_counts_in_span' ) ) :
	function blockchain_lite_wrap_category_widget_post_counts_in_span( $output, $args ) {
		if ( ! isset( $args['show_count'] ) || 0 === (int) $args['show_count'] ) {
			return $output;
		}
		$output = preg_replace_callback( '#(<a.*?>)\s*?(\(.*?\))#', 'blockchain_lite_replace_category_widget_post_counts_in_span', $output );

		return $output;
	}
endif;

if ( ! function_exists( 'blockchain_lite_replace_category_widget_post_counts_in_span' ) ) :
	function blockchain_lite_replace_category_widget_post_counts_in_span( $matches ) {
		return sprintf( '%s <span class="ci-count">%s</span>',
			$matches[1],
			$matches[2]
		);
	}
endif;


function blockchain_lite_header_is_overlaid() {
	$is_overlaid = false;

	if ( is_singular() ) {
		$overlaid = get_post_meta( get_queried_object_id(), 'blockchain_lite_header_overlaid', true );
		if ( $overlaid ) {
			$is_overlaid = true;
		}
	}

	return apply_filters( 'blockchain_lite_header_is_overlaid', $is_overlaid );
}

add_filter( 'blockchain_lite_header_classes', 'blockchain_lite_add_header_classes' );
function blockchain_lite_add_header_classes( $classes ) {
	if ( blockchain_lite_header_is_overlaid() ) {
		$classes[] = 'header-overlaid';
	}

	return $classes;
}

add_filter( 'blockchain_lite_head_mast_classes', 'blockchain_lite_add_head_mast_classes' );
function blockchain_lite_add_head_mast_classes( $classes ) {
	if ( blockchain_lite_header_is_overlaid() ) {
		$classes[] = 'over-background';
	}

	return $classes;
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
add_action( 'wp_body_open', 'blockchain_lite_skip_link', 5 );
function blockchain_lite_skip_link() {
	?><div><a class="skip-link sr-only sr-only-focusable" href="#site-content"><?php esc_html_e( 'Skip to the content', 'blockchain-lite' ); ?></a></div><?php
}

/**
 * Add wrapper to embedded items to apply responsive styling.
 */
add_filter( 'embed_oembed_html', 'blockchain_lite_oembed_responsive_wrapper', 10, 4 );
function blockchain_lite_oembed_responsive_wrapper( $cache, $url, $attr, $post_ID ) {
	if ( empty( $cache ) ) {
		return $cache;
	}

	$url_patterns = array(
		'youtube.com',
		'youtu.be',
		'youtube-nocookie.com', // This doesn't seem to embed anything.
		'vimeo.com',
		'dailymotion.com',
		'dai.ly', // This doesn't seem to embed anything.
		'hulu.com',
		'wordpress.tv',
		'slideshare.net',
	);

	$match = false;

	foreach ( $url_patterns as $url_pattern ) {
		$pattern = 'https?://.*?' . preg_quote( $url_pattern, '#' );
		if ( preg_match( '#' . $pattern . '#', $url ) ) {
			$match = true;
			break;
		}
	}

	if ( $match ) {
		$cache = '<div class="blockchain-lite-responsive-embed">' . $cache . '</div>';
	}

	return $cache;
}

add_filter( 'wp_page_menu', 'blockchain_lite_wp_page_menu', 10, 2 );
function blockchain_lite_wp_page_menu( $menu, $args ) {
	$menu = preg_replace( '#^<div .*?>#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul id="' . esc_attr( $args['menu_id'] ) . '" class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}

add_filter( 'tiny_mce_before_init', 'blockchain_lite_insert_wp_editor_formats' );
function blockchain_lite_insert_wp_editor_formats( $init_array ) {
	$style_formats = array(
		array(
			'title'   => esc_html__( 'Intro text (big text)', 'blockchain-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-intro',
			'wrapper' => true,
		),
		array(
			'title'   => esc_html__( '2 Column Text', 'blockchain-lite' ),
			'block'   => 'div',
			'classes' => 'entry-content-column-split',
			'wrapper' => true,
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'mce_buttons_2', 'blockchain_lite_mce_buttons_2' );
function blockchain_lite_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
