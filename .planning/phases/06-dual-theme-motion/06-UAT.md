# UAT: Phase 6 — Dual Theme Foundation, Global Navigation & Core Components

**Branch:** `ND` (Local)  
**Executed Plans:** Plan 6.1 & Plan 6.2  
**Overall Status:** In Progress (Conversational Verification)  

---

## Acceptance Test Scenarios

### Test 1: Light/Dark Theme Switcher in Global Navbar
- **Status:** Pending Verification
- **Description:** Click the animated theme toggle button (Sun/Moon sliding pill) in the global navbar header.
- **Expected:** 
  - Smooth 360° rotation and sliding transition between Sun (Light) and Moon (Dark).
  - Background switches between signature sky blue (`#CCE8FF`) and deep cyber void (`#070B14`).
  - Cards, borders, and typography adapt with high contrast and zero clipping.

### Test 2: Theme Persistence & Zero-FOUC
- **Status:** Pending Verification
- **Description:** Toggle to Light theme (or Dark theme) and refresh the page or navigate to another page (e.g. `/services`, `/about`).
- **Expected:**
  - The chosen theme persists seamlessly via `localStorage`.
  - Zero flash of unstyled theme (FOUC) on page load.

### Test 3: Global Navbar & Services Dropdown
- **Status:** Pending Verification
- **Description:** Hover/click "Services" in the navbar, test links, and observe active underlines.
- **Expected:**
  - Services dropdown appears as a frosted white glass panel in light mode and cyber obsidian glass in dark mode.
  - Active indicator underline displays beneath current navigation link.

### Test 4: Mobile Viewport & Drawer Menu (390px)
- **Status:** Pending Verification
- **Description:** Open the website on mobile (or reduce browser window to mobile width ~390px).
- **Expected:**
  - Header displays brand logo on the left, theme switcher in the center-right, and hamburger trigger on the right.
  - Zero horizontal page overflow.
  - Tapping hamburger menu opens the mobile drawer displaying navigation items, live status dot, and secondary theme toggle.

### Test 5: Global Footer & Watermark
- **Status:** Pending Verification
- **Description:** Scroll to the bottom of any page to inspect the master footer.
- **Expected:**
  - Soft cobalt radial gradient in light mode; deep void in dark mode.
  - Giant "AZORA" watermark smoothly fades with gradient mask.
  - Circular social buttons, company links, contact details, and "Start a Project" button are crisp and legible.

### Test 6: Rapid Proposal Modal
- **Status:** Pending Verification
- **Description:** Click "Get a Quote" or "Build Custom Scope & Quote".
- **Expected:**
  - Modern modal opens smoothly with dual-theme frosted backdrop (`.azora-modal-backdrop`).
  - Interactive selection chips adapt cleanly in both Light and Dark themes.

### Test 7: Homepage Hero & Component Redesign (Plan 6.3)
- **Status:** Complete (Verified)
- **Description:** Inspect the homepage in both Light and Dark themes at desktop (1440px) and mobile (390px/500px).
- **Expected:**
  - Hero Section: High-contrast fluid headline, soft periwinkle atmospheric bloom (Light) / cyber violet (Dark), dual-action CTAs (`Build Custom Scope & Quote` and `Explore All Capabilities`).
  - Proof Metrics Row: 4 elevated bento metric boxes (`500+ Platforms Live`, `$45M+ Client Revenue`, `99.9% Uptime`, `< 15s AI Response`) with crisp card styling.
  - Live Operations Stage: AI Front Office live call card with audio wave bars and live typing indicator, Organic Leads counter with sparkline path, Map Pack Rank badge.
  - 3-Card Capabilities Section: Pure white cards with `#D5E6F5` border on Light theme; obsidian glass on Dark theme.
  - 4-Stage Engineering Cycle: Step connector loop, high-contrast monospace numbers (`01`, `02`, `03`, `04`), dark titles on Light theme, neon cyan on Dark theme.
  - Pricing Plans: Filter pills (`Website Development` vs `Local SEO & Marketing`) with active signature blue pill, white pricing cards, highlighted Growth tier.
  - FAQ Accordions: Clean dual-theme accordion cards with smooth chevron rotation.
  - Paymate 3D Carousel: Completely untouched.

- **Description:** Click any "Get a Quote" or "Start a Project" button to trigger the modal.
- **Expected:**
  - Modal opens over blurred backdrop (`.azora-modal-backdrop`).
  - Container renders white glass card in light mode and deep cyber card in dark mode.
  - Service toggle chips are interactive and clearly legible.

