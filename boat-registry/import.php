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
$boat_post_type_name        = 'iworks_fleet_boat';
$taxonomy_name_manufacturer = 'iworks_fleet_boat_manufacturer';
$person_post_type_name      = 'iworks_fleet_person';
$result_post_type_name      = 'iworks_fleet_result';
$owners_field_name          = 'iworks_fleet_boat_owners';
$owners_index_field_name    = 'iworks_fleet_boot_owner_id';


$hull_manufacturer = array();
$data              = get_terms( $taxonomy_name_manufacturer, array( 'hide_empty' => false ) );
foreach ( $data as $one ) {
	$hull_manufacturer[ $one->name ] = $one;
}

$import_registry = $import_results = $import_sailors = false;

if ( sizeof( $argv ) === 1 ) {
	echo 'select parts to import:',PHP_EOL;
	echo '- all (all parts)',PHP_EOL;
	echo '- registry',PHP_EOL;
	echo '- sailors',PHP_EOL;
	echo '- results',PHP_EOL;
	exit;
}

/**
 * Setup import parts
 */
if ( in_array( 'all', $argv ) ) {
	$import_registry = $import_results = $import_sailors = true;
} else {
	if (
		in_array( 'registry', $argv )
		|| in_array( 'boats', $argv )
	) {
		$import_registry = true;
	}
	if ( in_array( 'sailors', $argv ) ) {
		$import_sailors = true;
	}
	if ( in_array( 'results', $argv ) ) {
		$import_results = true;
	}
}

/**
 * import sailors
 */
if ( $import_sailors && ( $handle = fopen( 'sailors.csv', 'r' ) ) !== false ) {
	echo PHP_EOL,'IMPORT: sailors.csv',PHP_EOL;
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( isset( $data[1] ) && ! empty( $data[1] ) ) {
			$p = person_clear_name( $data[1] );
			if ( empty( $p ) ) {
				continue;
			}
			$post = get_page_by_title( $p, OBJECT, $person_post_type_name );
			if ( ! empty( $post ) ) {
				echo 'x';
				continue;
			}
			echo '.';
			$post_array = array(
				'post_title'  => $p,
				'post_type'   => $person_post_type_name,
				'post_status' => 'publish',
				'meta_input'  => array(
					'iworks_fleet_personal_nation' => trim( $data[0] ),
				),
			);
			wp_insert_post( $post_array );
		} else {
			echo 'x';
		}
	}
}

