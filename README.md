<p align="center">
  <img src="logo-mark.svg" alt="FinEngine Logo" width="120" height="120" />
</p>

# FinEngine WordPress Plugin: Deterministic Loan & EMI Calculator

> **Verified reducing-balance EMI loan calculator powered by FinEngine.**  
> Eliminates IEEE-754 floating-point drift and brings native South Asian Lakh/Crore numbering (Bangladeshi Taka · Poisha) directly into WordPress.

[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.0%2B-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org/)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777bb4.svg?logo=php&logoColor=white)](https://www.php.net/)
[![Zero Float Drift](https://img.shields.io/badge/Precision-Zero%20Drift%20(B_n%20%3D%3D%3D%200.00)-059669.svg)](https://finengine.js.org/)
[![Academic Lab](https://img.shields.io/badge/Research-CFSBR%20Lab-0f766e.svg)](https://finengine.js.org/methodology/)
[![DOI](https://img.shields.io/badge/DOI-10.67226%2Fcfsbr.fe.2026.001.v1-0284c7.svg)](https://doi.org/10.67226/cfsbr.fe.2026.001.v1)
[![Zenodo](https://img.shields.io/badge/Zenodo-10.5281%2Fzenodo.22769502-blue.svg)](https://doi.org/10.5281/zenodo.22769502)

---

## Why FinEngine for WordPress?

Modern web financial applications increasingly offload real-time calculations to client-side runtimes. However, standard ECMAScript engines rely on IEEE-754 double-precision binary floating-point arithmetic (binary64), introducing representation drift in everyday decimal arithmetic:

```javascript
0.1 + 0.2 === 0.30000000000000004; // True in standard JS runtimes
```

In multi-year financial loan amortization schedules, this drift compounds across monthly periods, causing final closing balances to fail to liquidate cleanly to zero ($B_n \neq 0.00$). Furthermore, existing WordPress calculators lack native South Asian Lakh and Crore numbering conventions (`2,45,87,500.00`).

**FinEngine Loan Calculator** resolves this by delivering:
1. **Zero Float Drift Guarantee:** Actuarial reducing-balance calculations with strict integer sub-unit Poisha scaling (1 BDT = 100 Poisha).
2. **Terminal Reconciliation Rule:** Boundary enforcement guaranteeing closing balance liquidates identically to zero ($B_n \equiv 0.00$).
3. **South Asian Numbering Conventions:** Built-in Lakh and Crore grouping for Bangladeshi Taka (BDT) and Indian Rupee (INR).
4. **Full-Site Editing (Gutenberg) Block:** Native WordPress block with live Inspector Controls.
5. **Universal Shortcode:** One-line drop-in `[finengine_calculator]` compatible with Elementor, Divi, Beaver Builder, and Classic Editor.
6. **100% Client-Side Privacy:** Zero server tracking, zero AJAX calls, and no cookies. Customer financial numbers never leave the user's browser.

---

## FinEngine Ecosystem Parity

FinEngine maintains identical mathematical parity between client-side JavaScript runtimes, Python scientific backends, and WordPress interfaces:

| Package / Repository | Version | Registry | Purpose |
| :--- | :--- | :--- | :--- |
| [**@finengine/core**](https://github.com/gmrafi/FinEngine/blob/main/packages/core) | 0.3.0 | npm | Integer sub-unit arithmetic, BDT currency primitives, double-entry ledger. |
| [**@finengine/math**](https://github.com/gmrafi/FinEngine/blob/main/packages/math) | 0.3.0 | npm | Actuarial reducing-balance loan amortization, EMI schedules, XIRR solver. |
| [**@finengine/ui**](https://github.com/gmrafi/FinEngine/blob/main/packages/ui) | 0.3.0 | npm | Accessible view-models for repayment summaries and burden gauges. |
| [**finengine (Python)**](https://github.com/gmrafi/FinEngine-Py) | 0.1.1 | PyPI | Python actuarial math, Pandas DataFrames, and alternative credit risk AI. |
| [**FinEngine-WP**](https://github.com/gmrafi/FinEngine-WP) | 1.0.0 | WP.org / GitHub | Deterministic reducing-balance Loan & EMI Calculator WordPress plugin. |

---

## Installation & Usage

### 1. Gutenberg Block (Recommended)
1. In the WordPress Block Editor, search for **"FinEngine Loan Calculator"**.
2. Customize the default currency, principal, interest rate, and tenure directly from the sidebar settings panel.

### 2. Universal Shortcode
Add the shortcode anywhere in your content, widgets, or page builder:
```text
[finengine_calculator currency="BDT" default_principal="500000" default_rate="12.0" default_tenure="36"]
```

#### Shortcode Parameters:
| Attribute | Default | Description |
| :--- | :--- | :--- |
| `currency` | `BDT` | Currency code (`BDT`, `INR`, `USD`, `EUR`, `GBP`) |
| `default_principal` | `500000` | Initial loan amount |
| `default_rate` | `12.0` | Annual interest rate (percentage) |
| `default_tenure` | `36` | Loan tenure in months |
| `theme` | `light` | Visual theme (`light`) |

---

## Development & Build Pipeline

This plugin uses the official WordPress build toolchain `@wordpress/scripts`:

```bash
# Clone the repository
git clone https://github.com/gmrafi/FinEngine-WP.git
cd FinEngine-WP

# Install dependencies
npm install

# Start development watch mode
npm run start

# Compile production bundle for release
npm run build
```

---

## Academic Backing & Citation

FinEngine is published as an open computational methodology standard by the **Centre for Fintech and Strategic Business Research (CFSBR)**.

### APA 7th Edition
> Rafi, M. G. M. (2026). FinEngine: A Deterministic Computational Framework for Client-Side Financial Interfaces (CFSBR Technical Working Paper No. CFSBR-FE-2026-001). Centre for Fintech and Strategic Business Research. https://doi.org/10.67226/cfsbr.fe.2026.001.v1

### BibTeX (Working Paper)
```bibtex
@techreport{rafi2026finengine,
  author      = {Rafi, Md Golam Mubasshir},
  title       = {FinEngine: A Deterministic Computational Framework for Client-Side Financial Interfaces},
  institution = {Centre for Fintech and Strategic Business Research (CFSBR)},
  year        = {2026},
  month       = {September},
  type        = {Technical Working Paper},
  number      = {CFSBR-FE-2026-001},
  doi         = {10.67226/cfsbr.fe.2026.001.v1},
  url         = {https://finengine.js.org/methodology/}
}
```

### Archival Identifiers
- **Methodology DOI (Crossref):** [10.67226/cfsbr.fe.2026.001.v1](https://doi.org/10.67226/cfsbr.fe.2026.001.v1)
- **Software Version DOI (Zenodo):** [10.5281/zenodo.22769502](https://doi.org/10.5281/zenodo.22769502)
- **Software Concept DOI (Zenodo All Versions):** [10.5281/zenodo.22769501](https://doi.org/10.5281/zenodo.22769501)
- **Software Heritage ID:** `swh:1:dir:4da6366919f478fd431b2f9ce1d342620cc8834f`

---

## Institutional Maintainer, Authors & Governance

FinEngine-WP is an official open computational initiative developed and maintained under the institutional governance of:

- **Institutional Maintainer & Research Lab:** [Centre for Fintech and Strategic Business Research (CFSBR)](https://finengine.js.org/)
- **Lead Author & Software Architect:** [Md Golam Mubasshir Rafi](https://gmrafi.com.bd/)
- **WordPress Directory Contributor:** [@gmrafi](https://profiles.wordpress.org/gmrafi/)
- **GitHub Repository:** [@gmrafi](https://github.com/gmrafi)
- **Official Contact:** rafi@gmrafi.com.bd

The project is governed collaboratively by CFSBR Lab and the open-source community to ensure rigorous financial calculation accuracy, zero floating-point drift, and South Asian localization standards across WordPress environments.

---

## License

- **Software Code:** Licensed under the [GNU General Public License v2.0 or later (GPL-2.0-or-later)](LICENSE) in full compliance with WordPress.org guidelines.
- **Documentation & Research Methodology:** [Creative Commons Attribution 4.0 International (CC-BY 4.0)](https://creativecommons.org/licenses/by/4.0/).
