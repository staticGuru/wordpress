<?php
add_action( 'admin_init', 'blockchain_lite_admin_setup_hide_single_featured' );
function blockchain_lite_admin_setup_hide_single_featured() {
	if ( current_theme_supports( 'blockchain-lite-hide-single-featured' ) ) {
		$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
		$hide_featured_support = $hide_featured_support[0];

		foreach ( $hide_featured_support as $supported_post_type ) {
			add_meta_box( 'blockchain-lite-single-featured-visibility', esc_html__( 'Featured Image Visibility', 'blockchain-lite' ), 'blockchain_lite_single_featured_visibility_metabox', $supported_post_type, 'side', 'default' );
		}
	}

	add_action( 'save_post', 'blockchain_lite_hide_single_featured_save_post' );
}

add_action( 'init', 'blockchain_lite_setup_hide_single_featured' );
function blockchain_lite_setup_hide_single_featured() {
	if ( current_theme_supports( 'blockchain-lite-hide-single-featured' ) ) {
		add_filter( 'get_post_metadata', 'blockchain_lite_hide_single_featured_get_post_metadata', 10, 4 );
	}
}

function blockchain_lite_single_featured_visibility_metabox( $object, $box ) {
	$fieldname = 'blockchain_lite_hide_single_featured';
	$checked   = get_post_meta( $object->ID, $fieldname, true );

	?>
		<input type="checkbox" id="<?php echo esc_attr( $fieldname ); ?>" class="check" name="<?php echo esc_attr( $fieldname ); ?>" value="1" <?php checked( $checked, 1 ); ?> />
		<label for="<?php echo esc_attr( $fieldname ); ?>"><?php esc_html_e( "Hide when viewing this post's page", 'blockchain-lite' ); ?></label>
	<?php
	wp_nonce_field( 'blockchain_lite_hide_single_featured_nonce', '_blockchain_lite_hide_single_featured_meta_box_nonce' );
}

function blockchain_lite_hide_single_featured_get_post_metadata( $value, $post_id, $meta_key, $single ) {
	$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return $value;
	}

	if ( '_thumbnail_id' === $meta_key && ( is_single( $post_id ) || is_page( $post_id ) ) && get_post_meta( $post_id, 'blockchain_lite_hide_single_featured', true ) ) {
		return false;
	}

	return $value;
}

function blockchain_lite_hide_single_featured_save_post( $post_id ) {
	$hide_featured_support = get_theme_support( 'blockchain-lite-hide-single-featured' );
	$hide_featured_support = $hide_featured_support[0];

	if ( ! in_array( get_post_type( $post_id ), $hide_featured_support, true ) ) {
		return;
	}

	if ( isset( $_POST['_blockchain_lite_hide_single_featured_meta_box_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['_blockchain_lite_hide_single_featured_meta_box_nonce'] ), 'blockchain_lite_hide_single_featured_nonce' ) ) {
		update_post_meta( $post_id, 'blockchain_lite_hide_single_featured', isset( $_POST['blockchain_lite_hide_single_featured'] ) ); // Input var okay.
	}
}
