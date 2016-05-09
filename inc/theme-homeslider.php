<?php
if ( ! function_exists('homeslider_post_type') ) {

// Register Slider CPT
function homeslider_post_type() {

	$labels = array(
		'name'                  => _x( 'Home Sliders', 'Post Type General Name', 'businessportfolio' ),
		'singular_name'         => _x( 'Home Slider', 'Post Type Singular Name', 'businessportfolio' ),
		'menu_name'             => __( 'Home Slider', 'businessportfolio' ),
		'name_admin_bar'        => __( 'Home Slider', 'businessportfolio' ),
		'archives'              => __( 'Home Slider Archives', 'businessportfolio' ),
		'parent_item_colon'     => __( 'Parent Item:', 'businessportfolio' ),
		'all_items'             => __( 'All Sliders', 'businessportfolio' ),
		'add_new_item'          => __( 'Add New Slider', 'businessportfolio' ),
		'add_new'               => __( 'Add New Slider', 'businessportfolio' ),
		'new_item'              => __( 'New Slider', 'businessportfolio' ),
		'edit_item'             => __( 'Edit Slider', 'businessportfolio' ),
		'update_item'           => __( 'Update Slider', 'businessportfolio' ),
		'view_item'             => __( 'View Slider', 'businessportfolio' ),
		'search_items'          => __( 'Search Slider', 'businessportfolio' ),
		'not_found'             => __( 'Not found', 'businessportfolio' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'businessportfolio' ),
		'featured_image'        => __( 'Featured Image', 'businessportfolio' ),
		'set_featured_image'    => __( 'Set featured image', 'businessportfolio' ),
		'remove_featured_image' => __( 'Remove featured image', 'businessportfolio' ),
		'use_featured_image'    => __( 'Use as featured image', 'businessportfolio' ),
		'insert_into_item'      => __( 'Insert into item', 'businessportfolio' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'businessportfolio' ),
		'items_list'            => __( 'Items list', 'businessportfolio' ),
		'items_list_navigation' => __( 'Items list navigation', 'businessportfolio' ),
		'filter_items_list'     => __( 'Filter items list', 'businessportfolio' ),
	);
	$args = array(
		'label'                 => __( 'Home Slider', 'businessportfolio' ),
		'description'           => __( 'Home Page Slider Images', 'businessportfolio' ),
		'labels'                => $labels,
		'supports'              => array( 'editor', 'title',  'thumbnail', 'page-attributes', ),
		'taxonomies'            => array( '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
    'menu_icon'             => 'dashicons-format-gallery',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'homeslider', $args );

}

add_action( 'init', 'homeslider_post_type', 0 );

add_filter( 'manage_edit-homeslider_columns', 'set_custom_edit_homeslider_columns' );
add_action( 'manage_homeslider_posts_custom_column' , 'custom_homeslider_columns', 10, 2 );

function set_custom_edit_homeslider_columns( $columns ) {

    $columns['title'] = __( 'Image Title', 'businessportfolio' );
    return $columns;
}

function custom_homeslider_columns( $column, $post_id ) {
    switch ( $column ) {

        case 'title' :
            echo get_post_meta( $post_id, '_quote_post_pairname', true );
            break;

        case 'Featured Image' :
            echo get_post_meta( $post_id, 'thumbnail', true );
            break;
    }
}

}

function homeslider_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
        $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN

function homeslider_columns_head($defaults) {
    $defaults['featured_image'] = 'Featured Image';
    return $defaults;
}


// SHOW THE FEATURED IMAGE
function homeslider_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
        $post_featured_image = homeslider_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" height="100px"/>';
        }
    }
}

add_filter('manage_posts_columns', 'homeslider_columns_head');
add_action('manage_posts_custom_column', 'homeslider_columns_content', 10, 2);





function add_new_homeslider_column($homeslider_columns) {
  $homeslider_columns['menu_order'] = "Order";
  return $homeslider_columns;
}
add_action('manage_edit-homeslider_columns', 'add_new_homeslider_column');

/**
* show custom order column values
*/
function show_order_column($name){
  global $post;

  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_homeslider_posts_custom_column','show_order_column');

/**
* make column sortable
*/
function order_column_register_sortable($columns){
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-homeslider_sortable_columns','order_column_register_sortable');
