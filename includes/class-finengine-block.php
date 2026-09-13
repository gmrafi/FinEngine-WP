<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FinEngine_Block {
    public function __construct() {
        add_action( 'init', [ $this, 'register_block' ] );
    }

    public function register_block() {
        $block_json = FINENGINE_PATH . 'build/block.json';
        if ( ! file_exists( $block_json ) ) {
            return;
        }

        register_block_type( FINENGINE_PATH . 'build', [
            'render_callback' => [ $this, 'render_block' ],
        ] );
    }

    public function render_block( $attributes, $content ) {
        $shortcode = new FinEngine_Shortcode();
        return $shortcode->render_shortcode( [
            'currency'          => $attributes['currency'] ?? 'BDT',
            'default_principal' => $attributes['defaultPrincipal'] ?? '500000',
            'default_rate'      => $attributes['defaultRate'] ?? '12.0',
            'default_tenure'    => $attributes['defaultTenure'] ?? '36',
            'title'             => $attributes['title'] ?? __( 'FinEngine Loan & EMI Calculator', 'finengine-calculator' ),
            'theme'             => $attributes['theme'] ?? 'light',
        ] );
    }
}
