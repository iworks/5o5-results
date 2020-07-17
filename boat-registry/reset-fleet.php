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

$truncate = array(
	'fleet_regatta',
	'fleet_regatta_race',
);
foreach ( $truncate as $table ) {
	$wpdb->query( sprintf( 'truncate %s%s', $wpdb->prefix, $table ) );
	echo $wpdb->last_query,PHP_EOL;
}

$post_types = array(
	'iworks_fleet_boat',
	'iworks_fleet_person',
	'iworks_fleet_result',
);


foreach ( $post_types as $post_type ) {
	$wpdb->delete( $wpdb->posts, array( 'post_type' => $post_type ) );
	echo $wpdb->last_query,PHP_EOL;
}

$wpdb->query( sprintf( 'DELETE pm FROM %s pm LEFT JOIN %s wp ON wp.ID = pm.post_id WHERE wp.ID IS NULL', $wpdb->postmeta, $wpdb->posts ) );
echo $wpdb->last_query,PHP_EOL;


