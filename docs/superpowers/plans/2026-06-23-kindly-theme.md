# Kindly Block Theme — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build `Kindly`, a from-scratch WordPress FSE block theme for the nonprofit/faith (congregation) niche, WordPress.org-Themes-compliant, with a live demo.

**Architecture:** A pure block theme (no plugins, no CPTs): `theme.json` v3 design system + HTML block templates/parts + PHP-registered block patterns + three `theme.json` style variations. Anything dynamic (donations, events, forms) is layout-only and delegated to plugins the site owner installs. Verification is tool-based: the **Theme Check** plugin, the **Theme Unit Test** data, the **Site Editor**, and the **browse** skill (rendering/responsive/accessibility) — not unit tests.

**Tech Stack:** WordPress 6.7+ (FSE, `theme.json` v3), block markup (HTML comments), minimal PHP (pattern registration + enqueues), Docker for local WP, WP-CLI, the Theme Check plugin, the gstack `browse` skill.

**Spec:** `docs/superpowers/specs/2026-06-23-kindly-theme-design.md`

## Global Constraints

- License: **GPLv2-or-later**; every bundled asset (fonts, demo images, screenshot) must be GPL-compatible — document each source in `readme.txt`.
- **No** custom post types, taxonomies, shortcodes, or settings/options framework anywhere in the theme.
- **No** external HTTP requests. Fonts are bundled locally under `assets/fonts/` — **no Google Fonts CDN**.
- All PHP functions, globals, handles, and the pattern category slug are prefixed **`kindly_`** / `kindly`.
- `theme.json` is **schema version 3**; site requires WordPress **6.7+**.
- Text domain: **`kindly`** (used in all translatable PHP strings, e.g. pattern titles).
- Accessibility target: **WCAG 2.2 AA**, claiming the `accessibility-ready` tag — every interactive element keyboard-operable with a visible focus style; contrast ≥ AA in all three style variations.
- Required files must exist and pass Theme Check: `style.css` (header), `index.html`, `screenshot.png`.
- Nothing gated behind "Pro"; no upsell, tracking, or "powered by".

---

## Task 1: Local WP environment + theme skeleton that activates

**Files:**
- Create: `dev/docker-compose.yml` (local only; excluded from the theme zip)
- Create: `style.css`
- Create: `theme.json` (minimal, v3)
- Create: `functions.php`
- Create: `templates/index.html`
- Create: `screenshot.png` (temporary 1200×900 placeholder)
- Create: `.gitignore`

**Interfaces:**
- Produces: an installable theme named `Kindly` (slug `kindly`) that activates in WP without fatal errors; a running WP at `http://localhost:8920/wp-admin` (admin/admin123).

- [ ] **Step 1: Write the Docker env**

`dev/docker-compose.yml`:
```yaml
services:
  db:
    image: mariadb:11
    environment:
      MARIADB_DATABASE: wp
      MARIADB_USER: wp
      MARIADB_PASSWORD: wp
      MARIADB_ROOT_PASSWORD: root
    volumes: [db:/var/lib/mysql]
  wordpress:
    image: wordpress:6.7-php8.2-apache
    depends_on: [db]
    ports: ["8920:80"]
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wp
      WORDPRESS_DB_PASSWORD: wp
      WORDPRESS_DB_NAME: wp
    volumes:
      - ./..:/var/www/html/wp-content/themes/kindly
  wpcli:
    image: wordpress:cli-php8.2
    depends_on: [wordpress, db]
    user: "33:33"
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wp
      WORDPRESS_DB_PASSWORD: wp
      WORDPRESS_DB_NAME: wp
    volumes:
      - ./..:/var/www/html/wp-content/themes/kindly
    entrypoint: ["tail", "-f", "/dev/null"]
volumes:
  db:
```

- [ ] **Step 2: Write `.gitignore`**

```
/dev/.data
node_modules/
*.log
.DS_Store
```

- [ ] **Step 3: Write `style.css` (header only)**

```css
/*
Theme Name: Kindly
Theme URI: https://github.com/internick2017/kindly
Author: Nick Granados
Author URI: https://nickgranados.com
Description: A lightweight, accessibility-ready block theme for nonprofits and congregations. WCAG 2.2 AA out of the box, no page builder, nothing locked behind Pro.
Requires at least: 6.7
Tested up to: 6.7
Requires PHP: 8.0
Version: 0.1.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: kindly
Tags: full-site-editing, block-patterns, accessibility-ready, translation-ready, custom-colors, blog, news, one-column, two-columns
*/
```

