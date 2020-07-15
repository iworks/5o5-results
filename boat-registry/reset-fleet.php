#!/usr/bin/php -d memory_limit=20480M
<?php
/**
 * posts & coments import API
 *
 * PHP version 5
 *
 * @category   WordPress_Tools
 * @package    WordPress
 * @subpackage Import
 * @author     Marcin Pietrzak <marci@iworks.pl>
 * @license    http://iworks.pl/ commercial
 * @version    SVN: $Id: import_posts.php 4872 2012-07-24 13:53:34Z illi $
 * @link       http://iworks.pl/
 *
 */

if ( isset( $_SERVER['SERVER_NAME'] ) ) {
	die( 'not allow with www' );
}

$_SERVER['HTTP_HOST'] = 'int505';

error_reporting( E_ALL );

if ( ! is_file( 'config.php' ) ) {
	echo 'ERROR!', PHP_EOL;
	echo 'Please create `config.php` file with WordPress location!',PHP_EOL;
	echo 'You can copy `config.example.php`.',PHP_EOL,PHP_EOL;
	die;
}

require 'config.php';
require $wordpress_path . '/wp-load.php';

global $wpdb;

print_r( $wpdb );


