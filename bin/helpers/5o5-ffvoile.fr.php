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

$odd = true;

if ( false !== ( $handle = fopen( $argv[1], 'r' ) ) ) {
	$number_of_races       = 0;
	$number_of_competitors = 0;
	while ( ( $one = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if (
			preg_match( '/place/', $one[1] )
			&& preg_match( '/licences/', $one[2] )
		) {
			continue;
		}
		if ( $odd ) {
			$number_of_competitors++;
			$row = array();
			/**
			 * Country
			 */
			$row[] = 'FRA';
			if ( preg_match( '/^belgique$/i', trim( preg_replace( '/[  ]+/', ' ', $one[4] ) ) ) ) {
				$row[0] = 'BEL';
			} elseif ( preg_match( '/^suisse$/i', trim( preg_replace( '/[  ]+/', ' ', $one[4] ) ) ) ) {
				$row[0] = 'SUI';
			}
			/**
			 * Boat Number
			 */
			$row[] = '';
			/**
			 * Helm
			 */
			$row[] = ucwords( strtolower( trim( preg_replace( '/[  ]+/', ' ', $one[3] ) ) ) );
			/**
			 * Crew
			 */
			$row[] = '';
			/**
			 * Club
			 */
			$row[] = trim( preg_replace( '/[  ]+/', ' ', $one[4] ) );
			/**
			 * reaces
			 */
			$n               = explode( ',', $one['10'] );
			$number_of_races = count( $n );
			foreach ( $n as $r ) {
				$row[] = preg_replace( '/[^\d^a-z]+/i', '', $r );
			}
			/**
			 * Points Brutto
			 */
			$row[] = '';
			/**
			 * Points
			 */
			$row[] = $one[9];
			/**
			 * Place
			 */
			$row[] = $one[1];
		} else {
			/**
			 * Crew
			 */
			$row[3] = ucwords( strtolower( trim( preg_replace( '/[  ]+/', ' ', $one[3] ) ) ) );
			$club   = trim( preg_replace( '/[  ]+/', ' ', $one[4] ) );
			if ( ! empty( $club ) && $one[4] !== $club ) {
				if ( ! empty( $row[4] ) ) {
					$row[4] .= ' / ';
				}
					$row[4] .= $club;
			}
		}
		/**
		 */
		if ( $odd ) {
			$odd = false;
		} else {
			$odd      = true;
			$result[] = $row;
		}
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
