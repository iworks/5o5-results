---
description: Analyze a results CSV or event data from the 5O5 archive (stats, top sailors, coverage)
---

Analyze 5O5 data: $ARGUMENTS

Interpretation of the argument:
- a path under `data/results/` → analyze that results CSV (columns: Nat, Sail No., Skipper, Crew, Yacht Club, R1..Rn, Total, Nett, Rank; bracketed values like [13] or [36 DNC] are discarded scores)
- a year or range (e.g. `1994` or `1990-1999`) → find matching events in `data/events-list.csv` (column 1 = start date) and summarize them
- a country code (e.g. `FRA`) → summarize that country's events over time
- a person name → search `data/sailors.csv`, `data/sailors/` biographies, and results CSVs (grep by name) for their placings
- a sail number → check `data/registry.csv` and the boat's history

Rules:
1. Use Python with the csv module for parsing; handle quoted fields and bracketed discard scores.
2. Show compact tables; always state the number of rows/events analyzed and any files skipped (empty/missing).
3. Read-only: do not modify files.
4. End with a one-paragraph summary of the most notable findings.
