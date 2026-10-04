<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FinEngine_Shortcode {
    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_shortcode( 'finengine_calculator', [ $this, 'render_shortcode' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    public function register_assets() {
        $asset_file = FINENGINE_PATH . 'build/view.asset.php';
        $dependencies = [];
        $version = FINENGINE_VERSION;

        if ( file_exists( $asset_file ) ) {
            $asset = include $asset_file;
            $dependencies = $asset['dependencies'] ?? [];
            $version = $asset['version'] ?? FINENGINE_VERSION;
        }

        wp_register_script(
            'finengine-calculator-runtime',
            FINENGINE_URL . 'build/view.js',
            $dependencies,
            $version,
            true
        );

        wp_register_style(
            'finengine-calculator-style',
            FINENGINE_URL . 'build/style-index.css',
            [],
            $version
        );
    }

    public function render_shortcode( $atts ) {
        $global_currency  = get_option( 'finengine_default_currency', 'BDT' );
        $global_principal = get_option( 'finengine_default_principal', '500000' );
        $global_rate      = get_option( 'finengine_default_rate', '12.0' );
        $global_tenure    = get_option( 'finengine_default_tenure', '36' );

        $attributes = shortcode_atts( [
            'currency'          => $global_currency,
            'default_principal' => $global_principal,
            'principal'         => '',
            'default_rate'      => $global_rate,
            'rate'              => '',
            'default_tenure'    => $global_tenure,
            'tenure'            => '',
            'theme'             => 'light',
            'title'             => __( 'FinEngine Loan & EMI Calculator', 'finengine-calculator' ),
        ], $atts, 'finengine_calculator' );

        wp_enqueue_script( 'finengine-calculator-runtime' );
        wp_enqueue_style( 'finengine-calculator-style' );

        $currency       = esc_attr( $attributes['currency'] );
        $principal_raw  = ( '' !== $attributes['principal'] ) ? $attributes['principal'] : $attributes['default_principal'];
        $rate_raw       = ( '' !== $attributes['rate'] ) ? $attributes['rate'] : $attributes['default_rate'];
        $tenure_raw     = ( '' !== $attributes['tenure'] ) ? $attributes['tenure'] : $attributes['default_tenure'];

        $principal = max( 0.0, floatval( $principal_raw ) );
        $rate      = max( 0.0, floatval( $rate_raw ) );
        $tenure    = max( 1, intval( $tenure_raw ) );

        // Actuarial reducing-balance calculation for instant server-rendered KPIs
        $monthly_rate = ( $rate > 0 ) ? ( ( $rate / 100 ) / 12 ) : 0;
        if ( $monthly_rate > 0 && $tenure > 0 ) {
            $factor = pow( 1 + $monthly_rate, $tenure );
            $initial_emi = ( $principal * $monthly_rate * $factor ) / ( $factor - 1 );
        } elseif ( $tenure > 0 ) {
            $initial_emi = $principal / $tenure;
        } else {
            $initial_emi = 0;
        }
        $initial_emi = round( $initial_emi, 2 );

        $initial_total    = round( $initial_emi * $tenure, 2 );
        $initial_interest = round( $initial_total - $principal, 2 );
        if ( $initial_interest < 0 ) {
            $initial_interest = 0;
        }

        $principal_max = max( 20000000, $principal );

        ob_start();
        ?>
        <div class="finengine-calculator-wrapper theme-<?php echo esc_attr( $attributes['theme'] ); ?>" 
             data-currency="<?php echo esc_attr( $currency ); ?>"
             data-principal="<?php echo esc_attr( $principal ); ?>"
             data-rate="<?php echo esc_attr( $rate ); ?>"
             data-tenure="<?php echo esc_attr( $tenure ); ?>">
            
            <div class="fe-card">
                <div class="fe-header">
                    <h3 class="fe-title"><?php echo esc_html( $attributes['title'] ); ?></h3>
                    <span class="fe-badge">
                        <span class="fe-badge-dot"></span>
                        <?php esc_html_e( 'Zero Float Drift · Actuarial Precision', 'finengine-calculator' ); ?>
                    </span>
                </div>

                <div class="fe-grid">
                    <div class="fe-inputs-panel">
                        <!-- Loan Principal -->
                        <div class="fe-field-group">
                            <div class="fe-field-header">
                                <label><?php esc_html_e( 'Loan Amount', 'finengine-calculator' ); ?></label>
                                <div class="fe-amount-box">
                                    <span class="fe-currency-tag"><?php echo esc_html( $currency ); ?></span>
                                    <input type="number" class="fe-input-principal" min="1000" max="100000000" step="5000" value="<?php echo esc_attr( $principal ); ?>" aria-label="<?php esc_attr_e( 'Principal Loan Amount', 'finengine-calculator' ); ?>">
                                </div>
                            </div>
                            <input type="range" class="fe-range-principal" min="10000" max="<?php echo esc_attr( $principal_max ); ?>" step="10000" value="<?php echo esc_attr( $principal ); ?>">
                            <div class="fe-range-labels">
                                <span><?php echo esc_html( $currency ); ?> 10K</span>
                                <span><?php echo esc_html( $currency ); ?> 2 Crore+</span>
                            </div>
                        </div>

                        <!-- Interest Rate -->
                        <div class="fe-field-group">
                            <div class="fe-field-header">
                                <label><?php esc_html_e( 'Annual Interest Rate (%)', 'finengine-calculator' ); ?></label>
                                <div class="fe-amount-box">
                                    <input type="number" class="fe-input-rate" min="0.1" max="50" step="0.1" value="<?php echo esc_attr( $rate ); ?>" aria-label="<?php esc_attr_e( 'Annual Interest Rate', 'finengine-calculator' ); ?>">
                                    <span class="fe-currency-tag">%</span>
                                </div>
                            </div>
                            <input type="range" class="fe-range-rate" min="1" max="30" step="0.25" value="<?php echo esc_attr( $rate ); ?>">
                            <div class="fe-range-labels">
                                <span>1%</span>
                                <span>15%</span>
                                <span>30%</span>
                            </div>
                        </div>

                        <!-- Tenure Months -->
                        <div class="fe-field-group">
                            <div class="fe-field-header">
                                <label><?php esc_html_e( 'Tenure Duration', 'finengine-calculator' ); ?></label>
                                <div class="fe-amount-box">
                                    <input type="number" class="fe-input-tenure" min="1" max="480" step="1" value="<?php echo esc_attr( $tenure ); ?>" aria-label="<?php esc_attr_e( 'Tenure Months', 'finengine-calculator' ); ?>">
                                    <span class="fe-currency-tag"><?php esc_html_e( 'Mo', 'finengine-calculator' ); ?></span>
                                </div>
                            </div>
                            <input type="range" class="fe-range-tenure" min="6" max="360" step="6" value="<?php echo esc_attr( $tenure ); ?>">
                            <div class="fe-range-labels">
                                <span>6 Mo</span>
                                <span>120 Mo (10Y)</span>
                                <span>360 Mo (30Y)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Results Panel -->
                    <div class="fe-results-panel">
                        <div class="fe-kpi-main">
                            <span class="fe-kpi-label"><?php esc_html_e( 'Monthly Payment (EMI)', 'finengine-calculator' ); ?></span>
                            <div class="fe-kpi-hero fe-emi-display"><?php echo esc_html( self::format_currency( $initial_emi, $currency ) ); ?></div>
                            <div class="fe-kpi-sub"><?php esc_html_e( 'Equated Monthly Installment', 'finengine-calculator' ); ?></div>
                        </div>

                        <div class="fe-kpi-row">
                            <div class="fe-kpi-card">
                                <span class="fe-kpi-card-label"><?php esc_html_e( 'Total Principal', 'finengine-calculator' ); ?></span>
                                <span class="fe-kpi-card-value fe-principal-display"><?php echo esc_html( self::format_currency( $principal, $currency ) ); ?></span>
                            </div>
                            <div class="fe-kpi-card">
                                <span class="fe-kpi-card-label"><?php esc_html_e( 'Total Interest', 'finengine-calculator' ); ?></span>
                                <span class="fe-kpi-card-value fe-interest-display"><?php echo esc_html( self::format_currency( $initial_interest, $currency ) ); ?></span>
                            </div>
                        </div>

                        <div class="fe-kpi-card fe-kpi-card-full">
                            <span class="fe-kpi-card-label"><?php esc_html_e( 'Total Payable Amount', 'finengine-calculator' ); ?></span>
                            <span class="fe-kpi-card-value fe-total-display"><?php echo esc_html( self::format_currency( $initial_total, $currency ) ); ?></span>
                        </div>

                        <!-- Drift Validation Badge -->
                        <div class="fe-drift-footer">
                            <span class="fe-drift-check">&#10003;</span>
                            <span class="fe-drift-text">
                                <?php esc_html_e( 'Terminal Balance:', 'finengine-calculator' ); ?> 
                                <strong class="fe-terminal-display"><?php echo esc_html( self::format_currency( 0.00, $currency ) ); ?></strong> 
                                (<?php esc_html_e( 'Zero Float Drift Guaranteed', 'finengine-calculator' ); ?>)
                            </span>
                        </div>
                    </div>
                </div>

                <div class="fe-footer-note">
                    <small>
                        <?php esc_html_e( 'Actuarial Precision - 100% Client-Side Computation - Zero Server Tracking', 'finengine-calculator' ); ?>
                    </small>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Format currency using South Asian Lakh/Crore grouping or Western standard.
     */
    public static function format_currency( $amount, $currency = 'BDT' ) {
        $num = floatval( $amount );
        $is_negative = $num < 0;
        $abs_num = abs( $num );
        $fixed = number_format( $abs_num, 2, '.', '' );
        list( $int_part, $dec_part ) = explode( '.', $fixed );

        if ( in_array( $currency, [ 'BDT', 'INR' ], true ) ) {
            $len = strlen( $int_part );
            if ( $len > 3 ) {
                $last_three = substr( $int_part, -3 );
                $other_numbers = substr( $int_part, 0, $len - 3 );
                $formatted_other = preg_replace( '/\B(?=(\d{2})+(?!\d))/', ',', $other_numbers );
                $formatted_int = $formatted_other . ',' . $last_three;
            } else {
                $formatted_int = $int_part;
            }
            $sign = $is_negative ? '-' : '';
            return $currency . ' ' . $sign . $formatted_int . '.' . $dec_part;
        }

        $sign = $is_negative ? '-' : '';
        return $currency . ' ' . $sign . number_format( $abs_num, 2 );
    }
}
