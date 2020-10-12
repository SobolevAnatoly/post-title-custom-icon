<?php
/**
 * PostIcon
 *
 * @package           PostIcon
 * @author            Anatolii S.
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       PostIcon
 * Plugin URI:        https://github.com/SobolevAnatoly/post-title-custom-icon
 * Description:       Test task: adds an icon from dashicons set to the post title specified in the plugin settings
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.2
 * Author:            Anatolii S.
 * Author URI:
 * Text Domain:       posticon
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Don't access directly.
};

if ( defined( 'PI_VERSION' ) ) {
    // The user is attempting to activate a second plugin instance.
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
    require_once ABSPATH . 'wp-includes/pluggable.php';
    if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
        deactivate_plugins( plugin_basename( __FILE__ ) ); // Deactivate this plugin.
        // Inform that the plugin is deactivated.
        wp_safe_redirect( add_query_arg( 'deactivate', 'true', remove_query_arg( 'activate' ) ) );
        exit;
    }
}

define('PI_VERSION', '1.0.0');

define('PI_REQUIRED_WP_VERSION', '5.0');

define('PI_REQUIRED_PHP_VERSION', '7.2');

define('PI_PLUGIN', __FILE__);

define('PI_PLUGIN_BASENAME', plugin_basename(PI_PLUGIN));

define('PI_PLUGIN_NAME', trim(dirname(PI_PLUGIN_BASENAME), '/'));

define('PI_PLUGIN_DIR', untrailingslashit(dirname(PI_PLUGIN)));

define('PI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Check for required PHP version
if (version_compare(PHP_VERSION, PI_REQUIRED_PHP_VERSION, '<')) {
    exit(esc_html(sprintf('Post Icon requires PHP 7.2 or higher. You’re still on %s.', PHP_VERSION)));
}

// Check for required Wordpress version
if (version_compare(get_bloginfo('version'), PI_REQUIRED_WP_VERSION, '<')) {
    exit(esc_html(sprintf('Post Icon requires Wordpress 5.0 or higher. You’re still on %s.', get_bloginfo('version'))));
}

if (file_exists(PI_PLUGIN_DIR . '/vendor/autoload.php')) :
    require_once PI_PLUGIN_DIR . '/vendor/autoload.php';
endif;

if (class_exists('Posticon\\Init')) :
    new Posticon\Init();
endif;
