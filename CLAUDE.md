# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

Client project for **Excigent Tech Partners**. Contains two components:
1. **Static HTML previews** — standalone `.html` files opened directly in a browser (no build step)
2. **WordPress theme** (`excigent-wp-theme/`) — deployed to a live WordPress server via SFTP

## Live Server

| Item | Value |
|---|---|
| Live URL | `https://excigent.tequp.info` |
| SSH host | `159.89.36.80` port `22`, user `root` |
| Theme path on server | `/mnt/wp-sites/excigent/www/wp-content/themes/excigent-wp-theme` |
| DB | `excigent` / user `admin` / host `localhost` |

**SSH on Windows**: The Windows OpenSSH client does not support inline password auth. Use Python `paramiko` for all SSH/SFTP operations (`python3 -m pip install paramiko`). WP-CLI is not available on the server — use PHP scripts bootstrapped with `wp-load.php` for WP operations.

## WordPress Theme Architecture

### File layout

- `functions.php` — theme setup, asset enqueueing, CPT registration, ACF include, helper functions, nav walker
- `acf-fields.php` — all ACF field groups registered via `acf_add_local_field_group()` (no DB required); loaded from `functions.php` when ACF is active
- `front-page.php` — homepage template (most complex; all CSS/JS inline at top of file)
- `page-about.php`, `page-services.php`, `page-contact.php` — named page templates assigned via `_wp_page_template` post meta
- `header.php` / `footer.php` — shared layout wrappers; `Excigent_Nav_Walker` used for nav menu output
- `assets/css/main.css` — global stylesheet (Plus Jakarta Sans via Google Fonts)
- `assets/js/main.js` — shared JS (nav, hamburger, scroll-reveal)
- `assets/js/home.js` — homepage-only JS (Three.js globe, GSAP animations); enqueued only on `is_front_page()`

### CPTs registered in `functions.php`

| CPT | Slug | Notes |
|---|---|---|
| `team_member` | `/team` | Supports title, thumbnail, editor; ACF group `group_team_member_cpt` |
| `event` | `/events` | Has archive; ACF group `group_event_cpt` |

### ACF field groups (defined in `acf-fields.php`)

| Group key | Location rule | Purpose |
|---|---|---|
| `group_front_page` | `page_type == front_page` | Hero, events carousel (repeater), about snapshot, stats (repeater), CTAs |
| `group_about_page` | `page_template == page-about.php` | About page content |
| `group_services_page` | `page_template == page-services.php` | Services page content |
| `group_contact_page` | `page_template == page-contact.php` | Contact column heading/subtext |
| `group_options` | Options page `excigent-settings` | Site-wide settings (affiliations, footer links) |
| `group_event_cpt` | `post_type == event` | Event CPT fields |
| `group_team_member_cpt` | `post_type == team_member` | Team member CPT fields |

### Helper functions in `functions.php`

- `excigent_field($field, $fallback, $post_id)` — safe ACF text output with `wp_kses_post` / `esc_html`
- `excigent_img($field, ...)` — outputs `<img>` from ACF image field with fallback src
- `excigent_link($field, ...)` — outputs `<a>` from ACF link field with fallback url/label

`front-page.php` also defines a local `_ef($k, $fb)` shorthand for inline use within that template.

### Template content pattern (3-tier fallback)

All templates follow: ACF field value → CPT query (events/team) → static HTML fallback. This ensures pages render even with no ACF data entered.

### Populating ACF data via PHP script

To seed content programmatically, create a PHP file at the WordPress web root, bootstrap with `require('/mnt/wp-sites/excigent/www/wp-load.php')`, then call `update_field('field_key', $value, $post_id)` using ACF field keys (e.g. `field_hero_heading`). Delete the script immediately after running. Call `flush_rewrite_rules()` after creating new pages.

## Static HTML Previews

- `hero-preview-stable.html` — nav, hero with 3D globe, services carousel, testimonials
- `hero-preview-v3.html` — full single-page layout (adds About, Services grid, Team, News, Affiliations marquee, Footer)

Both are self-contained (all CSS/JS inline). Dependencies via CDN: **Three.js r128**, **GSAP + ScrollTrigger**.

## Brand Colors

| Token | Hex | Usage |
|---|---|---|
| Primary navy | `#0F405A` | Backgrounds, headings |
| Blue accent | `#1260A7` / `#2363A0` | Buttons, links |
| Lighter blue | `#3B6998` | Secondary accents |

Font: **Plus Jakarta Sans** (Google Fonts) — used as the cross-platform Aptos equivalent.

## Assets

- `Logo/Excigent Logo.svg` — primary brand mark (also copied to `excigent-wp-theme/assets/images/logo.svg`)
- `Affiliations/` — 8 partner logo SVGs for the auto-scrolling marquee
- `Team/` — headshots for John Centofanti, Paul Weintraub, Robert Lopez (PNG)
