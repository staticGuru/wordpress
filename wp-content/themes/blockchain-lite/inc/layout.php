<?php
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blockchain_lite_content_width() {
	$content_width = $GLOBALS['content_width'];

	if ( is_page_template( 'templates/full-width-page.php' )
		|| is_page_template( 'templates/builder.php' )
	) {
		$content_width = 1140;
	} elseif ( is_singular() || is_home() || is_archive() ) {
		$info          = blockchain_lite_get_layout_info();
		$content_width = $info['content_width'];
	}

	$GLOBALS['content_width'] = apply_filters( 'blockchain_lite_content_width', $content_width );
}
add_action( 'template_redirect', 'blockchain_lite_content_width', 0 );

if ( ! function_exists( 'blockchain_lite_get_columns_classes' ) ) :
	function blockchain_lite_get_columns_classes( $columns ) {
		switch ( intval( $columns ) ) {
			case 1:
				$classes = 'col-12';
				break;
			case 2:
				$classes = 'col-sm-6 col-12';
				break;
			case 3:
				$classes = 'col-lg-4 col-sm-6 col-12';
				break;
			case 4:
			default:
				$classes = 'col-xl-3 col-sm-6 col-12';
				break;
		}

		return apply_filters( 'blockchain_lite_get_columns_classes', $classes, $columns );
	}
endif;


if ( ! function_exists( 'blockchain_lite_has_sidebar' ) ) :
	/**
	 * Determine if a sidebar is being displayed.
	 */
	function blockchain_lite_has_sidebar() {
		$has_sidebar = false;

		if ( blockchain_lite_is_woocommerce_with_sidebar() ) {
			$has_sidebar = is_active_sidebar( 'shop' );
		} elseif ( blockchain_lite_is_woocommerce_without_sidebar() ) {
			$has_sidebar = false;
		} elseif ( is_home() || is_archive() ) {
			if ( get_theme_mod( 'archive_sidebar', 1 ) && is_active_sidebar( 'sidebar-1' ) ) {
				$has_sidebar = true;
			}
		} elseif ( ! is_page() && is_active_sidebar( 'sidebar-1' ) ) {
			$has_sidebar = true;
		} elseif ( is_page() && is_active_sidebar( 'sidebar-2' ) ) {
			$has_sidebar = true;
		}

		return apply_filters( 'blockchain_lite_has_sidebar', $has_sidebar );
	}
endif;

if ( ! function_exists( 'blockchain_lite_get_layout_info' ) ) :
	/**
	 * Return appropriate layout information.
	 */
	function blockchain_lite_get_layout_info() {
		$has_sidebar = blockchain_lite_has_sidebar();

		$classes = array(
			'container_classes' => $has_sidebar ? 'col-lg-9 col-12' : 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
			'sidebar_classes'   => $has_sidebar ? 'col-lg-3 col-12' : '',
			'content_width'     => $has_sidebar ? 850 : 750,
			'has_sidebar'       => $has_sidebar,
		);

		if ( is_singular() ) {
			if ( 'left' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
				$classes = array(
					'container_classes' => $has_sidebar ? 'col-lg-9 push-lg-3 col-12' : 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
					'sidebar_classes'   => $has_sidebar ? 'col-lg-3 pull-lg-9 col-12' : '',
					'content_width'     => 850,
					'has_sidebar'       => $has_sidebar,
				);
			} elseif ( 'none' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
				$classes = array(
					'container_classes' => 'col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-12',
					'sidebar_classes'   => '',
					'content_width'     => 750,
					'has_sidebar'       => false,
				);
			}
		} elseif ( is_home() || is_archive() ) {
			// 1 will get default narrow fullwidth classes. 2 and 3 will get fullwidth.
			if ( 1 !== (int) get_theme_mod( 'archive_layout', blockchain_lite_archive_layout_default() ) ) {
				if ( ! $has_sidebar ) {
					$classes = array(
						'container_classes' => 'col-12',
						'sidebar_classes'   => '',
						'content_width'     => 1140,
						'has_sidebar'       => false,
					);
				}
			}
		}

		$non_narrow_templates = apply_filters( 'blockchain_lite_non_narrow_templates', array() );
		if ( is_page_template( $non_narrow_templates ) ) {
			if ( ! $has_sidebar || 'none' === get_post_meta( get_the_ID(), 'blockchain_lite_sidebar', true ) ) {
				$classes['container_classes'] = 'col-12';
				$classes['sidebar_classes']   = '';
				$classes['content_width']     = 1140;
			}
		} elseif ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
			if ( ( ( is_shop() || is_product_taxonomy() ) && ! $has_sidebar ) || is_product() ) {
				$classes['container_classes'] = 'col-12';
				$classes['sidebar_classes']   = '';
				$classes['content_width']     = 1140;
			}
		}

		return apply_filters( 'blockchain_lite_layout_info', $classes, $has_sidebar );
	}
endif;

