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
- `bin/` — CLI tools (see "CLI tools" below); `bin/import.php` imports into WordPress, `bin/reset-fleet.php` **deletes** imported content
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

## CLI tools (`bin/`)

All PHP tools need `-d memory_limit=20480M` (see their shebangs) and most load WordPress via `require 'functions.php'` (which needs `etc/config.php`).

### Import / maintenance
| Script | Purpose |
|---|---|
| `import.php` | Main importer into WordPress. Args: `all` (clubs → sailors → registry → results), or parts: `registry`/`b`/`boats`, `sailors`/`s`, `clubs`/`c`, `results`/`e`/`events`. `results <path>` imports one results CSV. `--debug` enables debug output. |
| `reset-fleet.php` | **Destructive**: deletes imported posts. Args: `all`, `registry`, `sailors`, `results`. Only on explicit request. |
| `delete.taxonomy.iworks_fleet_club.php` | **Destructive**: direct-SQL delete of every `iworks_fleet_club` term. |
| `functions.php` | Shared bootstrap/config, not runnable: loads `etc/config.php` + WordPress, person-name helpers, `int505_get_club_term_id()` (lookup-only club matching), echo helpers. |

### Analysis
| Script | Purpose |
|---|---|
| `analize.php` | Scans `data/` results + `sailors.csv` and lists person names found in results but missing from `sailors.csv` (import gaps). |
| `analize-db.php` | Compares all `iworks_fleet_person` titles pairwise with `similar_text` and reports likely duplicate persons above ~89.9% similarity. |
| `get-sailors-ids.php` | Builds/updates `data/sailors/ids.csv` mapping sail numbers to sailor names from results data. |
| `export-wiki-results.php` | Exports a series' results from the DB as wiki-markup tables (podium per regatta, country counts). Args: `category=<id>` or `serie=<slug>`, `debug`. |

### Data conversion (run on a CSV file: `<script> file.csv`)
| Script | Purpose |
|---|---|
| `convert-old-points-to-places.sh` | Rewrites old low-points scoring totals into place columns in a results CSV. |
| `convert-small-points-to-places.sh` | Same for small-points (low point system) results files. |
| `fix-start-date.php` | Reads `events-list.csv` and infers missing start dates (col 18) from file names; prints CSV (no write). |
| `convert-regates.ffvoile.fr.php` | Converts French Sailing Federation (regates.ffvoile.fr) result exports into archive results format. |

### One-off helpers (`bin/helpers/`)
Scrapers/converters for specific source batches, kept for provenance: `5o5-3wadmin-de.php` + `5o5-add-de-file.sh` (German 3wadmin site results), `5o5-ffvoile.sh` / `5o5-ffvoile.fr.php` / `5o5-ffvoile.fr.2023.php` / `5o5-ffvoile-add-run.sh` (ffvoile.fr results), `5o5-html.sh` (HTML table → CSV), `5o5-olimpic-scoring-to-places.sh` (Olympic scoring → places).

## OpenCode commands

Project commands live in `.opencode/commands/`: `/import`, `/wp`, `/clubs`, `/normalize`, `/analyze` — prefer them for their built-in safety rails.
