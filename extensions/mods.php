<?php
/**
 * @package Portfolio Press
 */

/**
 * Helper function to get saved options
 */
function puredemo_get_option( $name, $default = false ) {

	$options = get_option( 'puredemo' );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}

/**
 * Adds a body class to indicate sidebar position
 */
function puredemo_body_class_options( $classes ) {

	// Layout options
	$classes[] = puredemo_get_option( 'layout', 'layout-2cr' );

	// Clear the menu if selected
	if ( puredemo_get_option( 'menu_position', false ) == 'clear' ) {
		$classes[] = 'clear-menu';
	}

	return $classes;
}
add_filter( 'body_class', 'puredemo_body_class_options' );

/**
 * Favicon Option
 */
function portfolio_favicon() {

	$favicon = puredemo_get_option( 'custom_favicon', false );
	if ( $favicon ) : ?>
        <link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>" />
    <?php endif;

    $logo_apple_touch = puredemo_get_option( 'logo_apple_touch', false );
	if ( $logo_apple_touch ) : ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url( $logo_apple_touch ); ?>" />
	<?php endif;

}
add_action( 'wp_head', 'portfolio_favicon' );

/**
 * Menu Position Option
 */
function puredemo_head_css() {

		// var_dump( get_option( 'puredemo' ) );

		$output = '';

		$mod = puredemo_get_option( 'header_color', '#000000' );
		$color = sanitize_hex_color( $mod );

		if ( "#000000" != $color ) {
			$output .= "#branding { background:" . $color . " }\n";
		}

		// Output styles
		if ( $output <> '') {
			$output = "<!-- Portfolio Press Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		}
}
add_action( 'wp_head', 'puredemo_head_css' );

/**
 * Removes image and gallery post formats from is_home if option is set
 */
function puredemo_exclude_post_formats( $query ) {
	if (
		! puredemo_get_option( 'display_image_gallery_post_formats', true ) &&
		$query->is_main_query() &&
		$query->is_home()
	) {
		$tax_query = array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array(
					'post-format-image',
					'post-format-gallery'
				),
				'operator' => 'NOT IN',
			)
		);
		$query->set( 'tax_query', $tax_query );
	}
}
add_action( 'pre_get_posts', 'puredemo_exclude_post_formats' );