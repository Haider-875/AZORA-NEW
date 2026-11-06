---
status: FINALIZED
created: 2026-11-06T10:52:00Z
finalized: 2026-11-06T10:52:00Z
---

# PROJECT.md — Azora Solution Specification

## Vision

Azora Solution is a high-performance commercial web engineering and digital marketing agency platform. The system delivers custom conversion-optimized websites, local SEO growth systems (Google Map Pack dominance), and AI front-office automation (AI Voice receptionist and WhatsApp triage) for service trades, healthcare clinics, multi-unit dining, and B2B commercial suppliers.

---

## Core Capabilities & Architecture

1. **Full-Stack Laravel Web Application:**
   - Architecture: Modern Laravel 13 MVC with Blade components, layouts, and controllers.
   - Database: MySQL persistence with Eloquent ORM (`Lead` model).
   - Email: Branded transactional emails via `LeadReceived` Mailable.
   - Admin Panel: Protected Command Center (`/dashboard`) with lead analytics, filtering, inspection, and CSV export.

2. **Luxury Modern Cyber UI Layer:**
   - Primary Framework: Bootstrap 5.3.3 + Bootstrap Icons (Strict Zero Tailwind policy).
   - Design System: Custom futuristic dark glassmorphic styling (`public/assets/css/azora-modern.css`).
   - Dynamic Components: Interactive 3D Paymate-style carousel for portfolio deployments, custom modal lead generator, and responsive navbar/footer.

3. **Lead Engine & Rapid Proposal System:**
   - Multi-point lead intake (interactive configurator, instant quote modal, consultation booking).
   - Dynamic plan pricing matrices and multi-location custom scope calculators.

---

## Goals

1. **High-Converting Public Presence:**
   Deliver sub-second Core Web Vitals performance across all pages (Home, Services, Plans, Portfolio, About, Quote, Success).

2. **Frictionless Lead Capture:**
   Capture and route inbound merchant leads with zero obligation, automated anti-spam protection, and instant email dispatch.

3. **Production Stability & Security:**
   Enforce CSRF verification, input sanitization, rate-limiting on lead capture, and secure authentication for administrative dashboards.

---

## Non-Goals (Out of Scope)

- **POS Hardware Sales:** Azora does NOT sell physical card terminals or POS inventory (legacy hardware routes are permanently 301-redirected).
- **Payment Processing Merchant Account Underwriting:** Azora provides web engineering and API integration, not card-acquiring merchant accounts.
- **Third-Party Bloat:** No external CSS framework dependencies outside Bootstrap 5.3.3.

---

## Users & Personas

- **Prospective Business Clients (SMEs, Franchises, Trades):** Looking for enterprise-grade web development, local SEO rank, and AI receptionists.
- **Agency Directors / Administrators:** Internal team managing lead pipelines, inspecting customer scope requests, and exporting data via the dashboard.

