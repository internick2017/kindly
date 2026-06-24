# Kindly — WordPress Block Theme — Design Spec

**Date:** 2026-06-23
**Author:** Nick Granados (with Claude)
**Status:** Approved design → ready for implementation plan
**Repo:** `E:\dev\02-wordpress\kindly`

---

## 1. Purpose & context

`Kindly` is a custom **Full Site Editing (FSE) block theme** built from scratch. It serves two goals:

1. **Portfolio / CV evidence** — fills the "custom theme development from scratch" gap in Nick's *WordPress Engineer* positioning (the existing assets — the Smart Alt Generator plugin and the Lanny Herrera child site — do not prove from-scratch theme building).
2. **Public asset / lead-gen** — built WordPress.org-Themes-compliant from day 1, so it can be submitted to the directory later (like the published plugin). The live demo ships first; the WP.org submit is an optional follow-up.

**Differentiator (the answer to "why not just another theme?"):** the free FSE space is contested for *multipurpose* themes but **wide open for service/faith verticals**. `Kindly` is a **nonprofit / faith (congregation) niche** theme, positioned on the three things users most complain about in existing themes:

- **Lightweight** — no page-builder dependency, minimal CSS via `theme.json`, core blocks only.
- **Accessibility-ready (WCAG 2.2 AA) out of the box** — rare among free themes, legally relevant since 2025, and thematically aligned (nonprofits serve diverse audiences).
- **Nothing locked behind Pro** — all patterns and style variations are free.

**Dogfood target:** inspired by Nick's own congregation (La Iglesia de Jesucristo de los Santos de los Últimos Días). That church does **not** solicit public donations — it gives (humanitarian service). This shapes the content model: **donation is an optional, non-default pattern**, and the emphasis is on **service/outreach**, not fundraising. The shipped theme stays **generic** (faith + nonprofit) for broad WP.org appeal; the demo uses a fictional, non-denominational congregation (no official branding/affiliation).

---

## 2. Identity

- **Theme name:** `Kindly`
- **Slug / text domain:** `kindly` (verified available on WordPress.org Themes directory, 2026-06-23)
- **Function/handle prefix:** `kindly_`
- **License:** GPLv2-or-later; all bundled assets (fonts, images, screenshot) GPL-compatible.

---

## 3. Architecture (WP.org-clean FSE block theme)

```
kindly/
├── style.css            # Theme header only (name, author, GPLv2+, tags, text domain). No styling.
├── theme.json           # v3: settings (palette, fluid typography, spacing, layout) + base styles.
├── functions.php        # Minimal: enqueue style.css, add_theme_support, register pattern categories,
│                        #          enqueue editor styles, register block styles. Prefixed kindly_.
├── readme.txt           # WP.org readme (description, changelog, FAQ).
├── screenshot.png       # 1200×900.
├── templates/           # Block templates (HTML)
│   ├── index.html       # required — blog fallback
│   ├── front-page.html  # the congregation/nonprofit homepage (default pattern assembly)
│   ├── page.html
│   ├── single.html
│   ├── archive.html
│   ├── search.html
│   └── 404.html
├── parts/               # Template parts (HTML)
│   ├── header.html      # logo + nav + optional CTA
│   └── footer.html      # columns (about / quick links / contact) + social + copyright
├── patterns/            # Block patterns (PHP, registered & prefixed)
│   └── ... (see §5)
├── styles/              # theme.json style variations (see §6)
│   ├── charity.json
│   ├── faith.json
│   └── community.json
└── assets/
    └── fonts/           # locally bundled GPL fonts (no Google Fonts CDN)
```

**Hard rule (WP.org Theme Review):** the theme registers **no** custom post types, taxonomies, shortcodes, or options framework. Anything dynamic (events, donations, forms) is presentation only — the theme supplies layout/patterns; real functionality is delegated to plugins the site owner installs (e.g., The Events Calendar, GiveWP, a forms plugin). Dynamic listings use the **core Query Loop** over standard posts/pages.

---

## 4. Templates & template parts

| Template | Purpose |
|----------|---------|
| `index.html` | Required fallback; blog/posts list via Query Loop. |
| `front-page.html` | Homepage; assembles the default pattern set (§5). |
| `page.html` | Generic page (title + content + sidebar-less layout). |
| `single.html` | Single post (article + meta + featured image). |
| `archive.html` | Category/tag/date archives via Query Loop. |
| `search.html` | Search results. |
| `404.html` | Friendly not-found with search + home CTA. |

**Parts:** `header.html` (site logo, primary navigation, optional single CTA button), `footer.html` (3-column: short about / quick links / contact + service times, plus social icons and copyright).

---

## 5. Block patterns (core blocks only)

All patterns use core blocks (Group, Columns, Cover, Buttons, Query Loop, Details, Image, Heading, Paragraph, Social Icons). Registered with `kindly_` prefix and a `kindly` pattern category.

**Congregation / faith-oriented (default emphasis):**
- `hero` — welcome + mission statement + primary CTA (e.g., "Visit us" / "Get involved")
- `mission` — who we are / what we believe (short)
- `service-times` — meeting/service schedule + location
- `activities` — upcoming activities/events (Query Loop over posts; layout only)
- `serve` — "Join us in serving" (volunteer/ministering invitation)
- `outreach` — **Service / humanitarian outreach** — what the organization gives/does *for others* (replaces fundraising emphasis)
- `announcements` — recent announcements/news
- `location` — address, map embed placeholder, how to find us
- `contact` — contact details + space for a forms-plugin block

