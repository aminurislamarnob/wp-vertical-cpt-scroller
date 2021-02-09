<?php
/**
 * Enqueue Styles & Scripts of this plugin
 */
function wpvcps_front_assets() {
    //Plugin Styles
    wp_enqueue_style('wpvcps-style', WPVCPS_FRONT_ASSETS . 'assets/wpvcps-style.css', array(), WPVCPS_PLUGIN_VERSION);

    //Plugin Scripts
    wp_enqueue_script( 'wpvcps-vticker', WPVCPS_FRONT_ASSETS . 'assets/jquery.vticker.js', array('jquery'), WPVCPS_PLUGIN_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'wpvcps_front_assets' );