<?php 
/**
 * Plugin Name:       Easy Facebook Likebox
 * Plugin URI:        httt://wordpress.org/plugins/easy-facebook-likebox
 * Description:       Easy Facebook like box WordPress plugin allows you to easly display facebook like box fan page on your website using either widget or shortcode to increase facbook fan page likes. You can use the shortcode generated after saving the facebook like box widget. Its completely customizable with lots of optional settings. Its also responsive facebook like box at the same time.
 * Version:           3.1
 * Author:            Sajid Javed
 * Author URI:        http://jwebsol.com
 * Text Domain:       easy-facebook-likebox
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/easy-facebook-likebox.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
register_activation_hook( __FILE__, array( 'Easy_Facebook_Likebox', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Easy_Facebook_Likebox', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
add_action( 'plugins_loaded', array( 'Easy_Facebook_Likebox', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name-admin.php` with the name of the plugin's admin file
 * - replace Plugin_Name_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/easy-facebook-likebox-admin.php' );
	add_action( 'plugins_loaded', array( 'Easy_Facebook_Likebox_Admin', 'get_instance' ) );

}


/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * Including widget class.
 */
 
require_once( plugin_dir_path( __FILE__ ) . 'includes/easy-facebook-likebox-widget.php' );
// register Foo_Widget widget
function register_fblx_widget() {
    register_widget( 'Easy_Facebook_Like_Box_Widget' );
}
add_action( 'widgets_init', 'register_fblx_widget' );