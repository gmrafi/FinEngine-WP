<?php
/**
 * Title: Interactive Loan Calculator Section
 * Slug: finengine-fintech/calculator-section
 * Categories: finengine-fintech-finance
 * Description: Ready-made container for embedding the FinEngine Loan Calculator block or shortcode.
 */
?>
<!-- wp:group {"align":"wide","layout":{"type":"constrained"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)">
  <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontSize":"var:preset|font-size|xx-large","fontWeight":"800"}}} -->
  <h2 class="wp-block-heading has-text-align-center" style="font-size:var(--wp--preset--font-size--xx-large);font-weight:800">Live Loan &amp; EMI Simulation</h2>
  <!-- /wp:heading -->

  <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"var:preset|font-size|medium"}},"color":{"text":"var:preset|color|muted"}} -->
  <p class="has-text-align-center has-muted-color has-text-color" style="font-size:var(--wp--preset--font-size--medium)">Interactive reducing-balance calculation powered by the official FinEngine Calculator integration.</p>
  <!-- /wp:paragraph -->

  <!-- wp:shortcode -->
  [finengine_calculator currency="BDT" default_principal="1000000" default_rate="11.5" default_tenure="36"]
  <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
