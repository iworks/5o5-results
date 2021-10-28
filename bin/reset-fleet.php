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

$reset_registry = $reset_results = $reset_sailors = false;

if ( sizeof( $argv ) === 1 ) {
	echo 'select parts to reset:',PHP_EOL;
	echo '- all (all parts)',PHP_EOL;
	echo '- registry',PHP_EOL;
	echo '- sailors',PHP_EOL;
	echo '- results',PHP_EOL;
	exit;
}
/**
 * Setup reset parts
 */
if ( in_array( 'all', $argv ) ) {
	$reset_registry = $reset_results = $reset_sailors = true;
} else {
	if (
		in_array( 'b', $argv )
		|| in_array( 'registry', $argv )
		|| in_array( 'boats', $argv )
	) {
		$reset_registry = true;
	}
	if (
		in_array( 's', $argv )
		|| in_array( 'sailors', $argv )
	) {
		$reset_sailors = true;
	}
	if (
		in_array( 'e', $argv )
		|| in_array( 'events', $argv )
		|| in_array( 'results', $argv )
	) {
		$reset_results = true;
	}
}
global $wpdb;
$post_types = array();
if ( $reset_registry ) {
	$post_types[] = 'iworks_fleet_boat';
}
if ( $reset_sailors ) {
	$post_types[] = 'iworks_fleet_person';
}
if ( $reset_results ) {
	$post_types[] = 'iworks_fleet_result';
	$truncate     = array(
		'fleet_regatta',
		'fleet_regatta_race',
	);
	foreach ( $truncate as $table ) {
		$wpdb->query( sprintf( 'truncate %s%s', $wpdb->prefix, $table ) );
		echo $wpdb->last_query,PHP_EOL;
	}
}
foreach ( $post_types as $post_type ) {
	$wpdb->delete( $wpdb->posts, array( 'post_type' => $post_type ) );
	echo $wpdb->last_query,PHP_EOL;
}

$wpdb->query( sprintf( 'DELETE pm FROM %s pm LEFT JOIN %s wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL', $wpdb->postmeta, $wpdb->posts ) );
echo $wpdb->last_query,PHP_EOL;


