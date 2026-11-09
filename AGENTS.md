# AGENTS.md

International 5O5 Class Archive: a dataset (boat registry, sailors, clubs, regatta results 1956–2025) plus tooling that imports it into a WordPress site running the Fleet plugin. Live site: https://5o5.iworks.pl/ (local dev: https://int505.test/).

## Repository layout

- `data/` — the dataset:
  - `events-list.csv` — regattas; column 8 (index 7) is the Organizer; column 15 (index 14) `Series` contains unquoted commas, always parse with a real CSV reader
  - `registry.csv` — boat registry (sail number is the key)
  - `sailors.csv` — sailor profiles; column 3 (index 2) is their Club
  - `clubs/clubs.csv` — curated canonical club list (`Country,Name,Short,City,Website`); the source of truth for club names
  - `clubs/<letter>/<country>/<short>.<ext>` — club logos matched by lowercase short code
  - `results/<year>/{world,country,continental}/*.csv` — one CSV per event: `Nat,Sail No.,Skipper,Crew,Yacht Club,R1..Rn,Total,Nett,Rank`; bracketed values (`[13]`, `[36 DNC]`) are discarded scores
  - `boats/<sailno>`, `sailors/<slug>`, `owners/*.csv` — free-text histories (mixed languages)
- `bin/` — CLI tools; `bin/import.php` imports into WordPress, `bin/reset-fleet.php` **deletes** imported content
- `tools/wordpress/mu-plugin/505-import-filter.php` — mu-plugin deployed to WordPress `wp-content/mu-plugins/`; contains person-name alias tables and result-import hooks
- `etc/config.php` (gitignored, from `etc/config.example.php`) and `etc/config.json` — import configuration

## Local WordPress (https://int505.test/)

- Document root `/var/virtuals/wordpress`; DB is selected by `HTTP_HOST` in `wp-config.php` — **always set `$_SERVER['HTTP_HOST'] = 'int505.test'` before `wp-load.php`** in CLI scripts, or you hit the wrong database
- Active plugin is `wp-content/plugins/dev-fleet` (build copy of `fleet/`); when editing Fleet plugin code, keep both copies in sync
- Table prefix `505_`; post types `iworks_fleet_boat`, `iworks_fleet_person`, `iworks_fleet_result`; clubs are the `iworks_fleet_club` taxonomy (terms, not posts); result rows in `505_fleet_regatta` / `505_fleet_regatta_race`
- Club binding is **curated-only**: result/sailor imports attach the `iworks_fleet_club` term only when the name exactly matches `clubs/clubs.csv` — never auto-create club terms
- Import order matters: clubs → sailors → registry → results. Imports are idempotent; use `reset-fleet.php` only on explicit request

## Conventions

- PHP files use tabs; run `php -l` before deploying
- CSV files: LF line endings, UTF-8; when round-tripping, preserve every field including trailing empty columns (don't use `DictReader` for rewrites)
- Club names: canonical form comes from `clubs.csv`; strip city suffixes, leading "The"/"Le", unify apostrophes; leave multi-club values ("X, Y") and ambiguous short codes untouched
- Keep `tools/wordpress/mu-plugin/505-import-filter.php` and its deployed copy identical

## OpenCode commands

Project commands live in `.opencode/commands/`: `/import`, `/wp`, `/clubs`, `/normalize`, `/analyze` — prefer them for their built-in safety rails.
