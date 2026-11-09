---
description: Normalize club/organizer names in a data CSV using clubs.csv as the canonical reference
---

Normalize club names in: $ARGUMENTS

Rules:
1. Target file must be one of `data/events-list.csv` (Organizer, column index 7) or `data/sailors.csv` (Club, column index 2). Ask which column if unclear.
2. Canonical reference is `data/clubs/clubs.csv` (column Name). A name is only rewritten when the change is unambiguous:
   - exact variant spellings (case, apostrophes ’ vs ', typos like Zbńszyński)
   - city/country suffixes ("Nepean Sailing Club – Ottawa" → "Nepean Sailing Club")
   - leading "The"/"Le" and punctuation-only differences
   - short codes when the mapping is unique in clubs.csv (e.g. CVML, PSC, PYC); skip ambiguous codes like KYC
3. NEVER touch: multi-club values ("X, Y", "X | Y"), clubs not in clubs.csv with no confident canonical form, province/region names (KZN), or any other column.
4. Preserve the file structure byte-exactly: read/write with Python csv, keep LF line endings, keep every field including trailing empty ones (never use DictReader for round-trip — it drops unnamed trailing columns). Line count before and after must be identical.
5. First show the proposed mapping table (from → to, affected row count) and WAIT for confirmation. Apply only after an explicit yes.
6. After applying, verify: same line count, only the target column changed (show `git diff --stat` and a sample of changed lines).
