<?php
defined( 'ABSPATH' ) OR exit; 
/**
 * Plugin Name: EDD Download Shortcodes
 * Plugin URI: http://Extend.BT4.ME/downloads/EDD-Download-Extendify/
 * Description: This plugin will provide the ability to customize how your Easy Digital Downloads will display through the use of highly customizable shortcodes.
 * Version: 1.0
 * Author: Bento4Extend
 * Author URI: http://Extend.BT4.ME/
 */

function EDD_Extendify_on_activation()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "activate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}

function EDD_Extendify_on_deactivation()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
    check_admin_referer( "deactivate-plugin_{$plugin}" );

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}

function EDD_Extendify_on_uninstall()
{
    if ( ! current_user_can( 'activate_plugins' ) )
        return;
    check_admin_referer( 'bulk-plugins' );

    // Important: Check if the file is the one
    // that was registered during the uninstall hook.
    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
        return;

    # Uncomment the following line to see the function in action
    # exit( var_dump( $_GET ) );
}

register_activation_hook(   __FILE__, 'EDD_Extendify_on_activation' );
register_deactivation_hook( __FILE__, 'EDD_Extendify_on_deactivation' );
register_uninstall_hook(    __FILE__, 'EDD_Extendify_on_uninstall' );
define("ROOT_PATH", plugin_dir_path( __FILE__ ) );
define("ROOT", plugin_dir_url( __FILE__ ) );
include (ROOT_PATH.'shortcodes/all.php');

// Plugins document Link

add_filter( 'plugin_row_meta', 'custom_plugin_row_meta', 10, 2 );

function custom_plugin_row_meta( $links, $file ) {

	if ( strpos( $file, 'edd-download-themify.php' ) !== false ) {
		$new_links = array(
					'<a href="http://extend.bt4.me/documentation/edd-download-extendify/" target="_blank">Documentation</a>',
					'<a href="http://extend.bt4.me/downloads/EDD-Download-Extendify/" target="_blank">Full Premium Plugin</a>',
					'<a href="http://extend.bt4.me/downloads/EDD-Checkout-Extendify/" target="_blank">EDD Checkout Extendify</a>'
				);
		
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}