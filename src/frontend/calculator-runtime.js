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
      const syncFromInput = () => {
        const val = parseFloat(principalInput.value) || 0;
        if (val > parseFloat(principalRange.max)) {
          principalRange.max = val;
        }
        principalRange.value = val;
        recalculate();
      };
      const syncFromRange = () => {
        principalInput.value = principalRange.value;
        recalculate();
      };

      principalInput.addEventListener('input', syncFromInput);
      principalInput.addEventListener('change', syncFromInput);
      principalRange.addEventListener('input', syncFromRange);
      principalRange.addEventListener('change', syncFromRange);
    }

    if (rateInput && rateRange) {
      const syncFromInput = () => {
        const val = parseFloat(rateInput.value) || 0;
        if (val > parseFloat(rateRange.max)) {
          rateRange.max = val;
        }
        rateRange.value = val;
        recalculate();
      };
      const syncFromRange = () => {
        rateInput.value = rateRange.value;
        recalculate();
      };

      rateInput.addEventListener('input', syncFromInput);
      rateInput.addEventListener('change', syncFromInput);
      rateRange.addEventListener('input', syncFromRange);
      rateRange.addEventListener('change', syncFromRange);
    }

    if (tenureInput && tenureRange) {
      const syncFromInput = () => {
        const val = parseInt(tenureInput.value, 10) || 1;
        if (val > parseInt(tenureRange.max, 10)) {
          tenureRange.max = val;
        }
        tenureRange.value = val;
        recalculate();
      };
      const syncFromRange = () => {
        tenureInput.value = tenureRange.value;
        recalculate();
      };

      tenureInput.addEventListener('input', syncFromInput);
      tenureInput.addEventListener('change', syncFromInput);
      tenureRange.addEventListener('input', syncFromRange);
      tenureRange.addEventListener('change', syncFromRange);
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
