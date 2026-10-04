<?php
/**
 * FinEngine Fintech functions and definitions
 *
 * @package FinEngine_Fintech
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! function_exists( 'finengine_fintech_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function finengine_fintech_setup() {
        // Enforce block styles and editor styles
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_editor_style( 'style.css' );

        // Responsive embedded content
        add_theme_support( 'responsive-embeds' );

        // Full Elementor Page Builder integration support
        add_theme_support( 'elementor' );

        // Register custom block pattern categories
        register_block_pattern_category(
            'finengine-fintech-finance',
            [
                'label' => __( 'FinEngine Financial & Banking', 'finengine-fintech' ),
            ]
        );

        register_block_pattern_category(
            'finengine-fintech-heroes',
            [
                'label' => __( 'FinEngine Hero Sections', 'finengine-fintech' ),
            ]
        );
    }
endif;
add_action( 'after_setup_theme', 'finengine_fintech_setup' );

/**
 * Enqueue theme stylesheet.
 */
function finengine_fintech_scripts() {
    wp_enqueue_style(
        'finengine-fintech-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'finengine_fintech_scripts' );

