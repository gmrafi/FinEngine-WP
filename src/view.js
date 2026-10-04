/**
 * FinEngine Loan Calculator Frontend Runtime
 * Standalone, lightweight client-side execution with zero external dependencies.
 */
import { initFinEngineCalculators } from './frontend/calculator-runtime';

// Initialize calculators immediately if document is ready, or on DOMContentLoaded
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initFinEngineCalculators);
} else {
  initFinEngineCalculators();
}
