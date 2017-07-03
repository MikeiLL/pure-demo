<?php

namespace Roots\Sage\HeroRender;

	/**
	 * Render the page hero
	 */

	// Get hero content
	function puredemo_get_hero_content( $post_id = null ) {

		// Get the post ID
		global $post;

		$post_id = $post_id ? $post_id : $post->ID;

		// Get hero
		$hero = get_post_meta( $post_id, 'puredemo_page_hero', true );
		$is_hero = is_array( $hero );

		// Get post thumbnail
		$is_thumbnail = has_post_thumbnail( $post_id );
		$thumbnail_id = $is_thumbnail ? get_post_thumbnail_id() : null;

		return array(
			'content'              => $is_hero && array_key_exists( 'content', $hero ) ? stripslashes( $hero['content'] ) : null,
			'image'                => $is_hero && array_key_exists( 'image', $hero ) ? $hero['image'] : null,
			'overlay'              => $is_hero && array_key_exists( 'overlay', $hero ) ? $hero['overlay'] : null,
			'img'                  => $is_thumbnail ? wp_get_attachment_image_src( $thumbnail_id, 'full', true ) : null,
			'min_height'           => $is_hero && array_key_exists( 'min_height', $hero ) ? $hero['min_height'] : null,
			'overlay_styling'           => $is_hero && array_key_exists( 'overlay_styling', $hero ) ? $hero['overlay_styling'] : null,
		);

	}



	// Determine if a post has a hero
	function puredemo_has_hero( $post_id = null ) {

		// Return false on blog posts and 404 pages
		if ( is_home() || is_single() || is_404() ) return false;

		// Get the post ID
		global $post;

		if ( $post_id = null ) return false;

		// Get hero content
		$hero = puredemo_get_hero_content( $post_id );

		return ( empty( $hero['content'] ) && empty( $hero['image'] ) && empty( $hero['img'] ) ) ? false : true;

	}



	// Generate hero markup
	function puredemo_get_hero( $post_id = null ) {

		// Get the post ID
		global $post;
		$post_id = $post_id ? $post_id : $post->ID;

		// Get hero
		$hero = puredemo_get_hero_content( $post_id );

		// If no hero, bail
		if ( empty( $hero['content'] ) && empty( $hero['image'] ) && empty( $hero['img'] ) ) return;

		// Get hero image
		$check_image = wp_check_filetype( $hero['image'] );

		$image = ( strpos( $check_image['type'], 'image' ) === false ? wp_oembed_get( $hero['image'] ) : '<img src="' . $hero['image'] . '">' );
		preg_match("/^(rgba?)\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3}),\s*(\d*(?:\.\d+)?)\)$/", $hero['overlay_styling'], $overlay_styling);

		if ( empty( $hero['overlay_styling'] ) || count($overlay_styling) == 0) {
			$value_type = 'rgba';
			$overlay = '0, 0, 0';
			$transparency = '0.7';
		} else {
			$value_type = $overlay_styling[1];
			$overlay = $overlay_styling[2] . ', ' . $overlay_styling[3] . ', ' . $overlay_styling[4];
			$transparency = $overlay_styling[5];
		}

		$min_height = ( empty( $hero['min_height'] ) ? '' : 'min-height: ' . $hero['min_height'] . '; ' );

		?><div class="bg-hero <?php echo ( empty( $hero['img'] ) ? 'bg-muted' : 'bg-dark text-shadow' ); ?> margin-bottom" <?php if ( !empty( $hero['img'] ) ) { echo 'style="' . ( empty( $hero['min_height'] ) ? '' : 'min-height: ' . $hero['min_height'] . '; ' ) . 'background-image: ' . ( empty( $hero['overlay'] ) ? '' : 'linear-gradient( '.$value_type .'(' . $overlay . ', ' . $transparency . '), '.$value_type .'(' . $overlay . ', ' . $transparency . ') ),' ) . ' url(' . $hero['img'][0] . ');"'; } ?>>
					<div class="container <?php if ( !empty( $hero['content'] ) && !empty( $image ) ) { echo 'container-large'; } ?> <?php echo ( !empty( $hero['img'] ) && is_array( $hero['img'] ) && ( empty( $hero['content'] ) || empty( $image ) ) ? 'padding-top-xlarge padding-bottom-xlarge' : 'padding-top padding-bottom' ); ?>">
						<?php
							// If there's hero content AND video
							if ( !empty( $hero['content'] ) && !empty( $hero['image'] ) ) :
						?>
							<div class="row text-center">
								<div class="grid-half text-left-large">
									<?php echo do_shortcode( wpautop( $hero['content'] ) ); ?>
								</div>
								<div class="grid-half grid-flip margin-bottom">
									<?php echo $image; ?>
								</div>
							</div>
						<?php
							// If there's hero content, but no video
							// OR, if there's video, but no content
							elseif ( !empty( $hero['content'] ) || !empty( $hero['image'] ) ) :
						?>
							<div class="text-center">
								<?php echo do_shortcode( $hero['content'] ); ?>
								<?php echo $image; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
		<?php

	}

		function puredemo_get_her( $post_id = null ) {

		// Get the post ID
		global $post;
		$post_id = $post_id ? $post_id : $post->ID;

		// Get hero
		$hero = puredemo_get_hero_content( $post_id );

		// If product page or no hero, bail
		if ( get_post_type($post_id) == 'product' || empty( $hero['content'] ) && empty( $hero['image'] ) && empty( $hero['img'] ) ) return;

		// Get hero image
		$check_image = wp_check_filetype( $hero['image'] );

		$image = ( strpos( $check_image['type'], 'image' ) === false ? wp_oembed_get( $hero['image'] ) : '<img src="' . $hero['image'] . '">' );
		preg_match("/^(rgba?)\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3}),\s*(\d*(?:\.\d+)?)\)$/", $hero['overlay_styling'], $overlay_styling);

		if ( empty( $hero['overlay_styling'] ) || count($overlay_styling) == 0) {
			$value_type = 'rgba';
			$overlay = '0, 0, 0';
			$transparency = '0.7';
		} else {
			$value_type = $overlay_styling[1];
			$overlay = $overlay_styling[2] . ', ' . $overlay_styling[3] . ', ' . $overlay_styling[4];
			$transparency = $overlay_styling[5];
		}

		$min_height = ( empty( $hero['min_height'] ) ? '' : 'min-height: ' . $hero['min_height'] . '; ' );

		?>
		<div class="bg-hero <?php echo ( empty( $hero['img'] ) ? 'bg-muted' : 'bg-dark text-shadow' ); ?> margin-bottom" <?php if ( !empty( $hero['img'] ) ) { echo 'style="' . ( empty( $hero['min_height'] ) ? '' : 'min-height: ' . $hero['min_height'] . '; ' ) . 'background-image: ' . ( empty( $hero['overlay'] ) ? '' : 'linear-gradient( '.$value_type .'(' . $overlay . ', ' . $transparency . '), '.$value_type .'(' . $overlay . ', ' . $transparency . ') ),' ) . ' url(' . $hero['img'][0] . ');"'; } ?>>

					<div class="container <?php if ( !empty( $hero['content'] ) && !empty( $image ) ) { echo 'container-large'; } ?> <?php echo ( !empty( $hero['img'] ) && is_array( $hero['img'] ) && ( empty( $hero['content'] ) || empty( $image ) ) ? 'padding-top-xlarge padding-bottom-xlarge' : 'padding-top padding-bottom' ); ?>">
<?php
							// If there's hero content AND video
							if ( !empty( $hero['content'] ) && !empty( $hero['image'] ) ) :
						?>
							<div class="row text-center">
								<div class="grid-half text-left-large">
									<?php echo do_shortcode( wpautop( $hero['content'] ) ); ?>
								</div>
								<div class="grid-half grid-flip margin-bottom">
									<?php echo $image; ?>
								</div>
							</div>
						<?php
							// If there's hero content, but no video
							// OR, if there's video, but no content
							elseif ( !empty( $hero['content'] ) || !empty( $hero['image'] ) ) :
						?>
							<div class="text-center">
								<?php echo do_shortcode( $hero['content'] ); ?>
								<?php echo $image; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
		<?php

	}
