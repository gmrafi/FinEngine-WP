import { computeAmortization, formatLakhCrore } from './engine-adapter';

export function initFinEngineCalculators() {
  const containers = document.querySelectorAll('.finengine-calculator-wrapper');

  containers.forEach((container) => {
    // Check if already initialized
    if (container.dataset.feInitialized === 'true') {
      return;
    }
    container.dataset.feInitialized = 'true';

    const principalInput = container.querySelector('.fe-input-principal');
    const principalRange = container.querySelector('.fe-range-principal');
    const rateInput = container.querySelector('.fe-input-rate');
    const rateRange = container.querySelector('.fe-range-rate');
    const tenureInput = container.querySelector('.fe-input-tenure');
    const tenureRange = container.querySelector('.fe-range-tenure');

    const emiDisplay = container.querySelector('.fe-emi-display');
    const principalDisplay = container.querySelector('.fe-principal-display');
    const interestDisplay = container.querySelector('.fe-interest-display');
    const totalDisplay = container.querySelector('.fe-total-display');
    const terminalDisplay = container.querySelector('.fe-terminal-display');

    const currency = container.dataset.currency || 'BDT';

    function recalculate() {
      const principal = parseFloat(principalInput?.value) || 0;
      const rate = parseFloat(rateInput?.value) || 0;
      const tenure = parseInt(tenureInput?.value, 10) || 1;

      const plan = computeAmortization({
        principal,
        annualRate: rate,
        months: tenure
      });

      if (emiDisplay) emiDisplay.textContent = formatLakhCrore(plan.monthlyPayment, currency);
      if (principalDisplay) principalDisplay.textContent = formatLakhCrore(principal, currency);
      if (interestDisplay) interestDisplay.textContent = formatLakhCrore(plan.totalInterest, currency);
      if (totalDisplay) totalDisplay.textContent = formatLakhCrore(plan.totalPayable, currency);
      if (terminalDisplay) terminalDisplay.textContent = formatLakhCrore(plan.terminalBalance, currency);
    }

    function syncAndRecalc(source, target) {
      target.value = source.value;
      recalculate();
    }

    if (principalInput && principalRange) {
      principalInput.addEventListener('input', () => syncAndRecalc(principalInput, principalRange));
      principalRange.addEventListener('input', () => syncAndRecalc(principalRange, principalInput));
    }

    if (rateInput && rateRange) {
      rateInput.addEventListener('input', () => syncAndRecalc(rateInput, rateRange));
      rateRange.addEventListener('input', () => syncAndRecalc(rateRange, rateInput));
    }

    if (tenureInput && tenureRange) {
      tenureInput.addEventListener('input', () => syncAndRecalc(tenureInput, tenureRange));
      tenureRange.addEventListener('input', () => syncAndRecalc(tenureRange, tenureInput));
    }

    // Run initial calculation
    recalculate();
  });
}

// Auto-run on DOMContentLoaded or immediately if already ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initFinEngineCalculators);
} else {
  initFinEngineCalculators();
}
