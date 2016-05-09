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
		'all_items'             => __( 'All Items', 'businessportfolio' ),
		'add_new_item'          => __( 'Add New Item', 'businessportfolio' ),
		'add_new'               => __( 'Add New', 'businessportfolio' ),
		'new_item'              => __( 'New Item', 'businessportfolio' ),
		'edit_item'             => __( 'Edit Item', 'businessportfolio' ),
		'update_item'           => __( 'Update Item', 'businessportfolio' ),
		'view_item'             => __( 'View Item', 'businessportfolio' ),
		'search_items'          => __( 'Search Item', 'businessportfolio' ),
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
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
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

}

function businessportfolio_login_logo() { ?>
		<?php if ( get_header_image() ) { ?>
			<style type="text/css">
					.login h1 a {
							background-image: url(<?php echo header_image(); ?>) !important;
							padding-bottom: 30px !important;
							width: 100% !important;
							height: auto !important;
							background-size: 100% !important;
					}
			</style>
		<?php } ?>
<?php }

if (get_theme_mod( 'use_logo_in_admin_login', array() )) {
		add_action( 'login_enqueue_scripts', 'businessportfolio_login_logo' );
		add_action( 'wp_before_admin_bar_render', 'businessportfolio_remove_wp_logo' );
}

function my_footer_shh() {
    if ( ! current_user_can('manage_options') ) {
        remove_filter( 'update_footer', 'core_update_footer' );
				//add_filter('show_admin_bar', '__return_false');
				add_filter('admin_footer_text', 'businessportfolio_remove_footer_admin');
    }
}

function businessportfolio_remove_footer_admin () {
	echo get_theme_mod( 'admin_footer_text_replace', 'Business Portfolio Theme');
}

add_action( 'admin_menu', 'my_footer_shh' );

function  businessportfolio_remove_wp_logo() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
}


function remove_menus () {
global $menu;
                // We define which menu/submenu items we want to restrict
        $restricted = array(__('Users'),__('Profile'));
        end ($menu);
        while (prev($menu)){
            $value = explode(' ',$menu[key($menu)][0]);
            if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
        }
}
/*
if ( current_user_can( 'edit_users' ) ) {
add_action('admin_menu', 'remove_menus');
}
*/

function get_fluid_toggle() {
    $options = get_theme_mod( 'fluid_toggle', array() );
    $value = $default;
    if ( isset( $options[ $setting ] ) ) {
        $value = $options[ $setting ];
    }
    return ($options ? '' : '-fluid');
}
