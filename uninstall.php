<?php
/**
 * FinEngine Calculator Uninstall
 *
 * Cleans up options and transients on plugin deletion.
 *
 * @package FinEngine_Calculator
 */

// If uninstall not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete registered options
delete_option( 'finengine_default_currency' );
delete_option( 'finengine_default_principal' );
delete_option( 'finengine_default_rate' );
delete_option( 'finengine_default_tenure' );
