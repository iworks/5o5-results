---
description: Analyze data quality of clubs.csv / organizers in events-list.csv / sailors.csv clubs
---

Analyze club-name data quality for: $ARGUMENTS (default: everything)

Steps:
1. Load `data/clubs/clubs.csv` (the curated canonical list: Country,Name,Short,City,Website).
2. Load organizers from `data/events-list.csv` column 8 (Organizer) and clubs from `data/sailors.csv` column 3. Use a real CSV parser (Python `csv` module) — naive comma splitting breaks on quoted fields.
3. Report:
   - coverage: how many rows have a club/organizer value, how many distinct values
   - exact matches against `clubs.csv` names (curated) vs unmatched values
   - likely duplicates/variants: group by a normalized key (lowercase, strip accents/apostrophes/punctuation, drop "The"/"Le", drop suffixes like Sailing Club / Yacht Club / e.V.) and list groups with more than one spelling
   - short codes from `clubs.csv` (e.g. BKSS, StFYC) appearing as full values in events/sailors
4. For each variant group propose a canonical name (prefer the `clubs.csv` form).
5. Do NOT modify any files — report only, as tables. End with the proposed mapping table (from → to, row counts) so it can be applied later on request.
