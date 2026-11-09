---
description: Import data into the WordPress 5O5 archive (all, clubs, sailors, registry, results, or a single results file)
---

Run the 5O5 data import for: $ARGUMENTS

Rules:
1. The import script is `./bin/import.php` (PHP CLI, loads WordPress from /var/virtuals/wordpress, DB selected via HTTP_HOST set in etc/config.php to int505.test).
2. Valid parts: `all`, `registry` (boats), `sailors`, `clubs`, `results`, or `results <path>` for a single results CSV (path must start with `data/results/`).
3. If the argument is empty or invalid, list the valid parts and ask which to run. Do not guess.
4. `all` runs clubs first, then sailors, registry, results — keep that order.
5. For `results` over the whole dataset warn first: it takes ~30 minutes. Run it in the background and report when done.
6. After the import finishes, verify state with:
   `cd /var/virtuals/wordpress && php -r '$_SERVER["HTTP_HOST"]="int505.test"; require "wp-load.php"; global $wpdb; foreach (array("iworks_fleet_boat","iworks_fleet_person","iworks_fleet_result") as $pt) echo $pt, ": ", $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type=%s", $pt)), PHP_EOL; $t = get_terms(array("taxonomy"=>"iworks_fleet_club","hide_empty"=>false,"number"=>0)); echo "club terms: ", count($t), PHP_EOL;'`
7. Report the counts and any failures. The import must stay idempotent — never run `bin/reset-fleet.php` unless I explicitly ask.
