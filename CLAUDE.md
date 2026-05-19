# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

Static website preview repository for the **Excigent Tech Partners** client project. There is no build system or package manager — HTML files are standalone and open directly in a browser.

## Key Files

- `hero-preview-stable.html` — Stable hero section preview (navigation, hero with 3D globe, services carousel, testimonials)
- `hero-preview-v3.html` — Enhanced version with additional sections: About, Services grid, Team cards, News, Affiliations marquee, and Footer
- `Excigent Scope Document.docx` — Project requirements and deliverables
- `Logo/` — Primary brand SVG (`Excigent Logo.svg`)
- `Affiliations/` — Partner/affiliation logos (8 SVGs for the auto-scrolling marquee)
- `Team/` — Leadership headshots (John Centofanti, Paul Weintraub, Robert Lopez — PNG)

## Architecture of HTML Previews

Both HTML files are self-contained single-page layouts with all CSS and JS inline. They share the same structure:

**Dependencies (via CDN, no local install needed):**
- **Three.js r128** — powers the interactive 3D Earth globe in the hero section
- **GSAP + ScrollTrigger** — drives scroll-based section reveals and timeline animations

**CSS approach:** CSS custom properties for theming, backdrop-filter frosted glass effects, CSS Grid/Flexbox layouts, keyframe animations with `will-change` optimizations, and a `prefers-reduced-motion` media query for accessibility.

**JS patterns:** Three.js scene setup at the top, GSAP timeline/ScrollTrigger wiring mid-file, then vanilla DOM event listeners (search expand/collapse, service category switching, marquee loop). All state is managed via DOM class toggling.

`v3` adds sections not in `stable`: Convergence, Network, Expertise, Process, Why Choose Us (icon grid), team cards, news cards, affiliations marquee, newsletter form, and full footer with contact info and social links.

## Brand Colors

| Token | Hex | Usage |
|---|---|---|
| Primary navy | `#0F405A` | Backgrounds, headings |
| Blue accent | `#1260A7` / `#2363A0` | Buttons, links |
| Lighter blue | `#3B6998` | Secondary accents |
