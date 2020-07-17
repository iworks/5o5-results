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

require 'functions.php';

global $wpdb;

$line = 85;


$csv   = true;
$debug = false;


foreach ( $argv as $arg ) {
	switch ( $arg ) {
		case 'cli':
			$csv = false;
			break;
		case 'debug':
			$debug = true;
			break;
	}
}

$separtor = ';';
if ( ! $csv ) {
	$separtor = ' => ';
}

$query = sprintf( 'select post_title from %s where post_type = "iworks_fleet_person"', $wpdb->posts );

$persons = $wpdb->get_col( $query );

$compared = array();
foreach ( $persons as $p1 ) {
	foreach ( $persons as $p2 ) {
		if ( $p1 === $p2 ) {
			continue;
		}
		if (
			isset( $compared[ $p1 . $p2 ] )
			|| isset( $compared[ $p2 . $p1 ] )
		) {
			continue;
		}
		$compared[ $p1 . $p2 ] = true;
		$sim                   = similar_text( $p1, $p2, $perc );
		if ( $line < $perc ) {
			echo $p1,$separtor,$p2,PHP_EOL;
			// echo $perc;
			// echo PHP_EOL;
			// echo PHP_EOL;
		}
	}
}
