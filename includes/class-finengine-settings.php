<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FinEngine_Settings {
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    public function add_settings_page() {
        add_options_page(
            __( 'FinEngine Calculator Settings', 'finengine-calculator' ),
            __( 'FinEngine Calculator', 'finengine-calculator' ),
            'manage_options',
            'finengine-calculator',
            [ $this, 'render_settings_page' ]
        );
    }

    public function register_settings() {
        register_setting( 'finengine_settings_group', 'finengine_default_currency', [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => 'BDT',
        ] );
        register_setting( 'finengine_settings_group', 'finengine_default_principal', [
            'type'              => 'number',
            'sanitize_callback' => 'absint',
            'default'           => 500000,
        ] );
        register_setting( 'finengine_settings_group', 'finengine_default_rate', [
            'type'              => 'number',
            'sanitize_callback' => 'floatval',
            'default'           => 12.0,
        ] );
        register_setting( 'finengine_settings_group', 'finengine_default_tenure', [
            'type'              => 'number',
            'sanitize_callback' => 'absint',
            'default'           => 36,
        ] );

        add_settings_section(
            'finengine_main_section',
            __( 'Default Calculator Presets', 'finengine-calculator' ),
            function() {
                echo '<p>' . esc_html__( 'Configure the global defaults for FinEngine Loan & EMI Calculator blocks and shortcodes.', 'finengine-calculator' ) . '</p>';
            },
            'finengine-calculator'
        );

        add_settings_field(
            'finengine_default_currency',
            __( 'Default Currency', 'finengine-calculator' ),
            [ $this, 'render_currency_field' ],
            'finengine-calculator',
            'finengine_main_section'
        );

        add_settings_field(
            'finengine_default_principal',
            __( 'Default Loan Amount', 'finengine-calculator' ),
            [ $this, 'render_principal_field' ],
            'finengine-calculator',
            'finengine_main_section'
        );

        add_settings_field(
            'finengine_default_rate',
            __( 'Default Annual Interest Rate (%)', 'finengine-calculator' ),
            [ $this, 'render_rate_field' ],
            'finengine-calculator',
            'finengine_main_section'
        );

        add_settings_field(
            'finengine_default_tenure',
            __( 'Default Tenure (Months)', 'finengine-calculator' ),
            [ $this, 'render_tenure_field' ],
            'finengine-calculator',
            'finengine_main_section'
        );
    }

    public function render_currency_field() {
        $currency = get_option( 'finengine_default_currency', 'BDT' );
        ?>
        <select name="finengine_default_currency" id="finengine_default_currency">
            <option value="BDT" <?php selected( $currency, 'BDT' ); ?>>BDT (Bangladeshi Taka - Lakh/Crore)</option>
            <option value="INR" <?php selected( $currency, 'INR' ); ?>>INR (Indian Rupee - Lakh/Crore)</option>
            <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD (US Dollar - Million/Billion)</option>
            <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR (Euro - Million/Billion)</option>
            <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP (British Pound)</option>
        </select>
        <p class="description">
            <?php esc_html_e( 'BDT and INR automatically apply South Asian Lakh and Crore numbering conventions (e.g. 1,25,00,000.00).', 'finengine-calculator' ); ?>
        </p>
        <?php
    }

    public function render_principal_field() {
        $principal = get_option( 'finengine_default_principal', 500000 );
        ?>
        <input type="number" name="finengine_default_principal" id="finengine_default_principal" value="<?php echo esc_attr( $principal ); ?>" min="1000" step="5000" class="regular-text">
        <p class="description"><?php esc_html_e( 'Initial loan amount presented when calculator loads.', 'finengine-calculator' ); ?></p>
        <?php
    }

    public function render_rate_field() {
        $rate = get_option( 'finengine_default_rate', 12.0 );
        ?>
        <input type="number" name="finengine_default_rate" id="finengine_default_rate" value="<?php echo esc_attr( $rate ); ?>" min="0.1" max="50" step="0.1" class="small-text"> %
        <p class="description"><?php esc_html_e( 'Default annual interest percentage.', 'finengine-calculator' ); ?></p>
        <?php
    }

    public function render_tenure_field() {
        $tenure = get_option( 'finengine_default_tenure', 36 );
        ?>
        <input type="number" name="finengine_default_tenure" id="finengine_default_tenure" value="<?php echo esc_attr( $tenure ); ?>" min="1" max="480" step="1" class="small-text"> <?php esc_html_e( 'Months', 'finengine-calculator' ); ?>
        <p class="description"><?php esc_html_e( 'Default repayment duration in months.', 'finengine-calculator' ); ?></p>
        <?php
    }

    public function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'finengine-calculator' ) );
        }
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'finengine_settings_group' );
                do_settings_sections( 'finengine-calculator' );
                submit_button();
                ?>
            </form>
            <hr>
            <h2><?php esc_html_e( 'Shortcode Usage Guide', 'finengine-calculator' ); ?></h2>
            <p><?php esc_html_e( 'Insert the calculator into any page, post, or widget with:', 'finengine-calculator' ); ?></p>
            <code>[finengine_calculator currency="BDT" default_principal="500000" default_rate="12.0" default_tenure="36"]</code>
        </div>
        <?php
    }
}
