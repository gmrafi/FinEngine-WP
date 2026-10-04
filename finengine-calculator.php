<?php
/**
 * Plugin Name:       FinEngine Calculator
 * Plugin URI:        https://finengine.js.org/wordpress/
 * Description:       Verified reducing-balance EMI loan calculator powered by FinEngine. Zero float-drift and native BDT/South Asian lakh-crore precision.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Md Golam Mubasshir Rafi (CFSBR)
 * Author URI:        https://gmrafi.com.bd/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       finengine-calculator
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Direct access blocked
}

define( 'FINENGINE_VERSION', '1.0.0' );
define( 'FINENGINE_PATH', plugin_dir_path( __FILE__ ) );
define( 'FINENGINE_URL', plugin_dir_url( __FILE__ ) );

// Require module classes
require_once FINENGINE_PATH . 'includes/class-finengine-shortcode.php';
require_once FINENGINE_PATH . 'includes/class-finengine-block.php';
require_once FINENGINE_PATH . 'includes/class-finengine-settings.php';

// Initialize text domain and plugin components
add_action( 'plugins_loaded', function() {
    load_plugin_textdomain(
        'finengine-calculator',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages'
    );

    new FinEngine_Shortcode();
    new FinEngine_Block();
    new FinEngine_Settings();
} );

// Add quick settings action link on plugins.php
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ) {
    $settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=finengine-calculator' ) ) . '">' . esc_html__( 'Settings', 'finengine-calculator' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
} );

// Register activation hooks with sensible defaults
register_activation_hook( __FILE__, function() {
    if ( false === get_option( 'finengine_default_currency' ) ) {
        update_option( 'finengine_default_currency', 'BDT' );
    }
    if ( false === get_option( 'finengine_default_principal' ) ) {
        update_option( 'finengine_default_principal', 500000 );
    }
    if ( false === get_option( 'finengine_default_rate' ) ) {
        update_option( 'finengine_default_rate', 12.0 );
    }
    if ( false === get_option( 'finengine_default_tenure' ) ) {
        update_option( 'finengine_default_tenure', 36 );
    }
} );
