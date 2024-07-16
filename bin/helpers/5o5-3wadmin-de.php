#!/usr/bin/php -d memory_limit=20480M
<?php

if ( empty( $argv ) ) {
	die( 'o file' );
}

function d( $a ) {
	print_r( $a );
}

$result = array(
	array(
		'Country',
		'Boat Number',
		'Helm',
		'Crew',
		'Club',
	),
);
if ( false !== ( $handle = fopen( $argv[1], 'r' ) ) ) {
	$number_of_races       = 0;
	$number_of_competitors = 0;
	$check                 = true;
	while ( ( $one = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 'Platz' === $one[0] ) {
			$check = false;
			continue;
		}
		/**
		 * int505.de
		 */
		if ( 'Pl.' === $one[0] ) {
			$check = false;
			continue;
		}
		if ( $check ) {
			echo 'smth wrong!';
			d( $one );
			die;
		}
		$number_of_competitors++;
		$n = explode( ' ', $one['4'] );
		// $r = array(
			// 'place' => $one[0],
			// 'helm' => $one[1],
			// 'crew' => $one[2],
			// 'national' => $n[0],
			// 'number' => $n[1],
			// 'races' => explode( ',', $one['5'])
		// );
		$row = array();
		/**
		 * nation
		 */
		$row[] = $n[0];
		/**
		 * Boa Number
		 */
		$row[] = $n[1];
		/**
		 * Helm
		 */
		$row[] = $one[1];
		/**
		 * Crew
		 */
		$row[] = $one[2];
		/**
		 * Club
		 */
		$row[] = $one[3];
		/**
		 * races
		 */
		$races           = explode( ',', $one[5] );
		$number_of_races = ( count( $races ) > $number_of_races ) ? count( $races ) : $number_of_races;
		foreach ( $races as $race ) {
			$row[] = $race;
		}
		$row[] = '';
		$row[] = '';
		$row[] = $one[0];
		/**
		 */
		$result[] = $row;
	}
	for ( $i = 0; $i < $number_of_races; $i++ ) {
		$result[0][] = sprintf( 'Race %d', $i + 1 );
	}
	$result[0][] = 'Brutto';
	$result[0][] = 'Netto';
	$result[0][] = 'Place';
}
foreach ( $result as &$row ) {
	if ( 'Country' === $row[0] ) {
		continue;
	}
	$max    = 5 + $number_of_races;
	$points = 0;
	for ( $i = 5; $i < $max; $i++ ) {
		if ( preg_match( '/^\d+/', $row[ $i ] ) ) {
			$points += intval( $row[ $i ] );
		} else {
			$row[ $i ] .= sprintf( ' %d', ( $number_of_competitors + 1 ) );
			$points    += $number_of_competitors + 1;
		}
	}
	$row[ $max ] = $points;
	if ( 4 > $number_of_races ) {
		$row[ $max + 1 ] = $points;
	}
}
/**
 * output
 */
if ( false !== ( $handle = fopen( $argv[1], 'w' ) ) ) {
	foreach ( $result as $a ) {
		fputcsv( $handle, $a );
	}
}
