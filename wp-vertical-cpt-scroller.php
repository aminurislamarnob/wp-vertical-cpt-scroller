<?php
/*
Plugin Name: WP Vertical CPT Scroller
Plugin URI:
Description: WordPress Vertical Custom Posts or Post Scroller.
Version: 1.1
Author: Jakarea Parvez
Author URI: 
License: GPLv2 or later
Text Domain: wpv-cp-sc
Domain Path: /languages
*/

/**
 * Restrict this file to call directly
 */
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Currently plugin version.
 */
define('WPVCPS_PLUGIN_VERSION', '1.0');


/**
 * Load plugin textdomain.
 */
function wpvcps_load_textdomain() {
    load_plugin_textdomain( 'wpv-cp-sc', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'wpvcps_load_textdomain' );


/***
* Plugin Directory
**/
define( 'WPVCPS_DIR',  plugin_dir_path( __FILE__ ) );
define( 'WPVCPS_ADMIN_ASSETS',  plugin_dir_url( __FILE__ ) . "admin/" );
define( 'WPVCPS_FRONT_ASSETS',  plugin_dir_url( __FILE__ ) . "public/");


/****
* Include Admin & Public Assets
***/
require WPVCPS_DIR . 'public/wpvcps-public.php';


/****
* Include Settings Page
***/
require WPVCPS_DIR . 'includes/admin/page-settings/admin-settings.php';


/****
* Include Shortcode
***/
require WPVCPS_DIR . 'includes/front/latest-post-shortcode.php';



/**
 * Add settings page link with plugin.
 */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wpvcps_vertical_scroll_action_link' );
function wpvcps_vertical_scroll_action_link( $links ){
    $wpvcps_action_links = array(
    '<a href="' . admin_url( 'admin.php?page=wpvcps_vertical_scroll' ) . '"> '. __('Settings', 'wpv-cp-sc') . '</a>',
    );
    return array_merge( $links, $wpvcps_action_links );
}