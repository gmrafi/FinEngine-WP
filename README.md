<p align="center">
  <img src="logo-mark.svg" alt="FinEngine Logo" width="120" height="120" />
</p>

# FinEngine WordPress Ecosystem

### Deterministic Financial Architecture: Plugin & Full-Site Editing Theme

> **Official WordPress suite for deterministic actuarial loan computation and modern fintech web architecture.**  
> Eliminates IEEE-754 floating-point drift, introduces native South Asian Lakh/Crore numbering (Bangladeshi Taka · Poisha), and provides an engineered Full-Site Editing (FSE) block theme.

[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![WordPress Compatibility](https://img.shields.io/badge/WordPress-6.0%2B-21759b.svg?logo=wordpress&logoColor=white)](https://wordpress.org/)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777bb4.svg?logo=php&logoColor=white)](https://www.php.net/)
[![Theme Trac](https://img.shields.io/badge/Theme_Trac-%23293749-0f766e.svg)](https://themes.trac.wordpress.org/ticket/293749)
[![Zero Float Drift](https://img.shields.io/badge/Precision-Zero%20Drift%20(B_n%20%3D%3D%3D%200.00)-059669.svg)](https://finengine.js.org/)
[![Research](https://img.shields.io/badge/Research-CFSBR-0f766e.svg)](https://finengine.js.org/methodology/)
[![DOI](https://img.shields.io/badge/DOI-10.67226%2Fcfsbr.fe.2026.001.v1-0284c7.svg)](https://doi.org/10.67226/cfsbr.fe.2026.001.v1)
[![Zenodo](https://img.shields.io/badge/Zenodo-10.5281%2Fzenodo.22769502-blue.svg)](https://doi.org/10.5281/zenodo.22769502)
[![Official Portal](https://img.shields.io/badge/Portal-finengine.js.org%2Fwordpress-10b981.svg)](https://finengine.js.org/wordpress/)
[![Shortcode Builder](https://img.shields.io/badge/Tools-Shortcode%20Builder-059669.svg)](https://finengine.js.org/wordpress/#shortcode-builder)
[![Playground Demo](https://img.shields.io/badge/Live_Demo-WordPress_Playground-3858e9.svg?logo=wordpress&logoColor=white)](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/gmrafi/FinEngine-WP/main/blueprint.json)

---

## The Dual Ecosystem Architecture

The **FinEngine-WP** ecosystem provides two interconnected solutions for banks, microfinance institutions, fintech startups, and research organizations:

```
                  ┌──────────────────────────────────────────────┐
                  │          FinEngine WordPress Suite           │
                  └──────────────────────┬───────────────────────┘
                                         │
                 ┌───────────────────────┴───────────────────────┐
                 ▼                                               ▼
  ┌─────────────────────────────┐                 ┌─────────────────────────────┐
  │     FinEngine Calculator    │                 │      FinEngine Fintech      │
  │      (WordPress Plugin)     │                 │       (WordPress Theme)     │
  ├─────────────────────────────┤                 ├─────────────────────────────┤
  │ • Actuarial reducing balance│                 │ • Full-Site Editing (FSE)   │
  │ • Integer Poisha arithmetic │                 │ • theme.json v3 token system│
  │ • Terminal zero ($B_n=0.00$)│                 │ • Financial block patterns  │
  │ • Lakh/Crore grouping       │                 │ • Native Elementor support  │
  │ • Gutenberg Block & Shortcode│                │ • 100% Client-side speed    │
  └─────────────────────────────┘                 └─────────────────────────────┘
```

---

## 1. FinEngine Calculator (The Computational Engine)

**Role:** Actuarial Mathematics, Floating-Point Correction & Interactive Financial Computation.

Standard web runtimes execute arithmetic using the IEEE-754 binary floating-point standard (binary64). In financial calculations, decimal fractions like `0.1` or `0.2` cannot be represented exactly in binary, creating silent truncation errors:

```javascript
0.1 + 0.2 === 0.30000000000000004; // True in standard JavaScript runtimes
```

In multi-year financial loan amortization schedules, compounding float drift causes monthly closing balances to fail terminal reconciliation ($B_n \neq 0.00$). Existing WordPress calculators also lack native South Asian Lakh and Crore numbering conventions (`2,45,87,500.00`).

### What the Plugin Solves:
- **Sub-Unit Poisha Scaling:** Executes all internal operations using integer scaling ($1\text{ BDT} = 100\text{ Poisha}$), completely eliminating binary float representation drift.
- **Terminal Zero Balance ($B_n \equiv 0.00$):** Enforces rigorous boundary conditions so that the final installment liquidates the principal balance to exactly zero.
- **South Asian Formatting (Lakh/Crore):** Renders currency strings adhering to standard South Asian comma grouping conventions.
- **Universal Embed Options:** Provides a native Gutenberg block with Inspector Controls and a universal shortcode `[finengine_calculator]` compatible with all page builders.
- **Client-Side Privacy:** Operates 100% in the user's browser without AJAX, server tracking, or database queries.

---

## 2. FinEngine Fintech (The Visual Architecture & Theme)

**Role:** Structural Layout, Site Scaffolding, Full-Site Editing & Design System.

While the plugin handles the mathematics, **FinEngine Fintech** provides the presentation framework, typography, and layout foundation required for professional banking and fintech web properties.

### What the Theme Delivers:
- **Full-Site Editing (FSE) Foundation:** Complete template control over headers, footers, query loops, and single page layouts powered by the modern `theme.json` v3 schema.
- **Pre-Built Financial Block Patterns:**
  - `finengine-fintech/hero-finance`: Hero section with financial metrics, statistics, and high-conversion call-to-actions.
  - `finengine-fintech/kpi-grid`: 3-column KPI card grid highlighting integer precision, zero reconciliation, and local numbering.
  - `finengine-fintech/calculator-section`: A pre-styled, responsive container pre-wired to embed live loan calculators.
- **Elementor Canvas & Full-Width Compatibility:** Includes dedicated `page-elementor-fullwidth.html` template for drag-and-drop landing page design.
- **Zero-Bloat Performance:** Uses native system font stacks (`-apple-system`, `Segoe UI`, `Roboto`), zero external CDN requests, and pure CSS variables.
- **Accessible Color Architecture:** Curated Emerald (`#0f766e`), Slate Navy (`#0f172a`), and Cyan (`#0ea5e9`) meeting WCAG AAA contrast guidelines.

---

## 3. Cohesive Interoperability (How They Function Together)

Although each component functions independently:
1. **Standalone Plugin:** Can be installed on any WordPress theme (Astra, GeneratePress, Twenty Twenty-Four, custom themes).
2. **Standalone Theme:** Functions as a complete FSE block theme for corporate finance sites with or without loan calculators.
3. **Combined Ecosystem:** When used together, the theme's `calculator-section` pattern automatically surfaces the plugin's computational interface inside a pre-styled, high-contrast financial layout with zero configuration.

---

## FinEngine Ecosystem Parity

FinEngine maintains identical mathematical parity between client-side JavaScript runtimes, Python scientific backends, and WordPress interfaces:

| Package / Repository | Version | Registry | Purpose |
| :--- | :--- | :--- | :--- |
| [**@finengine/core**](https://github.com/gmrafi/FinEngine/blob/main/packages/core) | 0.3.0 | npm | Integer sub-unit arithmetic, BDT currency primitives, double-entry ledger. |
| [**@finengine/math**](https://github.com/gmrafi/FinEngine/blob/main/packages/math) | 0.3.0 | npm | Actuarial reducing-balance loan amortization, EMI schedules, XIRR solver. |
| [**@finengine/ui**](https://github.com/gmrafi/FinEngine/blob/main/packages/ui) | 0.3.0 | npm | Accessible view-models for repayment summaries and burden gauges. |
| [**finengine (Python)**](https://github.com/gmrafi/FinEngine-Py) | 0.1.1 | PyPI | Python actuarial math, Pandas DataFrames, and alternative credit risk AI. |
| [**finengine-calculator**](https://github.com/gmrafi/FinEngine-WP) | 1.0.0 | WP.org / GitHub | Deterministic reducing-balance Loan & EMI Calculator WordPress plugin. |
| [**finengine-fintech**](https://themes.trac.wordpress.org/ticket/293749) | 1.0.0 | WP.org / GitHub | Full-Site Editing (FSE) block theme for fintech and banking portals. |

### Live Interactive Ecosystem Hubs & Surfaces

Explore the broader FinEngine computational platform:
- **WordPress Integration Portal:** [https://finengine.js.org/wordpress/](https://finengine.js.org/wordpress/) (Interactive shortcode generator, Gutenberg block walkthrough, and compatibility matrix)
- **Flagship Computational Platform:** [https://finengine.js.org/](https://finengine.js.org/) (Core deterministic financial primitives and live simulators)
- **Student & Educator Lab (EN/BN):** [https://finengine.js.org/student/](https://finengine.js.org/student/) (Interactive loan decomposition and FinTech education)
- **DSE Econometric Market Feed:** [https://finengine.js.org/dse/](https://finengine.js.org/dse/) (Dhaka Stock Exchange econometric feeds)
- **Global Open-Source Finance Directory (500 Repos):** [https://finengine.js.org/repositories/](https://finengine.js.org/repositories/) (Curated quant, AI agents, and market data directory)
- **Python SDK & Quant Hub:** [https://finengine.js.org/python/](https://finengine.js.org/python/) (Pandas DataFrame integration and PyPI quant library)
- **AI Models & MCP Agent Lab:** [https://finengine.js.org/ai/](https://finengine.js.org/ai/) (Model Context Protocol server for Claude and Cursor)
- **Simulation Lab:** [https://finengine.js.org/simulation/](https://finengine.js.org/simulation/) (SME working capital, student loan, and merchant scenarios)
- **Methodology Working Paper:** [https://finengine.js.org/methodology/](https://finengine.js.org/methodology/) (Academic paper CFSBR-FE-2026-001)
- **Core Monorepo:** [https://github.com/gmrafi/FinEngine](https://github.com/gmrafi/FinEngine)
- **Python SDK Repository:** [https://github.com/gmrafi/FinEngine-Py](https://github.com/gmrafi/FinEngine-Py)

---

## Installation & Usage

### 1. Instant 1-Click Demo (WordPress Playground)
Test the entire FinEngine ecosystem in a live WordPress environment directly inside your web browser without installing any software:

- **[Launch Live WordPress Playground Demo](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/gmrafi/FinEngine-WP/main/blueprint.json)**

*Spins up an isolated WebAssembly (Wasm) WordPress instance with both the plugin and theme pre-configured.*

### 2. Plugin Setup (`finengine-calculator`)
1. Download `finengine-calculator.zip` or install via WordPress Plugin Directory.
2. In WordPress admin, navigate to **Plugins > Add New > Upload Plugin**.
3. Activate the plugin.
4. Add the block via Block Editor (**FinEngine Loan Calculator**) or embed via shortcode:
   ```text
   [finengine_calculator currency="BDT" default_principal="500000" default_rate="12.0" default_tenure="36"]
   ```

#### Shortcode Parameters:
| Attribute | Default | Description |
| :--- | :--- | :--- |
| `currency` | `BDT` | Currency code (`BDT`, `INR`, `USD`, `EUR`, `GBP`) |
| `default_principal` | `500000` | Initial loan principal amount |
| `default_rate` | `12.0` | Annual interest rate (percentage) |
| `default_tenure` | `36` | Loan tenure in months |
| `theme` | `light` | Visual theme (`light`) |

### 3. Theme Setup (`finengine-fintech`)
1. Download `finengine-fintech.zip` or install via WordPress Theme Directory.
2. In WordPress admin, navigate to **Appearance > Themes > Add New > Upload Theme**.
3. Activate **FinEngine Fintech**.
4. Customize templates and global styles via **Appearance > Editor** (Site Editor).

---

## Development & Build Pipeline

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

## Institutional Governance, Authors & Maintenance

FinEngine WordPress Ecosystem is developed as an open computational research initiative under the institutional governance of the **Centre for Fintech and Strategic Business Research (CFSBR)**. Conceived and architected to eliminate IEEE-754 binary floating-point drift in client-side financial environments, the framework provides verifiable actuarial amortization schedules alongside native South Asian currency numbering standards.

### Authorship & Leadership

- **Author & Architect:** [Md Golam Mubasshir Rafi](https://gmrafi.com.bd/)
- **Institutional Governance:** [Centre for Fintech and Strategic Business Research (CFSBR)](https://finengine.js.org/)
- **WordPress Profile:** [https://profiles.wordpress.org/gmrafi](https://profiles.wordpress.org/gmrafi/)
- **Personal Website:** [https://gmrafi.com.bd](https://gmrafi.com.bd/)
- **GitHub Repository:** [https://github.com/gmrafi/FinEngine-WP](https://github.com/gmrafi/FinEngine-WP)
- **Theme Trac Ticket:** [https://themes.trac.wordpress.org/ticket/293749](https://themes.trac.wordpress.org/ticket/293749)
- **Official Contact:** [rafi@gmrafi.com.bd](mailto:rafi@gmrafi.com.bd)

The codebase is collaboratively maintained under CFSBR stewardship alongside the international WordPress developer community.

---

## License

- **Software Code:** Licensed under the [GNU General Public License v2.0 or later (GPL-2.0-or-later)](LICENSE) in full compliance with WordPress.org guidelines.
- **Documentation & Research Methodology:** [Creative Commons Attribution 4.0 International (CC-BY 4.0)](https://creativecommons.org/licenses/by/4.0/).

