#!/usr/bin/php -d memory_limit=20480M
<?php

/*
 * converts file  like this:
 * https://regates.ffvoile.fr/epreuves/253045/resultats/?resultId=191972
 */

if ( 2 > count( $argv ) ) {
	die( 'o file' );
}

$withraw = false;
if ( isset( $argv[2] ) ) {
	$withraw = intval( $argv[2] );
}

$map = array(
	'place'         => 0,
	'nomBateau'     => 1,
	'nom'           => 2,
	'prenom'        => 3,
	'noLicence'     => 4,
	'clubCode'      => 5,
	'clubNom'       => 6,
	'cdvCode'       => 7,
	'cdvNom'        => 8,
	'ligueCode'     => 9,
	'ligueNom'      => 10,
	'serieCode'     => 11,
	'serieNom'      => 12,
	'noVoile'       => 13,
	'categorieAge'  => 14,
	'genre'         => 15,
	'nbPoints'      => 16,
	'detailManches' => 17,

);

$racedata = array();

function int505_capitalize( $string ) {
	$string = ucwords( strtolower( $string ) );
	$string = str_replace( ' De ', ' de ', $string );
	$string = str_replace( ' Des ', ' des ', $string );
	$string = str_replace( ' Le ', ' le ', $string );
	$string = str_replace( ' Van ', ' van ', $string );
	$string = str_replace( ' Von ', ' von ', $string );
	return $string;
}

function int505_races( $detailManches ) {
	$detailManches = trim( $detailManches, '() ' );
	$races         = explode( ',', $detailManches );
	$result        = array();
	foreach ( $races as $race ) {
		$result[] = trim( $race );
	}
	return $result;
}

function int5o5_country( $ligueNom ) {
	$ligueNom = strtolower( $ligueNom );
	switch ( $ligueNom ) {
		case 'belgique':
			return 'BEL';
		case 'x':
			return 'GBR';
		case 'france':
			return 'FRA';
		case 'luxembourg':
			return 'LUX';
		case 'suisse':
			return 'SUI';
	}
	return 'FRA';
}

if ( false !== ( $handle = fopen( $argv[1], 'r' ) ) ) {
	$helm  = true;
	$row   = 0;
	$races = 0;
	while ( ( $one = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( preg_match( '/place/', $one[0] ) ) {
			continue;
		}
		if ( 0 === $races ) {
			$races = count( explode( ',', $one[ $map['detailManches'] ] ) );
		}
		if ( $helm ) {
			$racedata[ $row ] = array(
				int5o5_country( $one[ $map['ligueNom'] ] ),
				$one[ $map['noVoile'] ],
				int505_capitalize( $one[ $map['prenom'] ] . ' ' . $one[ $map['nom'] ] ),
				'crew name',
				$one[ $map['clubNom'] ],
			);

			$places = int505_races( $one[ $map['detailManches'] ] );
			for ( $i = 0; $i < $races; $i++ ) {
				$racedata[ $row ][] = $places[ $i ];
			}
			$racedata[ $row ][] = 'crew club';
			$racedata[ $row ][] = ''; // boat name
			$racedata[ $row ][] = ''; // points total
			$racedata[ $row ][] = $one[ $map['nbPoints'] ]; // points netto
			$racedata[ $row ][] = $one[ $map['place'] ]; // place
		} else {
			$racedata[ $row ][3]            = int505_capitalize( $one[ $map['prenom'] ] . ' ' . $one[ $map['nom'] ] );
			$racedata[ $row ][ 5 + $races ] = $one[ $map['clubNom'] ];
			++$row;
		}
		$helm = ! $helm;
	}
}
/**
 * support variables
 */
$competitors = count( $racedata );
$penalty     = $competitors + 1;
/**
 * count points
 */
for ( $i = 0; $i < $competitors; $i++ ) {
	$sum = 0;
	for ( $j = 5; $j < $races + 5; $j++ ) {
		$place = (int) $racedata[ $i ][ $j ];
		if ( 0 === $place ) {
			$place = $penalty;
		}
		$sum += $place;
	}
	$racedata[ $i ][ $races + 7 ] = $sum;
}
/**
 * fix penalty
 */
for ( $i = 0; $i < $competitors; $i++ ) {
	for ( $j = 5; $j < $races + 5; $j++ ) {
		if ( ! preg_match( '/^\d+$/', $racedata[ $i ][ $j ] ) ) {
			$racedata[ $i ][ $j ] .= ' ' . $penalty;
		}
	}
}
/**
 * mark withdraws
 */
if ( 0 < $withraw ) {
	/**
	 * map
	 */
	for ( $i = 0; $i < $competitors; $i++ ) {
		$map = array();
		for ( $j = 5; $j < $races + 5; $j++ ) {
			$map[] = preg_replace( '/[^\d]+/', '', $racedata[ $i ][ $j ] );
		}
		rsort( $map );
		$map = array_slice( $map, 0, $withraw );
		foreach ( $map as $one ) {
			for ( $j = 5; $j < $races + 5; $j++ ) {
				if ( preg_replace( '/[^\d^\[]+/', '', $racedata[ $i ][ $j ] ) === $one
				) {
					$racedata[ $i ][ $j ] = '[' . $racedata[ $i ][ $j ] . ']';
					$j                    = $races + 6;
				}
			}
		}
	}
}
/**
 * Override file
 */
$file   = fopen( $argv[1], 'w' );
$header = array( 'Country', 'Boat Number', 'Helm', 'Crew', 'Club' );
for ( $i = 1; $i <= $races; $i++ ) {
	$header[] = "Race $i";
}
$header[] = 'Crew Club';
$header[] = 'Boat Name';
$header[] = 'Points Total';
$header[] = 'Points Netto';
$header[] = 'Place';

fputcsv( $file, $header );

foreach ( $racedata as $row ) {
	fputcsv( $file, $row );
}
