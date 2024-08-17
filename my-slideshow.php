<?php
/**
 * Plugin Name: My Slideshow
 * Plugin URI: #
 * Description: This plugin to add a slideshow of images using a shortcode.
 * Version: 1.0.0
 * Author: Bhavesh Vala
 * Author URI: #
 * Text Domain: my-slideshow
 * Requires at least: 6.3
 * Requires PHP: 7.4
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

/**
 * If this file is called directly.
 * abort.
 * @since 1.0.0
 */
defined('ABSPATH') || exit;

/**
 * Currently plugin defines.
 * @since 1.0.0
 */
define('MY_SLIDESHOW_VERSION', '1.0.0');
define('MY_SLIDESHOW_PATH', plugin_dir_path(__FILE__));
define('MY_SLIDESHOW_URL', plugin_dir_url(__FILE__));

/**
 * Activation Hook
 * @since 1.0.0
 */
register_activation_hook(__FILE__, 'my_slideshow_activate');
function my_slideshow_activate() {
    if ( file_exists( MY_SLIDESHOW_PATH . 'inc/class-my-slideshow-activator.php' ) ) {
        require_once MY_SLIDESHOW_PATH . 'inc/class-my-slideshow-activator.php';
        My_Slideshow_Activator::activate();
    }
}

/**
 * Deactivation Hook
 * @since 1.0.0
 */
register_deactivation_hook(__FILE__, 'my_slideshow_deactivate');
function my_slideshow_deactivate() {
    if ( file_exists( MY_SLIDESHOW_PATH . 'inc/class-my-slideshow-deactivator.php' ) ) {
        require_once MY_SLIDESHOW_PATH . 'inc/class-my-slideshow-deactivator.php';
        My_Slideshow_Deactivator::deactivate();
    }
}

/**
 * The core plugin class that is used, admin-specific hooks, and public-facing site hooks.
 * @since 1.0.0
 */
if ( file_exists( MY_SLIDESHOW_PATH . 'inc/class-my-slideshow.php' ) ) {
    require_once MY_SLIDESHOW_PATH . 'inc/class-my-slideshow.php';
}

if ( file_exists( MY_SLIDESHOW_PATH . 'public/class-my-slideshow-public.php' ) ) {
    require_once MY_SLIDESHOW_PATH . 'public/class-my-slideshow-public.php';
}