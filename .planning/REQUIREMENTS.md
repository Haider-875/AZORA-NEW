---
milestone: v1.0-commercial-readiness
updated: 2026-11-06T11:24:00Z
---

# REQUIREMENTS.md — Azora Solution Requirements

## Functional Requirements

| ID | Requirement | Source | Phase | Status |
|----|-------------|--------|-------|--------|
| REQ-01 | Public Marketing Pages (Home, About, Services, Plans, Portfolio) | PROJECT Vision | Delivered | Complete |
| REQ-02 | Global Responsive Navigation with Services dropdown & Mobile Drawer | PROJECT UI | Delivered | Complete |
| REQ-03 | Master Global Footer with Corporate Headquarters and Google Map | PROJECT Vision | Delivered | Complete |
| REQ-04 | Lead Capture Configurator & Rapid Quote Modal | PROJECT Lead Engine | Delivered | Complete |
| REQ-05 | Database Persistence in MySQL `leads` table with Eloquent ORM | PROJECT Backend | Delivered | Complete |
| REQ-06 | Interactive 3D Case Study Carousel on Portfolio | PROJECT UI | Delivered | Complete |
| REQ-07 | Native Admin Authentication & Dashboard Route Lockdown | Security Audit | Phase 1 | Ready for Execution |
| REQ-08 | Public Endpoint Rate Limiting & Stored XSS Neutralization | Security Audit | Phase 1 | Ready for Execution |
| REQ-09 | Lead Ingestion Transaction Resiliency, Queued Email & Deduplication | Reliability Audit | Phase 2 | Planned |
| REQ-10 | Client-Side Error Feedback & Silent Redirect Elimination | UX Audit | Phase 2 | Planned |
| REQ-11 | Comprehensive Automated Test Suite & Nyquist Verification | Quality Baseline | Phase 3 | Queued |
| REQ-12 | Dead Asset Pruning (POS hardware images, unused prototype scripts) | Architecture Audit | Phase 4 | Queued |
| REQ-13 | Portfolio Carousel Integrity & Asset Link Scanner Gate | Regression Audit | Phase 4 | Queued |
| REQ-14 | Schema.org Structured Data, Canonical URLs, Sitemap & Robots.txt | Commercial Audit | Phase 5 | Queued |
| REQ-15 | Core Web Vitals Optimization (Lighthouse 90+ Target) | Performance Audit | Phase 5 | Queued |

---

## Non-Functional Requirements

| ID | Requirement | Category | Phase | Status |
|----|-------------|--------|-------|--------|
| NFR-01 | Page Load Performance: Core Web Vitals score >= 90 | Performance | Phase 5 | In Progress |
| NFR-02 | Full Viewport Responsiveness (360px mobile to 4K desktop) | UX / Mobile | Delivered | Complete |
| NFR-03 | WCAG AA Accessibility Contrast & Semantic Markup | Accessibility | Delivered | Complete |
| NFR-04 | CSRF Protection on all mutating web POST/PUT/DELETE routes | Security | Phase 1 | In Progress |
| NFR-05 | Zero Broken Assets / 404 Links Across All Pages | Reliability | Phase 4 | Queued |

---

## Constraints

| ID | Constraint | Source | Impact |
|----|------------|--------|--------|
| CON-01 | Pure Bootstrap 5.3 (Zero Tailwind Framework CSS) | Architectural Decision | All templates must use Bootstrap 5.3 + custom modern CSS |
| CON-02 | PHP 8.2+ Compatibility | Environment | All server logic must support modern PHP typing |
| CON-03 | POS Hardware Content Deprecated | Business Model Pivot | Hardware routes must return 301 redirects to digital services |
| CON-04 | No Data Loss on Cleanup | User Directive | Backup / Git checkpoint required before deleting legacy assets |
