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

$category   = 0;
$debug      = false;
$serie_slug = false;

foreach ( $argv as $arg ) {
	switch ( $arg ) {
		case 'debug':
			$debug = true;
			break;
	}
	parse_str( $arg, $out );
	foreach ( $out as $arg => $value ) {
		switch ( $arg ) {
			case 'category':
				$category = $value;
				break;
			case 'slug':
				$serie_slug = $value;
				break;
		}
	}
}
$category = intval( $category );
if ( 1 > $category && empty( $serie_slug ) ) {
	echo 'wrong category or empty slug!' . PHP_EOL;
	die;
}

$options  = array(
	'posts_per_page' => -1,
	'output'         => 'raw',
	'order'          => 'ASC',
);
$regattas = apply_filters( 'iworks_fleet_result_serie_regatta_list', '', $serie_slug, $options );

global $wpdb, $iworks_fleet;
$table_name_regatta      = $wpdb->prefix . 'fleet_regatta';
$table_name_regatta_race = $wpdb->prefix . 'fleet_regatta_race';

foreach ( $regattas as $regatta ) {
	/**
	 * count number of countries
	 */
	$query           = sprintf(
		'select count( distinct( country ) ) from %s where post_regata_id = %%d and country <> \'\'',
		$table_name_regatta
	);
	$query           = $wpdb->prepare( $query, $regatta['ID'] );
	$count_countries = $wpdb->get_var( $query );
	/**
	 * get regata data
	 */
	$query   = $wpdb->prepare( "SELECT * FROM {$table_name_regatta} where post_regata_id = %d order by place limit 3", $regatta['ID'] );
	$results = $wpdb->get_results( $query );
	echo '|-' . PHP_EOL;
	printf( '| %d%s%s', $regatta['year'], make_citation( $regatta ), PHP_EOL );
	echo '| ';
	$add_break = false;
	if ( is_array( $regatta['location'] ) && isset( $regatta['location'][0] ) ) {
		printf( '{{Państwo|%s}}', get_mna_country_code( $regatta['location'][0]->name ) );
		$add_break = true;
	}
	if ( ! empty( $regatta['organizer'] ) && '&ndash;' !== $regatta['organizer'] ) {
		if ( $add_break ) {
			echo '<br />';
			$add_break = false;
		}
		printf( '[[%s]]', $regatta['organizer'] );
	}
	echo PHP_EOL;
	for ( $i = 0; $i < 3; $i++ ) {
		echo '| ';
		if ( is_array( $results ) && isset( $results[ $i ] ) ) {
			$add_break = false;
			if ( ! empty( $results[ $i ]->country ) ) {
				printf( '{{Flaga|%s}} ', $results[ $i ]->country );
				$add_break = true;
			}
			if ( ! empty( $results[ $i ]->boat_id ) ) {
				echo $results[ $i ]->boat_id;
				$add_break = true;
			}
			if ( $add_break ) {
				echo '<br />';
				$add_break = false;
			}
			if ( ! empty( $results[ $i ]->helm_name ) ) {
				echo $results[ $i ]->helm_name;
				$add_break = true;
			}
			if ( $add_break ) {
				echo '<br />';
				$add_break = false;
			}
			if ( ! empty( $results[ $i ]->crew_name ) ) {
				echo $results[ $i ]->crew_name;
			}
		}
		echo PHP_EOL;
	}
	// | {{Flaga|USA}}
	// | {{Flaga|USA}}
	// | {{Flaga|USA}}
	// | align = right |
	// | align = right |
	printf(
		'| align = right | %d%s',
		( 0 < $regatta['number_of_competitors'] ) ? $regatta['number_of_competitors'] : '&ndash;',
		PHP_EOL
	);
	printf(
		'| align = right | %d%s',
		( 0 < $count_countries ) ? $count_countries : '&ndash;',
		PHP_EOL
	);
}

function make_citation( $one ) {
	return '';
	return sprintf(
		'<ref>{{Cytuj | url = %s | tytuł = %s | data = %s | opublikowany = %s | język = en | data dostępu = %s}}</ref>',
		esc_url( $one['permalink'] ),
		esc_attr( $one['title'] ),
		get_the_date( 'Y-m-d', $one['ID'] ),
		get_bloginfo( 'name' ),
		date( 'Y-m-d' )
	);
}

function get_mna_country_code( $country ) {
	$countries = iworks_fleet_get_contries();
	foreach ( $countries as $one ) {
		if ( $one['en'] === $country ) {
			return $one['code'];
		}
	}
	return $country;
}



