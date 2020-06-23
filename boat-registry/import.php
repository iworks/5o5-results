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

error_reporting( E_ALL );

define( 'WP_USE_THEMES', false );
define( 'WP_PLUGIN_DIR', false );
if ( ! defined( 'IMPORT_DEBUG' ) ) {
	define( 'IMPORT_DEBUG',  true );
}
define( 'WP_LOAD_IMPORTERS', true );


// require '../../wp-load.php';

// global $wpdb;

$rows = array();
if (($handle = fopen("registry.csv", "r")) !== FALSE) {
    while ( ($data = fgetcsv($handle, 0, ",") ) !== FALSE ) {

        print_r( $data );


    }
    fclose($handle);
}

