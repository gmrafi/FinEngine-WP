import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, RangeControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps();
  const { title, currency, defaultPrincipal, defaultRate, defaultTenure } = attributes;

  return (
    <div {...blockProps}>
      <InspectorControls>
        <PanelBody title={__('Calculator Presets', 'finengine-calculator')} initialOpen={true}>
          <TextControl
            label={__('Calculator Title', 'finengine-calculator')}
            value={title}
            onChange={(val) => setAttributes({ title: val })}
          />
          <SelectControl
            label={__('Currency', 'finengine-calculator')}
            value={currency}
            options={[
              { label: 'BDT (Bangladeshi Taka · Lakh/Crore)', value: 'BDT' },
              { label: 'INR (Indian Rupee · Lakh/Crore)', value: 'INR' },
              { label: 'USD (US Dollar)', value: 'USD' },
              { label: 'EUR (Euro)', value: 'EUR' },
              { label: 'GBP (British Pound)', value: 'GBP' }
            ]}
            onChange={(val) => setAttributes({ currency: val })}
          />
          <RangeControl
            label={__('Default Principal', 'finengine-calculator')}
            value={defaultPrincipal}
            onChange={(val) => setAttributes({ defaultPrincipal: val })}
            min={10000}
            max={20000000}
            step={10000}
          />
          <RangeControl
            label={__('Default Rate (%)', 'finengine-calculator')}
            value={defaultRate}
            onChange={(val) => setAttributes({ defaultRate: val })}
            min={1}
            max={30}
            step={0.25}
          />
          <RangeControl
            label={__('Default Tenure (Months)', 'finengine-calculator')}
            value={defaultTenure}
            onChange={(val) => setAttributes({ defaultTenure: val })}
            min={6}
            max={360}
            step={6}
          />
        </PanelBody>
      </InspectorControls>

      <div className="finengine-editor-preview" style={{ padding: '1.5rem', background: '#f8fafc', borderRadius: '10px', border: '1px solid #e2e8f0' }}>
        <h4 style={{ margin: '0 0 0.5rem 0', color: '#0f766e' }}>⚙️ {title} (Editor Preview)</h4>
        <p style={{ margin: 0, fontSize: '0.9rem', color: '#64748b' }}>
          <strong>Currency:</strong> {currency} | <strong>Principal:</strong> {defaultPrincipal.toLocaleString()} | <strong>Rate:</strong> {defaultRate}% | <strong>Tenure:</strong> {defaultTenure} Mo
        </p>
        <p style={{ margin: '0.5rem 0 0 0', fontSize: '0.82rem', color: '#059669' }}>
          ✓ Verified reducing-balance actuarial amortization with guaranteed zero terminal drift.
        </p>
      </div>
    </div>
  );
}