$rows = array();
if ( $import_registry && ( $handle = fopen( 'registry.csv', 'r' ) ) !== false ) {
	echo PHP_EOL,'IMPORT: registry.csv',PHP_EOL;
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 1 > intval( $data[0] ) ) {
			continue;
		}
		$post = get_page_by_title( $data[0], OBJECT, $boat_post_type_name );
		if ( empty( $post ) ) {
			echo '.';
			/*
			 *  0 Sail No
			 *  1 Year Built
			 *  2 Builder
			 *  3 Name
			 *  4 Hull material
			 *  5 Description
			 *  6 First Owner
			 *  7 Subsequent Owners
			 *  8 Last Recorded Owner
			 *  9 Fleet/Sailing Club
			 * 10 City
			 * 11 Country
			 * 12 Last Updated
			 * 13 Colors
			 */

			$iworks_fleet_boat_hull_number   = intval( $data[0] );
			$iworks_fleet_boat_build_year    = intval( $data[1] );
			$iworks_fleet_hull_manufacturer  = trim( $data[2] );
			$iworks_fleet_boat_name          = trim( $data[3] );
			$iworks_fleet_boat_hull_material = trim( $data[4] );
			$post_content                    = trim( $data[5] );

			$iworks_fleet_boat_nation = trim( $data[11] );
			$iworks_fleet_boat_colors = explode( ';', trim( $data[13] ) );

			if ( ! is_string( $post_content ) ) {
				print_r( $post_content );
				die;
			}
			$post = array(
				'post_status'  => 'publish',
				'post_type'    => $boat_post_type_name,
				'post_title'   => $iworks_fleet_boat_hull_number,
				'post_content' => trim( $post_content ),
				'meta_input'   => array(
					'iworks_fleet_boat_hull_number' => $iworks_fleet_boat_hull_number,
				),
				'tax_input'    => array(),
			);
			/**
			 * simple meta
			 */
			foreach (
				array(
					'iworks_fleet_boat_hull_number',
					'iworks_fleet_boat_build_year',
					'iworks_fleet_boat_hull_material',
					'iworks_fleet_boat_name',
					'iworks_fleet_boat_nation',
				) as $key ) {
				if ( empty( $$key ) ) {
					continue;
				}
				$post['meta_input'][ $key ] = $$key;
			}
			if ( is_array( $iworks_fleet_boat_colors ) ) {
				if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
					$color = trim( array_shift( $iworks_fleet_boat_colors ) );
					if ( ! empty( $color ) ) {
						$post['meta_input']['iworks_fleet_boat_color_top'] = $color;
					}
					if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
						$color = trim( array_shift( $iworks_fleet_boat_colors ) );
						if ( ! empty( $color ) ) {
							$post['meta_input']['iworks_fleet_boat_color_side'] = $color;
						}
						if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
							$color = trim( array_shift( $iworks_fleet_boat_colors ) );
							if ( ! empty( $color ) ) {
								$post['meta_input']['iworks_fleet_boat_color_bottom'] = $color;
							}
						}
					}
				}
			}
			/**
			 * Hull builder
			 */
			if ( ! empty( $iworks_fleet_hull_manufacturer ) ) {
				switch ( $iworks_fleet_hull_manufacturer ) {
					case 'Parker/Nab':
					case 'Parker kit':
					case 'Parker launcher':
					case 'Parker-hulled Lindsay':
					case 'Rondar Parker':
						$iworks_fleet_hull_manufacturer = 'Parker';
						break;
					case 'builder':
					case 'Custom homebuilt':
					case 'home-build':
					case 'home-built':
					case 'self-built':
					case 'self-constructed':
					case 'self-made':
					case 'Builder':
						$iworks_fleet_hull_manufacturer = 'home built';
						break;
					case 'Honore Marine':
					case 'Honore Marine GB':
					case 'Honor Marine':
						$iworks_fleet_hull_manufacturer = 'Honnor Marine';
						break;
					case 'Polymec kit':
						$iworks_fleet_hull_manufacturer = 'Polymec';
						break;
					case 'International & Olympic Yachts':
						$iworks_fleet_hull_manufacturer = 'International & Olympic Yachts';
						break;
					case 'new mould (Kyrwood)':
					case 'Kyrwood hull':
					case 'Krywood':
						$iworks_fleet_hull_manufacturer = 'Kyrwood';
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
						$iworks_fleet_hull_manufacturer = 'home built';
						$post['post_content']          .= sprintf( '<p>builder: %s</p>', $iworks_fleet_hull_manufacturer );
						break;
					case 'Barklay':
					case 'Barclay / Winwood':
						$iworks_fleet_hull_manufacturer = 'Barclay';
						break;
					case 'Clark (Seattle)':
						$iworks_fleet_hull_manufacturer = 'Clark';
						break;
					case 'Schnieder':
						$iworks_fleet_hull_manufacturer = 'Schneider';
						break;
					case 'Copland GBR':
						$iworks_fleet_hull_manufacturer = 'Copland Boats';
						break;
					case 'Fountain-Pajot':
					case 'Fountaine Pajot':
					case 'Fountaine/Pajot':
					case 'Fountaine-Pajot/Illy Brummer':
					case 'Fountaine-Pajot':
						$iworks_fleet_hull_manufacturer = 'Fountain Pajot';
						break;
					case 'Ballenger/Meller':
						$iworks_fleet_hull_manufacturer = 'Ballenger';
						break;
					case 'G;H Marine':
						$iworks_fleet_hull_manufacturer = 'G&H Marine';
						break;
					case 'Pevear/Lindsay':
					case 'Lindsay':
					case 'Lindsay/ Grey':
						$iworks_fleet_hull_manufacturer = 'Mark Lindsay Boatbuilders';
						break;
					case 'Waterat':
						$iworks_fleet_hull_manufacturer = 'Waterat Sailing Equipment';
						break;
					case 'Moore/ Van Landingham':
						$iworks_fleet_hull_manufacturer = 'Moore';
						break;
					case 'Milanes White':
					case 'Milanes&White':
					case 'Milanes':
						$iworks_fleet_hull_manufacturer = 'Milanes & White';
						break;
					case 'Rowsell & Morrison':
					case 'Rowsell; Morrison':
						$iworks_fleet_hull_manufacturer = 'Rowsell and Morrison';
						break;
					case 'Collignon':
						$iworks_fleet_hull_manufacturer = 'Collingnon (CDK)';
						break;
					case 'Rondar(epoxy)':
						$iworks_fleet_hull_manufacturer = 'Rondar';
						break;
					case 'WitchCraft':
						$iworks_fleet_hull_manufacturer = 'Witchcraft';
						break;
					case 'Young Marine Systems':
					case 'Young Marine':
					case 'YMS':
						$iworks_fleet_hull_manufacturer = 'Young Marine Services';
						break;
					case 'Otto':
					case 'Kulmar':
						$iworks_fleet_hull_manufacturer = 'Kulmar / Otto';
						break;
					case 'Fremantle':
					case 'Freemantle':
					case 'Fremantle/XSP':
						$iworks_fleet_hull_manufacturer = 'Fremantle 505';
						break;
					case 'VanMunster/ Pegasus':
					case 'Pegasus':
						$iworks_fleet_hull_manufacturer = 'Van Munster';
						break;
					case 'Segelsport Jess':
						$iworks_fleet_hull_manufacturer = 'JESS Segelsport';
						break;
					case 'Duvosion':
						$iworks_fleet_hull_manufacturer = 'Duvoisin';
						break;
					case 'P&B/ Ovington':
						$iworks_fleet_hull_manufacturer = 'P&B/Ovington';
						break;
					case 'Jess Ovington':
						$iworks_fleet_hull_manufacturer = 'Jess/Ovington';
						break;
				}
				if ( ! array_key_exists( htmlentities( $iworks_fleet_hull_manufacturer ), $hull_manufacturer ) ) {
					$hull_manufacturer[ $iworks_fleet_hull_manufacturer ] = wp_insert_term( $iworks_fleet_hull_manufacturer, $taxonomy_name_manufacturer );
				}
			}
			$post_ID = wp_insert_post( $post );
			wp_set_post_terms( $post_ID, array( $iworks_fleet_hull_manufacturer ), $taxonomy_name_manufacturer );

			/**
			 * owners
			 */
			$owners = array();
			foreach ( array( 6, 7, 8 ) as $index ) {
				if ( empty( $data[ $index ] ) ) {
					continue;
				}
				$data[ $index ] = trim( $data[ $index ] );
				$data[ $index ] = preg_replace( '/\-$/', '', $data[ $index ] );
				if ( empty( $data[ $index ] ) ) {
					continue;
				}
				foreach ( preg_split( '/[;\t\,]/', $data[ $index ] ) as $persons ) {
					$persons = trim( $persons );
					if ( empty( $persons ) ) {
						continue;
					}
					/**
					 * set info
					 */
					$date_from = null;
					$type      = null;
					switch ( $index ) {
						case 6:
							$date_from = 0 < intval( $data[1] ) ? intval( $data[1] ) . '-01-01' : '';
							$type      = 'first';
							break;
						case 7:
							break;
						case 8:
							$type = 'current';
							break;
					}
					/**
					 * check is more than one
					 */
					$persons = preg_split( '/[\&\/]/', $persons );
					if ( 1 < sizeof( $persons ) ) {
						$users_ids = array();
						foreach ( $persons as $name ) {
							$date_from = null;
							$name      = trim( $name );
							$name      = preg_replace( '/\-$/', '', $name );
							if ( empty( $name ) ) {
								continue;
							}
							if ( preg_match( '/[\'`\t ](\d+)$/', $name, $matches ) ) {
								$name = preg_replace( '/[\'`\t ]+\d+$/', '', $name );
								$year = $matches[1];
								if ( 56 > $year ) {
									$year += 100;
								}
								$year     += 1900;
								$date_from = sprintf( '%d-01-01', $year );
							}
							$person = get_person_by_name( $name );
							if ( is_object( $person ) ) {
								add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
								$users_ids[] = $person->ID;
							}
						}
						$o = add_more_owners( $users_ids, $date_from, $type );
						if ( ! empty( $o ) ) {
							$owners[] = $o;
						}
					} else {
						foreach ( $persons as $name ) {
							$name = trim( $name );
							if ( empty( $name ) ) {
								continue;
							}
							$person = get_person_by_name( $name );
							if ( is_object( $person ) ) {
								add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
								$owners[] = person( $name, $person, $date_from, $type );
							} else {
								$owners[] = add_organization( $name, $person, $date_from, $type );
							}
						}
					}
				}
			}
			if ( ! empty( $owners ) ) {
				add_post_meta( $post_ID, $owners_field_name, $owners, true );
			}
		} else {
			echo 'x';
			// echo 'x(',$data[0],')';
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
	wp_update_term_count_now( $update_terms, $taxonomy_name_manufacturer );

	fclose( $handle );
}

