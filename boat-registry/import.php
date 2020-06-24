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

require '../wp-load.php';
require 'functions.php';

global $wpdb;
$boat_post_type_name        = 'iworks_fleet_boat';
$taxonomy_name_manufacturer = 'iworks_fleet_boat_manufacturer';
$person_post_type_name      = 'iworks_fleet_person';
$owners_field_name          = 'iworks_fleet_boat_owners';
$owners_index_field_name    = 'iworks_fleet_boot_owner_id';


$hull_manufacturer = array();
$data              = get_terms( $taxonomy_name_manufacturer, array( 'hide_empty' => false ) );
foreach ( $data as $one ) {
	$hull_manufacturer[ $one->name ] = $one;
}

$persons = array();

function get_person_by_name( $post_title ) {
	global $persons, $person_post_type_name;
	if ( 5 > strlen( $post_title ) ) {
		return null;
	}
	$post_title = person_clear_name( $post_title );
	if ( isset( $persons[ $post_title ] ) ) {
		return $persons[ $post_title ];
	}
	$person = get_page_by_title( $post_title, OBJECT, $person_post_type_name );
	if ( empty( $person ) ) {
		$args = array(
			'post_status' => 'publish',
			'post_type'   => $person_post_type_name,
			'post_title'  => $post_title,

		);
		$post_ID                = wp_insert_post( $args );
		$persons[ $post_title ] = get_post( $post_ID, OBJECT );
	} else {
		$persons[ $post_title ] = $person;
	}
	return $persons[ $post_title ];
}



$rows = array();
if ( ( $handle = fopen( 'registry.csv', 'r' ) ) !== false ) {
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 1 > intval( $data[0] ) ) {
			continue;
		}
		$post = get_page_by_title( $data[0], OBJECT, $boat_post_type_name );
		if ( empty( $post ) ) {
			echo '.';
			$post_content           = trim( $data[3] );
			$iworks_fleet_boat_name = null;
			if ( preg_match( '/@([^@]+)@/', $post_content, $matches ) ) {
				$post_content           = preg_replace( '/@([^@])+@/', '', $post_content );
				$iworks_fleet_boat_name = $matches[1];
			}
			if ( ! is_string( $post_content ) ) {
				print_r( $post_content );
				die;
			}
			$post = array(
				'post_status'  => 'publish',
				'post_type'    => $boat_post_type_name,
				'post_title'   => intval( $data[0] ),
				'post_content' => trim( $post_content ),
				'meta_input'   => array(),
				'tax_input'    => array(),
			);
			if ( 0 < intval( $data[1] ) ) {
				$post['meta_input']['iworks_fleet_boat_build_year'] = intval( $data[1] );
			}
			if ( ! empty( $iworks_fleet_boat_name ) ) {
				$post['meta_input']['iworks_fleet_boat_name'] = $iworks_fleet_boat_name;
			}
			/**
			 * Hull builder
			 */
			$hull = trim( $data[2] );

			if ( ! empty( $hull ) ) {
				switch ( $hull ) {
					case 'Parker/Nab':
					case 'Parker kit':
					case 'Parker launcher':
					case 'Parker-hulled Lindsay':
					case 'Rondar Parker':
						$hull = 'Parker';
						break;
					case 'builder':
					case 'Custom homebuilt':
					case 'home-build':
					case 'home-built':
					case 'self-built':
					case 'self-constructed':
					case 'self-made':
					case 'Builder':
						$hull = 'home built';
						break;
					case 'Honore Marine':
					case 'Honore Marine GB':
					case 'Honor Marine':
						$hull = 'Honnor Marine';
						break;
					case 'Polymec kit':
						$hull = 'Polymec';
						break;
					case 'International & Olympic Yachts':
						$hull = 'International & Olympic Yachts';
						break;
					case 'new mould (Kyrwood)':
					case 'Kyrwood hull':
					case 'Krywood':
						$hull = 'Kyrwood';
						break;
					case 'Sydney mould':
					case 'N.S.W. mould':
					case 'Winwood':
					case 'Davies':
					case 'Glenn Dennis':
					case 'self-made (Barclay)':
					case 'Morin':
					case 'Bara':
					case 'R. Haselgrove':
					case 'Blessing':
					case 'Malcolm Goodwin':
					case 'Henderson':
					case 'Scarisbrick':
					case 'Mayberry':
					case 'Nectec Racing Boats':
					case 'Ziegelmayer':
					case 'Fisher':
					case 'Bob Fischer':
					case 'Ovi/Paris Voile':
						$hull                  = 'home built';
						$post['post_content'] .= sprintf( '<p>builder: %s</p>', $hull );
						break;
					case 'Barklay':
					case 'Barclay / Winwood':
						$hull = 'Barclay';
						break;
					case 'Clark (Seattle)':
						$hull = 'Clark';
						break;
					case 'Schnieder':
						$hull = 'Schneider';
						break;
					case 'Copland GBR':
						$hull = 'Copland Boats';
						break;
					case 'Fountain-Pajot':
					case 'Fountaine Pajot':
					case 'Fountaine/Pajot':
					case 'Fountaine-Pajot/Illy Brummer':
					case 'Fountaine-Pajot':
						$hull = 'Fountain Pajot';
						break;
					case 'Ballenger/Meller':
						$hull = 'Ballenger';
						break;
					case 'G;H Marine':
						$hull = 'G&H Marine';
						break;
					case 'Pevear/Lindsay':
					case 'Lindsay':
					case 'Lindsay/ Grey':
						$hull = 'Mark Lindsay Boatbuilders';
						break;
					case 'Waterat':
						$hull = 'Waterat Sailing Equipment';
						break;
					case 'Moore/ Van Landingham':
						$hull = 'Moore';
						break;
					case 'Milanes White':
					case 'Milanes&White':
					case 'Milanes':
						$hull = 'Milanes & White';
						break;
					case 'Rowsell & Morrison':
					case 'Rowsell; Morrison':
						$hull = 'Rowsell and Morrison';
						break;
					case 'Collignon':
						$hull = 'Collingnon (CDK)';
						break;
					case 'Rondar(epoxy)':
						$hull = 'Rondar';
						break;
					case 'WitchCraft':
						$hull = 'Witchcraft';
						break;
					case 'Young Marine Systems':
					case 'Young Marine':
					case 'YMS':
						$hull = 'Young Marine Services';
						break;
					case 'Otto':
					case 'Kulmar':
						$hull = 'Kulmar / Otto';
						break;
					case 'Fremantle':
					case 'Freemantle':
					case 'Fremantle/XSP':
						$hull = 'Fremantle 505';
						break;
					case 'VanMunster/ Pegasus':
					case 'Pegasus':
						$hull = 'Van Munster';
						break;
					case 'Segelsport Jess':
						$hull = 'JESS Segelsport';
						break;
					case 'Duvosion':
						$hull = 'Duvoisin';
						break;
					case 'P&B/ Ovington':
						$hull = 'P&B/Ovington';
						break;
					case 'Jess Ovington':
						$hull = 'Jess/Ovington';
						break;
				}
				if ( ! array_key_exists( htmlentities( $hull ), $hull_manufacturer ) ) {
					$hull_manufacturer[ $hull ] = wp_insert_term( $hull, $taxonomy_name_manufacturer );
				}
			}
			$post_ID = wp_insert_post( $post );
			wp_set_post_terms( $post_ID, array( $hull ), $taxonomy_name_manufacturer );

			/**
			 * owners
			 */
			$owners = array();
			foreach ( array( 4, 5, 6 ) as $index ) {
				if ( empty( $data[ $index ] ) ) {
					continue;
				}
					$data[ $index ] = trim( $data[ $index ] );
				if ( empty( $data[ $index ] ) ) {
					continue;
				}
				$is_person = check_is_person( $data[ $index ] );



				foreach ( preg_split( '/[;\/\t]/', $data[ $index ] ) as $person_name ) {

					$person_name = trim( $person_name );
					$person      = get_person_by_name( $person_name );
					if ( is_object( $person ) ) {
						add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
						$date_from = null;
						$type      = null;
						switch ( $index ) {
							case 4:
									$date_from = 0 < intval( $data[1] ) ? intval( $data[1] ) . '-01-01' : '';
									$type      = 'first';
								break;
							case 6:
								$type = 'current';
								break;
						}
						$owners[] = person( $person_name, $person, $date_from, $type );
					} else {
						echo $index . ' : ' . var_dump( $data[ $index ] );
						print_r( $data );
						print_r( $person );
					}
				}
			}
			if ( ! empty( $owners ) ) {
				add_post_meta( $post_ID, $owners_field_name, $owners, true );
			}
		}
	}

	/**
	 * update term  counter
	 */
	$get_terms_args = array(
		'taxonomy'   => $taxonomy_name_manufacturer,
		'fields'     => 'ids',
		'hide_empty' => false,
	);

	$update_terms = get_terms( $get_terms_args );
	wp_update_term_count_now( $update_terms, $update_taxonomy );



	fclose( $handle );
}

