<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/dmilegal
 * @since             1.0.0
 * @package           Lb_Breadcrumb
 *
 * @wordpress-plugin
 * Plugin Name:       LB Breadcrumb
 * Plugin URI:        https://https://github.com/dmilegal/lb-breadcrumb
 * Description:       Custom breadcrumbs
 * Version:           1.0.0
 * Author:            DK
 * Author URI:        https://https://github.com/dmilegal/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lb-breadcrumb
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LB_BREADCRUMB_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lb-breadcrumb-activator.php
 */
function activate_lb_breadcrumb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lb-breadcrumb-activator.php';
	Lb_Breadcrumb_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lb-breadcrumb-deactivator.php
 */
function deactivate_lb_breadcrumb() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lb-breadcrumb-deactivator.php';
	Lb_Breadcrumb_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lb_breadcrumb' );
register_deactivation_hook( __FILE__, 'deactivate_lb_breadcrumb' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lb-breadcrumb.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lb_breadcrumb() {

	$plugin = new Lb_Breadcrumb();
	$plugin->run();

}
run_lb_breadcrumb();