/**
 * Import events
 */
if ( $import_results && ( $handle = fopen( 'events-list.csv', 'r' ) ) !== false ) {
	$series = array();
	echo PHP_EOL,'IMPORT: events-list.csv',PHP_EOL;
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 1 > intval( $data[0] ) ) {
			continue;
		}
		/*
		[0] => iworks_fleet_result_date_start
		[1] => iworks_fleet_result_date_end
		[2] => post_title
		[3] => iworks_fleet_result_number_of_races
		[4] => iworks_fleet_result_number_of_competitors
		[5] => iworks_fleet_result_location
		[6] => iworks_fleet_result_organizer
		[7] => iworks_fleet_result_secretary
		[8] => iworks_fleet_result_arbiter
		[9] => iworks_fleet_result_wind_direction
		[10] => iworks_fleet_result_wind_power
		[11] => post_content
		[12] => file
		[13] => iworks_fleet_serie
		 */
		$fields = array(
			0  => 'iworks_fleet_result_date_start',
			1  => 'iworks_fleet_result_date_end',
			2  => 'post_title',
			3  => 'iworks_fleet_result_number_of_races',
			4  => 'iworks_fleet_result_number_of_competitors',
			5  => 'iworks_fleet_result_location',
			6  => 'iworks_fleet_result_organizer',
			7  => 'iworks_fleet_result_secretary',
			8  => 'iworks_fleet_result_arbiter',
			9  => 'iworks_fleet_result_wind_direction',
			10 => 'iworks_fleet_result_wind_power',
			11 => 'post_content',
			12 => 'file',
			13 => 'iworks_fleet_serie',
		);
		foreach ( $fields as $index => $key ) {
			$value = trim( $data[ $index ] );
			switch ( $key ) {
				case 'iworks_fleet_result_date_start':
				case 'iworks_fleet_result_date_end':
					$value = strtotime( $value );
					break;
				case 'iworks_fleet_result_number_of_races':
				case 'iworks_fleet_result_number_of_competitors':
					$value = intval( $value );
					break;
			}
			$$key = trim( $value );
		}
		/**
		 * check file
		 */
		echo $post_title,PHP_EOL;
		echo 'FILE: ' . $file;
		$file = '../' . $file;
		if ( ! is_file( $file ) ) {
			echo ' - NO FILE!',PHP_EOL;
			continue;
		}
		/**
		 * Check already exists
		 */
		$args  = array(
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'post_type'      => $result_post_type_name,
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'   => 'iworks_fleet_result_date_start',
					'value' => $iworks_fleet_result_date_start,
				),
				array(
					'key'   => 'iworks_fleet_result_date_end',
					'value' => $iworks_fleet_result_date_end,
				),
			),
		);
		$query = new WP_Query( $args );
		if ( 0 < $query->post_count ) {
			add_filter( 'iworks_fleet_result_skip_year_in_title', '__return_true' );
			foreach ( $query->posts as $post_ID ) {
				$test = preg_replace( '/&#8211;/', '-', get_the_title( $post_ID ) );
				$test = preg_replace( '/&amp;/', '&', $test );
				if ( $test === $post_title ) {
					echo 'SKIP: ',$post_title,PHP_EOL;
					continue 2;
				}
			}
			remove_filter( 'iworks_fleet_result_skip_year_in_title', '__return_true' );
		}
		$post_array = array(
			'post_name'   => sanitize_title( sprintf( '%s-%s', date( 'Y-m', $iworks_fleet_result_date_start ), $post_title ) ),
			'post_type'   => $result_post_type_name,
			'post_status' => 'publish',
			'meta_input'  => array(),
			'tax_input'   => array(
				'iworks_fleet_serie' => array(),
			),
		);
		foreach ( $fields as $field ) {
			if ( empty( $$field ) ) {
				continue;
			}
			if ( preg_match( '/^post_/', $field ) ) {
				$post_array[ $field ] = $$field;
				continue;
			}
			if ( 'iworks_fleet_serie' === $field ) {
				if ( empty( $value ) ) {
					continue;
				}
				$this_series = array();
				foreach ( explode( ',', $value ) as $serie ) {
					$serie = trim( $serie );
					if ( isset( $series[ $serie ] ) && is_object( $series[ $serie ] ) ) {
						$post_array['tax_input'][ $field ][] = $series[ $serie ]->term_id;
					} else {
						$series[ $serie ] = wp_insert_term( $serie, $field );
						$series[ $serie ] = get_term_by( 'name', $serie, $field );
						if ( is_object( $series[ $serie ] ) ) {
							$post_array['tax_input'][ $field ][] = $series[ $serie ]->term_id;
						} else {
							print_r( [ $serie, $series ] );
							die;
						}
					}
				}
				continue;
			}
			$post_array['meta_input'][ $field ] = $$field;
		}
		if ( empty( $post_array['post_title'] ) ) {
			continue;
		}
		$post_ID = wp_insert_post( $post_array );
		/**
		 * update taxonomies
		 */
		foreach ( $post_array['tax_input'] as $taxonomy => $terms ) {
			wp_set_object_terms( $post_ID, $terms, $taxonomy );
		}
		/**
		 * import results
		 */
		if ( ( $handle2 = fopen( $file, 'r' ) ) !== false ) {
			$regatta_data = array();
			while ( ( $d = fgetcsv( $handle2, 0, ',' ) ) !== false ) {
				$regatta_data[] = $d;
			}
			fclose( $handle2 );
			if ( empty( $regatta_data ) ) {
				echo ' - EMPTY FILE!',PHP_EOL;
			} else {
				echo PHP_EOL;
				echo 'Begin import, rows: ', count( $regatta_data ) ,PHP_EOL;
				do_action( 'iworks_fleet_result_import_data', $post_ID, $regatta_data );
			}
		}
		echo PHP_EOL;
	}
}

echo PHP_EOL,PHP_EOL;
