<?php

/*-----------------------------------------------------------------------------------*/
/* Post Type Registering
/*-----------------------------------------------------------------------------------*/

$iron_post_types = array();
$iron_query = (object) array();
$use_dashicons = floatval($wp_version) >= 3.8;

function iron_register_post_types() {
	global $iron_post_types, $use_dashicons;

	$iron_post_types = array( 'album');

	$default_args = array(
		  'public'              => true
		, 'show_ui'             => true
		, 'show_in_menu'        => true
		, 'has_archive'         => true
		, 'query_var'           => true
		, 'exclude_from_search' => false
	);

/* Album Post Type (album)
   ========================================================================== */

	$album_args = $default_args;

	$album_args['labels'] = array(
		  'name'               => __('Discographies', 'pure-demo')
		, 'singular_name'      => __('Discography', 'pure-demo')
		, 'name_admin_bar'     => _x('Discography', 'add new on admin bar', 'pure-demo')
		, 'menu_name'          => __('Discographies', 'pure-demo')
		, 'all_items'          => __('All Discographies', 'pure-demo')
		, 'add_new'            => __('Add New', 'album', 'pure-demo')
		, 'add_new_item'       => __('Add New Discography', 'pure-demo')
		, 'edit_item'          => __('Edit Discography', 'pure-demo')
		, 'new_item'           => __('New Discography', 'pure-demo')
		, 'view_item'          => __('View Discography', 'pure-demo')
		, 'search_items'       => __('Search Discography', 'pure-demo')
		, 'not_found'          => __('No discographies found.', 'pure-demo')
		, 'not_found_in_trash' => __('No discographies found in the Trash.', 'pure-demo')
		, 'parent'             => __('Parent Discography:', 'pure-demo')
	);

	$album_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'custom-fields'
		, 'revisions'
	);

	if($use_dashicons)
		$album_args['menu_icon'] = 'dashicons-format-audio';

	register_post_type('album', $album_args, 1);

}

add_action('init', 'iron_register_post_types');

// Add the Events Meta Boxes

function add_events_metaboxes() {
	add_meta_box('pure_album_price', 'Price', 'pure_album_price', 'album', 'side', 'default');
}

add_action( 'add_meta_boxes', 'add_events_metaboxes' );

// The Event Location Metabox

function pure_album_price() {
	global $post;

	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// Get the location data if its already been entered
	$price = get_post_meta($post->ID, '_price', true);

	// Echo out the field
	echo '<input type="text" name="_price" value="' . $price  . '" class="widefat" />';

}

// Save the Metabox Data

function wpt_save_events_meta($post_id, $post) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.

	$events_meta['_price'] = $_POST['_price'];

	// Add values of $events_meta as custom fields

	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields

function reigel_woocommerce_get_price($price,$post){
	if ($post->post->post_type === 'album')
		$price = get_post_meta($post->id, "price", true);
	return $price;
}
add_filter('woocommerce_get_price','reigel_woocommerce_get_price',20,2);


/*-----------------------------------------------------------------------------------*/
/* Discography Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon

function iron_manage_album_columns ($columns)
{
	$iron_cols = array(
		  'alb_release_date' => __('Release Date', 'pure-demo')
		, 'alb_tracklist'    => __('# Tracks', 'pure-demo')
		, 'alb_store_list'   => __('# Stores', 'pure-demo')
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	return $columns;
}

add_filter('manage_album_posts_columns', 'iron_manage_album_columns');