function person_clear_name( $name ) {
	$name      = preg_replace( '/ \' ?\d+$/', '', $name );
	$is_person = check_is_person( $name );
	if ( $is_person ) {
		$name = preg_replace( '/ [A-Z]{2,3}$/', '', $name );
	}
	switch ( $name ) {
		case 'St. Vincents Gulf 505 Association AUS':
			return 'St. Vincents Gulf 505 Association';
		case 'Tom Bojland':
			return 'Tom Bøjland';
		case 'Wolfgang Stuckl':
		case 'Wolfgang Stueckl':
		case 'Wolfgang Stuekl':
			return 'Wolfgang Stückl';
		case 'Y. Pajot':
			return 'Yves Pajot';
	}
	return $name;
}



function person( $raw, $person, $date_from = '', $order = false ) {
	if ( empty( $date_from ) && preg_match( '/ \\d{2}$/', $raw, $matches ) ) {
		$year = intval( $matches[1] );
		if ( 54 < $year ) {
			$year += 100;
		}
		$year     += 1900;
		$date_from = sprintf( '%d-01-01', $year );
	}
	return wp_parse_args(
		array(
			'first'     => 'first' === $order,
			'current'   => 'current' === $order,
			'user_id'   => $person->ID,
			'date_from' => $date_from,
		),
		array(
			'current'   => false,
			'first'     => false,
			'users_ids' => array(),
			'date_from' => '',
			'date_to'   => '',
		)
	);
}


function check_is_person( $data ) {
	switch ( $data ) {
		case 'St. George\'s School Sailing Club':
		case 'St. Johns Jr. College':
		case 'St. Vincents Gulf 505 Association':
		case 'Sawanaka Corinthian Yacht Club':
		case 'Burnham-Sharpe Co.':
		case 'Sailing club in Washington State':
		case 'School in Queen Anne':
		case 'some New England sailing academy.':
		case 'US Coastguard Academy':
		case 'Wansborough family':
		case 'Web Institute':
			return false;
	}
	return true;
}

