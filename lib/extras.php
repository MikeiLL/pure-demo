<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  $classes[] = 'no-js';

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'pure-demo') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


	/**
	 * Get saved markdown content if it exists and Jetpack is active. Otherwise, get HTML.
	 * @param  array  $options  Array with HTML and markdown content
	 * @param  string $name     The name of the content
	 * @param  string $suffix   The suffix to denote the markdown version of the content
	 * @return string           The content
	 */
	function get_jetpack_markdown( $options, $name, $suffix = '_markdown' ) {

		// If markdown class is defined, get markdown content
		if ( class_exists( 'WPCom_Markdown' ) && array_key_exists( $name . $suffix, $options ) && !empty( $options[$name . $suffix] ) ) {
			return $options[$name . $suffix];
		}

		// Else, return HTML
		return $options[$name];

	}

		/**
	 * Convert markdown to HTML using Jetpack
	 * @param  string $content Markdown content
	 * @return string          Converted content
	 */
	function process_jetpack_markdown( $content ) {

		// If markdown class is defined, convert content
		if ( class_exists( 'WPCom_Markdown' ) ) {

			// Get markdown library
			jetpack_require_lib( 'markdown' );

			// Return converted content
			return WPCom_Markdown::get_instance()->transform( $content );

		}

		// Else, return content
		return $content;

	}

/**
 * Appends our custom CSS to the global kirki-generated CSS.
 *
 * @return string
 */
function aristath_add_custom_css_to_dynamic_css( $css ) {
    // Get the custom CSS
    $custom_css = get_theme_mod( 'puredemo_custom_css', '' );
    // Append our custom CSS to the Kirki-generated custom-css
    // and return the result

    return $css . $custom_css;
}
// Please make sure you replace "my_config" with your actual config-id.
add_filter( 'kirki/pure-demo/dynamic_css', __NAMESPACE__ . '\\aristath_add_custom_css_to_dynamic_css' );

/**
 * Allow HTML in short description/excerpts.
 * Source: http://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt
 **/
function wpse_allowedtags() {
    // Add custom tags to this string
        return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>';
    }

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) :

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {

    $raw_excerpt = $wpse_excerpt;

        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) {

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' <a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&raquo;&nbsp;' . sprintf(__( 'Read more about: %s &nbsp;&raquo;', 'wpse' ), get_the_title()) . '</a>';
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */

            return $wpse_excerpt;

        }
        return apply_filters(__NAMESPACE__ . '\\wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif;

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', __NAMESPACE__ . '\\wpse_custom_wp_trim_excerpt');

  /**
   * Count number of widgets in a sidebar
   * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
   * Source: https://generatewp.com/snippet/2V0V0gy/
   */
    function pure_demo_count_widgets( $sidebar_id ) {
      // If loading from front page, consult $_wp_sidebars_widgets rather than options
      // to see if wp_convert_widget_settings() has made manipulations in memory.
      global $_wp_sidebars_widgets;
      if ( empty( $_wp_sidebars_widgets ) ) :
        $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
      endif;

      $sidebars_widgets_count = $_wp_sidebars_widgets;

      if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
        $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
        $widget_classes = 'pure-u-1-' . count( $sidebars_widgets_count[ $sidebar_id ] );
        return $widget_classes;
      endif;
    }

/*** Begin WooCommerce Customization ***/

/*
Plugin Name: My WooCommerce Modifications
Plugin URI: http://woothemes.com/
Description: Modificatinos to my WooCommerce site
Version: 1.0
Author: Patrick Rauland
Author URI: http://www.patrickrauland.com/
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Source: https://gist.github.com/BFTrick/4996955
*/
/*  Copyright 2013  Patrick Rauland

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


  // remove default woocommerce actions
  function pure_demo_woocommerce_modifications()
  {
      // hide product price on category page
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

      // hide add to cart button on category page
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
      remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 50 );
      add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  }

  add_action( 'init', __NAMESPACE__ . '\\pure_demo_woocommerce_modifications' );


  /**
   * Show full description in single product page, not excerpt.
   * Source: http://stackoverflow.com/a/22636114/2223106
   **/
  function pure_demo_woocommerce_template_product_description() {
    wc_get_template( 'single-product/tabs/description.php' );
  }
  /* I think we do want tab for description so takes entire width. */
  //add_action( 'woocommerce_single_product_summary', __NAMESPACE__ . '\\pure_demo_woocommerce_template_product_description', 60 );

  /**
   * Change the heading title on the "Product Description" tab section for single products.
   * Source: https://isabelcastillo.com/change-product-description-title-woocommerce
   */
  function pure_demo_product_description_heading() {
      return 'More About This Project';
  }

  add_filter( 'woocommerce_product_description_tab_title', __NAMESPACE__ . '\\pure_demo_product_description_heading' );

  function pure_demo_woo_remove_product_tabs( $tabs ) {

    //unset( $tabs['description'] );        // Remove the description tab
    unset( $tabs['reviews'] );            // Remove the reviews tab
    unset( $tabs['additional_information'] );      // Remove the additional information tab

    return $tabs;

  }
  add_filter( 'woocommerce_product_tabs', __NAMESPACE__. '\\pure_demo_woo_remove_product_tabs', 98 );

  /**
   * Change the Shop archive page title.
   * @param  string $title
   * @return string
   *
   * Source: https://nicola.blog/2016/03/29/change-shop-page-title/
   */
  function wc_pure_demo_archive_title( $title ) {
      if ( is_shop() && isset( $title['title'] ) ) {
          $title['title'] = 'Discography';
      }

      return $title;
  }
  add_filter( 'document_title_parts', __NAMESPACE__. '\\wc_pure_demo_archive_title' );

  /* Remove woocommerce title page and product summaries
   * Source: https://roots.io/using-woocommerce-with-sage/
   */
  add_filter( 'woocommerce_show_page_title', '__return_false' );
  remove_action('woocommerce_single_product_summary', __NAMESPACE__ . '\\woocommerce_template_single_title', 5);

} /* End if WooCommerce Active */
  /*** End WooCommerce Customization ***/
