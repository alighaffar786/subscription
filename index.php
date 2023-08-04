<?php

define('SUBSCRIPTION__FILE__', __FILE__);
define('SUBSCRIPTION_URL', plugins_url('/', SUBSCRIPTION__FILE__));
define('SUBSCRIPTION_ASSETS_URL', SUBSCRIPTION_URL . 'assets/');
define('SUBSCRIPTION_PLUGIN_BASE', plugin_basename(SUBSCRIPTION__FILE__));
define('SUBSCRIPTION_PLUGIN_PATH', plugin_dir_path(SUBSCRIPTION__FILE__));
define('SUBSCRIPTION_PLUGIN_FRONTEND_BASE', SUBSCRIPTION_PLUGIN_PATH . "frontend/");
define('SUBSCRIPTION_PLUGIN_BACKEND_BASE', SUBSCRIPTION_PLUGIN_PATH . "backend/");
define('SUBSCRIPTION_PLUGIN_ADMIN_BASE', SUBSCRIPTION_PLUGIN_PATH . "admin/");
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . '');


/**
 * Plugin Name: subscription
 * Plugin URI: https://not.yet/
 * Description: Adding rental products and create subscription in wo-commerce
 * Version: 1.0
 * Author: Ali Ghaffar
 * Author URI: https://office.com/
 * License: GPLv2 or later
 * Text Domain: ali
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Check if WooCommerce is active before proceeding.
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('admin_notices', 'subscription_missing_woocommerce_notice');
    add_action('admin_init', 'deactivate_plugin_using_hook');
    return;
}

// Register the custom page template.
add_filter('theme_page_templates', 'subscription_add_template');
function subscription_add_template($templates) {
    $templates['index.php'] = 'My Custom Template';
    return $templates;
}

// Display a notice if WooCommerce is not active.
function subscription_missing_woocommerce_notice() {
    echo SUBSCRIPTION_PLUGIN_ADMIN_BASE.'<div class="error"><p><strong>subscription Plugin</strong> requires <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> to be installed and activated.</p></div>';
}



// Deactivate a plugin using the 'deactivate_plugins' hook
function deactivate_plugin_using_hook() {
    $plugin_to_deactivate = 'subscription/index.php';
    deactivate_plugins($plugin_to_deactivate);
}