**Nonprofit-oriented (available, not all in default assembly):**
- `causes` — programs/causes grid
- `impact` — stats row (people served, volunteers, etc.)
- `stories` — testimonials / impact stories
- `team` — leadership/team grid
- `newsletter` — signup callout (layout for a forms/newsletter plugin)
- `donate` — **OPTIONAL**; included for orgs that fundraise, but **excluded from the default front-page assembly**

**Default `front-page.html` assembly:**
`hero → service-times → mission → activities → serve → outreach → contact`
(`donate`, `causes`, `impact` remain available as patterns for the "nonprofit fundraising" use case.)

---

## 6. Style variations (the FSE showcase)

Three `theme.json` style variations — same templates/patterns, different look — demonstrating real FSE depth:

- **Charity** — warm, hopeful palette; friendly rounded type.
- **Faith** — serene, calm palette; classic/readable type (aligned with the church dogfood use).
- **Community** — vibrant, grassroots, higher-energy palette.

Each varies color palette, typography pairing, and spacing rhythm via `styles/*.json`. All meet the AA contrast requirement (§7).

---

## 7. Design system & accessibility

**Design system (theme.json v3):**
- **Fluid typography** (`clamp()` via `settings.typography.fluid`) — scales smoothly across viewports.
- **Spacing scale** — a defined preset scale used by patterns (no magic numbers).
- **Color palette** — semantic slots (base, contrast, primary, secondary, accent, surface) so style variations swap cleanly.
- **Fonts** — bundled **locally** under `assets/fonts/` (GPL-licensed); **no Google Fonts CDN** (privacy guideline). Registered as `theme.json` font families.
- **Layout** — content/wide sizes set in `theme.json`; patterns built on the layout, not fixed widths.

**Accessibility (WCAG 2.2 AA — the headline feature):**
- Skip-to-content link.
- Visible keyboard focus styles on all interactive elements.
- Semantic landmarks (header/nav/main/footer) via template parts.
- Keyboard-operable navigation (incl. any submenu).
- Color contrast ≥ AA across all three style variations.
- `prefers-reduced-motion` respected for any motion.
- Accessible forms layout (labels, no placeholder-as-label) in contact/newsletter patterns.
- Target the `accessibility-ready` WP.org tag (requires passing the a11y audit).

---

## 8. WP.org Theme Review compliance checklist

- [ ] GPLv2-or-later; all assets GPL-compatible (document sources).
- [ ] No CPTs, taxonomies, shortcodes, or settings/options framework in the theme.
- [ ] No external HTTP requests; fonts bundled locally (no CDN).
- [ ] All functions/handles/globals prefixed `kindly_`.
- [ ] `theme.json` v3; valid against the schema.
- [ ] Required files present: `style.css` header, `index.html`, `screenshot.png`.
- [ ] Proper text-domain usage in any PHP strings (pattern titles, etc.).
- [ ] Escaping/sanitization where pattern PHP outputs anything dynamic.
- [ ] Passes the official **Theme Check** plugin with 0 required-level issues.
- [ ] No "powered by" / upsell / tracking; nothing gated behind Pro.

(Implementation plan should verify current guidelines against the live WP.org Theme Handbook, since rules evolve.)

---

## 9. Demo content & deployment

- **Local dev:** WordPress in Docker (reuse the pattern from the plugin's `wp-aatg-docker`), with the official **Theme Unit Test** data + a small set of demo content for a **fictional, non-denominational congregation/nonprofit**.
- **Live demo:** deploy a WordPress install with `Kindly` activated to a **HostGator subdomain** (e.g., `kindly.nickgranados.com`), populated with the demo content and using the **Faith** style variation by default.
- **Portfolio:** add a project card (category `wordpress`) pointing at the live demo + the GitHub repo, with a screenshot captured via the browse skill.

---

## 10. QA / acceptance

- **Theme Check** plugin: 0 required-level issues.
- **Theme Unit Test** data imports and renders correctly across all templates.
- **Accessibility audit:** keyboard-only walkthrough, contrast check on all 3 variations, screen-reader landmark check.
- **Responsive:** verified at mobile/tablet/desktop via the browse skill.
- **Site Editor:** all templates, parts, patterns, and style variations load and are editable without errors in the WP Site Editor.
- **Performance:** lightweight — no render-blocking bloat; good Lighthouse scores on the demo.

---

## 11. Out of scope (delegated to plugins, by design)

- Donation/payment processing (theme provides the `donate` pattern layout only).
- Event management / RSVPs (theme provides `activities` layout via Query Loop only).
- Contact/newsletter form processing (theme provides accessible form *layout*; a forms plugin does the work).
- Any custom post types or admin settings.

These exclusions are deliberate and required for WP.org theme compliance — and they keep the "theme" skill cleanly separated from the "plugin" skill (already evidenced by the Smart Alt Generator).

---

## 12. Success criteria

1. A from-scratch FSE block theme that passes Theme Check and is WP.org-submittable.
2. Three working style variations.
3. WCAG 2.2 AA accessibility-ready.
4. Live demo deployed to a HostGator subdomain + portfolio card added.
5. Reads, to a recruiter, as "this person can engineer a clean, accessible WordPress theme from nothing" — and is genuinely usable for a real congregation/nonprofit (dogfood-able).
