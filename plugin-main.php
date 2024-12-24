<?php
/**
 * Plugin Name: Rosaceus Info Manager
 * Description: Beheer en presenteer diverse type boekjes voor verenigingen.
 * Version: 1.0.0
 * Author: Jouw Naam
 * Text Domain: rosaceus-info-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Autoload classes
spl_autoload_register(function ($class) {
    $prefix = 'WPPlugin\\';
    $base_dir = __DIR__ . '/includes/classes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Include additional files
require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';

// Initialize the plugin
function wpplugin_init() {
    $plugin_main = new WPPlugin\Plugin_Main();
}
add_action('plugins_loaded', 'wpplugin_init');
