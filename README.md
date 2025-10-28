# International 5O5 Class Archive

The [database combining boat registry, competitors, and events](https://5o5.iworks.pl/). You can review the 5O5 boat register linked to which crews raced each boat and an extensive list of regattas those people and boats competed in with results.

Feel free to create a PR if you can fill out or add something.

## How to run a site and import results

1. Install [WordPress](https://wordpress.org/download/).
1. Install the [Fleet Manager](https://wordpress.org/plugins/fleet/) WordPress plugin.
1. Get a copy of this repository.
1. Copy `/tools/wordpress/mu-plugin/505-import-filter.php` into your WordPress `wp-content/mu-plugin/`, create this directory if it does not exist.
1. Copy `etc/config.example.php` into `etc/config.php`.
1. Edit `etc/config.php` and set `$wordpress_path` as the document root of your WordPress installation.
1. Run `./bin/import.php all`.

## Contributors

I will thank those people (ordered by time).

* **Ebbe Rosén** provided the first batch of results and helped me when I needed something more.
* **Mike Hattemore** provided a lot of WC and UK Nationals.
* **Peter Scannell** helped with the manual fixing of Irish results.
* **Olivier Barat** provided French Bulletin scans from 1972–1979 and a few more until 2003.
* **Jonathan Gibbons** provided "505 Great Britain" from 1975 to 1987.
* **Nicolas Ktz** provided entry list and first 6 places on WC 1969 (Argentina)
* **Philippe Blanchard** provided French Bulletin scans from 1960–2009.
* **Simon Gorman** provided the Australian Championship in 1998.
* **Ian Gregg** provided the Australian Championship 2016.
* [Deutsche 505er Klassenvereinigung - Aktuelles](http://505.3wadmin.de/) - a lot of older German (but not only) results from years 2000–2017.
* **Tim Böger** provided results from 1986 until 1996.
* **[Adam Wolnikowski](https://github.com/AWoLnik)** - the first push request contributor!
* **[bartekch](https://github.com/bartekch)** - the secound push request contributor!
* **Marco Giraldi** provided TransAlp cup rankings: 2010-2012
