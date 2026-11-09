---
description: Run PHP code against the int505.test WordPress database
---

Run arbitrary PHP against the local WordPress `int505.test` database and show the results: $ARGUMENTS

Method:
1. Always execute with: `cd /var/virtuals/wordpress && php -r '$_SERVER["HTTP_HOST"]="int505.test"; require "wp-load.php"; <CODE>'`
2. `$_SERVER["HTTP_HOST"]` MUST be set to `int505.test` before `wp-load.php`, otherwise wp-config.php selects the wrong database.
3. Wrap code in single quotes carefully; prefer double quotes inside PHP or heredoc when quotes conflict.
4. Useful facts: post types are `iworks_fleet_boat`, `iworks_fleet_person`, `iworks_fleet_result`; clubs are the `iworks_fleet_club` taxonomy; results rows live in `{$wpdb->prefix}fleet_regatta` and `{$wpdb->prefix}fleet_regatta_race`; table prefix is `505_`.
5. Read-only by default. If the code writes to the DB (update/delete/insert), say so and confirm before running unless the user's request is explicitly a write operation.
6. Present the output in a small table when it is tabular.
