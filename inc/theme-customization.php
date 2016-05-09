<?php

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
		add_action( 'admin_menu', 'my_footer_shh' );
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
    return ($options ? '-fluid' : '');
}

//var_dump( get_theme_mod( 'logo_align', 'left' ) );