- [ ] **Step 4: Write minimal `theme.json`**

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "appearanceTools": true,
    "layout": { "contentSize": "680px", "wideSize": "1140px" }
  }
}
```

- [ ] **Step 5: Write minimal `functions.php`**

```php
<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'kindly_setup' ) ) {
	function kindly_setup() {
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		load_theme_textdomain( 'kindly', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'kindly_setup' );

if ( ! function_exists( 'kindly_enqueue_styles' ) ) {
	function kindly_enqueue_styles() {
		wp_enqueue_style( 'kindly-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'kindly_enqueue_styles' );
```

- [ ] **Step 6: Write `templates/index.html` (minimal valid block template)**

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:query {"queryId":0,"query":{"inherit":true}} -->
<div class="wp-block-query"><!-- wp:post-template -->
<!-- wp:post-title {"isLink":true} /-->
<!-- wp:post-excerpt /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

(Header/footer parts are created in Task 3; until then WP renders empty parts gracefully.)

- [ ] **Step 7: Create a placeholder `screenshot.png`** (1200×900, solid color; replaced in Task 11).

- [ ] **Step 8: Boot WP and activate the theme**

Run:
```bash
cd dev && docker compose up -d
# wait for DB, then install WP
docker compose run --rm wpcli wp core install --url=http://localhost:8920 --title="Kindly Demo" --admin_user=admin --admin_password=admin123 --admin_email=admin@example.com --skip-email
docker compose run --rm wpcli wp theme activate kindly
```
Expected: `Success: Switched to 'Kindly' theme.`

- [ ] **Step 9: Verify it loads with no fatals**

Run: `docker compose run --rm wpcli wp eval 'echo "ok";'` → `ok`
Then with browse: `goto http://localhost:8920/` → page renders (empty-ish), `console --errors` shows no PHP fatals.

- [ ] **Step 10: Commit**

```bash
git add -A
git commit -m "feat: theme skeleton activates in WP (Kindly v0.1.0)"
```

---

## Task 2: Design system in `theme.json` + bundled fonts

**Files:**
- Modify: `theme.json` (full settings + base styles)
- Create: `assets/fonts/` (2 GPL font families, woff2) + `assets/fonts/LICENSE.md`

**Interfaces:**
- Produces: named color slots `base`, `contrast`, `primary`, `secondary`, `accent`, `surface`; font families `heading` and `body`; a spacing scale (`20`,`30`,`40`,`50`,`60`,`70`,`80`). Style variations (Task 9) and patterns (Tasks 5-8) reference these by slug.

- [ ] **Step 1: Download two GPL/OFL fonts locally** (e.g. headings: *Fraunces* or *Newsreader*; body: *Inter* or *Public Sans* — all OFL). Place `*.woff2` under `assets/fonts/` and record each font's license + source URL in `assets/fonts/LICENSE.md`.

- [ ] **Step 2: Write the full `theme.json`** (replace the minimal one)

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "settings": {
    "appearanceTools": true,
    "layout": { "contentSize": "680px", "wideSize": "1140px" },
    "useRootPaddingAwareAlignments": true,
    "color": {
      "defaultPalette": false,
      "palette": [
        { "slug": "base", "color": "#ffffff", "name": "Base" },
        { "slug": "surface", "color": "#f5f3ee", "name": "Surface" },
        { "slug": "contrast", "color": "#1f2933", "name": "Contrast" },
        { "slug": "primary", "color": "#2a6f6b", "name": "Primary" },
        { "slug": "secondary", "color": "#c9885a", "name": "Secondary" },
        { "slug": "accent", "color": "#e4b363", "name": "Accent" }
      ]
    },
    "typography": {
      "fluid": true,
      "defaultFontSizes": false,
      "fontFamilies": [
        {
          "slug": "heading", "name": "Heading", "fontFamily": "Fraunces, Georgia, serif",
          "fontFace": [ { "fontFamily": "Fraunces", "fontWeight": "400 700", "fontStyle": "normal", "fontStretch": "normal", "src": [ "file:./assets/fonts/fraunces.woff2" ] } ]
        },
        {
          "slug": "body", "name": "Body", "fontFamily": "Inter, -apple-system, sans-serif",
          "fontFace": [ { "fontFamily": "Inter", "fontWeight": "400 700", "fontStyle": "normal", "fontStretch": "normal", "src": [ "file:./assets/fonts/inter.woff2" ] } ]
        }
      ],
      "fontSizes": [
        { "slug": "small", "name": "Small", "size": "0.9rem", "fluid": false },
        { "slug": "medium", "name": "Medium", "size": "1.05rem", "fluid": { "min": "1rem", "max": "1.125rem" } },
        { "slug": "large", "name": "Large", "size": "1.5rem", "fluid": { "min": "1.25rem", "max": "1.6rem" } },
        { "slug": "x-large", "name": "Extra Large", "size": "2.25rem", "fluid": { "min": "1.9rem", "max": "2.75rem" } },
        { "slug": "xx-large", "name": "Huge", "size": "3.25rem", "fluid": { "min": "2.5rem", "max": "4rem" } }
      ]
    },
    "spacing": {
      "defaultSpacingSizes": false,
      "spacingScale": { "steps": 0 },
      "spacingSizes": [
        { "slug": "20", "name": "1", "size": "0.5rem" },
        { "slug": "30", "name": "2", "size": "1rem" },
        { "slug": "40", "name": "3", "size": "1.5rem" },
        { "slug": "50", "name": "4", "size": "2.5rem" },
        { "slug": "60", "name": "5", "size": "4rem" },
        { "slug": "70", "name": "6", "size": "6rem" },
        { "slug": "80", "name": "7", "size": "8rem" }
      ]
    }
  },
  "styles": {
    "color": { "background": "var(--wp--preset--color--base)", "text": "var(--wp--preset--color--contrast)" },
    "typography": { "fontFamily": "var(--wp--preset--font-family--body)", "fontSize": "var(--wp--preset--font-size--medium)", "lineHeight": "1.7" },
    "spacing": { "blockGap": "var(--wp--preset--spacing--40)", "padding": { "left": "var(--wp--preset--spacing--30)", "right": "var(--wp--preset--spacing--30)" } },
    "elements": {
      "heading": { "typography": { "fontFamily": "var(--wp--preset--font-family--heading)", "fontWeight": "600", "lineHeight": "1.2" } },
      "h1": { "typography": { "fontSize": "var(--wp--preset--font-size--xx-large)" } },
      "h2": { "typography": { "fontSize": "var(--wp--preset--font-size--x-large)" } },
      "h3": { "typography": { "fontSize": "var(--wp--preset--font-size--large)" } },
      "link": { "color": { "text": "var(--wp--preset--color--primary)" }, ":hover": { "typography": { "textDecoration": "underline" } } },
      "button": {
        "color": { "background": "var(--wp--preset--color--primary)", "text": "var(--wp--preset--color--base)" },
        "border": { "radius": "6px" },
        "spacing": { "padding": { "top": "0.75rem", "bottom": "0.75rem", "left": "1.5rem", "right": "1.5rem" } },
        ":hover": { "color": { "background": "var(--wp--preset--color--contrast)" } },
        ":focus": { "color": { "background": "var(--wp--preset--color--contrast)" } }
      }
    }
  }
}
```

- [ ] **Step 3: Verify in the Site Editor**

With browse: `goto http://localhost:8920/wp-admin/site-editor.php` (log in first via the form), open Styles → confirm the palette (6 colors), the two font families, and the spacing presets appear.

- [ ] **Step 4: Verify fonts load locally (no external request)**

browse `network` on the front page → confirm font files load from `/wp-content/themes/kindly/assets/fonts/...` and there is **no** request to `fonts.googleapis.com` / `fonts.gstatic.com`.

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "feat: theme.json design system + locally bundled GPL fonts"
```

---

## Task 3: Template parts — header & footer (with skip link + landmarks)

**Files:**
- Create: `parts/header.html`
- Create: `parts/footer.html`
- Modify: `theme.json` → add `templateParts` registration

**Interfaces:**
- Produces: `header` (tagName `header`, area `header`) containing a skip link, site title/logo, and a navigation block; `footer` (tagName `footer`, area `footer`). The skip link targets `#wp--skip-link--target`, which `main` elements in templates must expose.

- [ ] **Step 1: Register template parts in `theme.json`**

Add at top level:
```json
  "templateParts": [
    { "name": "header", "title": "Header", "area": "header" },
    { "name": "footer", "title": "Footer", "area": "footer" }
  ]
```

- [ ] **Step 2: Write `parts/header.html`**

```html
<!-- wp:group {"tagName":"div","className":"kindly-skip-link","layout":{"type":"constrained"}} -->
<div class="wp-block-group kindly-skip-link"><!-- wp:paragraph -->
<p><a href="#wp--skip-link--target"><?php /* skip */ ?>Skip to content</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:site-title {"level":1,"fontSize":"large"} /-->
<!-- wp:navigation {"overlayMenu":"mobile","ariaLabel":"Primary"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
```
(Note: the `<?php ?>` comment above is illustrative; the literal text "Skip to content" is the link text. Do not embed PHP in `.html` part files — write the plain text.)

- [ ] **Step 3: Write `parts/footer.html`** — three-column group: column 1 = site title + short about paragraph; column 2 = "Quick links" heading + navigation; column 3 = "Visit us" heading + address paragraph + service times paragraph; below, a Social Icons block and a copyright paragraph. Use core blocks only (`wp:columns`, `wp:heading` level 2, `wp:navigation`, `wp:social-links`, `wp:paragraph`), `surface` background, spacing presets `60`/`40`.

- [ ] **Step 4: Verify**

browse `goto http://localhost:8920/` → header shows title + nav, footer shows 3 columns; `snapshot -i` shows the skip link as the first focusable element. Tab once from page load → focus lands on "Skip to content".

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "feat: header/footer template parts with skip link and landmarks"
```

---

## Task 4: Core block templates

**Files:**
- Create: `templates/page.html`, `templates/single.html`, `templates/archive.html`, `templates/search.html`, `templates/404.html`
- (front-page.html is built in Task 8)

**Interfaces:**
- Consumes: `header`/`footer` parts (Task 3).
- Produces: every template wraps content in `<main id="wp--skip-link--target" tabindex="-1">` (the skip-link target) using `wp:group {"tagName":"main"}` with an anchor.

- [ ] **Step 1: Write each template** using core blocks. Each follows this shape (example = `templates/page.html`):

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main","metadata":{"name":"Main"},"anchor":"wp--skip-link--target","layout":{"type":"constrained"}} -->
<main id="wp--skip-link--target" tabindex="-1" class="wp-block-group"><!-- wp:post-title {"level":1} /-->
<!-- wp:post-featured-image /-->
<!-- wp:post-content {"layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

- `single.html` — like page but add `wp:post-date` + `wp:post-terms` meta row above the title, and a `wp:comments` block after the content.
- `archive.html` / `search.html` — `main` contains `wp:query-title`, then a `wp:query {"query":{"inherit":true}}` with post-template (title link + excerpt + date) and `wp:query-pagination`. `search.html` adds a `wp:search` block at top.
- `404.html` — `main` contains an H1 "Page not found", a helpful paragraph, a `wp:search` block, and a "Back to home" button (`wp:buttons`).

- [ ] **Step 2: Import the Theme Unit Test data**

```bash
cd dev && docker compose run --rm wpcli wp plugin install wordpress-importer --activate
docker compose run --rm wpcli bash -c "curl -sL https://raw.githubusercontent.com/WPTT/theme-unit-test/master/themeunittestdata.wordpress.xml -o /tmp/tut.xml && wp import /tmp/tut.xml --authors=create"
```

- [ ] **Step 3: Verify each template renders** with browse against representative URLs from the test data: a Page, a single Post, a category `/?cat=...` archive, `/?s=test` search, and a random 404 URL. `console --errors` clean on each; the `main` landmark and skip-link target present (`is visible "#wp--skip-link--target"`).

- [ ] **Step 4: Commit**

```bash
git add -A && git commit -m "feat: core block templates (page/single/archive/search/404)"
```

---

## Task 5: Pattern infrastructure + hero / service-times / mission

**Files:**
- Modify: `functions.php` → register the `kindly` pattern category
- Create: `patterns/hero.php`, `patterns/service-times.php`, `patterns/mission.php`

**Interfaces:**
- Produces: registered pattern category `kindly`; three patterns with slugs `kindly/hero`, `kindly/service-times`, `kindly/mission`. front-page.html (Task 8) references these slugs.

- [ ] **Step 1: Register the pattern category** — add to `functions.php`:

```php
if ( ! function_exists( 'kindly_register_pattern_categories' ) ) {
	function kindly_register_pattern_categories() {
		register_block_pattern_category( 'kindly', array( 'label' => __( 'Kindly', 'kindly' ) ) );
	}
}
add_action( 'init', 'kindly_register_pattern_categories' );
```

- [ ] **Step 2: Write `patterns/hero.php`** (full example — sets the convention for all patterns)

```php
<?php
/**
 * Title: Hero — Welcome
 * Slug: kindly/hero
 * Categories: kindly, banner
 * Description: Full-width welcome hero with mission statement and a primary call to action.
 */
?>
<!-- wp:cover {"overlayColor":"contrast","dimRatio":40,"minHeight":70,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);min-height:70vh"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-40 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"base","fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Welcome — come as you are', 'kindly' ); ?></h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
<p class="has-text-align-center has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'A community gathered around faith, service, and belonging.', 'kindly' ); ?></p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"accent","textColor":"contrast"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-accent-background-color has-text-color has-background wp-element-button"><?php esc_html_e( 'Plan your visit', 'kindly' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
```

- [ ] **Step 3: Write `patterns/service-times.php`** — same header convention (Title/Slug `kindly/service-times`/Categories `kindly`). Body: a `surface`-background `wp:group` (full), constrained inner with an H2 "When we gather", then `wp:columns` of 3 — each column a card (`wp:group` with padding `40`, base background, radius) holding an H3 (e.g. "Sunday Service", "Midweek", "Youth Night"), a time paragraph, and a short note. AA contrast on text.

- [ ] **Step 4: Write `patterns/mission.php`** — constrained `wp:group`: H2 "Who we are", a lead paragraph, and a 2-column `wp:columns` (left: a couple of short value paragraphs; right: an `wp:image` placeholder with empty `alt` to be filled by content). Keep it light and text-forward.

- [ ] **Step 5: Verify** — in the Site Editor inserter (browse), open Patterns → "Kindly" category → confirm the three patterns appear and insert without error; front-end render of an inserted hero shows AA-contrast white text on the dimmed cover.

- [ ] **Step 6: Commit**

```bash
git add -A && git commit -m "feat: pattern category + hero/service-times/mission patterns"
```

---

## Task 6: Congregation patterns — activities, serve, outreach, announcements, location, contact

**Files:**
- Create: `patterns/activities.php`, `patterns/serve.php`, `patterns/outreach.php`, `patterns/announcements.php`, `patterns/location.php`, `patterns/contact.php`

**Interfaces:**
- Produces: pattern slugs `kindly/activities`, `kindly/serve`, `kindly/outreach`, `kindly/announcements`, `kindly/location`, `kindly/contact`. All use the header convention and core blocks only.

- [ ] **Step 1: `activities.php`** — H2 "Upcoming activities", then a **core Query Loop** (`wp:query` with `"inherit":false`, `postType":"post"`, `perPage:3`) rendering post-template cards (featured image + title link + date + excerpt) and a "See all" button. (Layout only — real event management is a plugin's job.)

- [ ] **Step 2: `serve.php`** — `primary`-background full group, base text, centered: H2 "Join us in serving", a paragraph inviting participation, and a button "Get involved". AA contrast (white on primary — verify).

- [ ] **Step 3: `outreach.php`** — H2 "Service & outreach"; intro paragraph framed around *giving to others* (humanitarian focus, not fundraising); a 3-column `wp:columns` of outreach areas (icon image + H3 + short paragraph each).

- [ ] **Step 4: `announcements.php`** — H2 "Announcements"; a Query Loop (latest 3 posts, compact list: title link + date) — layout only.

- [ ] **Step 5: `location.php`** — 2-column: left = H2 "Find us" + address paragraph + service-times note; right = an `wp:image` placeholder captioned "Map" (a real map embed is added by the site owner; no external request shipped).

- [ ] **Step 6: `contact.php`** — H2 "Get in touch"; 2-column: left = contact details (email/phone/address paragraphs); right = a placeholder group captioned "Add your forms-plugin block here" with an accessible note. (No form processing in the theme.)

- [ ] **Step 7: Verify** — all six appear in the inserter under "Kindly", insert and render with no console errors; `serve` and any colored-background text pass AA contrast (check with browse + a contrast check).

- [ ] **Step 8: Commit**

```bash
git add -A && git commit -m "feat: congregation patterns (activities/serve/outreach/announcements/location/contact)"
```

---

## Task 7: Nonprofit patterns — causes, impact, stories, team, newsletter, donate (optional)

**Files:**
- Create: `patterns/causes.php`, `patterns/impact.php`, `patterns/stories.php`, `patterns/team.php`, `patterns/newsletter.php`, `patterns/donate.php`

**Interfaces:**
- Produces: pattern slugs `kindly/causes`, `kindly/impact`, `kindly/stories`, `kindly/team`, `kindly/newsletter`, `kindly/donate`. These are available in the inserter but are **not** part of the default front-page assembly (Task 8).

- [ ] **Step 1: `causes.php`** — H2 "Our programs"; 3-column cards (image + H3 + paragraph + "Learn more" link).
- [ ] **Step 2: `impact.php`** — `surface` full group; a `wp:columns` row of 3-4 stat cards (huge number via H2/`xx-large` + label paragraph). Numbers are demo placeholders in copy.
- [ ] **Step 3: `stories.php`** — H2 "Stories"; 2 `wp:quote` blocks (testimonial text + cite) in columns.
- [ ] **Step 4: `team.php`** — H2 "Our team"; 3-4 column grid (rounded `wp:image` + H3 name + role paragraph).
- [ ] **Step 5: `newsletter.php`** — centered `surface` group: H2 "Stay connected", paragraph, and a placeholder group captioned "Add your newsletter-plugin block here" (no processing in theme).
- [ ] **Step 6: `donate.php`** — centered `accent`/`surface` group: H2 "Support our work", paragraph, and a "Donate" button linking to `#` (the site owner points it at their donation page/plugin). Header description must note it is optional and excluded from the default homepage.
- [ ] **Step 7: Verify** — all six appear under "Kindly" in the inserter and render; AA contrast on any colored backgrounds.
- [ ] **Step 8: Commit**

```bash
git add -A && git commit -m "feat: nonprofit patterns (causes/impact/stories/team/newsletter/donate-optional)"
```

---

## Task 8: `front-page.html` default assembly

**Files:**
- Create: `templates/front-page.html`

**Interfaces:**
- Consumes: patterns from Tasks 5-6.
- Produces: the default homepage. Assembly order: `hero → service-times → mission → activities → serve → outreach → contact` (donate/causes/impact intentionally excluded).

- [ ] **Step 1: Write `templates/front-page.html`** wrapping the pattern refs in header/main/footer:

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->
<!-- wp:group {"tagName":"main","anchor":"wp--skip-link--target","layout":{"type":"constrained"}} -->
<main id="wp--skip-link--target" tabindex="-1" class="wp-block-group">
<!-- wp:pattern {"slug":"kindly/hero"} /-->
<!-- wp:pattern {"slug":"kindly/service-times"} /-->
<!-- wp:pattern {"slug":"kindly/mission"} /-->
<!-- wp:pattern {"slug":"kindly/activities"} /-->
<!-- wp:pattern {"slug":"kindly/serve"} /-->
<!-- wp:pattern {"slug":"kindly/outreach"} /-->
<!-- wp:pattern {"slug":"kindly/contact"} /-->
</main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

- [ ] **Step 2: Set a static front page + verify**

```bash
cd dev && docker compose run --rm wpcli wp option update show_on_front page
docker compose run --rm wpcli wp post create --post_type=page --post_title="Home" --post_status=publish --porcelain
# use the returned ID:
docker compose run --rm wpcli wp option update page_on_front <ID>
```
browse `goto http://localhost:8920/` → the full homepage renders in order; `console --errors` clean; `responsive` screenshots at mobile/tablet/desktop look intact. Read the screenshots.

- [ ] **Step 3: Commit**

```bash
git add -A && git commit -m "feat: front-page default assembly"
```

---

## Task 9: Style variations — Charity, Faith, Community

**Files:**
- Create: `styles/charity.json`, `styles/faith.json`, `styles/community.json`

**Interfaces:**
- Consumes: the palette/typography slugs from Task 2.
- Produces: three selectable styles. Each overrides `settings.color.palette` values (same slugs) and optionally `styles.typography`/font-family swaps. All must keep text/background contrast ≥ AA.

- [ ] **Step 1: `styles/faith.json`** (full example — default demo style: serene, calm)

```json
{
  "$schema": "https://schemas.wp.org/trunk/theme.json",
  "version": 3,
  "title": "Faith",
  "settings": {
    "color": {
      "palette": [
        { "slug": "base", "color": "#fbfbf9", "name": "Base" },
        { "slug": "surface", "color": "#eef1f0", "name": "Surface" },
        { "slug": "contrast", "color": "#22303a", "name": "Contrast" },
        { "slug": "primary", "color": "#3a6b7e", "name": "Primary" },
        { "slug": "secondary", "color": "#8a9b8e", "name": "Secondary" },
        { "slug": "accent", "color": "#d8c08a", "name": "Accent" }
      ]
    }
  }
}
```

- [ ] **Step 2: `styles/charity.json`** — warm/hopeful: base `#fffdf8`, surface `#fdeede`, contrast `#2c2417`, primary `#c4622d`, secondary `#5b8a72`, accent `#f0a02b`. Title "Charity".
- [ ] **Step 3: `styles/community.json`** — vibrant/grassroots: base `#ffffff`, surface `#eef4ff`, contrast `#1b2333`, primary `#3b54c4`, secondary `#e0467c`, accent `#f4c430`. Title "Community".

- [ ] **Step 4: Verify contrast for all three** — for each variation, the primary-as-button (base text) and contrast-on-base body text must be ≥ 4.5:1. Compute/verify each pair; adjust hex values until AA passes. Then in the Site Editor → Styles → confirm all three appear and switching re-themes the homepage. Screenshot each via browse and read them.

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "feat: three style variations (Faith/Charity/Community), AA-verified"
```

---

## Task 10: Accessibility pass (WCAG 2.2 AA)

**Files:**
- Modify: `theme.json` → add focus-visible outline styling via `styles.elements` where supported; add a small `assets/css/` only if a focus style cannot be expressed in theme.json (prefer theme.json).
- Modify: any pattern/part where a contrast or focus issue is found.

**Interfaces:**
- Produces: a theme that passes a keyboard + contrast + landmark audit.

- [ ] **Step 1: Verify skip link works end-to-end** — load homepage, press Tab once → focus on "Skip to content"; press Enter → focus moves to `#wp--skip-link--target` (main). (browse: `press Tab`, `is focused` on the link; activate and check focus moves.)

- [ ] **Step 2: Verify visible focus on all interactive elements** — Tab through nav links, buttons, form placeholders → each shows a clear focus outline. If the theme's button/link focus styles are insufficient, strengthen them in `theme.json` (`elements.button:focus`, `elements.link:focus`) — re-verify.

- [ ] **Step 3: Verify landmarks & headings** — each template exposes `header`/`main`/`footer`; one H1 per page; heading levels don't skip. (browse `accessibility` tree + manual check.)

- [ ] **Step 4: Verify reduced motion** — confirm no essential animation; any motion respects `prefers-reduced-motion` (the theme ships none by default — assert no auto-playing/animated blocks were introduced).

- [ ] **Step 5: Run an automated a11y check** — install the Theme Check + (optionally) an a11y scanner; confirm no contrast/landmark errors across the three variations.

- [ ] **Step 6: Commit**

```bash
git add -A && git commit -m "fix: accessibility pass — skip link, focus, landmarks (WCAG 2.2 AA)"
```

---

## Task 11: readme.txt, real screenshot, Theme Check 0 errors (compliance gate)

**Files:**
- Create: `readme.txt`
- Replace: `screenshot.png` (real homepage screenshot, 1200×900)
- Modify: bump `Version` to `1.0.0` in `style.css`

**Interfaces:**
- Produces: a WP.org-submittable theme that passes Theme Check with 0 required-level issues.

- [ ] **Step 1: Write `readme.txt`** — standard WP.org theme readme: short description, `Requires at least: 6.7`, `Tested up to`, `Requires PHP`, `License: GPLv2 or later`, a Description section, a Copyright/credits section listing **each bundled font and image with its license + source URL**, and a Changelog (`= 1.0.0 =`).

- [ ] **Step 2: Capture the real `screenshot.png`** — browse the homepage (Faith variation) at 1200px width, screenshot, crop/resize to exactly 1200×900, save as `screenshot.png`.

- [ ] **Step 3: Run Theme Check** —

```bash
cd dev && docker compose run --rm wpcli wp plugin install theme-check --activate
```
Then browse to `http://localhost:8920/wp-admin/themes.php?page=themecheck`, select Kindly, run, and read results. Expected: **0 REQUIRED** issues. Fix any that appear (re-run until clean). Record warnings that are intentional/acceptable.

- [ ] **Step 4: Bump version to 1.0.0** in `style.css` and `readme.txt`.

- [ ] **Step 5: Commit**

```bash
git add -A && git commit -m "chore: readme.txt, real screenshot, Theme Check clean — Kindly v1.0.0"
```

---

## Task 12: Demo content, deploy to HostGator, portfolio card

**Files:**
- Create: `dev/demo-content.md` (notes on the fictional org + the seeded pages)
- Modify (portfolio repo): `f:\proyects-to-sell\portfolio-template\nick-granados-website\src\data\projects.ts`

**Interfaces:**
- Produces: a live demo URL + a portfolio card.

- [ ] **Step 1: Build demo content** — create the fictional, non-denominational congregation/nonprofit content (Home using the front-page assembly, an About page, a few Activity posts) locally; document it in `dev/demo-content.md`. Use GPL/CC0 demo images with `alt` text.

- [ ] **Step 2: Deploy to a HostGator subdomain** — set up `kindly.nickgranados.com` (cPanel: create subdomain, install WordPress, upload the `kindly` theme zip, activate, set the Faith style, import the demo content). (Manual cPanel steps — Nick performs the WP install; the theme zip is produced by `git archive` excluding `dev/` and docs.) Verify the live URL renders and passes a quick browse smoke test.

- [ ] **Step 3: Add the portfolio card** — append a `Project` object to `projects.ts` (category `wordpress`): title EN/ES/PT, description (emphasize from-scratch FSE, WCAG 2.2 AA, lightweight, 3 style variations), `github: 'https://github.com/internick2017/kindly'`, `demo: 'https://kindly.nickgranados.com/'`, `image: '/images/project-kindly.png'`. Capture `project-kindly.png` via browse from the live demo. Run `yarn tsc --noEmit` in the portfolio repo.

- [ ] **Step 4: Commit (theme repo)** and (separately, with Nick's OK) deploy the portfolio update.

```bash
git add -A && git commit -m "docs: demo content notes"
```

---

## Self-Review

**Spec coverage:** §1 purpose → all tasks; §2 identity → Task 1 (style.css) + Global Constraints; §3 architecture → Tasks 1-9 (file structure realized); §4 templates → Tasks 1,4,8; §5 patterns → Tasks 5-8 (all listed patterns covered; default assembly = Task 8); §6 style variations → Task 9; §7 design system + a11y → Tasks 2 + 10; §8 WP.org compliance → Task 11 (Theme Check) + Global Constraints; §9 demo/deploy → Task 12; §10 QA → embedded verification steps + Tasks 10/11; §11 out-of-scope → enforced by Global Constraints + pattern notes; §12 success criteria → Tasks 9/10/11/12. No spec section is unmapped.

**Placeholder scan:** Pattern tasks 6/7 describe per-pattern content concretely (blocks, headings, copy intent) following the fully-written `hero` convention in Task 5 — each pattern is distinct content, not a hidden TODO. The image `alt`/map/forms placeholders are *intentional theme behavior* (delegated to the site owner/plugins), documented as such, not plan gaps.

**Type/name consistency:** prefix `kindly_` and category `kindly` consistent across functions.php tasks; pattern slugs (`kindly/hero`, etc.) match between Tasks 5-7 and the front-page refs in Task 8; palette slugs (`base/surface/contrast/primary/secondary/accent`) consistent between Task 2 and the variations in Task 9; skip-link target `#wp--skip-link--target` consistent between Task 3 (link) and Tasks 4/8 (main anchor).
