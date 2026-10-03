=== FinEngine Calculator ===
Contributors: gmrafi
Tags: loan calculator, emi calculator, amortization, bdt, fintech
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Verified reducing-balance EMI loan calculator powered by FinEngine. Zero float-drift and native BDT/South Asian lakh-crore precision. Developed by Md Golam Mubasshir Rafi at the Centre for Fintech and Strategic Business Research (CFSBR).

== Description ==

Standard JavaScript floating-point calculations suffer from IEEE-754 binary representation drift (`0.1 + 0.2 === 0.30000000000000004`). In multi-year loan schedules, this drift compounds across monthly periods, leaving non-zero terminal balances.

**FinEngine Loan Calculator** introduces academic-grade, deterministic financial mathematics into the WordPress ecosystem.

Key Features:
* **Zero Float Drift Guarantee:** Actuarial reducing-balance calculations with strict integer sub-unit Poisha scaling.
* **Terminal Reconciliation Rule:** Mathematical boundary enforcement guaranteeing the closing principal balance liquidates cleanly to exactly 0.00.
* **South Asian Numbering Conventions:** Native support for Lakh and Crore formatting (`2,45,87,500.00`) for Bangladeshi Taka (BDT) and Indian Rupee (INR).
* **Full-Site Editing (Gutenberg) Block:** Modern WordPress block with live inspector controls.
* **Universal Shortcode:** Embed anywhere with `[finengine_calculator]` (compatible with Elementor, Divi, Beaver Builder, and Classic Editor).
* **100% Client-Side Privacy:** Zero server tracking, zero AJAX calls, and no cookies. Customer loan details never leave the browser.
* **Academic Backing:** Developed by Md Golam Mubasshir Rafi in accordance with CFSBR (Centre for Fintech and Strategic Business Research) computational working papers and archived on CERN Zenodo.

== Installation ==

1. Upload the `finengine-calculator` folder to your `/wp-content/plugins/` directory, or install directly through the WordPress Plugins screen.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Insert the **FinEngine Loan Calculator** block into any post or page, or use the shortcode `[finengine_calculator]`.

== Frequently Asked Questions ==

= Does this calculator send data to external servers? =
No. All calculations are executed 100% client-side inside the user's browser runtime with zero network latency and maximum privacy.

= What currencies are supported? =
BDT (Bangladeshi Taka) and INR (Indian Rupee) with native Lakh/Crore grouping, as well as USD, EUR, GBP, and standard ISO formats.

= How do I customize default values? =
Go to **Settings > FinEngine Calculator** in your WordPress admin dashboard, or pass attributes directly in the shortcode:
`[finengine_calculator currency="BDT" default_principal="1000000" default_rate="9.5" default_tenure="60"]`

== Screenshots ==

1. Modern, responsive EMI loan calculator with interactive sliders and KPI summary.
2. Gutenberg block settings with custom currency and preset selectors.

== Changelog ==

= 1.0.0 =
* Initial public release with deterministic actuarial amortization engine.
* Native BDT Lakh/Crore grouping support.
* Gutenberg block (v3 API) and universal shortcode support.
* Built by Md Golam Mubasshir Rafi (Centre for Fintech and Strategic Business Research - CFSBR).
